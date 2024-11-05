<?php

namespace App\Http\Controllers;

use App\Services\ApiService; // Ensure you have this service to handle API calls
use Illuminate\Http\Request;

class BookingController extends Controller
{
    protected $apiService;

    public function __construct(ApiService $apiService)
    {
        $this->apiService = $apiService;
    }

    public function index()
    {
        // Fetch booking data from your API or database
        $bookings = $this->apiService->getBookings(); // Adjust this based on your implementation

        // Check for errors and format data
        if (isset($bookings['error']) && $bookings['error']) {
            return response()->json([
                'success' => false,
                'message' => $bookings['message'],
                'details' => $bookings['response'],
            ], 500);
        }

        // Transform the response to a simpler format
        $formattedBookings = [];
        if (!empty($bookings['results']['bindings'])) {
            foreach ($bookings['results']['bindings'] as $binding) {
                $formattedBookings[] = [
                    'email' => $binding['email']['value'],
                    'adresse' => $binding['adresse']['value'],
                    'description' => $binding['description']['value'],
                    'nom' => $binding['nom']['value'],
                    'numtelephone' => $binding['numtelephone']['value'],
                ];
            }
        }

        // Return the view with the formatted booking data
        return view('booking', ['bookings' => $formattedBookings]);
    }

    public function addBooking(Request $request)
    {
        $data = $request->validate([
            'email' => 'required|string',
            'adresse' => 'required|string',
            'description' => 'required|string',
            'nom' => 'required|string',
            'numtelephone' => 'required|string',
        ]);

        $result = $this->apiService->addBooking($data); // Adjust this based on your implementation

        if (isset($result['error']) && $result['error']) {
            return response()->json([
                'success' => false,
                'message' => $result['message'],
                'details' => $result['response'],
            ], 500);
        }

        return response()->json([
            'success' => true,
            'message' => 'Booking entry added successfully.',
        ]);
    }






}
