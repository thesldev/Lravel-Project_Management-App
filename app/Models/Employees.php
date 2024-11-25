<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Employees extends Model
{
    use HasFactory;

    // define table
    protected $table = 'users';

    protected $fillable = [
        'name',
        'email',
        'role',
        'job_role',
        'position',
        'join_date',
        'password'
    ];

    // define relationship with project table
    public function projects()
    {
        return $this->hasMany(Project::class, 'employee_id'); 
    }
}
