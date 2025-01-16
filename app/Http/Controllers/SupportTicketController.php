<?php

namespace App\Http\Controllers;

use App\Models\Employees;
use App\Models\Project;
use App\Models\Servics;
use App\Models\SupportTicket;
use App\Models\TicketAttachment;
use Exception;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\ValidationException;

use function Pest\Laravel\json;

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
                'attachment.*' => 'nullable|file|max:2048',
            ]);

            // Create the support ticket
            $supportTicket = SupportTicket::create([
                'title' => $validated['title'],
                'description' => $validated['description'],
                'client_id' => $validated['client_id'],
                'project_id' => $validated['project_id'] ?? null,
                'service_id' => $validated['service_id'] ?? null,
                'priority' => $validated['priority'],
                'status' => $validated['status'] ?? 'Open',
                'assigned_to' => $validated['assigned_to'] ?? null,
            ]);

            // Handle attachments if present
            if ($request->hasFile('attachment')) {
                foreach ($request->file('attachment') as $file) {
                    $filePath = $file->store('attachments', 'public');
                    TicketAttachment::create([
                        'ticket_id' => $supportTicket->id, // Use the correct variable
                        'file_name' => $file->getClientOriginalName(),
                        'file_path' => $filePath,
                    ]);
                }
            }

            return response()->json([
                'message' => 'Support ticket created successfully.',
                'ticket' => $supportTicket,
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'message' => 'Failed to create support ticket.',
                'error' => $e->getMessage(),
            ], 500);
        }
    }


    //  function for store service support ticket
    public function serviceSupportTicket(Request $request){
        try {
            $validated = $request->validate([
                'title' => 'required|string|max:255',
                'description' => 'required|string',
                'client_id' => 'required|exists:users,id',
                'service_id' => 'required|exists:services,id',
                'priority' => 'required|in:Low,Medium,High,Critical',
                'status' => 'nullable|string',
                'attachment.*' => 'nullable|file|max:2048',
            ]);
    
            // Create the support ticket
            $supportTicket = SupportTicket::create([
                'title' => $validated['title'],
                'description' => $validated['description'],
                'client_id' => $validated['client_id'],
                'service_id' => $validated['service_id'],
                'priority' => $validated['priority'],
                'status' => $validated['status'] ?? 'Open',
            ]);
    
            // Handle attachments if present
            if ($request->hasFile('attachment')) {
                foreach ($request->file('attachment') as $file) {
                    $filePath = $file->store('attachments', 'public');
                    TicketAttachment::create([
                        'ticket_id' => $supportTicket->id,
                        'file_name' => $file->getClientOriginalName(),
                        'file_path' => $filePath,
                    ]);
                }
            }
    
            return response()->json([
                'message' => 'Service support ticket created successfully.',
                'ticket' => $supportTicket,
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'message' => 'Failed to create service support ticket.',
                'error' => $e->getMessage(),
            ], 500);
        }
    }


    // function for get ticket history according to the project
    public function projectTicketHistory($id){
        try{

            $project = Project::findOrFail($id);

            // Get all tickets related to the project, ordered by creation date (latest first)
            $tickets = SupportTicket::where('project_id', $id)
                ->orderBy('created_at', 'desc')
                ->get();

            return response()->json([
                'message' => 'Tickets retrieved successfully.',
                'project' => $project,
                'tickets' => $tickets,
            ]);

        } catch(\Exception $e) {
            return response()->json([
                'message' => 'Failed to retrieve tickets.',
                'error' => $e->getMessage(),
            ], 500);
        }
    }


    // function for get ticket history according to the service.
    public function serviceTicketHistory($id){
        try {
            // Find the service by ID or fail with an exception
            $service = Servics::findOrFail($id);
    
            // Get all tickets related to the service, ordered by creation date (latest first)
            $tickets = SupportTicket::where('service_id', $id)
                ->orderBy('created_at', 'desc')
                ->get();
    
            // Return a JSON response with the service and ticket data
            return response()->json([
                'message' => 'Tickets retrieved successfully.',
                'service' => $service,
                'tickets' => $tickets,
            ]);
    
        } catch (\Exception $e) {
            // Handle exceptions and return an error response
            return response()->json([
                'message' => 'Failed to retrieve tickets.',
                'error' => $e->getMessage(),
            ], 500);
        }
    }

    // function for get closed tickets related to the project
    public function projectClosedTickets($id)
    {
        try {
            $project = Project::findOrFail($id);

            // Get tickets with statuses 'Resolved' or 'Closed'
            $closedTickets = SupportTicket::where('project_id', $id)
                ->whereIn('status', ['Resolved', 'Closed'])
                ->orderBy('created_at', 'asc')
                ->get();

            return response()->json([
                'message' => 'Tickets retrieved successfully.',
                'project' => $project,
                'closedTickets' => $closedTickets,
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'message' => 'Failed to retrieve resolved tickets.',
                'error' => $e->getMessage(),
            ], 500);
        }
    }


    // function for get closed tickets related to the service
    public function serviceClosedTickets($id) {
        try {
            $service = Servics::findOrFail($id);
            $closedTickets = SupportTicket::where('service_id', $id)
                ->whereIn('status', ['Resolved', 'Closed'])
                ->orderBy('created_at', 'asc')
                ->get();
    
            return response()->json([
                'message' => 'Tickets retrieved successfully.',
                'service' => $service,
                'closedTickets' => $closedTickets,
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'message' => 'Failed to retrieve resolved tickets.',
                'error' => $e->getMessage(),
            ], 500);
        }
    }
    


    // function for access the client tickets in admin portal
    public function clientTickets(){
        return view('tickets.clientTickets');
    }

    //  function for access the clients service tickets in admin portal
    public function clientServiceTickets(){
        return view('tickets.clientServiceTicket');
    }

    // function for fetch client ticket details
    public function getAllTickets() {
        $tickets = SupportTicket::with(['client', 'project', 'assignedUser'])
            ->whereNotNull('project_id')
            ->get(); // Execute the query
        return response()->json($tickets);
    }


    // function for fetch clients service ticket details
    public function getAllServiceTickets()
    {
        $tickets = SupportTicket::with(['client', 'service', 'assignedUser'])
            ->whereNotNull('service_id')
            ->get();
        return response()->json($tickets);
    }


    // function for filter client tickets according to the ticket status
    public function filterByStatus($status)
    {
        if ($status === 'all') {
            $tickets = SupportTicket::with(['client', 'project', 'assignedUser', 'service'])
                ->whereNotNull('project_id')
                ->get();
        } else {
            $tickets = SupportTicket::with(['client', 'project', 'assignedUser', 'service'])
                ->whereNotNull('project_id')
                ->where('status', $status)
                ->get();
        }

        return response()->json($tickets);
    }
    

    //  function for filter client tickets according to the ticket status for service ticket
    public function filterByStatusService($status){
        if ($status === 'all') {
            $tickets = SupportTicket::with(['client', 'project', 'assignedUser', 'service'])
                ->whereNotNull('service_id')
                ->get();
        } else {
            $tickets = SupportTicket::with(['client', 'project', 'assignedUser', 'service'])
                ->whereNotNull('service_id')
                ->where('status', $status)
                ->get();
        }

        return response()->json($tickets);
    }

    // display selected project-support-ticket's data in admin-side
    public function viewTicket($id){

        $ticket = SupportTicket::with(['client', 'project', 'assignedUser'])->find($id);

        $employees = Employees::all();
        return view('tickets.viewClientTickets', compact('ticket', 'employees'));
        
    }

    //  display selected service-support ticket data in admin side
    public function viewServiceTicket($id){

        $ticket = SupportTicket::with(['client', 'project', 'assignedUser', 'service'])->find($id);

        $employees = Employees::all();
        return view('tickets.viewClientService', compact('ticket', 'employees'));

    }

    // display selected support-ticket's data in client side
    public function clientViewTicket($id)
    {
        $ticket = SupportTicket::with(['project', 'assignedUser'])->find($id);

        return view('clients.clientPortal-view-selectedTicket', compact('ticket'));
    }


    // display selected service support ticket data in client side..
    public function clientViewServiceTicket($id)
    {
        $ticket = SupportTicket::with(['service', 'assignedUser', 'client', 'project'])->find($id);

        // Check if ticket exists
        if (!$ticket) {
            return redirect()->back()->with('error', 'Ticket not found.');
        }

        return view('clients.clientPortal-view-selectedServiceTicket', compact('ticket'));
    }


    // function for close the ticket from client side
    public function changeStatusClientSide($id)
    {
        $ticket = SupportTicket::find($id);

        if (!$ticket) {
            return response()->json([
                'message' => 'Ticket not found.'
            ], 404);
        }

        $ticket->status = 'Closed';
        $ticket->save();

        return response()->json([
            'message' => 'Ticket status updated successfully.',
            'ticket' => $ticket
        ]);
    }


    // function for update the ticket from client portal
    public function updateMyTicket(Request $request, $id)
    {
        // Validate the incoming request
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'attachments.*' => 'file|mimes:jpg,jpeg,png,pdf,docx|max:2048', 
            'remove_attachments.*' => 'integer|exists:ticket_attachments,id', 
        ]);

        try {
            // Find the ticket by ID
            $ticket = SupportTicket::where('id', $id)
                ->where('client_id', Auth::id())
                ->firstOrFail();

            // Update the ticket details
            $ticket->title = $validated['title'];
            $ticket->description = $validated['description'];
            $ticket->save();

            // Handle attachment removal
            if ($request->has('remove_attachments')) {
                $attachmentsToRemove = $ticket->attachments()->whereIn('id', $request->remove_attachments)->get();

                foreach ($attachmentsToRemove as $attachment) {
                    // Delete file from storage
                    Storage::disk('public')->delete($attachment->file_path);

                    // Delete record from database
                    $attachment->delete();
                }
            }

            // Handle new attachments
            if ($request->hasFile('attachments')) {
                foreach ($request->file('attachments') as $file) {
                    $filePath = $file->store('attachments', 'public');
                    $ticket->attachments()->create([
                        'file_name' => $file->getClientOriginalName(),
                        'file_path' => $filePath,
                    ]);
                }
            }

            return response()->json([
                'success' => true,
                'message' => 'Ticket updated successfully.',
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Error updating ticket: ' . $e->getMessage(),
            ], 500);
        }
    }

    // function for change the priority from client-portal
    public function myTicketPriority(Request $request, $id)
    {
        try {
            // Validate the incoming request
            $request->validate([
                'priority' => 'required|string|in:Low,Medium,High,Critical',
            ]);

            // Debug: Log the request data
            Log::info('Changing ticket priority', ['ticket_id' => $id, 'priority' => $request->input('priority')]);

            // Find the ticket and ensure it belongs to the logged-in user
            $ticket = SupportTicket::where('id', $id)->where('client_id', Auth::id())->firstOrFail();

            // Update the priority
            $ticket->priority = $request->input('priority');
            $ticket->save();

            return response()->json([
                'success' => true,
                'message' => 'Ticket priority updated successfully.',
            ], 200);
        } catch (ValidationException $e) {
            return response()->json([
                'success' => false,
                'message' => $e->errors(),
            ], 422);
        } catch (ModelNotFoundException $e) {
            return response()->json([
                'success' => false,
                'message' => 'Ticket not found or unauthorized.',
            ], 404);
        } catch (Exception $e) {
            Log::error('Error updating ticket priority:', ['error' => $e->getMessage()]);
            return response()->json([
                'success' => false,
                'message' => 'Failed to update ticket priority.',
            ], 500);
        }
    }


    // function for assign members into the project
    public function assignMember(Request $request, $ticketId)
    {
        // Validate the request
        $validated = $request->validate([
            'employee_id' => 'required|exists:users,id',
        ]);

        // Find the support ticket by ID
        $ticket = SupportTicket::findOrFail($ticketId);

        // Check if the selected employee belongs to the ticket's related project
        $project = $ticket->project; // Assuming the ticket has a `project` relationship
        if (!$project->employees->contains($validated['employee_id'])) {
            return redirect()->back()->with('error', 'The selected employee is not part of the project.');
        }

        // Assign the employee to the ticket
        $ticket->assigned_to = $validated['employee_id'];
        $ticket->save();

        return redirect()->back()->with('success', 'Member assigned to the support ticket successfully.');
    }


    // function for change the ticket status from admin-side
    public function changeStatus(Request $request, $id)
    {
        try {
            // Validate the incoming request
            $request->validate([
                'status' => 'required|string|in:Open,In Progress,On Hold,Resolved',
            ]);

            // Debug: Log the request data
            Log::info('Changing ticket status', ['ticket_id' => $id, 'status' => $request->input('status')]);

            // Find the ticket
            $ticket = SupportTicket::findOrFail($id);

            // Update the status
            $ticket->status = $request->input('status');
            $ticket->save();

            return response()->json([
                'success' => true,
                'message' => 'Ticket status updated successfully.',
            ], 200);
        } catch (ValidationException $e) {
            return response()->json([
                'success' => false,
                'message' => $e->errors(),
            ], 422);
        } catch (ModelNotFoundException $e) {
            return response()->json([
                'success' => false,
                'message' => 'Ticket not found.',
            ], 404);
        } catch (Exception $e) {
            Log::error('Error updating ticket status:', ['error' => $e->getMessage()]);
            return response()->json([
                'success' => false,
                'message' => 'Failed to update ticket status.',
            ], 500);
        }
    }


    // function for closed the ticked from admin-side
    public function closeSupportTicket($id)
    {
        $ticket = SupportTicket::find($id);

        if (!$ticket) {
            return response()->json([
                'message' => 'Ticket not found.'
            ], 404);
        }

        $ticket->status = 'Closed';
        $ticket->save();

        return response()->json([
            'message' => 'Ticket status updated successfully.',
            'ticket' => $ticket
        ]);
    }




}
