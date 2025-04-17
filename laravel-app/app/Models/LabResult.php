<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class LabResult extends Model
{
    protected $fillable = ['user_id', 'name', 'file_path', 'date_assigned'];

    public function patient()
    {
        return $this->belongsTo(Patient::class, 'user_id');
    }

    public function personnel()
    {
        return $this->belongsTo(Personnel::class, 'user_id');
    }
}
