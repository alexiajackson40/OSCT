<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Student extends Model
{
    protected $fillable = ['first_name', 'last_name', 'age', 'school'];

    // Define the relationship with visit schedules
    public function visitSchedules()
    {
        return $this->hasMany(VisitSchedule::class); // A student can have many visit schedules
    }
}
