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
   
    public function store(Request $request, Ticket $ticket){
        $data = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'priority' => 'required|in:Low,Medium,High,Critical',
            'status_id' => 'required|exists:statuses,id', 
            'type_id' => 'required|exists:types,id',
            'reporter_id' => 'required|exists:users,id', // Assuming a 'users' table for reporters
            'assignee_id' => 'nullable|exists:users,id', // Optional, but must exist if provided
            'project_id' => 'nullable|exists:projects,id', // Optional, but must exist if provided
            'due_date' => 'nullable|date|after_or_equal:today',
            'closed_at' => 'nullable|date|after_or_equal:created_at',
            'parent_ticket_id' => 'nullable|exists:tickets,id', // Optional, must be a valid ticket ID
        ]);

    }
}
