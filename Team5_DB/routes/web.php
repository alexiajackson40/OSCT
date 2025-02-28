<?php

use Illuminate\Support\Facades\Route;

// Route for login page
Route::get('/login', function () {
    return view('login');
});

// Route for home page (admin_user)
Route::get('/home', function () {
    return view('admin_user.home');
});

// Route for profile page (admin_user)
Route::get('/profile', function () {
    return view('admin_user.profile');
});

// Route for schedule page (admin_user)
Route::get('/schedule', function () {
    return view('admin_user.schedule');
});

// Route for documents page (admin_user)
Route::get('/documents', function () {
    return view('admin_user.documents');
});

// Route for profile page (patient_user)
Route::get('/profile-patient', function () {
    return view('patient_user.profile');
});

// Route for home page (patient_user)
Route::get('/home-patient', function () {
    return view('patient_user.home');
});

// Route for schedule page (patient_user)
Route::get('/schedule-patient', function () {
    return view('patient_user.schedule');
});

// Route for lab results page (patient_user)
Route::get('/lab-results', function () {
    return view('patient_user.lab_results');
});

// Route for documents page (patient_user)
Route::get('/documents-patient', function () {
    return view('patient_user.documents');
});

// Route for profile page (personnel_user)
Route::get('/profile-personnel', function () {
    return view('personnel_user.profile');
});

// Route for home page (personnel_user)
Route::get('/home-personnel', function () {
    return view('personnel_user.home');
});

// Route for schedule page (personnel_user)
Route::get('/schedule-personnel', function () {
    return view('personnel_user.schedule');
});

// Route for users page (personnel_user)
Route::get('/users', function () {
    return view('personnel_user.users');
});
