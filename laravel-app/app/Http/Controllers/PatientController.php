<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Document;
use App\Models\LabResult;
use App\Models\Measurement;
use Illuminate\Support\Facades\Auth;
use App\Models\Patient;
use App\Models\ParentModel;
use App\Models\Schedule;

class PatientController extends Controller
{
    // Method to show the patient home page
    public function home()
    {
        return view('patient_user.home');  // matches home.blade.php
    }

    // Method to show patient profile
    public function profile()
{
    $parent = auth()->user(); // logged-in parent

    // Get patient whose CURP matches the parent's CURP
    $patient = Patient::where('CURP', $parent->CURP)->first();

    return view('patient_user.profile', compact('patient', 'parent'));
}

    // Method to show patient's documents
    public function documents()
    {
        $documents = Document::where('user_id', Auth::id())->get(); // Updated to fetch data for authenticated patient
        return view('patient_user.documents', compact('documents')); // matches documents.blade.php
    }

    // Method to show patient's lab results
    public function labResults()
    {
        $labResults = LabResult::where('user_id', Auth::id())->get(); // Updated to fetch data for authenticated patient
        return view('patient_user.lab_results', compact('labResults')); // matches lab_results.blade.php
    }

    // Method to show patient's schedule
    public function schedule()
    {
        $schedules = Schedule::all(); // Retrieve all schedules
        return view('patient_user.schedule', compact('schedules')); // matches schedule.blade.php
    }

    // Method to show patient's measurements
    public function measurements()
    {  
    $parent = auth()->user();
    $patient = Patient::where('CURP', $parent->CURP)->first();
    $measurements = Measurement::where('user_id', $patient->CURP)->get(); // or ID if that's how it's stored

    return view('patient_user.measurements', compact('measurements'));
    }


    // Optional: Method to show the signup page
    public function signUp()
    {
        return view('patient_user.sign_up'); // matches sign_up.blade.php
    }
}
