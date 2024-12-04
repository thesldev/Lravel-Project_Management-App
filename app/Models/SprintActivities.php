<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SprintActivities extends Model
{
    // Specify the table name if it differs from the default naming convention
    protected $table = 'sprint_activities';

    // Mass assignable properties
    protected $fillable = [
        'sprint_id',
        'issue_id',
        'action',
        'performed_by',
        'performed_at',
    ];

    // Casts for specific attribute types
    protected $casts = [
        'performed_at' => 'datetime',
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];

    // Define the relationship with the Sprint model
    public function sprint()
    {
        return $this->belongsTo(Sprint::class, 'sprint_id');
    }

    // Define the relationship with the BacklogIssues model
    public function issue()
    {
        return $this->belongsTo(BacklogIssue::class, 'issue_id');
    }

    // Define the relationship with the User model for the user who performed the action
    public function performedBy()
    {
        return $this->belongsTo(User::class, 'performed_by');
    }
}
