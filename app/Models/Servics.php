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

}
