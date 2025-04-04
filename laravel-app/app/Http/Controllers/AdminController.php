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
        return view('admin_user.profile');
    }

    public function editProfile()
    {
        return view('admin_user.edit_profile');
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