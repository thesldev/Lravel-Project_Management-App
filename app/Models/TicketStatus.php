<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TicketStatus extends Model
{
    //

    use HasFactory;

    protected $table = 'ticket_statuses';

    protected $fillable = [
        'name',
        'is_final'
    ];


    // Define the inverse of the relationship with Ticket
    public function tickets()
    {
        return $this->hasMany(Ticket::class, 'status_id');
    }
}
