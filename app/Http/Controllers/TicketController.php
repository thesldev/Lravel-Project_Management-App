<?php

namespace App\Http\Controllers;

use App\Models\Ticket;
use Illuminate\Http\Request;

class TicketController extends Controller
{
    //
    public function index(){
        return view('tickets.index');
    }

    // function for store ticket data into db
    public function store(Request $request) {
        $data = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'priority' => 'required|in:Low,Medium,High,Critical',
            'status_id' => 'required|exists:ticket_statuses,id', // Updated validation rule
            'type_id' => 'required|exists:ticket_type,id',
            'reporter_id' => 'required|exists:users,id',
            'assignee_id' => 'nullable|exists:users,id',
            'project_id' => 'nullable|exists:project,id',
            'due_date' => 'nullable|date|after_or_equal:today',
            'closed_at' => 'nullable|date|after_or_equal:created_at',
            'parent_ticket_id' => 'nullable|exists:tickets,id',
        ]);
    
        // Use the create method to save the data to the database
        Ticket::create($data);
    
        // Redirect to the ticket index with a success message
        return redirect()->route('ticket.index')->with('success', 'Ticket created successfully!');
    }
    
    // functionm for get all ticket data
    public function getTickets(){
        $tickets = Ticket::with(['reporter', 'status', 'type', 'project', 'assignee'])->get(); 
        return response()->json($tickets);
    }
    

    public function view(Ticket $ticket){
        return view('tickets.view', compact('ticket'));
    }
}
