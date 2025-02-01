<?php

namespace App\Http\Controllers;

use App\Models\Client;
use App\Models\GeneralTicket;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class GeneralTicketController extends Controller
{
    //function for go to general tickets page
    public function generalTickets($id){
        try {
            // Ensure the user is authenticated
            if (Auth::id() !== (int)$id) {
                return redirect()->route('dashboard')->withErrors('Unauthorized access.');
            }

            // Retrieve the client data
            $client = Client::where('user_id', $id)->firstOrFail();

            // Pass the services to the view
            return view('tickets.generalTicketIndex', compact('client'));
        } catch (\Exception $e) {
            Log::error('Error fetching client services: ' . $e->getMessage());
            return redirect()->back()->withErrors('An error occurred. Please try again.');
        }
    }
}
