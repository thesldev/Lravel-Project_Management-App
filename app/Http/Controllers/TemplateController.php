<?php

namespace App\Http\Controllers;

use App\Models\Employees;
use App\Models\Project;
use Carbon\Carbon;

class TemplateController extends Controller
{
    // Create function to display home page
    public function index()
    {
        // Calculate total budget for the current year
        $totalBudget = Project::whereYear('start_date', Carbon::now()->year)->sum('budget');

        // Calculate total budget for the current month
        $monthlyEarnings = Project::whereYear('start_date', Carbon::now()->year)
            ->whereMonth('start_date', Carbon::now()->month)
            ->sum('budget');

        // Count total number of projects
        $totalProjects = Project::count();

        // Count total employees
        $totalEmployees = Employees::count(); 

        // Pass the $totalBudget to the view
        return view('dashboard', compact('totalBudget','monthlyEarnings','totalProjects','totalEmployees'));
    }

}
