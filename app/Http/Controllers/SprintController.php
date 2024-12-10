<?php

namespace App\Http\Controllers;

use App\Models\IssuesInSprint;
use App\Models\Project;
use App\Models\Sprint;
use App\Models\Subtask;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class SprintController extends Controller
{
    //function for go to sprints page
    public function index(){
        // Fetch all projects from the database
        $projects = Project::all();
        $sprints = Sprint::with('project')->get();

        return view('sprints.index', compact('projects', 'sprints'));
    }

    // function for got to manage sprint page..
    public function managePage(){
        $sprints = Sprint::with(['project', 'issues'])->get();
        return view('sprints.selectSprint', compact( 'sprints'));
    }

    // function for go to manage sprints page..
    public function manage($id)
    {
        $sprint = Sprint::with(['project', 'issuesInSprint.issue'])->findOrFail($id);
        $issuesInSprint = IssuesInSprint::where('sprint_id', $id)->get();
        return view('sprints.handleSprint', compact('sprint', 'issuesInSprint'));
    }
    


    // function for store sprint data in db
    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'project_id' => 'required|integer|exists:project,id',
            'duration_weeks' => 'required|integer|min:2|max:4',
            'start_date' => 'required|date',
            'end_date' => 'required|date|after:start_date',
            'created_by' => 'required|integer|exists:users,id',
        ]);

        // Save the sprint
        Sprint::create($validated);

        return redirect()->route('sprint.index')->with('success', 'Sprint created successfully.');
    }

    // function for go to sprint history page
    public function viewHistory(){
        $projects = Project::all(); 
        return view('sprints.sprintHistory', ['projects' => $projects]);
    }

    // function for view selected project's sprint history
    public function projectHistory($id){

        $projects = Project::findOrFail($id);
        $sprints = Sprint::all();

        return view('sprints.projectSprintHistory', ['projects'=>$projects, 'sprints'=>$sprints]);
    }


    // function for display spring to in employee interfaces
    public function empView()
    {
        // Get the logged-in employee ID
        $employeeId = Auth::id();

        // Fetch projects assigned to the logged-in employee
        $projects = Project::whereHas('employees', function ($query) use ($employeeId) {
            $query->where('employee_id', $employeeId);
        })->get();

        // Fetch sprints for the retrieved projects
        $sprints = Sprint::whereIn('project_id', $projects->pluck('id'))->with('project')->get();

        $subtasks = Subtask::where('assignee_id', $employeeId)->get();

        // Pass data to the view
        return view('sprints.empIndex', compact('projects', 'sprints', 'subtasks'));
    }


}
