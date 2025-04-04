<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Measurement;
use App\Models\Document;
use App\Models\LabResult;
use App\Models\Schedule;
use Illuminate\Http\Request;

class AdminUsersController extends Controller
{
    // Method to list patients
    public function patientUsers()
    {
        $patients = User::where('user_type', 'patient')->get();
        return view('admin_user.users.patient_users', compact('patients'));
    }

    // Method to list personnel
    public function personnelUsers()
    {
        $personnel = User::where('user_type', 'personnel')->get();
        return view('admin_user.users.personnel_users', compact('personnel'));
    }

    // Method to list admins
    public function adminUsers()
    {
        $admins = User::where('user_type', 'admin')->get();
        return view('admin_user.users.admin_users', compact('admins'));
    }

    // Method to view a patient's profile
    public function patientProfile($id)
    {
        $patient = User::where('user_type', 'patient')->findOrFail($id);
        return view('admin_user.users.patient_profile', compact('patient'));
    }

    // Method to view personnel profile
    public function personnelProfile($id)
    {
        $personnel = User::where('user_type', 'personnel')->findOrFail($id);
        return view('admin_user.users.personnel_profile', compact('personnel'));
    }

    // Method to view an admin's profile
    public function adminProfile($id)
    {
        $admin = User::where('user_type', 'admin')->findOrFail($id);
        return view('admin_user.users.admin_profile', compact('admin'));
    }

    // Method to show patient's measurements
    public function patientMeasurements($id)
    {
        $measurements = Measurement::where('user_id', $id)->get();
        return view('admin_user.users.patient_measurements', compact('measurements'));
    }

    // Method to show patient's documents
    public function patientDocuments($id)
    {
        $documents = Document::where('user_id', $id)->get();
        return view('admin_user.users.patient_documents', compact('documents'));
    }

    // Method to show patient's lab results
    public function patientLabResults($id)
    {
        $labResults = LabResult::where('user_id', $id)->get();
        return view('admin_user.users.patient_labResults', compact('labResults'));
    }

    // Method to download a document
    public function downloadDocument($documentId)
    {
        $document = Document::findOrFail($documentId);
        return response()->download(storage_path("app/public/documents/{$document->file_name}"));
    }

    // Method to handle document upload
    public function uploadDocument(Request $request, $id)
    {
        $request->validate([
            'document' => 'required|file|mimes:pdf,doc,docx|max:10240', // Adjust file types and size as needed
        ]);

        $document = $request->file('document');
        $path = $document->storeAs('public/documents', time() . '-' . $document->getClientOriginalName());

        Document::create([
            'user_id' => $id,
            'name' => $document->getClientOriginalName(),
            'file_name' => $path,
        ]);

        return redirect()->route('admin.users.patient_documents', $id)->with('success', 'Document uploaded successfully!');
    }
}

