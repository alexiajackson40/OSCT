<?php

namespace App\Http\Controllers;

use App\Models\Patient;
use Illuminate\Http\Request;

class PatientController extends Controller
{
    // Show the form to create a new patient
    public function create()
    {
        return view('patients.create');
    }

    // Store a new patient
    public function store(Request $request)
    {
        // Validate the form data
        $request->validate([
            'no_sol' => 'required',
            'patient_name' => 'required',
            'gender' => 'required',
            'age' => 'required',
            'school' => 'required',
            'glucose' => 'required',
            'triglycerides' => 'required',
            'cholesterol_total' => 'required',
            'hba1c' => 'required',
            'weight' => 'required',
            'height' => 'required',
            'bmi' => 'required',
            'icc' => 'required',
            'waist' => 'required',
            'hip' => 'required',
        ]);

        // Create a new patient
        Patient::create($request->all());

        // Redirect back to the patients list with a success message
        return redirect('/patients')->with('success', 'Patient added successfully!');
    }

    // Show the form to edit an existing patient
    public function edit($id)
    {
        $patient = Patient::findOrFail($id); // Get the patient by ID
        return view('patients.edit', compact('patient')); // Pass the patient data to the edit view
    }

    // Update an existing patient
    public function update(Request $request, $id)
    {
        $patient = Patient::findOrFail($id); // Get the patient by ID

        // Validate the form data
        $request->validate([
            'no_sol' => 'required',
            'patient_name' => 'required',
            'gender' => 'required',
            'age' => 'required',
            'school' => 'required',
            'glucose' => 'required',
            'triglycerides' => 'required',
            'cholesterol_total' => 'required',
            'hba1c' => 'required',
            'weight' => 'required',
            'height' => 'required',
            'bmi' => 'required',
            'icc' => 'required',
            'waist' => 'required',
            'hip' => 'required',
        ]);

        // Update the patient
        $patient->update($request->all());

        // Redirect back to the patients list with a success message
        return redirect('/patients')->with('success', 'Patient updated successfully!');
    }

    // Delete a patient
    public function destroy($id)
    {
        $patient = Patient::findOrFail($id); // Find the patient by ID
        $patient->delete(); // Delete the patient

        return redirect('/patients')->with('success', 'Patient deleted successfully!');
    }
}
