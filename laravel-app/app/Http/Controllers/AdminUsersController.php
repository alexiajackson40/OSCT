<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Measurement;
use App\Models\Document;
use App\Models\LabResult;
use Illuminate\Http\Request;

class AdminUsersController extends Controller
{
    public function patientUsers()
    {
        $patients = User::where('user_type', 'patient')->get();
        return view('admin_user.users.patient_users', compact('patients'));
    }

    public function personnelUsers()
    {
        $personnel = User::where('user_type', 'personnel')->get();
        return view('admin_user.users.personnel_users', compact('personnel'));
    }

    public function adminUsers()
    {
        $admins = User::where('user_type', 'admin')->get();
        return view('admin_user.users.admin_users', compact('admins'));
    }

    public function patientProfile($id)
    {
        $patient = User::where('user_type', 'patient')->findOrFail($id);
        return view('admin_user.users.patient_profile', compact('patient'));
    }

    public function personnelProfile($id)
    {
        $personnel = User::where('user_type', 'personnel')->findOrFail($id);
        return view('admin_user.users.personnel_profile', compact('personnel'));
    }

    public function adminProfile($id)
    {
        $admin = User::where('user_type', 'admin')->findOrFail($id);
        return view('admin_user.users.admin_profile', compact('admin'));
    }

    public function patientMeasurements()
    {
        $measurements = Measurement::with('user')->get();
        return view('admin_user.users.patient_measurements', compact('measurements'));
    }

    public function patientDocuments()
    {
        $documents = Document::with('user')->get();
        return view('admin_user.users.patient_documents', compact('documents'));
    }

    public function patientLabResults()
    {
        $labResults = LabResult::with('user')->get();
        return view('admin_user.users.patient_labResults', compact('labResults'));
    }
}
