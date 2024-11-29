<?php

namespace App\Http\Controllers;

use App\Models\TicketType;
use Illuminate\Http\Request;

class TicketTypeController extends Controller
{
    //

    public function index(){
        return view('tickets.types');
    }

    // function for get all ticket types
    public function getType(){
        return response()->json(TicketType::all());
    }

    // function for store ticket type
    public function store(Request $request){
        $data = $request->validate([
            'name' => 'required|string|max:100',
            'description' => 'nullable|string',
        ]);

        $type = TicketType::create($data);
        return response()->json(['message' => 'Ticket type created successfully.', 'type' => $type]);
    }

    // function for update type data
    public function update(Request $request, TicketType $ticketType)
    {
        $data = $request->validate([
            'name' => 'required|string|max:100',
            'description' => 'nullable|string',
        ]);

        $ticketType->update($data);
        return response()->json(['message' => 'Ticket type updated successfully.']);
    }


    // function for delete type data
    public function destroy(TicketType $ticketType)
    {
        $ticketType->delete();
        return response()->json(['message' => 'Ticket type deleted successfully.']);
    }


    // TicketTypeController
    public function getTicketType()
    {
        $ticketTypes = TicketType::select('id', 'name')->get();
        return response()->json($ticketTypes);
    }

}
