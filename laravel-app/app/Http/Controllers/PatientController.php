<?php

namespace App\Http\Controllers;

use App\Models\Document;
use App\Models\LabResult;
use App\Models\Measurement;
use App\Models\User;
use Illuminate\Http\Request;

class PatientController extends Controller
{
    // Method to show patient profile
    public function profile()
    {
        $patient = auth()->user(); // Assuming patient is logged in
        return view('patient_user.profile', compact('patient'));
    }

    // Method to show patient's documents
    public function documents()
    {
        $documents = Document::where('user_id', auth()->id())->get();
        return view('patient_user.documents', compact('documents'));
    }

    // Method to show patient's lab results
    public function labResults()
    {
        $labResults = LabResult::where('user_id', auth()->id())->get();
        return view('patient_user.lab_results', compact('labResults'));
    }

    // Method to show patient's schedule
    public function schedule()
    {
        $schedule = auth()->user()->schedule; // Assuming the patient has a schedule relationship
        return view('patient_user.schedule', compact('schedule'));
    }

    // Method to show patient's measurements
    public function measurements()
    {
        $measurements = Measurement::where('user_id', auth()->id())->get();
        return view('patient_user.measurements', compact('measurements'));
    }
}
