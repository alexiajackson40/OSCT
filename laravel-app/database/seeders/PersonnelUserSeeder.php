<?php

namespace Database\Seeders;

use App\Models\Personnel;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class PersonnelUserSeeder extends Seeder
{
    public function run(): void
    {
        Personnel::create([
            'first_name' => 'John',
            'last_name' => 'Doe',
            'username' => 'personnel',
            'email' => 'personnel@example.com',
            'phone' => '(555)555-6789',
            'address' => '456 Clinic Avenue',
            'employee_id' => 'EMP001',
            'specialization' => 'Nurse',
            'role' => 'personnel',
            'password' => Hash::make('password'),
        ]);
    }
}
