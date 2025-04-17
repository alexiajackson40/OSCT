<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Document;
use App\Models\LabResult;
use App\Models\Measurement;
use Illuminate\Support\Facades\Auth;

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
