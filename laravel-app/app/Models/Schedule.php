<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Schedule extends Model
{
    protected $fillable = [
        'school_name', 'location', 'visit_date' // Adjust as needed based on your actual table columns
    ];
}
