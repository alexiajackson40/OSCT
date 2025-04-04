<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Schedule;

class AdminController extends Controller
{
    public function home()
    {
        return view('admin_user.home');
    }

    public function profile()
    {
        // Retrieve the currently authenticated user
        $user = auth()->user();
    
        // Ensure the user is properly fetched
        if (!$user) {
            return redirect()->route('login')->withErrors('You must be logged in to access this page.');
        }
    
        // Pass the user to the view
        return view('admin_user.profile', compact('user'));
    }
    
    public function editProfile()
    {
        // Retrieve the currently authenticated user
        $user = auth()->user();
    
        // Pass the user to the view
        return view('admin_user.edit_profile', compact('user'));
    }    

    public function updateProfile(Request $request)
    {
    // Validate form inputs
    $request->validate([
        'first_name' => 'required|string|max:255',
        'last_name' => 'required|string|max:255',
        'username' => 'required|string|max:255|unique:users,username,' . auth()->id(),
        'email' => 'required|email|max:255|unique:users,email,' . auth()->id(),
        'phone' => 'nullable|string|max:15',
    ]);

    // Update the authenticated user's profile
    $user = auth()->user();
    $user->update([
        'first_name' => $request->input('first_name'),
        'last_name' => $request->input('last_name'),
        'username' => $request->input('username'),
        'email' => $request->input('email'),
        'phone' => $request->input('phone'),
    ]);

    // Redirect back with a success message
    return redirect()->route('admin.profile')->with('success', 'Profile updated successfully!');
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
    
    public function scheduleEdit($id)
    {
        $schedule = Schedule::findOrFail($id);
        return view('admin_user.schedule_edit', compact('schedule'));
    }

    public function users()
    {
        return view('admin_user.users');
    }

    public function addUser()
    {
        return view('admin_user.add_user');
    }
}