<?php

namespace App\Http\Controllers;

use App\Models\MuseeLouvre;
use App\Services\ApiService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class MuseeLouvreController extends Controller
{
    protected $apiService;

    public function __construct(ApiService $apiService)
    {
        $this->apiService = $apiService;
    }

    public function store(Request $request)
    {
        // Validation des données d'entrée
        $validatedData = $request->validate([
            'titre' => 'required|string',
            'description' => 'required|string|max:255',
        ]);
    
        // Appel du service pour ajouter le musée
        $response = $this->apiService->addMuseeLouvre($validatedData);
    
        // Vérifier si la réponse contient une erreur
        if (isset($response['error']) && $response['error']) {
            return response()->json([
                'success' => false,
                'message' => $response['message'],
                'details' => $response['response'],
            ], 500);
        }
    
        // Redirection vers la liste des musées avec un message de succès
        return redirect()->route('museelouvre.index')->with('success', 'Musée ajouté avec succès');
    }

    public function create()
    {
        return view('createmuseelouvre');
    }

    public function index(Request $request)
    {
        $search = $request->input('search');
        $response = Http::get('http://localhost:8085/museelouvre');
    
        // Vérifiez si la requête a réussi
        if (!$response->successful()) {
            return response()->json([
                'success' => false,
                'message' => 'Erreur lors de la récupération des musées',
                'details' => $response->body(),
            ], 500);
        }
    
        // Transformez la réponse JSON en une collection d'objets
        $results = $response->json()['results'];

        // Extraire les musées de 'bindings' et les mettre dans un tableau
        $museelouvre = collect($results['bindings'])->map(function ($binding) {
            return (object) [
                'id' => $binding['MuseeLouvre']['value'] ?? null,
                'titre' => $binding['titre']['value'] ?? 'N/A',
                'description' => $binding['description']['value'] ?? 'N/A'
            ];
        });
        if ($search) {
            $museelouvre = $museelouvre->filter(function ($musee) use ($search) {
                return stripos($musee->titre, $search) !== false;
            });
        }
    
        // Retournez la vue avec les données filtrées des musées
        return view('museelouvre', compact('museelouvre', 'search'));
    }
}