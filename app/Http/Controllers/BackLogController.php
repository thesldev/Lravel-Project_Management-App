<?php

namespace App\Http\Controllers;

use App\Models\BacklogIssue;
use App\Models\Employees;
use Illuminate\Http\Request;
use Symfony\Contracts\Service\Attribute\Required;

class BackLogController extends Controller
{

    public function view($id)
    {
        // Assuming 'Issue' is the model representing the issues table.
        $issue = BacklogIssue::with('subtasks')->find($id);
        $subtaskCount = $issue->subtasks->count();
        $employees = Employees::all();
        return view('sprints.viewIssues', compact('issue', 'employees', 'subtaskCount'));
    }


    // function for create issue
    public function store(Request $request)
    {
        $validateData = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'priority' => 'required|in:Low,Medium,High,Critical',
            'project_id' => 'required|exists:project,id',
            'sprint_id' => 'nullable|exists:sprints,id',
            'status' => 'required|in:Backlog,In Sprint,Completed',
            'created_by' => 'required|exists:users,id',
        ]);

        $issue = BacklogIssue::create($validateData);

        return response()->json(['message' => 'Issue created successfully'], 200);
    }


    // function for get issues..
    public function getIssues(Request $request){

        
        $issues = BacklogIssue::orderBy('order')->get();

        return response()->json($issues);
    }


    // function for order in the list
    public function updateOrder(Request $request)
    {
        $order = $request->input('order');

        if (!$order || !is_array($order)) {
            return response()->json(['message' => 'Invalid data'], 400);
        }

        foreach ($order as $index => $id) {
            BacklogIssue::where('id', $id)->update(['order' => $index]);
        }

        return response()->json(['message' => 'Order updated successfully']);
    }

    // function to show the details of a specific issue
    public function show($id)
    {
        $issue = BacklogIssue::findOrFail($id);
        return response()->json($issue);
    }

    // function to update the details of a specific issue
    public function update(Request $request, $id)
    {
        $issue = BacklogIssue::findOrFail($id);
        $issue->update($request->only(['title', 'description', 'priority', 'status']));
        return response()->json(['message' => 'Issue updated successfully']);
    }


    // function for delete the issue from project
    public function destroy(BacklogIssue $issue)
    {
        try {
            // Delete the issue
            $issue->delete();

            return response()->json([
                'message' => 'Issue deleted successfully.'
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                'message' => 'Failed to delete issue.',
                'error' => $e->getMessage()
            ], 500);
        }
    }
}
