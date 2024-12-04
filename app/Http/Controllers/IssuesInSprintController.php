<?php

namespace App\Http\Controllers;

use App\Models\IssuesInSprint;
use Illuminate\Http\Request;

class IssuesInSprintController extends Controller
{
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'issue_id' => 'required|exists:backlog_issues,id', 
            'sprint_id' => 'required|exists:sprints,id', 
        ]);

        // Check if the issue is already added to the sprint
        $existingEntry = IssuesInSprint::where('issue_id', $validatedData['issue_id'])
            ->where('sprint_id', $validatedData['sprint_id'])
            ->first();

        if ($existingEntry) {
            return response()->json(['message' => 'Issue already exists in the sprint'], 400);
        }

        // Determine the order index
        $maxOrderIndex = IssuesInSprint::where('sprint_id', $validatedData['sprint_id'])->max('order_index');
        $orderIndex = is_null($maxOrderIndex) ? 1 : $maxOrderIndex + 1;

        // Store the issue in the sprint
        $issuesInSprint = IssuesInSprint::create([
            'issue_id' => $validatedData['issue_id'],
            'sprint_id' => $validatedData['sprint_id'],
            'order_index' => $orderIndex,
        ]);

        return response()->json([
            'message' => 'Issue successfully added to the sprint',
            'data' => $issuesInSprint,
        ]);
    }


    public function getIssues(Request $request)
    {
        // Fetch the issues in the sprint
        $sprintId = $request->input('sprint_id'); // Assuming sprint ID is sent in the request
        $issuesInSprint = IssuesInSprint::where('sprint_id', $sprintId)
                                        ->with('issue') // Assuming there's a relationship set up
                                        ->get();

        return response()->json($issuesInSprint);
    }

    public function updateOrder(Request $request)
    {
        $validatedData = $request->validate([
            'order' => 'required|array',
            'sprint_id' => 'required|exists:sprints,id'
        ]);

        // Update order_index for each issue
        foreach ($validatedData['order'] as $index => $issueId) {
            IssuesInSprint::where('issue_id', $issueId)
                        ->where('sprint_id', $validatedData['sprint_id'])
                        ->update(['order_index' => $index + 1]);
        }

        return response()->json(['message' => 'Order updated successfully']);
    }

}