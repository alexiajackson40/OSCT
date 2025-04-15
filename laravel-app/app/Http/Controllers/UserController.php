<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
//use Hash;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    // Show the add user form
    public function create()
    {
        return view('add_user');
    }

    // Store the new user data
    public function store(Request $request)
    {
        // Validate form data
        $validated = $request->validate([
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'student_id' => 'required|string|max:255',
            'phone_number' => 'required|string|max:255',
            'username' => 'required|string|max:255|unique:users',
            'password' => 'required|string|min:6|confirmed', // Include password validation
            'role' => 'required|in:admin,personnel,patient',  // Make sure to validate the role
        ]);
    
        // Create a new user based on the role
        if ($validated['role'] === 'admin') {
            Admin::create([
                'first_name' => $validated['first_name'],
                'last_name' => $validated['last_name'],
                'student_id' => $validated['student_id'],
                'phone' => $validated['phone_number'],
                'username' => $validated['username'],
                'password' => Hash::make($validated['password']),
            ]);
        } elseif ($validated['role'] === 'personnel') {
            Personnel::create([
                'first_name' => $validated['first_name'],
                'last_name' => $validated['last_name'],
                'student_id' => $validated['student_id'],
                'phone' => $validated['phone_number'],
                'username' => $validated['username'],
                'password' => Hash::make($validated['password']),
            ]);
        } else {
            Patient::create([
                'first_name' => $validated['first_name'],
                'last_name' => $validated['last_name'],
                'student_id' => $validated['student_id'],
                'phone' => $validated['phone_number'],
                'username' => $validated['username'],
                'password' => Hash::make($validated['password']),
            ]);
        }
    
        // Redirect back to the form with a success message
        return redirect()->route('add-user.create')->with('success', 'User created successfully!');
    }    

public function signup(Request $request)
{
    $validated = $request->validate([
        'first_name'     => 'required|string|max:255',
        'last_name'      => 'required|string|max:255',
        'student_id'     => 'required|string|max:50',
        'phone_number'   => 'required|string|max:20',
        'username'       => 'required|string|max:255|unique:users,username',
        'password'       => 'required|string|min:6|confirmed',
    ]);

    User::create([
        'first_name'   => $validated['first_name'],
        'last_name'    => $validated['last_name'],
        'student_id'   => $validated['student_id'],
        'phone_number' => $validated['phone_number'],
        'username'     => $validated['username'],
        'password'     => Hash::make($validated['password']),
    ]);

    return redirect('/login')->with('success', 'Account created! Please log in.');
}

}
