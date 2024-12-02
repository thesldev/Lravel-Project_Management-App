<?php

namespace App\Http\Controllers;

use App\Models\Ticket;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

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
            'status_id' => 'required|exists:ticket_statuses,id', 
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

    // update function for tickets
    public function update(Request $request, Ticket $ticket) {
        $data = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'priority' => 'required|in:Low,Medium,High,Critical',
            'status_id' => 'required|exists:ticket_statuses,id',
            'type_id' => 'required|exists:ticket_type,id',
            'project_id' => 'nullable|exists:project,id',
            'due_date' => 'nullable|date|after_or_equal:today',
            'closed_at' => 'nullable|date|after_or_equal:created_at',
            'parent_ticket_id' => 'nullable|exists:tickets,id',
        ]);
    
        // Update the ticket with the validated data
        $ticket->update($data);
    
        // Return a JSON response indicating success
        return response()->json([
            'success' => true,
            'message' => 'Ticket updated successfully!',
            'ticket' => $ticket,
        ]);
    }

    // delete function for delete ticket
    public function destroy(Ticket $ticket)
    {
        $ticket->delete();
        return redirect()->route('ticket.index')->with('success', 'Ticket Deleted successfully');
    }
    

    // function for get tickets relavent to specific employee
    public function empTickets()
    {
        $userId = Auth::id();

        // Fetch tickets assigned to the user with related data
        $tickets = Ticket::with(['type', 'project', 'status', 'assignee', 'reporter'])
            ->where('assignee_id', $userId)
            ->get();

        // Return the view with the tickets
        return view('tickets.empTickets', compact('tickets'));
    }

    // function for display selected data in employee side
    public function empView(Ticket $ticket)
    {
        return view('tickets.empView', compact('ticket'));
    }
    

    // function for change the status of the ticket
    public function changeStatus(Ticket $ticket)
    {
        return view('tickets.changeStatus', compact('ticket'));
    }

    // update function for change the ticket status
    public function updateStatus(Request $request, Ticket $ticket)
    {
        // Validate the status_id field
        $request->validate([
            'status_id' => 'required|exists:ticket_statuses,id',
        ]);

        // Update the ticket's status_id column with the new value from the request
        $ticket->status_id = $request->status_id;
        $ticket->save();

        // Redirect back with a success message
        return redirect()->back()->with('success', 'Ticket status updated successfully.');
    }


}
