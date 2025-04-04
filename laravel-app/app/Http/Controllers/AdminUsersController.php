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

    public function patientMeasurements($id)
    {
        $measurements = Measurement::where('user_id', $id)->get();
        return view('admin_user.users.patient_measurements', compact('measurements'));
    }

    public function patientDocuments($id)
    {
        $documents = Document::where('user_id', $id)->get();
        return view('admin_user.users.patient_documents', compact('documents'));
    }

    public function patientLabResults($id)
    {
        $labResults = LabResult::where('user_id', $id)->get();
        return view('admin_user.users.patient_labResults', compact('labResults'));
    }

    public function downloadDocument($documentId)
    {
        $document = Document::findOrFail($documentId);
        return response()->download(storage_path("app/public/documents/{$document->file_name}"));
    }

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

    public function downloadLabResult($id)
    {
        $labResult = LabResult::findOrFail($id);
        return response()->download(storage_path("app/public/labResults/{$labResult->file_name}"));
    }

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
