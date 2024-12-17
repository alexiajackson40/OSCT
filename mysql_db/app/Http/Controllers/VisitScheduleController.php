<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Student;
use App\Models\VisitSchedule;
use Illuminate\Http\Request;

class VisitScheduleController extends Controller
{
    // Show the form for creating a visit schedule
    public function create($studentId)
    {
        $student = Student::findOrFail($studentId); // Find the student by ID
        return view('visitSchedules.create_schedule', compact('student')); // Pass the student to the form
    }

    // Store the newly created visit schedule
    public function store(Request $request, $studentId)
    {
        $request->validate([
            'level' => 'required|string',
            'shift' => 'required|string',
            'school_code' => 'required|string',
            'school_name' => 'required|string',
            'municipality' => 'required|string',
            'location' => 'required|string',
            'address' => 'required|string',
            'total_students' => 'required|integer',
            'visit_date' => 'required|date',
        ]);

        // Find the student by ID
        $student = Student::findOrFail($studentId);

        // Create the visit schedule and associate it with the student
        $student->visitSchedules()->create($request->all());

        // Redirect to the students index page
        return redirect()->route('students.index');
    }
}
