<?php

namespace App\Http\Controllers;

use App\Models\SupportTicket;
use App\Models\SupportTicketComment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SupportTicketCommentController extends Controller
{
    //
    public function storeClientComment(Request $request, $ticketId)
    {
        // Validate the request
        $request->validate([
            'content' => 'required|string|max:5000',
        ]);

        // Retrieve the ticket
        $ticket = SupportTicket::findOrFail($ticketId);

        // Check if the authenticated user is authorized to comment on the ticket
        if ($ticket->client_id !== Auth::id()) {
            return redirect()->back()->withErrors(['error' => 'You are not authorized to comment on this ticket.']);
        }

        // Create the comment
        SupportTicketComment::create([
            'ticket_id' => $ticket->id,
            'user_id' => Auth::id(),
            'content' => $request->input('content'),
        ]);

        // Redirect back with a success message
        return redirect()->back()->with('success', 'Your comment has been added successfully.');
    }

}
