<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    // Define roles for users
    const ROLE_ADMIN = 'admin';
    const ROLE_PERSONNEL = 'personnel';
    const ROLE_PATIENT = 'patient';

    // Get the role of the user
    public function role()
    {
        return $this->role;  // Assuming the `role` field exists in the users table
    }
    public function isAdmin()
    {
        return $this->role === 'admin';
    }

    public function isPersonnel()
    {
        return $this->role === 'personnel';
    }

    public function isPatient()
    {
        return $this->role === 'patient';
    }
}
