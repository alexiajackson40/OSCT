<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable; // Change from Model to User
use Illuminate\Support\Facades\Hash;

class Admin extends Authenticatable // Extending Authenticatable
{
    protected $fillable = [
        'first_name', 'last_name', 'username', 'password', 'email', 'phone', 'address'
    ];

    public $timestamps = true;

    public function schedules()
    {
        return $this->hasMany(Schedule::class, 'admin_id'); // assuming the foreign key is admin_id
    }

    // Automatically hash the password when it is set
    public function setPasswordAttribute($value)
    {
        $this->attributes['password'] = Hash::make($value);
    }
}
