<?php

namespace App\Http\Controllers;

use App\Models\SupportTicket;
use Illuminate\Http\Request;

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




}
