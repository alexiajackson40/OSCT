<?php

namespace App\Http\Controllers;

use App\Models\Admin;
use App\Models\Personnel;
use App\Models\Patient;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Http\Controllers\Controller;

class AuthController extends Controller
{
    // Show registration form
    public function showRegisterForm()
    {
        return view('auth.register'); // Make sure you have a view for the registration page
    }

    // Handle user login authentication
    public function authenticate(Request $request)
    {
        // Validate the login request
        $request->validate([
            'username' => 'required|string',
            'password' => 'required|string',
        ]);

        // Admin authentication
        $admin = Admin::where('username', $request->username)->first();
        if ($admin && Hash::check($request->password, $admin->password)) {  // Use Hash::check()
            Auth::guard('admin')->login($admin);
            return redirect()->route('admin.home');
        }

        // Personnel authentication
        $personnel = Personnel::where('username', $request->username)->first();
        if ($personnel && Hash::check($request->password, $personnel->password)) {  // Use Hash::check()
            Auth::login($personnel);
            return redirect()->route('personnel.home');
        }

        /* Patient authentication
        $patient = Patient::where('username', $request->username)->first();
        if ($patient && Hash::check($request->password, $patient->password)) {  // Use Hash::check()
            Auth::login($patient);
            return redirect()->route('patient.home');
        }

        
        // Parent authentication
        $parent = ParentModel::where('username', $request->username)->first();
        if ($parent && Hash::check($request->password, $parent->password)) {  // Use Hash::check()
            Auth::login($parent);
            return redirect()->route('parent.home');
        }
        */

        // If no match is found
        return back()->with('error', 'Invalid login credentials.');
    }
}
