<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PersonnelController extends Controller
{
    public function home() {
        return view('personnel_user.home');
    }

    public function profile() {
        return view('personnel_user.profile');
    }

    public function schedule() {
        return view('personnel_user.schedule');
    }

    public function labResults() {
        return view('personnel_user.users.patient_labResults');
    }

    public function documents() {
        return view('personnel_user.users.patient_documents');
    }
}
