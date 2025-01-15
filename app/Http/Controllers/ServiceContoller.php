<?php

namespace App\Http\Controllers;

use App\Models\Servics;
use Illuminate\Http\Request;
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
            // Use a database transaction
            DB::transaction(function () use ($validated) {
                // Create the client record
                Servics::create([
                    'name' => $validated['name'],
                    'description' => $validated['description'],
                    'service_type' => $validated['service_type'],
                    'status' => $validated['status'],
                    'priority' => $validated['priority'],
                    'start_date' => $validated['start_date'],
                ]);
            });

            // Redirect back with success message
            return redirect()->route('service.index')->with('success', 'Client data saved successfully!');
        } catch (\Exception $e) {
            Log::error($e->getMessage());
            return redirect()->back()->withErrors('An error occurred. Please try again.');
        }
    }

}
