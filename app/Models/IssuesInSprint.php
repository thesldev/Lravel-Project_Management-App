<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class IssuesInSprint extends Model
{
    protected $table = 'issues_in_sprint';

    protected $fillable = [
        'issue_id',
        'sprint_id',
        'order_index',
    ];

    public function issue()
    {
        return $this->belongsTo(BacklogIssue::class, 'issue_id');
    }

    public function sprint()
    {
        return $this->belongsTo(Sprint::class, 'sprint_id');
    }
}
