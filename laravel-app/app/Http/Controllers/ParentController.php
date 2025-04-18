<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Document;
use App\Models\LabResult;
use App\Models\Measurement;
use App\Models\Patient;
use Illuminate\Support\Facades\Auth;
use App\Models\Schedule;

class ParentController extends Controller
{
    public function showSignupForm()
    {
        return view('patient_user.sign_up');
    }

    public function home()
    {
        return view('patient_user.home');
    }

    public function profile()
{
    $parent = auth()->user(); // logged-in parent

    // Get patient whose CURP matches the parent's CURP
    $patient = Patient::where('CURP', $parent->CURP)->first();

    return view('patient_user.profile', compact('patient', 'parent'));
}

public function documents()
{
    $parent = auth()->user();
    $documents = Document::where('user_id', $parent->CURP)->get();

    return view('patient_user.documents', compact('documents'));
}

public function labResults()
{
    $parent = auth()->user();
    $labResults = LabResult::where('user_id', $parent->CURP)->get();

    return view('patient_user.lab_results', compact('labResults'));
}


public function downloadDocument($id)
{
    $document = Document::findOrFail($id);
    $filePath = public_path($document->file_path); 

    if (file_exists($filePath)) {
        return response()->download($filePath);
    }

    return redirect()->back()->with('error', 'File not found.');
}

public function downloadLabResult($id)
{
    $result = LabResult::findOrFail($id);
    $filePath = public_path($result->file_path); 

    if (file_exists($filePath)) {
        return response()->download($filePath);
    }

    return redirect()->back()->with('error', 'File not found.');
}

public function measurements()
{
    $parent = auth()->user();

    // Get the patient whose CURP matches the parent’s CURP
    $patient = Patient::where('CURP', $parent->CURP)->first();

    // Prevent crash if no patient found
    if (!$patient) {
        return redirect()->back()->with('error', 'No linked student found.');
    }

    // Pull measurements for that CURP
    $measurements = Measurement::where('user_id', $patient->CURP)->get();

    return view('patient_user.measurements', compact('measurements'));
}

public function schedule()
    {
        $schedules = Schedule::all(); // Retrieve all schedules
        return view('patient_user.schedule', compact('schedules'));
    }


    public function store(Request $request)
    {
        $request->validate([
            'first_name' => 'required|string|max:255',
            'last_name'  => 'required|string|max:255',
            'email'      => 'nullable|email|unique:parent,email',
            'username'   => 'required|string|unique:parent,username',
            'password'   => 'required|string|confirmed',
            'CURP'       => 'required|string|unique:parent,CURP',
        ]);

        ParentModel::create([
            'CURP'       => $request->CURP,
            'first_name' => $request->first_name,
            'last_name'  => $request->last_name,
            'email'      => $request->email,
            'username'   => $request->username,
            'password'   => Hash::make($request->password),
        ]);

        return redirect()->route('login')->with('success', 'Account created successfully.');
    }
}
