<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Sprint extends Model
{
    // Specify the table name if it differs from the default naming convention
    protected $table = 'sprints';

    // Mass assignable properties
    protected $fillable = [
        'title',
        'description',
        'project_id',
        'duration_weeks',
        'start_date',
        'end_date',
        'created_by',
    ];    
    
    // Casts for date attributes
    protected $casts = [
        'start_date' => 'date',
        'end_date' => 'date',
    ];

    // Define the relationship with the Project model
    public function project()
    {
        return $this->belongsTo(Project::class, 'project_id');
    }

    // Define the relationship with the User model for the creator
    public function createdBy()
    {
        return $this->belongsTo(User::class, 'created_by');
    }

    public function issuesInSprint()
    {
        return $this->hasMany(IssuesInSprint::class, 'sprint_id');
    }

    public function issues()
    {
        return $this->hasManyThrough(BacklogIssue::class, IssuesInSprint::class, 'sprint_id', 'id', 'id', 'issue_id');
    }

}
