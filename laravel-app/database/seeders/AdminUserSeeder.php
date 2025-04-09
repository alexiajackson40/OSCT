<?php

namespace Database\Seeders;

use App\Models\Admin;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class AdminUserSeeder extends Seeder
{
    public function run(): void
    {
        // Admin User
        Admin::create([
            'first_name' => 'Admin',
            'last_name' => 'User',
            'username' => 'admin',
            'password' => Hash::make('admin'),
            'email' => 'admin@example.com',
            'phone' => '(555)555-1234',
            'address' => '123 Test Ave',
            'role' => 'admin',
        ]);
    }
}
