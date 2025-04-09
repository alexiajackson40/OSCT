<?php

namespace Database\Seeders;

use App\Models\Patient;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class PatientUserSeeder extends Seeder
{
    public function run(): void
    {
        // Patient User
        Patient::create([
            'first_name' => 'Alice',
            'last_name' => 'Kent',
            'username' => 'alicek',
            'password' => Hash::make('password'),
            'email' => 'alice@example.com',
            'phone' => '(555)555-5555',
            'role' => 'patient',
            'school_name' => 'Sample School',
            'dob' => '2010-01-01',
            'gender' => 'Female',
            'guardian' => 'John Kent',
        ]);
    }
}
