<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Measurement extends Model
{
    protected $fillable = [
        'user_id', 'waist', 'hip', 'waist_to_hip_ratio',
        'body_mass', 'cholesterol', 'glucose', 'hemoglobin', 'triglycerides'
    ];

    public function patient()
    {
        return $this->belongsTo(Patient::class, 'user_id');
    }

    public function personnel()
    {
        return $this->belongsTo(Personnel::class, 'user_id');
    }
}
