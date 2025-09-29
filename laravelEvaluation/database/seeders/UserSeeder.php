<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        // Create Admin User
        User::create([
            'name' => 'Administrator',
            'email' => 'admin@example.com',
            'password' => Hash::make('admin123'),
            'role' => 'admin',
            'email_verified_at' => now(),
        ]);

        // Create Student User
        User::create([  
            'name' => 'Student',
            'email' => 'Dixni@gmail.com',
            'password' => Hash::make('user1'),
            'role' => 'student',
            'email_verified_at' => now(),
        ]);

        // Create another student for testing
        User::create([
            'name' => 'Student',
            'email' => 'student@example.com',
            'password' => Hash::make('student123'),
            'role' => 'student',
            'email_verified_at' => now(),
        ]);
    }
}
