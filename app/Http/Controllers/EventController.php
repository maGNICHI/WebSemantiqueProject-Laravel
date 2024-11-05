<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Event;
use App\Models\Destination; // Assurez-vous d'importer le modèle Destination

class EventController extends Controller
{
    /**
     * Affiche la liste des événements.
     */
    public function index()
    {
        $events = Event::with('destination')->orderBy('created_at', 'desc')->get();
        return view('events.index', compact('events'));
    }

    /**
     * Affiche le formulaire pour créer un nouvel événement.
     */
    public function create()
    {
        $destinations = Destination::all(); // Récupère toutes les destinations pour le menu déroulant
        return view('events.create', compact('destinations'));
    }

    /**
     * Enregistre un nouvel événement.
     */
    public function store(Request $request)
    {
        // Validation des données
        $request->validate([
            'nom' => 'required|string|max:255',
            'description' => 'nullable|string',
            'date_debut' => 'required|date',
            'date_fin' => 'required|date|after_or_equal:date_debut',
            'destination_id' => 'required|exists:destinations,id',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);
        $imageName = null;
        if ($request->hasFile('image')) {
            $imageName = time() . '.' . $request->image->extension();
            $request->image->move(public_path('uploads'), $imageName);
        }
    
        // Création de l'événement
        Event::create([
            'nom' => $request->nom,
            'description' => $request->description,
            'date_debut' => $request->date_debut,
            'date_fin' => $request->date_fin,
            'destination_id' => $request->destination_id,
            'image' => $imageName,
        

        ]);

        return redirect()->route('events.index')->with('success', 'Événement ajouté avec succès !');
    }

    /**
     * Affiche le formulaire pour modifier un événement.
     */
    public function edit($id)
    {
        $event = Event::findOrFail($id);
        $destinations = Destination::all(); // Récupère toutes les destinations pour le menu déroulant
        return view('events.edit', compact('event', 'destinations'));
    }

    /**
     * Met à jour un événement.
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'nom' => 'required|string|max:255',
            'description' => 'nullable|string',
            'date_debut' => 'required|date',
            'date_fin' => 'required|date|after_or_equal:date_debut',
            'destination_id' => 'required|exists:destinations,id',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $event = Event::findOrFail($id);
        if ($request->hasFile('image')) {
            // Supprimer l'ancienne image si elle existe
            if ($event->image && file_exists(public_path('uploads/' . $event->image))) {
                unlink(public_path('uploads/' . $event->image));
            }
            // Upload de la nouvelle image
            $file = $request->file('image');
            $filename = time() . '_' . $file->getClientOriginalName();
            $file->move(public_path('uploads'), $filename);
            $event->image = $filename;
        }
        $event->update($request->all());

        return redirect()->route('events.index')->with('success', 'Événement mis à jour avec succès !');
    }

    /**
     * Supprime un événement.
     */
    public function destroy($id)
    {
        $event = Event::findOrFail($id);
        $event->delete();

        return redirect()->route('events.index')->with('success', 'Événement supprimé avec succès !');
    }
    public function event()
    {
        $events = Event::all();
        return view('events.event', compact('events'));
    }
}
