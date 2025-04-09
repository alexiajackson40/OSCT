<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Hash;

class Patient extends Model
{
    protected $fillable = [
        'first_name', 'last_name', 'username', 'password', 'email', 'phone',
        'school_name', 'dob', 'gender', 'curp', 'bmi', 'icc', 'comments',
        'fasting_status', 'glucose', 'rights_of_coverage', 'hba1c',
        'height', 'weight', 'total_cholesterol', 'triglycerides', 'waist', 'hip'
    ];

    public $timestamps = true;

    public function documents()
    {
        return $this->hasMany(Document::class, 'user_id');
    }

    public function labResults()
    {
        return $this->hasMany(LabResult::class, 'user_id');
    }

    public function measurements()
    {
        return $this->hasMany(Measurement::class, 'user_id');
    }

    public function schedules()
    {
        return $this->hasMany(Schedule::class, 'patient_id'); // Ensure your foreign key matches here
    }

    public function parent()
    {
        return $this->belongsTo(ParentModel::class, 'parent_id'); // Adjust if Parent model has a different namespace
    }

    // Automatically hash the password when it is set
    public function setPasswordAttribute($value)
    {
        $this->attributes['password'] = Hash::make($value);
    }
}
