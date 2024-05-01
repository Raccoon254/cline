<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        // Create 100 users with the role of 'user'
        User::factory()
            ->count(100)
            ->create([
                'role' => 'user',
            ]);

        // Create 100 users with the role of 'client'
        User::factory()
            ->hasClient(1) // for each user, create 1 client
            ->count(100)
            ->create([
                'role' => 'client',
            ]);
    }
}
