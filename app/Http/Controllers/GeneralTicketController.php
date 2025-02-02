<?php

namespace App\Http\Controllers;

use App\Models\Client;
use App\Models\GeneralTicket;
use App\Models\TicketAttachment;
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
            $tickets = GeneralTicket::where('user_id', Auth::id())
                ->where('status', ['open', 'in-progress', 'on-hold'])
                ->orderBy('created_at', 'desc')
                ->get();

            $closedTickets = GeneralTicket::where('user_id', Auth::id())
                ->where('status', ['closed', 'resolved'])
                ->orderBy('created_at', 'desc')
                ->get();

            // Pass the services to the view
            return view('tickets.generalTicketIndex', compact('client', 'tickets', 'closedTickets'));
        } catch (\Exception $e) {
            Log::error('Error fetching client services: ' . $e->getMessage());
            return redirect()->back()->withErrors('An error occurred. Please try again.');
        }
    }

    // function for store general ticket
    public function store(Request $request)
    {
        try {
            $validated = $request->validate([
                'subject' => 'required|string|max:255',
                'description' => 'required|string',
                'priority' => 'required|in:low,medium,high',
                'attachments.*' => 'nullable|file|max:2048',
            ]);

            // Create the General Ticket
            $ticket = GeneralTicket::create([
                'user_id' => Auth::id(),
                'subject' => $validated['subject'],
                'description' => $validated['description'],
                'priority' => $validated['priority'],
            ]);

            // Handle attachments if present
            if ($request->hasFile('attachments')) {
                foreach ($request->file('attachments') as $file) {
                    $filePath = $file->store('tickets', 'public');
                    TicketAttachment::create([
                        'ticket_id' => $ticket->id,
                        'file_name' => $file->getClientOriginalName(),
                        'file_path' => $filePath,
                    ]);
                }
            }

            return redirect()->route('client.generalTickets', ['id' => Auth::user()->id])
                ->with('success', 'Ticket created successfully.');

        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Failed to create ticket: ' . $e->getMessage());
        }
    }


    // function for change the ticket status into closed from client portal
    public function closeTicket($id)
    {
        try {
            // Find the ticket and ensure it belongs to the authenticated user
            $ticket = GeneralTicket::where('id', $id)
                ->where('user_id', Auth::id())
                ->firstOrFail();

            // Update ticket status
            $ticket->status = 'closed';
            $ticket->save();

            return redirect()->back()->with('success', 'Ticket closed successfully.');
        } catch (\Exception $e) {
            Log::error('Error closing ticket: ' . $e->getMessage());
            return redirect()->back()->withErrors('Failed to close ticket.');
        }
    }
    
}
