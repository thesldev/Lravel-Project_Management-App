<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Employees extends Model
{
    use HasFactory;

    // define table
    protected $table = 'users';

    protected $fillable = [
        'name',
        'email',
        'role',
        'job_role',
        'position',
        'join_date',
        'password'
    ];

    // define relationship with project table
    public function projects()
    {
        return $this->belongsToMany(Project::class, 'employee_project', 'employee_id', 'project_id');
    }


    // Define the relationship for tickets where the user is the reporter
    public function reportedTickets()
    {
        return $this->hasMany(Ticket::class, 'reporter_id');
    }

    // Define the relationship for tickets where the user is the assignee
    public function assignedTickets()
    {
        return $this->hasMany(Ticket::class, 'assignee_id');
    }

    // Define the relationship for comments made by the user
    public function comments()
    {
        return $this->hasMany(Comment::class, 'user_id');
    }
}
