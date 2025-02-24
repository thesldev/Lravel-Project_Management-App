<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Servics extends Model
{
    //
    use HasFactory;
    protected $table = 'services';

    protected $fillable = [
        'id',
        'name',
        'description',
        'service_type',
        'status',
        'priority',
        'start_date',
        'user_id',
    ];

    /**
     * A service belongs to a client.
     */
    public function clients()
    {
        return $this->belongsToMany(Client::class, 'service_user', 'service_id', 'user_id');

    }


    public function users()
    {
        return $this->belongsToMany(User::class, 'service_user', 'service_id', 'user_id');
    }

    public function assignedEmployees()
    {
        return $this->belongsToMany(User::class, 'employee_service', 'service_id', 'employee_id');
    }


    public function announcements()
    {
        return $this->hasMany(Announcement::class, 'service', 'id');
    }

    /**
     * Support tickets related to this service.
     */
    public function supportTickets()
    {
        return $this->hasMany(SupportTicket::class, 'service_id', 'id');
    }

}
