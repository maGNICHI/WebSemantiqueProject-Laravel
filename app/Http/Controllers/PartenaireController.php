<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Partenaire; // Ensure this model exists
use OwenIt\Auditing\Models\Audit; // Import the Audit model from the package


class PartenaireController extends Controller
{
    public function index()
    {
        // Retrieve the most recent partenaires first
        $partenaires = Partenaire::orderBy('created_at', 'desc')->get();

        // Return the view with the partenaires
        return view('partenaires', compact('partenaires')); // Corrected variable name to match the data passed
    }

    public function create()
    {
        return view('createPartenaire');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nom' => 'required|string|max:255',
            'description' => 'required|string|min:20', // Minimum 20 characters
            'email' => 'required|email|max:255', // Validation for email
            'adresse' => 'required|string|max:255', // Validation for adresse
            'telephone' => 'required|string|size:8', // Ensure exactly 8 characters for telephone
            'type' => 'required|string|in:hebergement,transport,activite', // Validation for type
        ], [
            'description.min' => 'La description doit comporter au moins 20 caractères.',
            'telephone.size' => 'Le numéro de téléphone doit comporter exactement 8 caractères.',
            'email.required' => 'L\'email est requis.',
            'adresse.required' => 'L\'adresse est requise.',
            'nom.required' => 'Le nom est requis.',
            'type.required' => 'Le type est requis.',
        ]);

        // Create a new partenaire
        Partenaire::create($request->only(['nom', 'description', 'email', 'adresse', 'telephone', 'type'])); // Include all fields

        return redirect()->route('partenaires.index')->with('success', 'Partenaire ajouté avec succès.'); // Corrected the route name
    }

    public function show($id)
    {
        $partenaire = Partenaire::findOrFail($id);
        return view('partenaire', compact('partenaire')); // Assuming you have a single partenaire view named 'partenaire.blade.php'
    }

    public function edit($id)
    {
        $partenaire = Partenaire::findOrFail($id);
        return view('editPartenaire', compact('partenaire'));
    }

    public function update(Request $request, $id)
    {
        $partenaire = Partenaire::findOrFail($id);

        $request->validate([
            'nom' => 'required|string|max:255',
            'description' => 'required|string|min:20', // Minimum 20 characters
            'email' => 'required|email|max:255', // Validation for email
            'adresse' => 'required|string|max:255', // Validation for adresse
            'telephone' => 'required|string|size:8', // Ensure exactly 8 characters for telephone
            'type' => 'required|string|in:hebergement,transport,activite', // Validation for type
        ], [
            'description.min' => 'La description doit comporter au moins 20 caractères.',
            'telephone.size' => 'Le numéro de téléphone doit comporter exactement 8 caractères.',
            'email.required' => 'L\'email est requis.',
            'adresse.required' => 'L\'adresse est requise.',
            'nom.required' => 'Le nom est requis.',
            'type.required' => 'Le type est requis.',
        ]);

        // Update the partenaire
        $partenaire->update($request->only(['nom', 'description', 'email', 'adresse', 'telephone', 'type'])); // Include all fields

        return redirect()->route('partenaires.index')->with('success', 'Partenaire mis à jour avec succès!'); // Corrected the route name
    }

    public function destroy($id)
    {
        $partenaire = Partenaire::findOrFail($id);
        $partenaire->delete();

        return redirect()->route('partenaires.index')->with('success', 'Partenaire supprimé avec succès'); // Corrected the route name
    }

    public function partenaireStem()
    {
        $partenaires = Partenaire::orderBy('created_at', 'desc')->get();
        return view('partenaireStem', compact('partenaires')); // Assuming you want to display all partenaires
    }

    public function showAuditLogs($id)
    {
        $partenaire = Partenaire::findOrFail($id);
        $audits = $partenaire->audits; // Get audit logs for the specific partenaire

        return view('partenaireAuditLogs', compact('audits', 'partenaire')); // Pass audits and partenaire to the view
    }

    // Method to show all audit logs
    public function auditLogs()
{
    // Fetch paginated audit records, ordering by created_at in descending order
    $audits = Audit::orderBy('created_at', 'desc')->paginate(3); // Adjust the number as needed

    return view('index', compact('audits')); // Adjust the view name as necessary
}



}
