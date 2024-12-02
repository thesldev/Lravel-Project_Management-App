<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use App\Models\Ticket;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CommentController extends Controller
{
   /**
     * Store a new comment for a specific ticket.
     *
     * @param Request $request
     * @param Ticket $ticket
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request, Ticket $ticket)
    {
        // Validate the request
        $request->validate([
            'content' => 'required|string|max:1000',
        ]);

        // Create a new comment
        $comment = new Comment();
        $comment->ticket_id = $ticket->id;
        $comment->user_id = Auth::id(); // Get the currently authenticated user ID
        $comment->content = $request->content;
        $comment->save();

        // Redirect back to the ticket page with a success message
        return redirect()->route('ticket.empView', $ticket->id)
            ->with('success', 'Comment added successfully.');
    }
}
