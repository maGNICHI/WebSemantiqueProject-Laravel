<?php

namespace App\Http\Controllers;

use App\Models\Destination;
use Illuminate\Http\Request;
use App\Models\Itineraire; // Ajoutez cette ligne pour importer le modèle

class ItineraireController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        
    $itineraire = Itineraire::orderBy('created_at', 'desc')->get();

    // Retourne la vue avec les itinéraires
    return view('itineraires', compact('itineraire'));
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $destinations = Destination::all(); // Récupérer toutes les destinations
        return view('create', compact('destinations')); // Passer les destinations à la vue
    }
    

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
// Valider les données d'entrée
$request->validate([
    'nom' => 'required|string|max:255',
    'description' => 'required|string',
    'duree' => 'required|string|max:100',
    'destination_id' => 'required|exists:destinations,id',
]);

// Créer un nouvel itinéraire
Itineraire::create([
    'nom' => $request->nom,
    'description' => $request->description,
    'duree' => $request->duree,
    'destination_id' => $request->destination_id,
]);

// Rediriger vers la liste des itinéraires
return redirect('/itineraires')->with('success', 'Itinéraire ajouté avec succès.');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $itineraire = Itineraire::findOrFail($id); // Trouver l'itinéraire par son ID
        $destinations = Destination::all();
        return view('edit', compact('itineraire', 'destinations')); // Retourner la vue avec l'itinéraire    }
    }
    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $itineraire = Itineraire::findOrFail($id); // Trouver l'itinéraire par son ID

        // Valider les données du formulaire
        $request->validate([
            'nom' => 'required|string|max:255',
            'description' => 'required|string',
            'duree' => 'required|string|max:255',
            'destination_id' => 'required|exists:destinations,id',
        ]);

        // Mettre à jour l'itinéraire
        $itineraire->nom = $request->nom;
        $itineraire->description = $request->description;
        $itineraire->duree = $request->duree;
        $itineraire->destination_id = $request->destination_id;
        $itineraire->save(); // Enregistrer les modifications

        return redirect()->route('itineraires.index')->with('success', 'Itinéraire mis à jour avec succès!');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $itineraire = Itineraire::findOrFail($id); // Trouver l'itinéraire par son ID
        $itineraire->delete(); // Supprimer l'itinéraire

        return redirect()->route('itineraires.index')->with('success', 'Itinéraire supprimé avec succès'); // Rediriger avec message
        }
        public function itineraireStem()
{
    // Récupère les itinéraires triés par date de création
    $itineraire = Itineraire::orderBy('created_at', 'desc')->get();

    // Retourne la vue 'itinerairestem_template' avec les données des itinéraires
    return view('itinerairestem', compact('itineraire'));
}

}
