<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Hash;

class Personnel extends Model
{
    // Explicitly define the correct table name to avoid issues
    protected $table = 'personnel';

    protected $fillable = [
        'first_name', 'last_name', 'username', 'password', 'email', 'phone', 'role'
    ];

    public $timestamps = true;

    public function schedules()
    {
        return $this->belongsToMany(Schedule::class, 'personnel_schedule', 'personnel_id', 'schedule_id'); // Adjust pivot table fields if needed
    }

    public function documents()
    {
        return $this->hasMany(Document::class, 'user_id');
    }

    public function patients()
    {
        return $this->belongsToMany(Patient::class, 'personnel_patient', 'personnel_id', 'patient_id'); // Adjust pivot table fields if needed
    }

    // Automatically hash the password when it is set
    public function setPasswordAttribute($value)
    {
        $this->attributes['password'] = Hash::make($value);
    }
}
