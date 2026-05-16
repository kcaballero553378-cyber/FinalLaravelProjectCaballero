<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    protected $fillable = [
        'name',
        'email',
        'password',
        'role'
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    // ✅ ROLE CHECKS
    public function isAdmin()
    {
        return $this->role === 'admin';
    }

    public function isResearcher()
    {
        return $this->role === 'researcher';
    }

    public function isReviewer()
    {
        return $this->role === 'reviewer';
    }

    public function isGuest()  // renamed from isPublic
    {
        return $this->role === 'guest';  // renamed from 'user'
    }
}