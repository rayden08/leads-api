<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        // Create admin user
        User::create([
            'name' => 'Administrator',
            'email' => 'admin@leads.app',
            'password' => Hash::make('password123'),
            'role' => 'admin'
        ]);

        // Create regular user
        User::create([
            'name' => 'Regular User',
            'email' => 'user@leads.app',
            'password' => Hash::make('password123'),
            'role' => 'user'
        ]);

        // Create more users for testing
        User::factory(10)->create();
    }
}