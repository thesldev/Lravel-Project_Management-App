<?php

namespace App\Http\Controllers;

use App\Models\Employees;
use App\Models\Project;
use Carbon\Carbon;

class TemplateController extends Controller
{
    // Create function to display the home page
    public function index()
    {
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

        // Pass data to the view
        return view('dashboard', compact(
            'totalBudget',
            'monthlyEarnings',
            'totalProjects',
            'totalEmployees',
            'monthlyData',
            'chartData',
            'projectData'
        ));
    }

    public function employeeDashboard(){
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

        // Pass data to the view
        return view('employeeDashboard', compact(
            'totalBudget',
            'monthlyEarnings',
            'totalProjects',
            'totalEmployees',
            'monthlyData',
            'chartData',
            'projectData'
        ));
    }

    public function admin(){
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

        // Pass data to the view
        return view('admin', compact(
            'totalBudget',
            'monthlyEarnings',
            'totalProjects',
            'totalEmployees',
            'monthlyData',
            'chartData',
            'projectData'
        ));
    }
    public function supAdmin(){
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

        // Pass data to the view
        return view('supAdmin', compact(
            'totalBudget',
            'monthlyEarnings',
            'totalProjects',
            'totalEmployees',
            'monthlyData',
            'chartData',
            'projectData'
        ));
    }

    // function for client portal

    public function client(){
        return view('clientDashboard');
    }
}