<?php

namespace App\Http\Controllers;

use App\Models\WeLoveGreen;
use App\Services\ApiService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class WeLoveGreenController extends Controller
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
            'description' => 'required|string|max:255',
            'lieu' => 'required|string',
            'nom' => 'required|string',
        ]);
    
        // Appel du service pour ajouter le WeLoveGreen
        $response = $this->apiService->addWeLoveGreen($validatedData);
    
        // Vérifier si la réponse contient une erreur
        if (isset($response['error']) && $response['error']) {
            return response()->json([
                'success' => false,
                'message' => $response['message'],
                'details' => $response['response'],
            ], 500);
        }
    
        // Redirection vers la liste des WeLoveGreen avec un message de succès
        return redirect()->route('welovegreen.index')->with('success', 'We Love Green ajouté avec succès');
    }

    public function create()
    {
        return view('createwelovegreen');
    }

    public function index(Request $request)
    {
        $search = $request->input('search'); // Get search input
        $response = Http::get('http://localhost:8085/weLoveGreens');

        // Vérifiez si la requête a réussi
        if (!$response->successful()) {
            return response()->json([
                'success' => false,
                'message' => 'Erreur lors de la récupération des We Love Green',
                'details' => $response->body(),
            ], 500);
        }
    
        // Transformez la réponse JSON en une collection d'objets
        $results = $response->json()['results'];

        // Extraire les We Love Green de 'bindings' et les mettre dans un tableau
        $welovegreen = collect($results['bindings'])->map(function ($binding) {
            return (object) [
                'id' => $binding['WeLoveGreen']['value'] ?? null,
                'description' => $binding['description']['value'] ?? 'N/A',
                'lieu' => $binding['lieu']['value'] ?? 'N/A',
                'nom' => $binding['nom']['value'] ?? 'N/A'
            ];
        });

        // Filtrer par nom si une recherche est demandée
        if ($search) {
            $welovegreen = $welovegreen->filter(function ($we) use ($search) {
                return stripos($we->nom, $search) !== false; // Case-insensitive search
            });
        }

        // Retournez la vue avec les données des We Love Green
        return view('welovegreen', compact('welovegreen', 'search'));
    }
}