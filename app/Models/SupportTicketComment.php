<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SupportTicketComment extends Model
{
    //
    use HasFactory;

    protected $table = 'support_ticket_comments'; // Table name

    protected $fillable = [
        'ticket_id',
        'user_id',
        'content',
        'parent_comment_id',
    ];

    public function ticket()
    {
        return $this->belongsTo(SupportTicket::class, 'ticket_id');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function parentComment()
    {
        return $this->belongsTo(SupportTicketComment::class, 'parent_comment_id');
    }

    public function replies()
    {
        return $this->hasMany(SupportTicketComment::class, 'parent_comment_id');
    }
    
}
