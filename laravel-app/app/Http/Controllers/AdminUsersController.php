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

    // Fetch Patient Documents
    public function patientDocuments($id)
    {
        $documents = Document::where('user_id', $id)->get();
        return view('admin_user.users.patient_documents', compact('documents'));
    }

    // Fetch Patient Lab Results
    public function patientLabResults($id)
    {
        $labResults = LabResult::where('user_id', $id)->get();
        return view('admin_user.users.patient_labResults', compact('labResults'));
    }

    // Download Document
    public function downloadDocument($documentId)
    {
        $document = Document::findOrFail($documentId);
        return response()->download(storage_path("app/public/documents/{$document->file_name}"));
    }

    // Upload Document
    public function uploadDocument(Request $request, $id)
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

        return redirect()->route('admin.users.patient_documents', $id)->with('success', 'Document uploaded successfully!');
    }

    // Delete Document
    public function deleteDocument($documentId)
    {
        $document = Document::findOrFail($documentId);
        $filePath = storage_path("app/public/documents/{$document->file_name}");

        if (file_exists($filePath)) {
            unlink($filePath);
        }

        $document->delete();
        return redirect()->back()->with('success', 'Document deleted successfully!');
    }

    // Download Lab Result
    public function downloadLabResult($id)
    {
        $labResult = LabResult::findOrFail($id);
        return response()->download(storage_path("app/public/labResults/{$labResult->file_name}"));
    }

    // Upload Lab Result
    public function uploadLabResult(Request $request, $id)
    {
        $request->validate([
            'lab_result' => 'required|file|mimes:pdf,jpg,png|max:10240',
            'description' => 'required|string|max:255',
        ]);

        $labResultFile = $request->file('lab_result');
        $path = $labResultFile->storeAs('public/labResults', time() . '-' . $labResultFile->getClientOriginalName());

        LabResult::create([
            'user_id' => $id,
            'name' => $labResultFile->getClientOriginalName(),
            'file_name' => $path,
            'description' => $request->input('description'),
        ]);

        return redirect()->route('admin.users.patient_labResults', $id)->with('success', 'Lab result uploaded successfully!');
    }

    // Delete Lab Result
    public function deleteLabResult($id)
    {
        $labResult = LabResult::findOrFail($id);
        $filePath = storage_path("app/public/labResults/{$labResult->file_name}");

        if (file_exists($filePath)) {
            unlink($filePath);
        }

        $labResult->delete();
        return redirect()->back()->with('success', 'Lab result deleted successfully!');
    }
}
