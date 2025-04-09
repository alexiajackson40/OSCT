<?php

namespace App\Http\Controllers;

use App\Models\Admin;
use App\Models\Personnel;
use App\Models\Patient;
use App\Models\Schedule;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminController extends Controller
{
    public function home()
    {
        return view('admin_user.home');
    }

    public function profile()
    {
        $user = Auth::guard('admin')->user();
    
        if (!$user) {
            return redirect()->route('login')->withErrors('You must be logged in to access this page.');
        }
    
        return view('admin_user.profile', compact('user'));
    }
    
    public function storeUser(Request $request)
    {
        $request->validate([
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'username' => 'required|string|unique:admins,username|max:255',
            'role' => 'required|in:admin,personnel,patient',
            'email' => 'nullable|string|email|max:255',
            'phone' => 'nullable|string|max:15',
        ]);

        // Handle creating the user based on role
        if ($request->input('role') === 'admin') {
            Admin::create([
                'first_name' => $request->input('first_name'),
                'last_name' => $request->input('last_name'),
                'username' => $request->input('username'),
                'password' => bcrypt($request->input('password')),
                'email' => $request->input('email'),
                'phone' => $request->input('phone'),
            ]);
        } elseif ($request->input('role') === 'personnel') {
            Personnel::create([
                'first_name' => $request->input('first_name'),
                'last_name' => $request->input('last_name'),
                'username' => $request->input('username'),
                'password' => bcrypt($request->input('password')),
                'email' => $request->input('email'),
                'phone' => $request->input('phone'),
            ]);
        } else {
            Patient::create([
                'first_name' => $request->input('first_name'),
                'last_name' => $request->input('last_name'),
                'username' => $request->input('username'),
                'password' => bcrypt($request->input('password')),
                'email' => $request->input('email'),
                'phone' => $request->input('phone'),
            ]);
        }
    
        return redirect()->route('admin.users')->with('success', 'User added successfully!');
    }

    public function editProfile()
    {
        $user = Auth::guard('admin')->user();
    
        return view('admin_user.edit_profile', compact('user'));
    }

    public function updateProfile(Request $request)
    {
        $request->validate([
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'username' => 'required|string|max:255|unique:admins,username,' . Auth::guard('admin')->id(),
            'email' => 'required|email|max:255|unique:admins,email,' . Auth::guard('admin')->id(),
            'phone' => 'required|string|max:15',
            'address' => 'required|string|max:255',
        ]);
    
        $user = Auth::guard('admin')->user();
    
        // Update the user in the database
        $updated = $user->update([
            'first_name' => $request->input('first_name'),
            'last_name' => $request->input('last_name'),
            'username' => $request->input('username'),
            'email' => $request->input('email'),
            'phone' => $request->input('phone'),
            'address' => $request->input('address'),
        ]);
    
        // Check if the update was successful
        if ($updated) {
            return redirect()->route('admin.profile')->with('success', 'Profile updated successfully!');
        }
    
        // If the update failed, stay on the edit page with an error message
        return redirect()->back()->withErrors('Failed to update profile. Please try again.');
    }

    public function headerAdmin()
    {
        return view('admin_user.header_admin');
    }

    public function schedule()
    {
        $schedules = Schedule::all();
        return view('admin_user.schedule', compact('schedules'));
    }
    
    public function uploadSchedule(Request $request)
    {
        $request->validate([
            'schedule_file' => 'required|file|mimes:pdf,jpg,jpeg,png|max:10240', // Max 10MB
        ]);

        $filePath = $request->file('schedule_file')->store('schedules', 'public');

        return redirect()->route('admin.home')->with('success', 'Schedule uploaded successfully.');
    }

    public function users()
    {
        $admins = Admin::all(); // Fetch admins
        $personnel = Personnel::all(); // Fetch personnel
        $patients = Patient::all(); // Fetch patients
    
        // Combine all user types into one collection
        $users = $admins->concat($personnel)->concat($patients);
    
        return view('admin_user.users', compact('users'));
    }    

    public function addUser()
    {
        return view('admin_user.add_user');
    }

    public function editUser($id)
    {
        $user = Admin::find($id) ?? Personnel::find($id) ?? Patient::find($id); // Fetch user by ID
    
        if (!$user) {
            return redirect()->route('admin.users')->withErrors('User not found.');
        }
    
        return view('admin_user.edit_user', compact('user'));
    }
    
}
