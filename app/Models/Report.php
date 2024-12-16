<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Report extends Model
{
    //

    protected $fillable = [
        'title',
        'sub_title',
        'description',
        'created_by',
    ];

     // Relationship with the backlog_issues table
     public function backlogIssues()
     {
         return $this->hasMany(BacklogIssue::class);
     }
 
     // Relationship with the project table
     public function project()
     {
         return $this->belongsTo(Project::class);
     }
 
     // Relationship with the sprints table
     public function sprints()
     {
         return $this->hasMany(Sprint::class);
     }
 
     // Relationship with the subtasks table
     public function subtasks()
     {
         return $this->hasMany(Subtask::class);
     }
 
     // Relationship with the tickets table
     public function tickets()
     {
         return $this->hasMany(Ticket::class);
     }
 
     // Relationship with the users table
     public function users()
     {
         return $this->belongsToMany(User::class, 'report_user');
     }
 
     // Relationship with the client table
     public function client()
     {
         return $this->belongsTo(Client::class);
     }
 
     // Relationship with the ticket_statuses table
     public function ticketStatuses()
     {
         return $this->hasMany(TicketStatus::class);
     }
 
     // Relationship with the ticket_type table
     public function ticketType()
     {
         return $this->belongsTo(TicketType::class);
     }
}
