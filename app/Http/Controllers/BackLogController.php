<?php

namespace App\Http\Controllers;

use App\Models\BacklogIssue;
use Illuminate\Http\Request;
use Symfony\Contracts\Service\Attribute\Required;

class BackLogController extends Controller
{
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

}
