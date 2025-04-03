<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Measurement;
use App\Models\LabResult;
use Illuminate\Http\Request;

class PersonnelController extends Controller
{
    public function home() {
        return view('personnel_user.home');
    }

    public function personnelProfile($id)
    {
        $user = User::findOrFail($id); // Retrieve user data from the database
        return view('personnel_user.profile', compact('user'));
    }

    public function schedule() {
        return view('personnel_user.schedule');
    }

    public function patientLabResults($id)
    {
        $labResults = LabResult::where('user_id', $id)->get();
        $patient = User::findOrFail($id);
        return view('personnel_user.users.patient_labResults', compact('labResults', 'patient'));
    }  

    public function patientMeasurements($id)
    {
        $measurements = Measurement::where('user_id', $id)->first();  // Get the first record for measurements
        $patient = User::findOrFail($id);
        return view('personnel_user.users.patient_measurements', compact('measurements', 'patient'));
    }

    public function patientProfile($id)
    {
        $patient = User::findOrFail($id);  // Fetch the patient by ID
        return view('personnel_user.users.patient_profile', compact('patient'));
    }

    public function documents() {
        return view('personnel_user.users.patient_documents');
    }
}
