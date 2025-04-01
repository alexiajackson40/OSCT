<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use Notifiable;

    protected $fillable = [
        'first_name', 'last_name', 'email', 'phone', 'role', 'student_id', 'username', 'password',
    ];

    protected $hidden = ['password'];

    public function documents() {
        return $this->hasMany(Document::class);
    }

    public function labResults() {
        return $this->hasMany(LabResult::class);
    }

    public function measurements() {
        return $this->hasOne(Measurement::class);
    }
}
