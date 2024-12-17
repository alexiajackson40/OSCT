<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\StudentController;
use App\Http\Controllers\VisitScheduleController;

Route::get('/', function () {
    return view('welcome');
});

// Define routes for the authenticated users using the middleware group
Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');
    
    // Add resource routes for students
    Route::resource('students', StudentController::class);
});

// Define routes for VisitSchedule management
Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
    // Show the form for creating a visit schedule for a specific student
    Route::get('students/{studentId}/visit-schedule/create', [VisitScheduleController::class, 'create'])->name('visitSchedules.create');

    // Store the visit schedule for a specific student
    Route::post('students/{studentId}/visit-schedule', [VisitScheduleController::class, 'store'])->name('visitSchedules.store');
});