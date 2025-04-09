<?php

namespace Database\Seeders;

use App\Models\Personnel;
use Illuminate\Database\Seeder;

class PersonnelUserSeeder extends Seeder
{
    public function run(): void
    {
        // Creating a Personnel user
        Personnel::create([
            'first_name' => 'John',
            'last_name' => 'Doe',
            'username' => 'personnel',
            'password' => bcrypt('password'), // Fake password, hashed
            'email' => 'personnel@example.com',
            'phone' => '(555)555-6789',
            'role' => 'personnel', // Role
        ]);
    }
}
