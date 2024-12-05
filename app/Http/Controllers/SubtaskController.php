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


}
