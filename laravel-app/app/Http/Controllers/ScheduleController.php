<?php

namespace App\Http\Controllers;

use App\Models\Schedule;
use Illuminate\Http\Request;

class ScheduleController extends Controller
{
    // Method to display all schedules
    public function index()
    {
        $schedules = Schedule::all();
        return view('admin_user.schedule', compact('schedules'));
    }

    // Method to edit a schedule
    public function edit($id)
    {
        $schedule = Schedule::findOrFail($id);
        return view('admin_user.schedule_edit', compact('schedule'));
    }
}
