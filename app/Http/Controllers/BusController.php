<?php

namespace App\Http\Controllers;

use App\Models\Bus;
use App\Services\ApiService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class BusController extends Controller
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
        $response = $this->apiService->addBus($validatedData);
    
        // Vérifier si la réponse contient une erreur
        if (isset($response['error']) && $response['error']) {
            return response()->json([
                'success' => false,
                'message' => $response['message'],
                'details' => $response['response'],
            ], 500);
        }
    
        // Redirection vers la liste des avions avec un message de succès
        return redirect()->route('bus.index')->with('success', 'Bus ajouté avec succès');
    }
    public function create()
    {
        return view('createbus');
    }
    public function index()
    {
        $response = Http::get('http://localhost:8085/buses');
    
        // Vérifiez si la requête a réussi
        if (!$response->successful()) {
            return response()->json([
                'success' => false,
                'message' => 'Erreur lors de la récupération des bus',
                'details' => $response->body(),
            ], 500);
        }
    
        // Transformez la réponse JSON en une collection d'objets
 // Transformez les données de la réponse en une collection d'objets
   // Transformez les données de la réponse en une collection d'objets
   $results = $response->json()['results'];

   // Extraire les avions de 'bindings' et les mettre dans un tableau
   $bus = collect($results['bindings'])->map(function ($binding) {
       return (object) [
           'id' => $binding['bus']['value'], // Utiliser un identifiant unique si disponible
           'prix' => $binding['prix']['value'], // Le prix
           'description' => $binding['description']['value'], // La description
       ];
   });
        // Retournez la vue avec les données des avions
        return view('bus', compact('bus'));
    }
    
 

}
