<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Support\Facades\Hash;

class Personnel extends Authenticatable
{
    protected $table = 'personnel';

    protected $primaryKey = 'employee_id';
    public $incrementing = false;
    protected $keyType = 'string';

    protected $fillable = [
        'first_name',
        'last_name',
        'username',
        'password',
        'email',
        'phone',
        'role',
        'employee_id',
        'address'
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

    public function setPasswordAttribute($value)
    {
        $this->attributes['password'] = Hash::make($value);
    }
}
