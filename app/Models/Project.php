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
        'priority',
        'start_date',
        'end_date',
        'extended_deadline'
    ];

    protected $casts = [
        'assigned_employees' => 'array', // Automatically handle JSON conversion
    ];

    // define the relationship between clident & project
    public function client()
    {
        return $this->belongsTo(Client::class);
    }

    // Define the relationship between project and employees (pivot table)
    public function employees()
    {
        return $this->belongsToMany(Employees::class, 'employee_project', 'project_id', 'employee_id');
    }

}
