<?php

namespace App\Enums;

enum UserRole: string
{
    case ADMIN = 'admin';
    case USER = 'user';

    public function label(): string
    {
        return match($this) {
            self::ADMIN => 'Administrator',
            self::USER => 'Regular User',
        };
    }

    public function permissions(): array
    {
        return match($this) {
            self::ADMIN => [
                'leads.create',
                'leads.update.all',
                'leads.update.own',     // ← TAMBAHKAN INI
                'leads.delete.all',
                'leads.delete.own',     // ← TAMBAHKAN INI
                'leads.view.all',
                'users.manage'
            ],
            self::USER => [
                'leads.create',
                'leads.update.own',
                'leads.delete.own',
                'leads.view.own'
            ]
        };
    }

    public function hasPermission(string $permission): bool
    {
        return in_array($permission, $this->permissions());
    }

    
}