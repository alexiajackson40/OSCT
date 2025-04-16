<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Measurement;
use App\Models\LabResult;
use Illuminate\Http\Request;
use App\Models\Personnel;
use App\Models\Patient;
use App\Models\Document;
use App\Models\Schedule;


class PersonnelController extends Controller
{
    public function home() {
        return view('personnel_user.home');
    }

    public function personnelProfile($id)
    {
        $user = Personnel::findOrFail($id);
        return view('personnel_user.profile', compact('user'));
    }

    public function editProfile($id)
    {
        $user = \App\Models\Personnel::findOrFail($id);
        return view('personnel_user.edit_profile', compact('user'));
    }

    public function updateProfile(Request $request, $id)
    {
        $user = \App\Models\Personnel::findOrFail($id);

        $request->validate([
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'phone' => 'nullable|string|max:15',
            'address' => 'nullable|string|max:255',
        ]);

        $user->update($request->only(['first_name', 'last_name', 'phone', 'address']));
    
        return redirect()->route('personnel.profile', $id)->with('success', 'Profile updated.');
    }

    public function users()
    {
        $patients = \App\Models\Patient::all();
        return view('personnel_user.users', compact('patients'));
    }    

    public function patientLabResults($id)
    {
        $labResults = LabResult::where('user_id', $id)->get();
        $patient = Patient::findOrFail($id);  // Corrected to fetch from the patients table
        return view('personnel_user.users.patient_labResults', compact('labResults', 'patient'));
    }
    
    public function patientMeasurements($id)
    {
        $patient = Patient::where('CURP', $id)->firstOrFail();
        $measurements = Measurement::where('user_id', $id)->get(); // not ->exists() or ->first()
        return view('personnel_user.users.patient_measurements', compact('patient', 'measurements'));
    }
    
    public function patientProfile($id)
    {
        $patient = Patient::findOrFail($id);  // Corrected to fetch from the patients table
        return view('personnel_user.users.patient_profile', compact('patient'));
    }

    public function documents($id)
    {
        $patient = Patient::findOrFail($id);
        $documents = Document::where('user_id', $id)->get();
    
        return view('personnel_user.users.patient_documents', compact('patient', 'documents'));
    }

    public function schedule()
    {
        $schedules = Schedule::all();
        
        return view('personnel_user.schedule', compact('schedules'));
    }    
}
