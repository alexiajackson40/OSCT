<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Schedule extends Model
{
    protected $table = 'schedule';

    protected $fillable = [
        'level',
        'shift',
        'cct',
        'school_name',
        'municipality',
        'locality',
        'address',
        'total_students',
        'date',
    ];

    public $timestamps = true;

    public function admin()
    {
        return $this->belongsTo(Admin::class, 'admin_id');
    }

    public function personnel()
    {
        return $this->belongsToMany(Personnel::class, 'personnel_schedule');
    }

    public function patients()
    {
        return $this->belongsToMany(Patient::class, 'patient_schedule');
    }
}
