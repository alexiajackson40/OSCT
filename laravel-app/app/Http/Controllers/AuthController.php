<?php

namespace App\Http\Controllers;

use App\Models\Admin;
use App\Models\Personnel;
use App\Models\Patient;
use App\Models\ParentModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Log;

class AuthController extends Controller
{
    // Show registration form
    public function showRegisterForm()
    {
        return view('auth.register'); 
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
        if ($admin && Hash::check($request->password, $admin->password)) {  
            Auth::guard('admin')->login($admin);
            return redirect()->route('admin.home');
        }

        // Personnel authentication
        $personnel = Personnel::where('username', $request->username)->first();
        if ($personnel && Hash::check($request->password, $personnel->password)) {
            Auth::guard('personnel')->login($personnel); 
            return redirect()->route('personnel.home');
        }

        // Parent authentication
        $parent = ParentModel::where('username', $request->username)->first();
        if ($parent) {
        if (Hash::check($request->password, $parent->password)) {
        Auth::guard('parent')->login($parent);
        return redirect()->route('patient.home');
    }
} 
        // If no match is found
        return back()->withErrors([
            'login' => 'Invalid username or password.',
        ]);
    }
}
