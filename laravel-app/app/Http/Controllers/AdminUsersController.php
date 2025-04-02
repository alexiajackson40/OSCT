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

    // Method to show the schedule
    public function showSchedule()
    {
        // Fetch all schedules from the database
        $schedules = Schedule::all();
        return view('admin_user.schedule', compact('schedules'));
    }

    // Method to edit a schedule
    public function editSchedule($id)
    {
        // Find the schedule by ID
        $schedule = Schedule::findOrFail($id);
        return view('admin_user.schedule_edit', compact('schedule'));
    }

    // Method to show home page
    public function home()
    {
        return view('admin_user.home'); // Ensure the view 'admin_user.home' exists
    }

    // Method to show add user page
    public function addUser()
    {
        return view('admin_user.add_user'); // Ensure the view 'admin_user.add_user' exists
    }

    // Method to store the new user
    public function storeUser(Request $request)
    {
        // Validate the incoming form data
        $validated = $request->validate([
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'student_id' => 'required|unique:users,student_id|max:255',
            'phone_number' => 'required|string|max:255',
            'username' => 'required|string|unique:users,username|max:255',
            'password' => 'required|string|confirmed|min:8', // password confirmation will be checked automatically
        ]);

        // Create a new user record
        User::create([
            'first_name' => $validated['first_name'],
            'last_name' => $validated['last_name'],
            'student_id' => $validated['student_id'],
            'phone_number' => $validated['phone_number'],
            'username' => $validated['username'],
            'password' => bcrypt($validated['password']),
            // Add other fields as needed
        ]);

        // Redirect back with a success message
        return redirect()->route('admin.adminUsers')->with('success', 'User added successfully!');
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

        return redirect()->route('admin.users.patientDocuments', $id)->with('success', 'Document uploaded successfully!');
    }
}
