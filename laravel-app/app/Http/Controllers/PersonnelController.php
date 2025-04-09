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
        $user = Personnel::findOrFail($id); // Retrieve personnel from the personnel table
        return view('personnel_user.profile', compact('user'));
    }
    
    public function patientLabResults($id)
    {
        $labResults = LabResult::where('user_id', $id)->get();
        $patient = Patient::findOrFail($id);  // Corrected to fetch from the patients table
        return view('personnel_user.users.patient_labResults', compact('labResults', 'patient'));
    }
    
    public function patientMeasurements($id)
    {
        $measurements = Measurement::where('user_id', $id)->first();  // Corrected to fetch from the patients table
        $patient = Patient::findOrFail($id);  // Corrected to fetch from the patients table
        return view('personnel_user.users.patient_measurements', compact('measurements', 'patient'));
    }
    
    public function patientProfile($id)
    {
        $patient = Patient::findOrFail($id);  // Corrected to fetch from the patients table
        return view('personnel_user.users.patient_profile', compact('patient'));
    }
    

    public function documents() {
        return view('personnel_user.users.patient_documents');
    }
}
