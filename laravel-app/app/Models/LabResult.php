<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class LabResult extends Model
{
    protected $fillable = ['user_id', 'name', 'result_value', 'assigned_date'];

    public function patient()
    {
        return $this->belongsTo(Patient::class, 'user_id');
    }

    public function personnel()
    {
        return $this->belongsTo(Personnel::class, 'user_id');
    }
}
