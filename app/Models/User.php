<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    /**
     * Relationship with the Client model.
     */
    public function client()
    {
        return $this->hasOne(Client::class, 'user_id');
    }

    public function schedule()
    {
        return $this->hasOne(Schedule::class);
    }

    public function services()
    {
        return $this->belongsToMany(Servics::class, 'service_user');
    }

    /**
     * Relationship with employees assigned to services.
     */
    public function assignedEmployees()
    {
        return $this->belongsToMany(User::class, 'employee_service');
    }
}
