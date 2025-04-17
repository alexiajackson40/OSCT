<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Document;
use App\Models\LabResult;
use App\Models\Measurement;
use Illuminate\Support\Facades\Auth;

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
    $parent = auth()->user(); // the logged-in parent
    $patient = $parent->linkedPatient(); // find patient via CURP match

    return view('patient_user.profile', compact('parent', 'patient'));
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
        $schedule = Auth::user()->schedule ?? []; // Assuming relationship or array
        return view('patient_user.schedule', compact('schedule')); // matches schedule.blade.php
    }

    // Method to show patient's measurements
    public function measurements()
    {
        $measurements = Measurement::where('user_id', Auth::id())->get(); // Updated to fetch data for authenticated patient
        return view('patient_user.measurements', compact('measurements'));
    }

    // Optional: Method to show the signup page
    public function signUp()
    {
        return view('patient_user.sign_up'); // matches sign_up.blade.php
    }
}
