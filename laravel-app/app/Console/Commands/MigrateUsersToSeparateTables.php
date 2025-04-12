<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;

class MigrateUsersToSeparateTables extends Command
{
    protected $signature = 'migrate:users';
    protected $description = 'Move users from users table into admins, personnel, and patients tables';

    public function handle()
    {
        // Fetch users from the users table
        $users = DB::table('users')->get();

        foreach ($users as $user) {
            if ($user->user_type === 'admin') {
                DB::table('patients')->insert([
                    'first_name' => $user->first_name,
                    'last_name' => $user->last_name,
                    'username' => $user->username,
                    'password' => $user->password,
                    'email' => $user->email,
                    'phone' => $user->phone,
                    'school_name' => $user->school_name, // Matches migration
                    'dob' => $user->dob,
                    'gender' => $user->gender,
                    'guardian' => $user->guardian,
                    'created_at' => $user->created_at,
                    'updated_at' => $user->updated_at,
                ]);
                
            } elseif ($user->user_type === 'personnel') {
                DB::table('personnel')->insert([
                    'first_name' => $user->first_name,
                    'last_name' => $user->last_name,
                    'username' => $user->username,
                    'password' => $user->password,
                    'email' => $user->email,
                    'phone' => $user->phone,
                    'created_at' => $user->created_at,
                    'updated_at' => $user->updated_at,
                ]);
            } elseif ($user->user_type === 'patient') {
                DB::table('patients')->insert([
                    'first_name' => $user->first_name,
                    'last_name' => $user->last_name,
                    'username' => $user->username,
                    'password' => $user->password,
                    'email' => $user->email,
                    'phone' => $user->phone,
                    'school_name' => $user->school_name,
                    'dob' => $user->dob,
                    'gender' => $user->gender,
                    'guardian' => $user->guardian,
                    'created_at' => $user->created_at,
                    'updated_at' => $user->updated_at,
                ]);
            }
        }

        $this->info('Users successfully migrated into their respective tables.');
    }
}
