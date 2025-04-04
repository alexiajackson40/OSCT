<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    // Show login form
    public function showLoginForm()
    {
        return view('login');
    }

    // Handle login
    public function authenticate(Request $request)
    {
        // Validate user input
        $credentials = $request->validate([
            'username' => ['required', 'string'],
            'password' => ['required', 'string'],
        ]);

        // Attempt authentication
        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();

            // Redirect based on user type
            $user = Auth::user();
            if ($user->user_type === 'admin') {
                return redirect()->route('admin.home');
            } elseif ($user->user_type === 'personnel') {
                return redirect()->route('personnel.home');
            } elseif ($user->user_type === 'patient') {
                return redirect()->route('patient.home');
            }
        }

        // Handle invalid login attempt
        return back()->withErrors([
            'username' => 'The provided credentials do not match our records.',
        ])->onlyInput('username');
    }

    // Show registration form
    public function showRegisterForm()
    {
        return view('register');
    }

    // Handle logout
    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate(); // Invalidate session
        $request->session()->regenerateToken(); // Regenerate CSRF token

        return redirect('/login'); // Redirect to login page
    }
}
