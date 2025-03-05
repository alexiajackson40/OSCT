<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    public function run()
    {
        // Admin user
        $user = new User;
        $user->name = 'Admin User';
        $user->email = 'admin@example.com';
        $user->password = bcrypt('password');
        $user->role = 'admin';
        $user->save();

        // Personnel user
        $user = new User;
        $user->name = 'Personnel User';
        $user->email = 'personnel@example.com';
        $user->password = bcrypt('password');
        $user->role = 'personnel';
        $user->save();

        // Patient user
        $user = new User;
        $user->name = 'Patient User';
        $user->email = 'patient@example.com';
        $user->password = bcrypt('password');
        $user->role = 'patient';
        $user->save();
    }
}