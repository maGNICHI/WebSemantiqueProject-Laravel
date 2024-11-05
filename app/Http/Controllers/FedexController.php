<?php

namespace App\Http\Controllers;

use App\Services\ApiService;
use Illuminate\Http\Request;

class FedexController extends Controller
{
    protected $apiService;

    public function __construct(ApiService $apiService)
    {
        $this->apiService = $apiService;
    }

    public function index()
    {
        // Fetch FedEx data
        $fedexs = $this->apiService->getFedexs();

        if (isset($fedexs['error']) && $fedexs['error']) {
            return response()->json([
                'success' => false,
                'message' => $fedexs['message'],
                'details' => $fedexs['response'],
            ], 500);
        }

        // Transform the response to a simpler format
        $formattedFedexs = [];
        if (!empty($fedexs['results']['bindings'])) {
            foreach ($fedexs['results']['bindings'] as $binding) {
                $formattedFedexs[] = [
                    'email' => $binding['email']['value'],
                    'adresse' => $binding['adresse']['value'],
                    'description' => $binding['description']['value'],
                    'nom' => $binding['nom']['value'],
                    'numtelephone' => $binding['numtelephone']['value'],
                ];
            }
        }

        // Return the view with the formatted FedEx data
        return view('createfedex', ['fedexs' => $formattedFedexs]);
    }

    public function addFedex(Request $request)
    {
        $data = $request->validate([
            'email' => 'required|string',
            'adresse' => 'required|string',
            'description' => 'required|string',
            'nom' => 'required|string',
            'numtelephone' => 'required|string',
        ]);

        $result = $this->apiService->addFedex($data);

        if (isset($result['error']) && $result['error']) {
            return response()->json([
                'success' => false,
                'message' => $result['message'],
                'details' => $result['response'],
            ], 500);
        }

        return response()->json([
            'success' => true,
            'message' => 'FedEx entry added successfully.',
        ]);
    }
}
