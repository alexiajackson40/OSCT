<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ParentModel;
use App\Models\Patient;
use Illuminate\Support\Facades\Hash;

class ParentController extends Controller
{
    public function showSignupForm()
{
    return view('patient_user.sign_up'); // Keep view in same folder
}

   public function home()
    {
        return view('patient_user.home');
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

        $parent = ParentModel::create([
            'CURP'       => $request->CURP,
            'first_name' => $request->first_name,
            'last_name'  => $request->last_name,
            'email'      => $request->email,
            'username'   => $request->username,
            'password'   => Hash::make($request->password),
        ]);
        

        // Link parent to patient
        $patient = Patient::find($request->student_id);
        if ($patient) {
            $patient->parent_id = $parent->id;
            $patient->save();
        }

        return redirect()->route('login')->with('success', 'Account created and linked to student.');
    }
}
