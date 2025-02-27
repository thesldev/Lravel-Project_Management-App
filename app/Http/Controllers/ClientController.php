<?php

namespace App\Http\Controllers;

use App\Models\Client;
use App\Models\Employees;
use App\Models\Project;
use App\Models\Servics;
use App\Models\SupportTicket;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;

class ClientController extends Controller
{
    
    public function index(){
        // fetch client data from model
        $clients = Client::all();
        return view('clients.index', ['clients' => $clients]);

    }

    // Fetch all clients and return as JSON
    public function fetchClients()
    {
        $clients = Client::all();
        return response()->json($clients); // Return as JSON
    }


    public function create(){
        return view('clients.create');
    }

    // function to store new client
    public function storeData(Request $request)
    {
        // Validate request data
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'phone' => 'nullable|string|max:15',
            'project_description' => 'nullable|string|max:1000',
            'portal_access' => 'nullable', // Checkbox for portal access
        ]);

        // Cast portal_access to boolean
        $validated['portal_access'] = $request->has('portal_access') ? true : false;

        try {
            // Use a database transaction
            DB::transaction(function () use ($validated) {
                $defaultPassword = '12345678';
                $defaultRole = 3; // Client role is always '3'

                // Explicitly ensure the 'role' is set to '3'
                $user = User::create([
                    'name' => $validated['name'],
                    'email' => $validated['email'],
                    'password' => Hash::make($defaultPassword), // Default password
                    'role' => $defaultRole, // Explicitly set the role
                ]);

                // Create the client in the client table
                Client::create([
                    'id' => $user->id,
                    'user_id' => $user->id,
                    'name' => $validated['name'],
                    'email' => $validated['email'],
                    'phone' => $validated['phone'],
                    'project_description' => $validated['project_description'],
                    'portal_access' => $validated['portal_access'],
                ]);
            });

            // Redirect back with success message
            return redirect()->route('client.index')->with('success', 'Client registered successfully!');
        } catch (\Exception $e) {
            Log::error($e->getMessage());
            return redirect()->back()->withErrors('An error occurred. Please try again.');
        }
    }

    // function for edit client data
    public function editData(Client $client){
        return view('clients.edit', ['client' => $client]);
    }

    // function for update client data
    public function updateData(Client $client, Request $request) {
        $data = $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:client,email,' . $client->id,
            'phone' => 'nullable|digits_between:10,15',
            'project_description' => 'nullable|string|max:1000',
        ]);
    
        $client->update($data);
    
        return redirect(route('client.index'))->with('success', 'Client updated successfully.');
    }
    
    // Function for deleting client data from both client and users tables
    public function deleteData(Client $client)
    {
        try {
            // Use a database transaction for safe deletion
            DB::transaction(function () use ($client) {
                // Delete the related user record
                $client->user()->delete();

                // Delete the client record
                $client->delete();
            });

            return redirect(route('client.index'))->with('success', 'Client deleted successfully.');
        } catch (\Exception $e) {
            Log::error($e->getMessage());
            return redirect()->back()->withErrors('An error occurred. Please try again.');
        }
    }


    // function for get client by Id
    public function viewClient(Client $client){
        return view('clients.view', compact('client'));
    }

    // function for get all clients as JSON format
    public function getClients(){
        $clients = Client::select('id','name')->get();

        // return data in jason format
        return response()->json($clients);
    }


    // functon for go to client-portal dashboard
    public function portalIndex()
    {


        // Count total number of projects
        $totalProjects = Project::where('client_id', Auth::id())->count();

        // Count total services
        $totalServices = Servics::whereHas('users', function ($query) {
            $query->where('user_id', Auth::id());
        })->count();

        // Count total tickets with project_id
        $totalProjectTickets = DB::table('support_tickets')
            ->whereNotNull('project_id')
            ->where('client_id', Auth::id())
            ->count();

        // Count total tickets with service_id
        $totalServiceTickets = DB::table('support_tickets')
            ->whereNotNull('service_id')
            ->where('client_id', Auth::id())
            ->count();

        // Get monthly ticket counts for the chart
        $currentYear = date('Y');

        $monthlyTicketData = DB::table('support_tickets')
            ->select(DB::raw('MONTH(created_at) as month'), DB::raw('COUNT(*) as count'))
            ->where('client_id', Auth::id()) // Assuming client-specific tickets
            ->whereYear('created_at', $currentYear) // Filter by the current year
            ->groupBy(DB::raw('MONTH(created_at)'))
            ->pluck('count', 'month')
            ->toArray();

        // Convert to full month names and fill missing months with 0
        $formattedTicketData = collect(range(1, 12))->mapWithKeys(function ($month) use ($monthlyTicketData) {
            return [date('F', mktime(0, 0, 0, $month, 1)) => $monthlyTicketData[$month] ?? 0];
        })->toArray();

        $ticketLabels = array_keys($formattedTicketData);
        $ticketCounts = array_values($formattedTicketData);

        // Calculate the number of tickets by status
        $openTickets = DB::table('support_tickets')->where('status', 'Open')->count();
        $inProgressTickets = DB::table('support_tickets')->where('status', 'In Progress')->count();
        $onHoldTickets = DB::table('support_tickets')->where('status', 'On Hold')->count();
        $resolvedTickets = DB::table('support_tickets')->where('status', 'Resolved')->count();

        // Prepare data for the pie chart
        $chartData = [
            'Open' => $openTickets,
            'In Progress' => $inProgressTickets,
            'On Hold' => $onHoldTickets,
            'Resolved' => $resolvedTickets,
        ];

        return view('clients.clientPortal', compact(
            'totalProjects',
            'chartData',
            'totalServices',
            'totalProjectTickets',
            'totalServiceTickets',
            'formattedTicketData',
            'ticketLabels',
            'ticketCounts'
        ));
    }

    // function for go to my-projects page in client-portal
    public function myProjects($id)
    {
        try {
            // Ensure the user is authenticated
            if (Auth::id() !== (int)$id) {
                return redirect()->route('dashboard')->withErrors('Unauthorized access.');
            }

            // Retrieve the projects associated with the logged-in client
            $projects = Project::where('client_id', $id)->get();

            // Pass the projects to the view
            return view('clients.clientPortal-view-project', compact('projects'));
        } catch (\Exception $e) {
            Log::error($e->getMessage());
            return redirect()->back()->withErrors('An error occurred. Please try again.');
        }
    }


    // function for go to my-services page in client portal
    public function myServices($id)
    {
        try {
            // Ensure the user is authenticated
            if (Auth::id() !== (int)$id) {
                return redirect()->route('dashboard')->withErrors('Unauthorized access.');
            }

            // Retrieve the client data
            $client = Client::where('user_id', $id)->firstOrFail();

            // Fetch services associated with the client
            $services = $client->services;

            // Debugging: Log data to verify
            Log::info('Fetched services for client', ['client_id' => $client->id, 'services' => $services]);

            // Pass the services to the view
            return view('clients.clientPortal-view-service', compact('services'));
        } catch (\Exception $e) {
            Log::error('Error fetching client services: ' . $e->getMessage());
            return redirect()->back()->withErrors('An error occurred. Please try again.');
        }
    }




    // function for enable/disbale client portal access
    public function togglePortalAccess(Client $client)
    {
        $client->portal_access = $client->portal_access == 1 ? 0 : 1;
        $client->save();

        return response()->json([
            'success' => true,
            'portal_access' => $client->portal_access,
        ]);
    }

}
