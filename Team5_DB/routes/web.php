<?php

use App\Models\Patient;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PatientController;

// View all patients (with search functionality)
Route::get('/patients', function () {
    // Get the search query if it's present in the URL
    $search = request('search');
    
    // If there is a search query, filter the patients by name
    $patients = Patient::where('patient_name', 'like', "%$search%")
                       ->paginate(10); // Show 10 patients per page

    // Return the view with the patients and search term
    return view('patients.index', compact('patients', 'search'));
});

// Show the form to add a new patient
Route::get('/patients/create', [PatientController::class, 'create'])->name('patients.create');

// Store a new patient
Route::post('/patients', [PatientController::class, 'store']);

// Show the form to edit an existing patient
Route::get('/patients/{id}/edit', [PatientController::class, 'edit'])->name('patients.edit');

// Update an existing patient
Route::put('/patients/{id}', [PatientController::class, 'update']);

// Delete a patient
Route::delete('/patients/{id}', [PatientController::class, 'destroy'])->name('patients.destroy');
