<?php

namespace App\Http\Controllers;

use App\Models\Project;
use App\Models\SupportTicket;
use Illuminate\Http\Request;

use function Pest\Laravel\json;

class SupportTicketController extends Controller
{
    //

    // function for store project support tickets 
    public function projectSupportTicket(Request $request)
    {
        try {
            $validated = $request->validate([
                'title' => 'required|string|max:255',
                'description' => 'required|string',
                'client_id' => 'required|exists:users,id',
                'project_id' => 'nullable|exists:project,id',
                'service_id' => 'nullable|exists:services,id',
                'priority' => 'required|in:Low,Medium,High,Critical',
                'status' => 'nullable|string',
                'assigned_to' => 'nullable|exists:users,id',
            ]);

            // Create the support ticket
            $supportTicket = SupportTicket::create([
                'title' => $validated['title'],
                'description' => $validated['description'],
                'client_id' => $validated['client_id'],
                'project_id' => $validated['project_id'],
                'service_id' => $validated['service_id'] ?? null,
                'priority' => $validated['priority'],
                'status' => $validated['status'] ?? 'Open',
                'assigned_to' => $validated['assigned_to'] ?? null,
            ]);

            return response()->json([
                'message' => 'Support ticket created successfully.',
                'ticket' => $supportTicket,
            ]);
        } catch (\Exception $e) {
            // \Log::error($e->getMessage());
            return response()->json([
                'message' => 'Failed to create support ticket.',
                'error' => $e->getMessage(),
            ], 500);
        }
    }


    // function for get ticket history according to the project
    public function projectTicketHistory($id){
        try{

            $project = Project::findOrFail($id);

            // Get all tickets related to the project, ordered by creation date (latest first)
            $tickets = SupportTicket::where('project_id', $id)
                ->orderBy('created_at', 'desc')
                ->get();

            return response()->json([
                'message' => 'Tickets retrieved successfully.',
                'project' => $project,
                'tickets' => $tickets,
            ]);

        } catch(\Exception $e) {
            return response()->json([
                'message' => 'Failed to retrieve tickets.',
                'error' => $e->getMessage(),
            ], 500);
        }
    }


    // function for get closed tickets related to the project
    public function projectClosedTickets($id){
        try {
            
            $project = Project::findOrFail($id);

            // get tickets statuse equal to closed
            $closedTickets = SupportTicket::where('project_id', $id)
                ->where('status', 'Resolved')
                ->orderBy('created_at', 'desc')
                ->get();
            
                return response()->json([
                    'message' => 'Tickets retrieved Resolved Tickets successfully.',
                    'project' => $project,
                    'closedTickets' => $closedTickets,
                ]);


        } catch (\Exception $e) {
            //throw $th;

            return response()->json([
                'message' => 'Failed to retrieve Resolved tickets.',
                'error' => $e->getMessage(),
            ], 500);
        }
    }


    // function for access the client tickets in admin portal
    public function clientTickets(){
        return view('tickets.clientTickets');
    }

    // function for fetch client ticket details
    public function getAllTickets() {
        $tickets = SupportTicket::with(['client', 'project', 'assignedUser'])->get(); // Execute the query
        return response()->json($tickets);
    }

    // function for filter client tickets according to the ticket status
    public function filterByStatus($status)
    {
        if ($status === 'all') {
            $tickets = SupportTicket::with(['client', 'project', 'assignedUser'])->get();
        } else {
            $tickets = SupportTicket::with(['client', 'project', 'assignedUser'])
                ->where('status', $status)
                ->get();
        }

        return response()->json($tickets);
    }
    

    // display selected support-ticket's data in admin-side
    public function viewTicket($id){

        $ticket = SupportTicket::with(['client', 'project', 'assignedUser'])->find($id);

        return view('tickets.viewClientTickets', compact('ticket'));
        
    }

    // display selected support-ticket's data in client side
    public function clientViewTicket($id){
        $ticket = SupportTicket::with('project')->find($id);

        return view('clients.clientPortal-view-selectedTicket', compact('ticket'));
    }


    // function for close the ticket from client side
    public function changeStatusClientSide($id)
    {
        $ticket = SupportTicket::find($id);

        if (!$ticket) {
            return response()->json([
                'message' => 'Ticket not found.'
            ], 404);
        }

        $ticket->status = 'Closed';
        $ticket->save();

        return response()->json([
            'message' => 'Ticket status updated successfully.',
            'ticket' => $ticket
        ]);
    }


}
