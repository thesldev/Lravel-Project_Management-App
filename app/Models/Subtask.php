<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Subtask extends Model
{
    // Specify the table name if it differs from the default naming convention
    protected $table = 'subtasks';

    // Mass assignable properties
    protected $fillable = [
        'issue_id',
        'title',
        'description',
        'assignee_id',
        'status',
        'created_by',
    ];

    // Casts for specific attribute types
    protected $casts = [
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];

    // Define the relationship with the BacklogIssues model
    public function issue()
    {
        return $this->belongsTo(BacklogIssue::class, 'issue_id');
    }

    // Define the relationship with the User model for the assignee
    public function assignee()
    {
        return $this->belongsTo(User::class, 'assignee_id');
    }

    // Define the relationship with the User model for the creator
    public function createdBy()
    {
        return $this->belongsTo(User::class, 'created_by');
    }
}
