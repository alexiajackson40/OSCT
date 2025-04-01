<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class LabResult extends Model
{
    protected $fillable = [
        'user_id', 'name', 'file_path', 'assigned_date'
    ];

    public function user() {
        return $this->belongsTo(User::class);
    }
}
