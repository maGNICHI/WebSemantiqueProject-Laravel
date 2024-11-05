<?php

namespace App\Http\Controllers;

use App\Models\Reclamation;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Barryvdh\DomPDF\Facade\Pdf;
use App\Exports\ReclamationsExport;
use Maatwebsite\Excel\Facades\Excel;
use ConsoleTVs\Charts\Facades\Charts;

class ReclamationController extends Controller
{
    public function index()
    {
        // Récupère uniquement les réclamations de l'utilisateur connecté avec les réponses associées
        $reclamations = Reclamation::where('user_id', auth()->id())->with('reponses')->get();
        return view('reclamations.index', compact('reclamations'));
    }

    public function generatePDF($id)
    {
        // Récupère la réclamation avec les réponses associées
        $reclamation = Reclamation::with('reponses')->findOrFail($id);

        // Génère le PDF de la réclamation
        $pdf = Pdf::loadView('reclamations.pdf', compact('reclamation'));

        return $pdf->download('reclamation_' . $reclamation->id . '.pdf');
    }

    public function exportExcel()
    {
        // Exporte les réclamations au format Excel
        return Excel::download(new ReclamationsExport, 'reclamations.xlsx');
    }

    public function index1()
    {
        // Récupère toutes les réclamations pour l'administrateur avec les utilisateurs associés
        $reclamations = Reclamation::with('user')->get();
        return view('reclamations.index1', compact('reclamations'));
    }

    public function statistiques()
    {
        $chart = Charts::database(Reclamation::all(), 'bar', 'highcharts')
            ->title('Répartition des réclamations par état')
            ->elementLabel('Nombre de réclamations')
            ->groupBy('etat');

        return view('reclamations.stats', compact('chart'));
    }

    public function exportStatistiquesPDF()
    {
        
        $chart = Charts::database(Reclamation::all(), 'bar', 'highcharts')
            ->title('Répartition des réclamations par état')
            ->elementLabel('Nombre de réclamations')
            ->groupBy('etat');

        // Génération du PDF
        $pdf = Pdf::loadView('reclamations.stats-pdf', compact('chart'));

        return $pdf->download('statistiques_reclamations.pdf');
    }

    public function create()
    {

        return view('reclamations.create');
    }

    public function store(Request $request)
    {
     
        $request->validate([
            'sujet' => 'required|string|max:10',
            'description' => 'required|string|min:10',
        ], [
            'sujet.required' => 'Le sujet est obligatoire.',
            'sujet.max' => 'Le sujet ne doit pas dépasser 10 caractères.',
            'description.required' => 'La description est obligatoire.',
            'description.min' => 'La description doit contenir au moins 10 caractères.',
        ]);

        // Création de la réclamation
        Reclamation::create([
            'sujet' => $request->sujet,
            'description' => $request->description,
            'user_id' => Auth::id(),
            'etat' => 'en attente', // Statut par défaut
        ]);

        return redirect()->route('reclamations.index')->with('success', 'Réclamation créée avec succès.');
    }

    public function update(Request $request, Reclamation $reclamation)
    {
        // Validation avec messages personnalisés
        $request->validate([
            'sujet' => 'required|string|max:10',
            'description' => 'required|string|min:10',
        ], [
            'sujet.required' => 'Le sujet est obligatoire.',
            'sujet.max' => 'Le sujet ne doit pas dépasser 10 caractères.',
            'description.required' => 'La description est obligatoire.',
            'description.min' => 'La description doit contenir au moins 10 caractères.',
        ]);

        // Vérification de l'état avant la mise à jour
        if ($reclamation->etat !== 'en attente') {
            return redirect()->route('reclamations.index')
                ->with('error', 'Modification non autorisée.');
        }

        // Mise à jour de la réclamation
        $reclamation->update($request->all());

        return redirect()->route('reclamations.index')->with('success', 'Réclamation mise à jour avec succès.');
    }

    public function show(Reclamation $reclamation)
    {
        // Affiche les détails d'une réclamation spécifique
        return view('reclamations.show', compact('reclamation'));
    }

    public function edit(Reclamation $reclamation)
    {
        if ($reclamation->etat !== 'en attente') {
            return redirect()->route('reclamations.index')
                ->with('error', 'Vous ne pouvez pas modifier cette réclamation car elle est déjà traitée.');
        }

        return view('reclamations.edit', compact('reclamation'));
    }

    public function destroy(Reclamation $reclamation)
    {
        $reclamation->delete();
        return redirect()->route('reclamations.index')->with('success', 'Réclamation supprimée avec succès.');
    }
}
