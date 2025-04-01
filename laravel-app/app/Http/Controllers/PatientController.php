<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PatientController extends Controller
{
    public function home() {
        return view('patient_user.home');
    }

    public function profile() {
        return view('patient_user.profile');
    }

    public function schedule() {
        return view('patient_user.schedule');
    }

    public function documents() {
        return view('patient_user.documents');
    }

    public function labResults() {
        return view('patient_user.lab_results');
    }

    public function signUp() {
        return view('patient_user.sign_up');
    }
}
