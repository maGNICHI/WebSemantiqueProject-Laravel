<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class PollutionController extends Controller
{
    // Method to show the form for adding a new pollution report
    public function create()
    {
        return view('createpollution'); // Adjust the view name as necessary
    }

    // Method to store the new pollution report
    public function store(Request $request)
    {
        // Validate the request
        $request->validate([
            'sujet' => 'required|string|max:255',
            'description' => 'required|string',
            'status' => 'required|string|max:100',
            'date_reclamation' => 'required|date',
            'date_traitement' => 'required|date',
        ]);

        // Send data to the Spring Boot API
        $response = Http::post('http://localhost:8085/addPollution', [
            'sujet' => $request->sujet,
            'description' => $request->description,
            'status' => $request->status,
          
        ]);

        // Handle the response from the API
        if ($response->successful()) {
            return redirect()->route('pollutions')->with('success', 'Pollution report added successfully.');
        } else {
            Log::error('Failed to add pollution report: ' . $response->body());
            return redirect()->back()->with('error', 'Failed to add pollution report.');
        }
    }

    // Method to display the list of pollution reports
    public function index()
    {
        $response = Http::get('http://localhost:8085/pollution');

        // Check if the request was successful
        if (!$response->successful()) {
            return response()->json([
                'success' => false,
                'message' => 'Erreur lors de la récupération des rapports de pollution',
                'details' => $response->body(),
            ], 500);
        }

        // Transform the JSON response into a collection of objects
        $results = $response->json()['results'];

        // Extract pollution reports from 'bindings' and put them into an array
        $pollutionReports = collect($results['bindings'])->map(function ($binding) {
            return (object) [
                'sujet' => $binding['sujet']['value'], // The subject of the pollution report
                'description' => $binding['description']['value'], // The description
                'status' => $binding['status']['value'], // The status
              
            ];
        });

        // Return the view with the pollution report data
        return view('pollutions', compact('pollutionReports'));
    }

    // Method to delete a pollution report
    public function destroy($id)
    {
        // Call the API to delete the pollution report
        $response = Http::delete("http://localhost:8085/pollution/{$id}");

        // Check if the request was successful
        if (!$response->successful()) {
            return response()->json([
                'success' => false,
                'message' => 'Erreur lors de la suppression du rapport de pollution',
                'details' => $response->body(),
            ], 500);
        }

        return response()->json([
            'success' => true,
            'message' => 'Rapport de pollution supprimé avec succès',
        ]);
    }
}
