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
        'content',
        'parent_comment_id'
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

    // Define the relationship for parent comment (for replies)
    public function parentComment()
    {
        return $this->belongsTo(Comment::class, 'parent_comment_id');
    }

    // Define the relationship for child comments (replies)
    public function replies()
    {
        return $this->hasMany(Comment::class, 'parent_comment_id');
    }
}


