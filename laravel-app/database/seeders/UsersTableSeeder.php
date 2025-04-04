<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
    public function run(): void
    {
        // Patient User
        User::create([
            'first_name' => 'Alice',
            'last_name' => 'Kent',
            'username' => 'alicek',
            'password' => bcrypt('password'), // Fake password, hashed
            'user_type' => 'patient',
            'email' => 'alice@example.com',
            'phone' => '(555)555-5555',
            'school_name' => 'Sample School',
            'dob' => '2010-01-01',
            'gender' => 'Female',
            'guardian' => 'John Kent',
        ]);

        // Admin User
        User::create([
            'first_name' => 'Admin',
            'last_name' => 'User',
            'username' => 'admin',
            'password' => bcrypt('password'), // Fake password, hashed
            'user_type' => 'admin',
            'email' => 'admin@example.com',
            'phone' => '(555)555-1234',
        ]);

        // Personnel User
        User::create([
            'first_name' => 'John',
            'last_name' => 'Doe',
            'username' => 'personnel',
            'password' => bcrypt('password'), // Fake password, hashed
            'user_type' => 'personnel',
            'email' => 'personnel@example.com',
            'phone' => '(555)555-6789',
        ]);
    }
}
