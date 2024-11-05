<?php

namespace App\Http\Controllers;

use App\Models\Activite;
use App\Models\User;
use Illuminate\Http\Request;

class ActiviteController extends Controller
{
    // 1. Afficher la liste des activités (Read)
    public function index()
    {
         // Récupérer toutes les activités
    $activites = Activite::orderBy('created_at', 'desc')->get();

    // Calculer le nombre d'activités par heure
    $activitiesPerHour = Activite::selectRaw('HOUR(created_at) as hour, COUNT(*) as count')
        ->groupBy('hour')
        ->orderBy('hour')
        ->get();

    // Renvoyer les données à la vue
    return view('activites.index', compact('activites', 'activitiesPerHour'));
    }

    // 2. Afficher le formulaire de création d'une nouvelle activité (Create)
    public function create()
    {
        return view('activites.create');
    }

    // 3. Enregistrer une nouvelle activité dans la base de données (Store)
    public function store(Request $request)
    {
        $request->validate([
            'titre' => 'required|string|max:255|min:4',
            'contenu' => 'required|string|min:20',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $imageName = null;
        if ($request->hasFile('image')) {
            $imageName = time() . '.' . $request->image->extension();
            $request->image->move(public_path('uploads'), $imageName);
        }

        Activite::create([
            'titre' => $request->titre,
            'contenu' => $request->contenu,
            'image' => $imageName,
            'user_id' => auth()->id() ?: 1,
        ]);

        return redirect()->route('activites.index')->with('success', 'Activité ajoutée avec succès');
    }

    // 4. Afficher une activité spécifique (Show)
    public function show($id)
    {
        $activite = Activite::with('avis')->findOrFail($id);
        return view('activites.show', compact('activite'));
    }

    // 5. Afficher le formulaire d'édition d'une activité (Edit)
    public function edit($id)
    {
        $activite = Activite::findOrFail($id);
        return view('activites.edit', compact('activite'));
    }

    // 6. Mettre à jour une activité (Update)
    public function update(Request $request, $id)
    {
        $request->validate([
            'titre' => 'required|string|max:255',
            'contenu' => 'required|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $activite = Activite::findOrFail($id);

        if ($request->hasFile('image')) {
            // Supprimer l'ancienne image si elle existe
            if ($activite->image && file_exists(public_path('uploads/' . $activite->image))) {
                unlink(public_path('uploads/' . $activite->image));
            }
            // Upload de la nouvelle image
            $file = $request->file('image');
            $filename = time() . '_' . $file->getClientOriginalName();
            $file->move(public_path('uploads'), $filename);
            $activite->image = $filename;
        }

        $activite->titre = $request->input('titre');
        $activite->contenu = $request->input('contenu');
        $activite->save();

        return redirect()->route('activites.index')->with('success', 'Activité modifiée avec succès');
    }

    // 7. Supprimer une activité (Delete)
    public function destroy($id)
    {
        $activite = Activite::findOrFail($id);
        $activite->delete();

        return redirect()->route('activites.index')->with('success', 'Activité supprimée avec succès');
    }

    // 8. Afficher les activités triées (Stem)
    public function activiteStem(Request $request)
    {
        $search = $request->input('search');

        if ($search) {
            $activites = Activite::where('titre', 'like', '%' . $search . '%')->orderBy('created_at', 'desc')->get();
        } else {
            $activites = Activite::orderBy('created_at', 'desc')->get();
        }

        return view('activites.activitestem', compact('activites', 'search'));
    }
    public function like($id)
    {
        $activite = Activite::findOrFail($id);
        
        if (auth()->check() && !$activite->isLikedBy(auth()->user())) {
            $activite->likes()->attach(auth()->id());
        }

        return redirect()->back()->with('success', 'Vous avez aimé cette activité.');
    }

    public function unlike($id)
    {
        $activite = Activite::findOrFail($id);
        
        if ($activite->isLikedBy(auth()->user())) {
            $activite->likes()->detach(auth()->id());
        }

        return redirect()->back()->with('success', 'Vous n\'aimez plus cette activité.');
    }
}
