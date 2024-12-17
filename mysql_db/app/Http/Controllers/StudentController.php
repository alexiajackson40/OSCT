<?php

namespace App\Http\Controllers;

use App\Models\Student;
use Illuminate\Http\Request;

class StudentController extends Controller
{
    // Display a listing of the students
    public function index()
    {
        $students = Student::all();  // Get all students from the database
        return view('students.index', compact('students'));  // Return view with students data
    }

    // Show the form for creating a new student
    public function create()
    {
        return view('students.create');  // Return the form view for creating a new student
    }

    // Store a newly created student in the database
    public function store(Request $request)
    {
        // Validate the request
        $request->validate([
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'age' => 'required|integer',
            'school' => 'required|string|max:255',
        ]);

        // Create a new student record
        Student::create($request->all());

        // Redirect to the students list
        return redirect()->route('students.index');
    }

    // Show the form for editing a specific student
    public function edit($id)
    {
        $student = Student::findOrFail($id);  // Find the student by ID
        return view('students.edit', compact('student'));  // Return the edit form with the student's data
    }

    // Update the specified student in the database
    public function update(Request $request, $id)
    {
        // Validate the request
        $request->validate([
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'age' => 'required|integer',
            'school' => 'required|string|max:255',
        ]);

        $student = Student::findOrFail($id);  // Find the student by ID
        $student->update($request->all());  // Update the student's data

        // Redirect to the students list
        return redirect()->route('students.index');
    }

    // Delete the specified student from the database
    public function destroy($id)
    {
        $student = Student::findOrFail($id);  // Find the student by ID
        $student->delete();  // Delete the student

        // Redirect to the students list
        return redirect()->route('students.index');
    }
}
