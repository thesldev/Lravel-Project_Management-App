<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    //
    use HasFactory;

    protected $table = 'comments';

    protected $fillable = [
        'ticket_id ',
        'user_id ',
        'content'
    ];


    // Define the inverse of the relationship with Ticket
    public function ticket()
    {
        return $this->belongsTo(Ticket::class, 'ticket_id');
    }

    // Define the inverse of the relationship with User
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}


