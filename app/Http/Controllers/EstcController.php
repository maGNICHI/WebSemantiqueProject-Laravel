<?php

namespace App\Http\Controllers;

use App\Services\ApiService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class EstcController extends Controller
{
    protected $apiService;

    public function __construct(ApiService $apiService)
    {
        $this->apiService = $apiService;
    }

    public function store(Request $request)
    {
        // Validate the input data
        $validatedData = $request->validate([
            'nom' => 'required|string',
            'description' => 'required|string|max:255',
            'lieu' => 'required|string',
            'impact_environnemental' => 'required|string',
        ]);

        // Call the service to add the Estc record
        $response = $this->apiService->addEstc($validatedData);

        // Check if the response contains an error
        if (isset($response['error']) && $response['error']) {
            return response()->json([
                'success' => false,
                'message' => $response['message'],
                'details' => $response['response'],
            ], 500);
        }

        // Redirect to the Estc list with a success message
        return redirect()->route('estc.index')->with('success', 'Estc added successfully');
    }

    public function create()
    {
        return view('createestc');
    }

    public function index()
    {
        $response = Http::get('http://localhost:8085/estc');

        // Check if the request was successful
        if (!$response->successful()) {
            return response()->json([
                'success' => false,
                'message' => 'Error retrieving Estc records',
                'details' => $response->body(),
            ], 500);
        }

        // Parse the JSON response
        $results = $response->json()['results'];

        // Map the response data into a collection of objects
        $estc= collect($results['bindings'])->map(function ($binding) {
            return (object) [
                'id' => $binding['Estc']['value'] ?? null,
                'nom' => $binding['nom']['value'] ?? 'N/A',
                'description' => $binding['description']['value'] ?? 'N/A',
                'lieu' => $binding['lieu']['value'] ?? 'N/A',
                'impact_environnemental' => $binding['impact_environnemental']['value'] ?? 'N/A',
            ];
        });

        // Return the view with the Estc data
        return view('estc', compact('estc'));
    }
}
