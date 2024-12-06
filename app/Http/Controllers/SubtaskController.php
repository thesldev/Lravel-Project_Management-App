<?php

namespace App\Http\Controllers;

use App\Models\Subtask;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


class SubtaskController extends Controller
{
    // function for store subtask in db
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'issue_id' => 'required|exists:backlog_issues,id',
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'assignee_id' => 'nullable|exists:users,id',
            'status' => 'required|string|in:To Do,In Progress,Done',
        ]);

        $validatedData['created_by'] = Auth::id();

        Subtask::create($validatedData);

        return redirect()->route('issuesInSprint.view', $validatedData['issue_id'])
                        ->with('success', 'Subtask created successfully.');
    }


    public function getSubtasksByIssue($issue_id)
    {
        $subtasks = Subtask::with('backlogIssue') // Eager load the related backlog issue
                            ->where('issue_id', $issue_id)
                            ->get();
    
        return view('sprints.viewIssues', compact('subtasks'));
    }
    

    // function for get all sub taskts
    public function getAll(Request $request)
    {
        $issueId = $request->input('issue_id');
        $subtasks = Subtask::with(['assignee' => function($query) {
            $query->select('id', 'name', 'job_role', 'position'); 
        }])->where('issue_id', $issueId)->get();

        return response()->json($subtasks);
    }


    // function for delete sub task
    public function destroy($id)
    {
        try {
            $subtask = Subtask::findOrFail($id);
            $subtask->delete();

            return response()->json([
                'success' => true,
                'message' => 'Subtask deleted successfully.'
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Subtask not found or could not be deleted.',
                'error' => $e->getMessage()
            ], 404);
        }
    }


}
