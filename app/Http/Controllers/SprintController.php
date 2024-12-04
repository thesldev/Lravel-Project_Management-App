<?php

namespace App\Http\Controllers;

use App\Models\Project;
use App\Models\Sprint;
use Illuminate\Http\Request;

class SprintController extends Controller
{
    //function for go to sprints page
    public function index(){

        // Fetch all projects from the database
        $projects = Project::all();

        return view('sprints.index', compact('projects'));
    }

    // function for store sprint data in db

    public function store(Request $request){

        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'project_id' => 'required|integer|exists:project,id',
            'duration_weeks' => 'required|integer|min:2|max:4',
            'start_date' => 'required|date',
            'end_date' => 'required|date|after:start_date',
        ]);
    
        // Save sprint to the database
        Sprint::create($validated);
    
        return redirect()->route('sprint.index')->with('success', 'Sprint created successfully.');

    }
}
