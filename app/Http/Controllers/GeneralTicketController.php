<?php

namespace App\Http\Controllers;

use App\Models\Client;
use App\Models\GeneralTicket;
use App\Models\TicketAttachment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;

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
                ->where('status', ['closed', 'resolved', 'in-progress'])
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
    

    // function for view selected ticket
    public function viewGeneralTicket($id)
    {
        $ticket = GeneralTicket::with(['client', 'attachments'])->find($id);

        // Check if ticket exists
        if (!$ticket) {
            return redirect()->back()->with('error', 'Ticket not found.');
        }

        return view('clients.clientPortal-view-SelectedGeneralTicket', compact('ticket'));
    }


    // function for change the general ticket priority
    public function changePriority(Request $request, $id)
    {
        $request->validate([
            'priority' => 'required|in:low,medium,high',
        ]);

        $ticket = GeneralTicket::find($id);

        if (!$ticket) {
            return response()->json(['success' => false, 'message' => 'Ticket not found.'], 404);
        }

        $ticket->priority = $request->priority;
        $ticket->save();

        return response()->json(['success' => true, 'message' => 'Priority updated successfully.']);
    }


    // function for update the existing general ticket
    public function updateGeneralTicket(Request $request, $id)
    {
        // Validate the incoming request
        $validated = $request->validate([
            'subject' => 'required|string|max:255',
            'description' => 'required|string',
            'attachments.*' => 'file|mimes:jpg,jpeg,png,pdf,docx|max:2048',
            'remove_attachments.*' => 'integer|exists:ticket_attachments,id',
        ]);

        try {
            // Find the ticket by ID
            $ticket = GeneralTicket::where('id', $id)
                ->where('user_id', Auth::id()) // Ensure the user owns the ticket
                ->firstOrFail();

            // Update the ticket details
            $ticket->subject = $validated['subject'];
            $ticket->description = $validated['description'];
            $ticket->save();

            // Handle attachment removal
            if ($request->has('remove_attachments')) {
                $attachmentsToRemove = $ticket->attachments()->whereIn('id', $request->remove_attachments)->get();

                foreach ($attachmentsToRemove as $attachment) {
                    Storage::disk('public')->delete($attachment->file_path);
                    $attachment->delete();
                }
            }

            // Handle new attachments
            if ($request->hasFile('attachments')) {
                foreach ($request->file('attachments') as $file) {
                    $filePath = $file->store('general-ticket-attachments', 'public');
                    $ticket->attachments()->create([
                        'file_name' => $file->getClientOriginalName(),
                        'file_path' => $filePath,
                    ]);
                }
            }

            return response()->json([
                'success' => true,
                'message' => 'General ticket updated successfully.',
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Error updating general ticket: ' . $e->getMessage(),
            ], 500);
        }
    }


    // function for view general tickets in admin side
    public function clientGeneralTickets(){
        return view('tickets.clientGeneralTicket');
    }

    //  function for fetch active general tickets into admin dashboard
    public function getAllTickets(Request $request) {
        $status = $request->input('status', 'open'); // Default to 'open'
        
        $tickets = GeneralTicket::with(['client'])
            ->where('status', $status)
            ->get();
    
        return response()->json($tickets);
    }


    // function for fetched closed or resolved tickets
    public function getClosedOrResolvedTickets()
    {
        $tickets = GeneralTicket::with(['client'])
            ->whereIn('status', ['closed', 'resolved']) // Filter for Closed or Resolved tickets
            ->get();

        return response()->json($tickets);
    }


    // Function for viewing a selected ticket
    public function viewGeneralTicketAdmin($id)
    {
        $ticket = GeneralTicket::with(['client', 'attachments'])->find($id);

        // Check if the ticket exists
        if (!$ticket) {
            return redirect()->back()->with('error', 'Ticket not found.');
        }

        return view('tickets.viewSelectedGeneralTicket', compact('ticket'));
    }


    // Function to change the status of a ticket
    public function changeStatus(Request $request, $id)
    {
        $request->validate([
            'status' => 'required|in:open,in-progress,on-hold,closed',
        ]);

        $ticket = GeneralTicket::find($id);

        if (!$ticket) {
            return response()->json(['success' => false, 'message' => 'Ticket not found.'], 404);
        }

        $ticket->status = $request->status;
        $ticket->save();

        return response()->json(['success' => true, 'message' => 'Status updated successfully.']);
    }


    // function for change general ticket's stats into resolved in admin side
    public function markAsResolved($id)
    {
        $ticket = GeneralTicket::find($id);

        if (!$ticket) {
            return response()->json(['success' => false, 'message' => 'Ticket not found.'], 404);
        }

        $ticket->status = 'resolved';
        $ticket->save();

        return response()->json(['success' => true, 'message' => 'Ticket marked as resolved successfully.']);
    }


}
