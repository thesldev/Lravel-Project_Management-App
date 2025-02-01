<?php

namespace App\Http\Controllers;

use App\Models\Client;
use App\Models\Servics;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class ServiceContoller extends Controller
{
    //

    // function for view services page
    public function index(){
        $services = Servics::all();

        return view('services.index', compact('services'));
    }

    //  function for access form for add new service
    public function create(){
        return view('services.create');
    }

    // function for store service data in db
    public function storeData(Request $request)
    {
        // Validate request data
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'service_type' => 'required|string|max:255',
            'status' => 'required|string|max:255',
            'priority' => 'required|string|max:255',
            'start_date' => 'required|date',
        ]);

        try {
            // Debugging validation result
            Log::info('Validated Data: ', $validated);

            // Get the authenticated user's ID
            $userId = Auth::id();

            // Use Eloquent Model to create a new record
            Servics::create([
                'name' => $validated['name'],
                'description' => $validated['description'],
                'service_type' => $validated['service_type'],
                'status' => $validated['status'],
                'priority' => $validated['priority'],
                'start_date' => $validated['start_date'],
                'user_id' => $userId, // Required field
            ]);

            // Redirect back with success message
            return redirect()->route('service.index')->with('success', 'Service data saved successfully!');
        } catch (\Exception $e) {
            Log::error('Database Error: ' . $e->getMessage());
            return redirect()->back()->withErrors('An error occurred. Please try again.');
        }
    }



    // function for get service by Id
    public function viewService($id)
    {
        // Fetch the service by ID or throw a 404 if not found
        $service = Servics::findOrFail($id);
        $clients = Client::all();

        // Return the view with the selected service data
        return view('services.view', compact('service', 'clients'));
    }

    //  add users into service
    public function addUsers(Request $request, $serviceId)
    {
        // Validate the request
        $validatedData = $request->validate([
            'clients' => 'required|array', // Ensure clients is an array
            'clients.*' => 'exists:users,id', // Each client must exist in the 'users' table
        ]);

        // Find the service
        $service = Servics::findOrFail($serviceId);

        // Attach the selected users to the service
        $service->users()->syncWithoutDetaching($validatedData['clients']);

        // Redirect back with a success message
        return redirect()->back()->with('success', 'Users added successfully!');
    }




}
