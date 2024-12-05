<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class BacklogIssue extends Model
{
    // Specify the table name if it differs from the default naming convention
    protected $table = 'backlog_issues';

    // Mass assignable properties
    protected $fillable = [
        'title',
        'description',
        'priority',
        'project_id',
        'sprint_id',
        'status',
        'created_by',
    ];

    // Casts for specific attribute types
    protected $casts = [
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];

    // Relationship with the Project model
    public function project()
    {
        return $this->belongsTo(Project::class, 'project_id');
    }

    // Relationship with the Sprint model
    public function sprint()
    {
        return $this->belongsTo(Sprint::class, 'sprint_id');
    }

    // Relationship with the User model for the creator
    public function createdBy()
    {
        return $this->belongsTo(User::class, 'created_by');
    }

    public function issuesInSprint()
    {
        return $this->hasMany(IssuesInSprint::class, 'issue_id');
    }
}
