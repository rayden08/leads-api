<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use App\Enums\UserRole;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

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

    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
        // 'role' => UserRole::class,
    ];

    public function leads()
    {
        return $this->hasMany(Lead::class);
    }

    
    public function isAdmin()
    {
        return $this->role === 'admin'; 
    }

    public function isUser(): bool
    {
        return $this->role === UserRole::USER;
    }

    public function canViewAllLeads(): bool
    {
        return $this->isAdmin();
    }

    public function canUpdateAllLeads(): bool
    {
        return $this->isAdmin();
    }

    public function canDeleteAllLeads(): bool
    {
        return $this->isAdmin();
    }
}