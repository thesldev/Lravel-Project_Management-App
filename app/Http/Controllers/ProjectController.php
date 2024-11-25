<?php

namespace App\Http\Controllers;

use App\Models\Client;
use App\Models\Project;
use Illuminate\Http\Request;

class ProjectController extends Controller
{
    // function for load add project page
    public function create(){
        return view('projects.create');
    }

    // In ProjectController.php
    public function index()
    {
        // Fetch projects with associated clients
        $projects = Project::with('client')->get();

        return view('projects.index', compact('projects'));
    }


    // function for store project data
    public function store(Request $request){
        // validate user data
        $data = $request->validate([
            'name' => 'required|string',
            'description' => 'nullable|string|max:1000',
            'client_id' => 'required|exists:client,id',
            'project_type' => 'required|in:Web,Mobile,Desktop',
            'status' => 'required|in:Pending,Ongoing,Completed',
            'start_date' => 'required|date',
            'end_date' => 'nullable|date|after_or_equal:start_date',
        ]);

        // save data in databse
        Project::create($data);

        // return success response & redirect
        return redirect()->route('projects.index')->with('success', 'Project added successfully!');
    } 


    // function for get selected project details
    public function viewProject(Project $project)
    {
        // Retrieve all clients
        $clients = Client::all();
        
        // Pass both project and clients to the view
        return view('projects.view', compact('project', 'clients'));
    }


    // function for update project
    public function update(Request $request, Project $project)
    {
        // Validate the incoming request
        $data = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'client_id' => 'required|exists:client,id', 
            'project_type' => 'required|in:Web,Mobile,Desktop',
            'status' => 'required|in:Pending,Ongoing,Completed',
            'start_date' => 'required|date',
            'end_date' => 'nullable|date|after_or_equal:start_date',
        ]);

        // Update the project with validated data
        $project->update($data);

        // Return a JSON response indicating success
        return response()->json([
            'success' => true,
            'message' => 'Project updated successfully!',
            'project' => $project // Optional: Include the updated project
        ]);
    }




    // function for delete project
    public function destroy(Project $project)
    {
        // Delete the project
        $project->delete();

        // Fetch updated list of projects
        $projects = Project::with('client')->get();

        // Return the index view with the updated projects list
        return redirect()->route('projects.index')->with('success', 'Project Deleted successfully');

    }

}
