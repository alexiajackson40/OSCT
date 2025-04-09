<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Hash;

class Personnel extends Model
{
    protected $table = 'personnel';

    // Use employee_id as the primary key
    protected $primaryKey = 'employee_id';
    public $incrementing = false;  // Because employee_id is not auto-incrementing
    protected $keyType = 'string';  // Since employee_id is stored as a string

    protected $fillable = [
        'first_name', 'last_name', 'username', 'password', 'email', 'phone', 'role', 'employee_id'
    ];

    public $timestamps = true;

    public function schedules()
    {
        return $this->belongsToMany(Schedule::class, 'personnel_schedule', 'personnel_id', 'schedule_id');
    }

    public function documents()
    {
        return $this->hasMany(Document::class, 'user_id');
    }

    public function patients()
    {
        return $this->belongsToMany(Patient::class, 'personnel_patient', 'personnel_id', 'patient_id');
    }

    // Automatically hash the password when it is set
    public function setPasswordAttribute($value)
    {
        $this->attributes['password'] = Hash::make($value);
    }
}
