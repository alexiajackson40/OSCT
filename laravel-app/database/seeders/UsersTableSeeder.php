<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
    public function run(): void
    {
        User::create([
            'first_name' => 'Alice',
            'last_name' => 'Kent',
            'username' => 'alicek',
            'password' => bcrypt('password'),
            'user_type' => 'patient',
            'email' => 'alice@example.com',
            'phone' => '(555)555-5555',
            'school_name' => 'Sample School',
            'dob' => '2010-01-01',
            'gender' => 'Female',
            'guardian' => 'John Kent'
        ]);
    }
}
