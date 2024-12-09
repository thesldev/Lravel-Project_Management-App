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

    // function for display selected sub task
    public function show(Subtask $subtask)
    {
        // Eager load the assignee relationship
        $subtask->load('assignee');

        // Return the subtask with the assignee name as part of the response
        return response()->json([
            'id' => $subtask->id,
            'title' => $subtask->title,
            'description' => $subtask->description,
            'status' => $subtask->status,
            'assignee' => $subtask->assignee ? [
                'id' => $subtask->assignee->id,
                'name' => $subtask->assignee->name
            ] : null,
             'created_by' => $subtask->createdBy ? [
            'id' => $subtask->createdBy->id,
            'name' => $subtask->createdBy->name
            ] : null,
            'created_at' => $subtask->created_at->toDateTimeString()
        ]);
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

    // function for get data to edit the subtask
    public function edit($id)
    {
        $subtask = Subtask::findOrFail($id);
        return response()->json($subtask);
    }

    // function for update subtask
    public function update(Request $request, $id)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'status' => 'required|string|in:To Do,In Progress,Completed',
        ]);

        $subtask = Subtask::findOrFail($id);
        $subtask->update($request->all());

        return response()->json(['message' => 'Subtask updated successfully']);
    }


}
