<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Client extends Model
{
    use HasFactory;
    protected $table = 'client';

    protected $fillable = [
        'id',
        'user_id',
        'name',
        'email',
        'phone',
        'project_description',
        'portal_access',
    ];

    /**
     * Define the relationship with the User model.
     * A client belongs to a user.
     */
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    /**
     * Define additional relationships if needed, e.g., with projects.
     */
    public function projects()
    {
        return $this->hasMany(Project::class); 
    }

    /**
     * A client has many services.
     */
    public function services()
    {
        return $this->belongsToMany(Servics::class, 'service_user', 'user_id', 'service_id');
    }

}
