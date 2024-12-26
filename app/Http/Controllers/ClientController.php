<?php

namespace App\Http\Controllers;

use App\Models\Client;
use App\Models\Employees;
use App\Models\Project;
use Carbon\Carbon;
use Illuminate\Http\Request;

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
    public function storeData(Request $request){
        // validate user data
        $data = $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:client,email',
            'phone' => 'nullable|digits_between:10,15',
            'project_description' => 'nullable|string|max:1000',
        ]);

        $newClient = Client::create($data);
        return redirect(route('client.index'));
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
    
    //function for delete client data
    public function deleteData(Client $client){
        $client->delete();
        return redirect(route('client.index'))->with('success', 'Client Deleted successfully.');
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
    public function portalIndex(){

        // Calculate total budget for the current year
        $totalBudget = Project::whereYear('start_date', Carbon::now()->year)->sum('budget');

        // Calculate total budget for the current month
        $monthlyEarnings = Project::whereYear('start_date', Carbon::now()->year)
            ->whereMonth('start_date', Carbon::now()->month)
            ->sum('budget');

        // Get monthly earnings for the chart
        $monthlyData = Project::selectRaw('SUM(budget) as total, MONTH(start_date) as month')
            ->whereYear('start_date', Carbon::now()->year)
            ->groupBy('month')
            ->orderBy('month')
            ->pluck('total', 'month')->toArray();

        // Count total number of projects
        $totalProjects = Project::count();

        // Count total employees
        $totalEmployees = Employees::count();

        // Calculate the number of completed, ongoing, and pending projects
        $completedProjects = Project::where('status', 'completed')->count();
        $ongoingProjects = Project::where('status', 'ongoing')->count();
        $pendingProjects = Project::where('status', 'pending')->count();

        // Prepare data for the pie chart
        $chartData = [
            'completed' => $completedProjects,
            'ongoing' => $ongoingProjects,
            'pending' => $pendingProjects,
        ];

        // Get the top 10 projects by priority, then by creation date
        $projects = Project::select('name', 'priority', 'budget', 'end_date', 'extended_deadline', 'created_at')
            ->orderByRaw("FIELD(priority, 'High Priority', 'Medium Priority', 'Low Priority')")
            ->orderBy('created_at', 'desc')
            ->take(10)
            ->get();

        // Map through projects to prepare data for display
        $projectData = $projects->map(function ($project) {
            // Determine the end date based on extended_deadline or fallback to end_date
            $endDate = $project->extended_deadline ?? $project->end_date;

            // Get employee count for the project (assuming a relationship 'employees')
            $employeeCount = $project->employees()->count();

            return [
                'name' => $project->name,
                'priority' => $project->priority,
                'budget' => number_format($project->budget, 2) . ' $', // Format the budget
                'employeeCount' => $employeeCount . ' employees',
                'endDate' => $endDate ? Carbon::parse($endDate)->format('Y.m.d') : 'N/A', // Format or display N/A if no date
            ];
        });
        
        return view('clients.clientPortal', compact(
            'totalBudget',
            'monthlyEarnings',
            'totalProjects',
            'totalEmployees',
            'monthlyData',
            'chartData',
            'projectData'
        ));

    }
}
