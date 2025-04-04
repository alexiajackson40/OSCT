<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Measurement;
use App\Models\Document;
use App\Models\LabResult;
use Illuminate\Http\Request;

class AdminUsersController extends Controller
{
    // Fetch Patient Users
    public function patientUsers()
    {
        $patients = User::where('user_type', 'patient')->get();
        return view('admin_user.users.patient_users', compact('patients'));
    }

    // Fetch Personnel Users
    public function personnelUsers()
    {
        $personnel = User::where('user_type', 'personnel')->get();
        return view('admin_user.users.personnel_users', compact('personnel'));
    }

    // Fetch Admin Users
    public function adminUsers()
    {
        $admins = User::where('user_type', 'admin')->get();
        return view('admin_user.users.admin_users', compact('admins'));
    }

    // Admin Profile View
    public function adminProfile($id)
    {
        $admin = User::where('user_type', 'admin')->findOrFail($id);
        return view('admin_user.users.admin_profile', compact('admin'));
    }

    // Update Admin Profile
    public function updateAdmin(Request $request, $id)
    {
        $request->validate([
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255',
            'phone' => 'nullable|string|max:15',
        ]);

        $admin = User::where('user_type', 'admin')->findOrFail($id);
        $admin->update([
            'first_name' => $request->input('first_name'),
            'last_name' => $request->input('last_name'),
            'email' => $request->input('email'),
            'phone' => $request->input('phone'),
        ]);

        return redirect()->route('admin.users.admin_profile', $id)->with('success', 'Profile updated successfully!');
    }

    // Patient Profile View
    public function patientProfile($id)
    {
        $patient = User::where('user_type', 'patient')->findOrFail($id);
        return view('admin_user.users.patient_profile', compact('patient'));
    }

    // Fetch Patient Measurements
    public function patientMeasurements($id)
    {
        $measurements = Measurement::where('user_id', $id)->get();
        return view('admin_user.users.patient_measurements', compact('measurements'));
    }

    // Fetch All Patient Documents
    public function allPatientDocuments()
    {
        // Fetch all documents with related patient data
        $documents = Document::with('user')->get();
        return view('admin_user.users.patient_documents', compact('documents'));
    }

    // Download Document
    public function downloadDocument($documentId)
    {
        $document = Document::findOrFail($documentId);
        $filePath = storage_path("app/" . $document->file_name);

        if (!file_exists($filePath)) {
            abort(404, 'File not found.');
        }

        return response()->download($filePath);
    }

    // Upload Document
    public function uploadDocument(Request $request, $id = null)
    {
        $request->validate([
            'document_name' => 'required|string|max:255',
            'document_file' => 'required|file|mimes:pdf,doc,docx|max:10240',
        ]);

        $documentFile = $request->file('document_file');
        $path = $documentFile->storeAs('public/documents', time() . '-' . $documentFile->getClientOriginalName());

        Document::create([
            'user_id' => $id,
            'name' => $request->input('document_name'),
            'file_name' => $path,
        ]);

        return redirect()->route('admin.users.patient_documents')->with('success', 'Document uploaded successfully!');
    }

    // Delete Document
    public function deleteDocument($documentId)
    {
        $document = Document::findOrFail($documentId);
        $filePath = storage_path("app/" . $document->file_name);

        if (file_exists($filePath)) {
            unlink($filePath);
        }

        $document->delete();
        return redirect()->back()->with('success', 'Document deleted successfully!');
    }
}
