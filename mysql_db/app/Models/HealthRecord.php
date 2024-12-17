<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class HealthRecord extends Model
{
    protected $fillable = [
        'student_id', 'glucose', 'cholesterol', 'triglycerides', 'hemoglobin_glucosilada', 
        'weight', 'height', 'bmi', 'waist', 'hip', 'waist_hip_ratio'
    ];
}
