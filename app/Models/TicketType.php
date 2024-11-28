<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TicketType extends Model
{
    //

    use HasFactory;

    protected $table = 'ticket_type';

    protected $fillable = [
        'name',
        'description'
    ];

    // Define the inverse of the relationship with Ticket
    public function tickets()
    {
        return $this->hasMany(Ticket::class, 'type_id');
    }
}
