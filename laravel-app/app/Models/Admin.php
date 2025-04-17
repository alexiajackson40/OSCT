<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Support\Facades\Hash;

class Admin extends Authenticatable
{
    protected $fillable = [
        'first_name', 'last_name', 'username', 'password',
        'email', 'phone', 'address', 'role'
    ];

    public $timestamps = true;

    public function schedules()
    {
        return $this->hasMany(Schedule::class, 'admin_id');
    }

    public function setPasswordAttribute($value)
    {
        $this->attributes['password'] = bcrypt($value);
    }    
}
