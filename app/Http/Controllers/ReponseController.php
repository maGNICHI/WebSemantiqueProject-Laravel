<?php

namespace App\Http\Controllers;

use App\Models\Reclamation;
use App\Models\Reponse;
use Illuminate\Http\Request;

class ReponseController extends Controller
{
    public function store(Request $request, Reclamation $reclamation)
    {
        $request->validate([
            'message' => 'required|string|min:10|max:500', 
        ]);
    
        // Création de la réponse
        Reponse::create([
            'message' => $request->message,
            'reclamation_id' => $reclamation->id,
        ]);
        
        // Met à jour l'état de la réclamation
        $reclamation->etat = 'déjà traitée'; // Changez ici le texte selon vos besoins
        $reclamation->save();
    
        return redirect()->route('reclamations.show', $reclamation->id)->with('success', 'Réponse ajoutée avec succès et l\'état de la réclamation a été mis à jour.');
    }

    public function destroy(Reclamation $reclamation, Reponse $reponse)
    {
        $reponse->delete();
        return redirect()->route('reclamations.show', $reclamation->id)->with('success', 'Réponse supprimée avec succès.');
    }
}
