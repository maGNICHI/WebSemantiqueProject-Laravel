<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Transport; // Assurez-vous que cette ligne est présente
use App\Models\Itineraire; // Ajoutez cette ligne pour importer le modèle Itineraire
use PDF; // Importe la Facade PDF


class TransportController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $transports = Transport::with('itineraire')->orderBy('created_at', 'desc')->get();

    // Retourne la vue avec les transports
    return view('transports', compact('transports')); // Passe les transports à la vue
 }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

        $itineraire = Itineraire::all(); // Récupère tous les itinéraires
        return view('createtrans', compact('itineraire')); // Passe les itinéraires à la vue

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // Validation des données
        $request->validate([
            'type' => 'required|string',
            'description' => 'nullable|string',
            'capacite' => 'required|integer',
            'itineraire_id' => 'required|exists:itineraires,id',
        ]);

        // Création du transport
        Transport::create($request->all());

        // Redirection vers la liste des transports
        return redirect()->route('transports.index')->with('success', 'Transport ajouté avec succès !');

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
        $transport = Transport::findOrFail($id); // Récupère le transport par son ID
        $itineraire = Itineraire::all(); // Récupère tous les itinéraires pour le menu déroulant
        return view('edittransport', compact('transport', 'itineraire')); // Passe le transport et les itinéraires à la vue
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
        $request->validate([
            'type' => 'required|string',
            'description' => 'required|string',
            'capacite' => 'required|integer',
            'itineraire_id' => 'required|exists:itineraires,id',
        ]);

        // Mise à jour du transport
        $transport = Transport::findOrFail($id);
        $transport->update($request->all());

        // Redirection vers la liste des transports
        return redirect()->route('transports.index')->with('success', 'Transport mis à jour avec succès !');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $transport = Transport::findOrFail($id);
        $transport->delete(); // Supprime le transport

        // Redirection vers la liste des transports
        return redirect()->route('transports.index')->with('success', 'Transport supprimé avec succès !');
    }
    public function transportStem()
    {
        // Récupère les transports avec les itinéraires associés triés par date de création
        $transports = Transport::with('itineraire')->orderBy('created_at', 'desc')->get();

        // Retourne la vue 'transportstem_template' avec les données des transports
        return view('transportstem', compact('transports'));
    }
    public function search(Request $request)
    {
        $query = Transport::query();

        if ($request->filled('type')) {
            $query->where('type', $request->type);
        }

        // Modifier ici l'opérateur pour chercher une capacité exacte
        if ($request->filled('capacite')) {
            $query->where('capacite', '=', $request->capacite);
        }

        if ($request->filled('duree')) {
            $query->whereHas('itineraire', function($q) use ($request) {
                $q->where('duree', '=', $request->duree);
            });
        }


        $transports = $query->with('itineraire')->get();

        return view('transportstem', compact('transports'));
    }
    public function downloadPDF($id)
    {
        $transport = Transport::with('itineraire')->findOrFail($id);

        // Créer le HTML du PDF
        $html = '
        <!DOCTYPE html>
        <html>
        <head>
            <title>Détails du Transport</title>
            <style>
                body { font-family: "DejaVu Sans", sans-serif; }
                .card { border: 1px solid #ddd; padding: 10px; margin: 10px 0; }
                .card-footer { text-align: right; }
            </style>
        </head>
        <body>
            <div class="card">
                <h1>Détails du Transport</h1>
                <p><strong>Type :</strong> ' . $transport->type . '</p>
                <p><strong>Description :</strong> ' . $transport->description . '</p>
                <p><strong>Capacité :</strong> ' . $transport->capacite . '</p>';

        if ($transport->itineraire) {
            $html .= '<p><strong>Itinéraire :</strong> ' . $transport->itineraire->nom . '</p>';
            $html .= '<p><strong>Durée :</strong> ' . $transport->itineraire->duree . '</p>'; // Ajoute la durée ici

        } else {
            $html .= '<p><strong>Itinéraire :</strong> Aucun itinéraire associé</p>';
        }

        $html .= '</div></body></html>';

        // Charger le HTML pour le PDF
        $pdf = PDF::loadHTML($html);

        // Retourne le PDF avec un nom de fichier personnalisé
        return $pdf->download('transport_' . $transport->id . '.pdf');
    }
}
