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

    // Update Patient Profile
    public function updatePatient(Request $request, $id)
    {
        $request->validate([
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255',
            'phone' => 'nullable|string|max:15',
            'address' => 'nullable|string|max:255',
        ]);

        $patient = User::findOrFail($id);
        $patient->update([
            'first_name' => $request->input('first_name'),
            'last_name' => $request->input('last_name'),
            'email' => $request->input('email'),
            'phone' => $request->input('phone'),
            'address' => $request->input('address'),
        ]);

        return redirect()->route('admin.users.patient_profile', $id)->with('success', 'Patient profile updated successfully!');
    }

    // Fetch Patient Measurements
    public function patientMeasurements($id)
    {
        $patient = User::findOrFail($id);  // Get the patient by ID
        $measurements = Measurement::where('user_id', $id)->get();  // Fetch the measurements for the patient
    
        return view('admin_user.users.patient_measurements', compact('measurements', 'patient'));  // Pass both measurements and patient
    }
    
    // Upload Measurement
    public function uploadMeasurement(Request $request, $id)
    {
        $request->validate([
            'measurement_type' => 'required|string|max:255',
            'measurement_value' => 'required|numeric',
            'measurement_date' => 'required|date',
        ]);

        // Fetch the patient by ID
        $patient = User::findOrFail($id);

        // Create a new measurement record
        Measurement::create([
            'user_id' => $id,
            'type' => $request->input('measurement_type'),
            'value' => $request->input('measurement_value'),
            'date' => $request->input('measurement_date'),
        ]);

        return redirect()->route('admin.users.patient_measurements', $id)->with('success', 'Measurement uploaded successfully!');
    }

    // Fetch All Patient LabResults
    public function patientLabResults($id)
    {
        $patient = User::findOrFail($id);  // Get the patient by ID
        $labResults = LabResult::where('user_id', $id)->get();  // Fetch the lab results for the patient
    
        return view('admin_user.users.patient_labResults', compact('labResults', 'patient'));  // Pass both labResults and patient
    }

    // Fetch All Patient Documents
    public function allPatientDocuments($id)
    {
        $patient = User::findOrFail($id); // Get the patient by ID
        $documents = Document::where('user_id', $id)->get(); // Fetch all documents for this patient
    
        return view('admin_user.users.patient_documents', compact('documents', 'patient')); // Pass both documents and patient
    }
    
    // Upload Document
    public function uploadDocument(Request $request)
    {
        $request->validate([
            'document_name' => 'required|string|max:255',
            'document_file' => 'required|file|mimes:pdf,doc,docx,png,jpg|max:10240',
        ]);    

        if ($request->hasFile('document_file') && $request->file('document_file')->isValid()) {
            $file = $request->file('document_file');
            $filename = time() . '-' . $file->getClientOriginalName();  // Ensure unique filename

            // Store the file under 'public/documents' folder
            $path = $file->storeAs('public/documents', $filename);  // Store in storage/app/public

            // Save the file path to the database (no 'public/' prefix needed)
            Document::create([
                'name' => $request->input('document_name'),
                'file_path' => 'documents/' . $filename,  // Relative to public storage
            ]);
            
            return redirect()->route('admin.users.patient_documents')->with('success', 'Document uploaded successfully!');
        }

        return back()->with('error', 'File upload failed or no valid file provided.');
    }

    // Download Document
    public function downloadDocument($documentId)
    {
        $document = Document::findOrFail($documentId);
        
        $filePath = storage_path('app/public/' . $document->file_path); // Correct path
        if (!file_exists($filePath)) {
            abort(404, 'File not found.');
        }
        
        return response()->download($filePath);
    }

    // Delete Document
    public function deleteDocument($documentId)
    {
        $document = Document::findOrFail($documentId);
        $filePath = storage_path('app/public/' . $document->file_path);  // Ensure correct file path
    
        if (file_exists($filePath)) {
            unlink($filePath);  // Remove the file
        }
    
        $document->delete();  // Delete the record from the database
        return redirect()->back()->with('success', 'Document deleted successfully!');
    }
}
