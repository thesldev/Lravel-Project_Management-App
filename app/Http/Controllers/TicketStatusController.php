<?php

namespace App\Http\Controllers;

use App\Models\TicketStatus;
use Illuminate\Http\Request;

class TicketStatusController extends Controller
{
    //
    
    public function status(){
        return view('tickets.status');
    }

    // function for store ticket status
    public function store(Request $request){
        $data = $request->validate([
            'name' => 'required|string|max:100', 
            'is_final' => 'required|boolean',
        ]);

        $status = TicketStatus::create($data);
        return response()->json(['message' => 'Ticket type created successfully.', 'status' => $status]);
    }

    // function for get ticket statuses
    public function get(){
        return response()->json(TicketStatus::all());
    }

    // function for delete statuses data
    public function destroy(TicketStatus $ticketStatus)
    {
        try {
            $ticketStatus->delete();
            return response()->json(['message' => 'Ticket Status deleted successfully.']);
        } catch (\Exception $e) {
            return response()->json(['message' => 'Error: ' . $e->getMessage()], 500);
        }
    }

    // function for update ticket status
    public function update(Request $request, TicketStatus $ticketStatus)
    {
        // Validate the incoming request data
        $data = $request->validate([
            'name' => 'required|string|max:100',
            'is_final' => 'required|boolean',
        ]);

        // Update the record
        $ticketStatus->update($data);

        // Check if the update was successful
        if ($ticketStatus->wasChanged()) {
            return response()->json(['message' => 'Ticket status updated successfully.']);
        } else {
            return response()->json(['message' => 'No changes were made.']);
        }
    }


    // TicketStatusController
    public function getTicketStatuses()
    {
        $ticketStatuses = TicketStatus::select('id', 'name')->get();
        return response()->json($ticketStatuses);
    }

}
