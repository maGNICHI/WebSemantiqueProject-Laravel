<?php

namespace App\Http\Controllers;

use App\Models\Bateau;
use App\Services\ApiService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class BateauController extends Controller
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
        $response = $this->apiService->addBateau($validatedData);
    
        // Vérifier si la réponse contient une erreur
        if (isset($response['error']) && $response['error']) {
            return response()->json([
                'success' => false,
                'message' => $response['message'],
                'details' => $response['response'],
            ], 500);
        }
    
        // Redirection vers la liste des avions avec un message de succès
        return redirect()->route('bateau.index')->with('success', 'bateau ajouté avec succès');
    }
    public function create()
    {
        return view('createbateau');
    }
    public function index()
    {
        $response = Http::get('http://localhost:8085/bateaux');
    
        // Vérifiez si la requête a réussi
        if (!$response->successful()) {
            return response()->json([
                'success' => false,
                'message' => 'Erreur lors de la récupération des bateau',
                'details' => $response->body(),
            ], 500);
        }
    
        // Transformez la réponse JSON en une collection d'objets
 // Transformez les données de la réponse en une collection d'objets
   // Transformez les données de la réponse en une collection d'objets
   $results = $response->json()['results'];

   // Extraire les avions de 'bindings' et les mettre dans un tableau
   $bateau = collect($results['bindings'])->map(function ($binding) {
       return (object) [
           'id' => $binding['bateau']['value'], // Utiliser un identifiant unique si disponible
           'prix' => $binding['prix']['value'], // Le prix
           'description' => $binding['description']['value'], // La description
       ];
   });
        // Retournez la vue avec les données des avions
        return view('bateau', compact('bateau'));
    }
    
 

}
