<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Schedule extends Model
{
    protected $fillable = [
        'school_name', 'location', 'visit_date', 'file_path', 'admin_id'
    ];

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
