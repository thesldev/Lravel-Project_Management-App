<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SupportTicket extends Model
{
    //
    use HasFactory;

    protected $fillable = [
        'title',
        'description',
        'client_id',
        'project_id',
        'service_id',
        'priority',
        'status',
        'assigned_to',
    ];

    // Relationships
    public function client()
    {
        return $this->belongsTo(Client::class, 'client_id');
    }

    public function project()
    {
        return $this->belongsTo(Project::class, 'project_id');
    }

    // public function service()
    // {
    //     return $this->belongsTo(Service::class, 'service_id');
    // }

    public function assignedUser()
    {
        return $this->belongsTo(User::class, 'assigned_to');
    }
}
