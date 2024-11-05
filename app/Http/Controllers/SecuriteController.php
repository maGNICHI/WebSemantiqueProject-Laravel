<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class SecuriteController extends Controller
{
    // Method to show the form for adding a new security report
    public function create()
    {
        return view('createsecurite'); // Adjust the view name as necessary
    }

    // Method to store the new security report
    public function store(Request $request)
    {
        // Validate the request
        $request->validate([
            'sujet' => 'required|string|max:255',
            'description' => 'required|string',
            'status' => 'required|string|max:100',
      
      
        ]);

        // Send data to the Spring Boot API
        $response = Http::post('http://localhost:8085/addSecurites', [
            'sujet' => $request->sujet,
            'description' => $request->description,
            'status' => $request->status,
   
        ]);

        // Handle the response from the API
        if ($response->successful()) {
            return redirect()->route('securites')->with('success', 'Security report added successfully.');
        } else {
            Log::error('Failed to add security report: ' . $response->body());
            return redirect()->back()->with('error', 'Failed to add security report.');
        }
    }

    // Method to display the list of security reports
    public function index()
    {
        $response = Http::get('http://localhost:8085/securite');
    
        if (!$response->successful()) {
            return response()->json(['success' => false, 'message' => 'Error retrieving reports'], 500);
        }
    
        // Assuming your API returns the results as expected
        $results = $response->json()['results'];
    
        // Map the results to your data structure
        $securiteReports = collect($results['bindings'])->map(function ($binding) {
            return (object) [
                'sujet' => $binding['sujet']['value'] ?? null,
                'description' => $binding['description']['value'] ?? null,
                'status' => $binding['status']['value'] ?? null,
            
            ];
        });
    
        return view('securites', compact('securiteReports'));
    }
    
    // Method to delete a security report
    public function destroy($id)
    {
        // Call the API to delete the security report
        $response = Http::delete("http://localhost:8085/securite/{$id}");

        // Check if the request was successful
        if (!$response->successful()) {
            return response()->json([
                'success' => false,
                'message' => 'Erreur lors de la suppression du rapport de sécurité',
                'details' => $response->body(),
            ], 500);
        }

        return response()->json([
            'success' => true,
            'message' => 'Rapport de sécurité supprimé avec succès',
        ]);
    }
}
