<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use Notifiable;

    protected $fillable = [
        'first_name', 'last_name', 'email', 'phone', 'role', 'school_name', 'dob', 'gender', 'guardian', 'username', 'password',
    ];

    protected $hidden = ['password'];

    public function documents()
    {
        return $this->hasMany(Document::class);
    }

    public function labResults()
    {
        return $this->hasMany(LabResult::class);
    }

    public function measurements()
    {
        return $this->hasOne(Measurement::class);
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
