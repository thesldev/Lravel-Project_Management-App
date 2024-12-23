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

    // Function for going to the sprint history page
    public function viewHistory(){
        $projects = Project::all();

        $projectData = $projects->map(function ($project) {
            $startDate = new \DateTime($project->start_date);
            $endDate = new \DateTime($project->end_date);
            $currentDate = new \DateTime();

            // Calculate total time duration
            $totalDuration = $startDate->diff($endDate)->format('%a days');

            // Calculate remaining time
            $remainingTime = $currentDate < $endDate 
                ? $currentDate->diff($endDate)->format('%a days')
                : '0 days'; // If the current date is past the end date, set remaining time to 0

            return [
                'project' => $project,
                'totalDuration' => $totalDuration,
                'remainingTime' => $remainingTime,
            ];
        });

        return view('sprints.sprintHistory', [
            'projects' => $projects,
            'projectData' => $projectData,
        ]);
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


    // function for display sprint history for employee section
    public function empSprintHistory($id)
    {
        // Get the logged-in employee ID
        $employeeId = Auth::id();

        // Get projects where the logged-in employee is assigned
        $projects = Project::whereHas('employees', function ($query) use ($employeeId) {
            $query->where('employee_id', $employeeId);
        })->get();

        // Get sprints related to the specific project
        $sprints = Sprint::where('project_id', $id)->get();

        // Get subtasks assigned to the logged-in employee
        $subtasks = Subtask::where('assignee_id', $employeeId)->get();

        return view('sprints.empSprintHistory', compact('sprints', 'subtasks', 'projects'));
    }



    // function for display selected sprint's sub-tasks in employee side
    public function viewSubTask($sprintId){
        $employeeId = Auth::id();

        // Fetch the specific sprint
        $sprint = Sprint::where('id', $sprintId)
            ->with('project')
            ->first();

        if (!$sprint) {
            return redirect()->back()->with('error', 'Sprint not found.');
        }

        // Fetch only subtasks for the specific sprint assigned to the logged-in employee
        $subtasks = Subtask::where('assignee_id', $employeeId)
            ->whereHas('issue', function ($query) use ($sprintId) {
                $query->where('sprint_id', $sprintId);
            })
            ->get();

        return view('sprints.empViewSubTask', compact('sprint', 'subtasks'));
    
    }

}
