<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::create([
            'name' => 'Admin FitAcademy',
            'email' => 'admin@fitacademy.com',
            'password' => Hash::make('password'), // Change this for production!
            'role' => 'admin',
            'email_verified_at' => now(),
        ]);

        // 2. Create a specific Test Member
        User::create([
            'name' => 'Stevie pilat',
            'email' => 'stevie@gmail.com',
            'password' => Hash::make('password'),
            'role' => 'member',
            'email_verified_at' => now(),
        ]);

        // 3. Create 10 Random Members (for testing lists/pagination)
        User::factory(10)->create([
            'role' => 'member',
        ]);
    }
}
