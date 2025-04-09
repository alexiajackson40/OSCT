<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Document extends Model
{
    protected $fillable = ['name', 'file_path', 'user_id'];

    public function patient()
    {
        return $this->belongsTo(Patient::class, 'user_id');
    }

    public function personnel()
    {
        return $this->belongsTo(Personnel::class, 'user_id');
    }

    public function admin()
    {
        return $this->belongsTo(Admin::class, 'user_id');
    }
}
