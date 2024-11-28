<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ticket extends Model
{
    use HasFactory;

    protected $table = 'tickets';

    protected $fillable = [
        'title',
        'description',
        'priority',
        'status_id',
        'type_id',
        'reporter_id',
        'assignee_id',
        'project_id',
        'due_date',
        'closed_at',
        'parent_ticket_id',

    ];

    // Define the relationship with the status
    public function status()
    {
        return $this->belongsTo(TicketStatus::class, 'status_id');
    }

    // Define the relationship with the type
    public function type()
    {
        return $this->belongsTo(TicketType::class, 'type_id');
    }

    // Define the relationship with the reporter
    public function reporter()
    {
        return $this->belongsTo(User::class, 'reporter_id');
    }

    // Define the relationship with the assignee
    public function assignee()
    {
        return $this->belongsTo(User::class, 'assignee_id');
    }

    // Define the relationship with the project
    public function project()
    {
        return $this->belongsTo(Project::class, 'project_id');
    }

    // Define the relationship for the parent ticket
    public function parentTicket()
    {
        return $this->belongsTo(Ticket::class, 'parent_ticket_id');
    }

    // Define the relationship for child tickets
    public function childTickets()
    {
        return $this->hasMany(Ticket::class, 'parent_ticket_id');
    }
}
