<?php

namespace App\Http\Controllers;

use App\Models\SupportTicket;
use App\Models\SupportTicketComment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SupportTicketCommentController extends Controller
{
    //function for store comments from cilent-portal
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

    // function for fetch comments related to the ticket
    public function viewComments(Request $request, $ticketId)
    {
        // Find the support ticket by ID
        $ticket = SupportTicket::find($ticketId);

        if (!$ticket) {
            return response()->json([
                'success' => false,
                'error' => 'Support ticket not found.',
            ], 404);
        }

        // Fetch all comments related to the support ticket
        $comments = SupportTicketComment::with('user')
            ->where('ticket_id', $ticketId)
            ->orderBy('created_at', 'asc')
            ->get();

        // Return comments in JSON format
        return response()->json($comments, 200);
    }

    // function for update support ticket comments
    public function updateComment(Request $request, $commentId)
    {
        // Find the comment by ID
        $comment = SupportTicketComment::find($commentId);

        if (!$comment) {
            return response()->json([
                'success' => false,
                'error' => 'Comment not found.',
            ], 404);
        }

        // Check if the current user is the owner of the comment or has the necessary permissions
        if ($comment->user_id !== Auth::id()) {
            return response()->json([
                'success' => false,
                'error' => 'You are not authorized to update this comment.',
            ], 403);
        }

        // Validate the incoming content
        $validatedData = $request->validate([
            'content' => 'required|string|max:5000',
        ]);

        // Update the comment content
        $comment->content = $validatedData['content'];
        $comment->save();

        return response()->json([
            'success' => true,
            'message' => 'Comment updated successfully.',
            'content' => $comment->content,  // Send the updated content back
        ]);
    }


    // function for delete support ticket comments from client portal
    public function deleteComment($commentId)
    {
        // Find the comment by ID
        $comment = SupportTicketComment::find($commentId);

        if (!$comment) {
            return response()->json([
                'success' => false,
                'error' => 'Comment not found.',
            ], 404);
        }

        // Check if the current user is the owner of the comment or has the necessary permissions
        if ($comment->user_id !== Auth::id()) {
            return response()->json([
                'success' => false,
                'error' => 'You are not authorized to delete this comment.',
            ], 403);
        }

        // Delete the comment
        $comment->delete();

        return response()->json([
            'success' => true,
            'message' => 'Comment deleted successfully.',
        ]);
    }


     //function for store comments from admin-side
     public function storeAdminComment(Request $request, $ticketId)
     {
         // Validate the request
         $request->validate([
             'content' => 'required|string|max:5000',
         ]);
 
         // Retrieve the ticket
         $ticket = SupportTicket::findOrFail($ticketId);

         // Create the comment
         SupportTicketComment::create([
             'ticket_id' => $ticket->id,
             'user_id' => Auth::id(),
             'content' => $request->input('content'),
         ]);
 
         // Redirect back with a success message
         return redirect()->back()->with('success', 'Your comment has been added successfully.');
     }


     // function for update support ticket comments form admin side
    public function updateCommentAdmin(Request $request, $commentId)
    {
        // Find the comment by ID
        $comment = SupportTicketComment::find($commentId);

        if (!$comment) {
            return response()->json([
                'success' => false,
                'error' => 'Comment not found.',
            ], 404);
        }

        // Validate the incoming content
        $validatedData = $request->validate([
            'content' => 'required|string|max:5000',
        ]);

        // Update the comment content
        $comment->content = $validatedData['content'];
        $comment->save();

        return response()->json([
            'success' => true,
            'message' => 'Comment updated successfully.',
            'content' => $comment->content,  // Send the updated content back
        ]);
    }


    // function for delete support ticket comments from admin side
    public function deleteCommentAdmin($commentId)
    {
        // Find the comment by ID
        $comment = SupportTicketComment::find($commentId);

        if (!$comment) {
            return response()->json([
                'success' => false,
                'error' => 'Comment not found.',
            ], 404);
        }

        // Delete the comment
        $comment->delete();

        return response()->json([
            'success' => true,
            'message' => 'Comment deleted successfully.',
        ]);
    }
}
