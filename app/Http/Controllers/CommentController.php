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
   
    // function for store comments in the databse
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


    // function for store coments in admin side..
    public function storeAdmin(Request $request, Ticket $ticket){
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
        return redirect()->route('ticket.view', $ticket->id)
            ->with('success', 'Comment added successfully.');
    }

    // function for get all commets related to the selected ticket
    public function getComments(Ticket $ticket)
    {
        // Fetch comments for the given ticket with related user data
        $comments = Comment::with('user') // Eager load the related user
            ->where('ticket_id', $ticket->id)
            ->get();

        return response()->json($comments);
    }
    
    // function for get all commets related to the selected ticket
    public function getAdminComments(Ticket $ticket)
    {
        // Fetch comments for the given ticket with related user data
        $comments = Comment::with('user') // Eager load the related user
            ->where('ticket_id', $ticket->id)
            ->get();

        return response()->json($comments);
    }


    // delete comment
    public function destroy($id)
    {
        $comment = Comment::find($id);

        if ($comment) {
            $comment->delete();
            return response()->json(['success' => true]);
        }

        return response()->json(['success' => false, 'error' => 'Comment not found'], 404);
    }


    // function for update comments
    public function update(Request $request, $id)
    {
        $comment = Comment::find($id);

        if (!$comment) {
            return response()->json(['success' => false, 'error' => 'Comment not found'], 404);
        }

        // Validate the new content
        $request->validate([
            'content' => 'required|string|max:1000',
        ]);

        // Update the comment
        $comment->content = $request->input('content');
        $comment->save();

        return response()->json(['success' => true]);
    }

}
