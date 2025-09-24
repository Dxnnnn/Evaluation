<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Create 10 random users
        // User::factory(10)->create();

        // Call the UserSeeder
        $this->call([
            UserSeeder::class,
        ]);
    }


}
