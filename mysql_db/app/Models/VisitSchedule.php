<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class VisitSchedule extends Model
{
    protected $fillable = [
        'level', 'shift', 'school_code', 'school_name', 'municipality', 
        'location', 'address', 'total_students', 'visit_date', 'student_id'
    ];

    // Define the inverse of the relationship
    public function student()
    {
        return $this->belongsTo(Student::class); // Each visit schedule belongs to one student
    }
}
