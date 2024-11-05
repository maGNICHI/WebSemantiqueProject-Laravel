<?php

namespace App\Http\Controllers;

use App\Models\Avion;
use App\Services\ApiService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class AvionController extends Controller
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
            'prix' => 'required|numeric',
            'description' => 'required|string|max:255',
        ]);
    
        // Appel du service pour ajouter l'avion
        $response = $this->apiService->addAvion($validatedData);
    
        // Vérifier si la réponse contient une erreur
        if (isset($response['error']) && $response['error']) {
            return response()->json([
                'success' => false,
                'message' => $response['message'],
                'details' => $response['response'],
            ], 500);
        }
    
        // Redirection vers la liste des avions avec un message de succès
        return redirect()->route('avions.index')->with('success', 'Avion ajouté avec succès');
    }

    public function create()
    {
        return view('createavion');
    }

    public function index(Request $request)
    {
        $search = $request->input('search');

        $response = Http::get('http://localhost:8085/avions');
    
        // Vérifiez si la requête a réussi
        if (!$response->successful()) {
            return response()->json([
                'success' => false,
                'message' => 'Erreur lors de la récupération des avions',
                'details' => $response->body(),
            ], 500);
        }
    
        // Transformez les données de la réponse en une collection d'objets
        $results = $response->json()['results'];
        $avions = collect($results['bindings'])->map(function ($binding) {
            return (object) [
                'id' => $binding['avion']['value'], // Utiliser un identifiant unique si disponible
                'prix' => $binding['prix']['value'], // Le prix
                'description' => $binding['description']['value'], // La description
            ];
        });

        // Filter the avions if a search query is provided
        if ($search) {
            $avions = $avions->filter(function ($avion) use ($search) {
                return stripos($avion->prix, $search) !== false; // Case-insensitive search
            });
        }

        // Retournez la vue avec les données des avions
        return view('avions', compact('avions', 'search'));
    }

    // Delete method
    public function destroy($id)
    {
        $response = Http::delete("http://localhost:8085/deleteAvion/{$id}");

        // Vérifiez si la requête a réussi
        if (!$response->successful()) {
            return response()->json([
                'success' => false,
                'message' => 'Erreur lors de la suppression de l\'avion',
                'details' => $response->body(),
            ], 500);
        }
    
        // Redirection vers la liste des avions avec un message de succès
        return redirect()->route('avions.index')->with('success', 'Avion supprimé avec succès');
    }
}