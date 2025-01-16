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


}
