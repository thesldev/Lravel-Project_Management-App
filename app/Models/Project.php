<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Project extends Model
{
    use HasFactory;

    // table
    protected $table = 'project';

    // fillable attributes
    protected $fillable = [
        'name',
        'description',
        'client_id',
        'project_type',
        'status',
        'start_date',
        'end_date'
    ];

    // define the relationship between clident & project
    public function client()
    {
        return $this->belongsTo(Client::class);
    }
}
