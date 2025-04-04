<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminUsersController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\PersonnelController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\HomeController; // Import the HomeController

// Main Route
Route::get('/', [HomeController::class, 'home'])->name('home'); // Main route for the home page

// Login Route
Route::get('/login', [HomeController::class, 'login'])->name('login'); // Define the login route with the 'login' name

// Register Route
Route::get('/register', [AuthController::class, 'showRegisterForm'])->name('register');

// Admin Routes
Route::prefix('admin')->group(function () {
    // Admin Home Page
    Route::get('home', [AdminController::class, 'home'])->name('admin.home');

    // Admin Profile Routes
    Route::get('profile', [AdminController::class, 'profile'])->name('admin.profile');
    Route::get('profile/edit', [AdminController::class, 'editProfile'])->name('admin.editProfile');
    Route::put('profile/edit', [AdminController::class, 'updateProfile'])->name('admin.updateProfile');

    // Admin Header Route (Static View)
    Route::get('header_admin', function () {
        return view('admin_user.header_admin');
    })->name('admin.header_admin');

    // Admin User Management Routes
    Route::get('users', [AdminController::class, 'users'])->name('admin.users'); // List Users Page
    Route::get('add-user', [AdminController::class, 'addUser'])->name('admin.addUser'); // Add User Page

    // Admin > Specific User Groups
    Route::get('users/patient', [AdminController::class, 'patientUsers'])->name('admin.patientUsers'); // Patients
    Route::get('users/personnel', [AdminController::class, 'personnelUsers'])->name('admin.personnelUsers'); // Personnel
    Route::get('users/admin', [AdminController::class, 'adminUsers'])->name('admin.adminUsers'); // Admins

    // Admin Schedule Routes
    Route::get('schedule', [AdminController::class, 'schedule'])->name('schedule.index'); // Schedule Page
    Route::get('schedule/edit/{id}', [AdminController::class, 'scheduleEdit'])->name('schedule.edit'); // Edit Schedule

    // Logout Route
    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
});

// Personnel Routes
Route::prefix('personnel')->group(function () {
    // Personnel Home Page
    Route::get('home', [PersonnelController::class, 'home'])->name('personnel.home');

    // Personnel Profile Routes
    Route::get('profile/{id}', [PersonnelController::class, 'personnelProfile'])->name('personnel.profile');

    // Personnel Schedule Routes
    Route::get('schedule', [PersonnelController::class, 'schedule'])->name('personnel.schedule');

    // Personnel Patient Routes
    Route::get('patients/{id}/lab-results', [PersonnelController::class, 'patientLabResults'])->name('personnel.patientLabResults');
    Route::get('patients/{id}/measurements', [PersonnelController::class, 'patientMeasurements'])->name('personnel.patientMeasurements');
    Route::get('patients/{id}/profile', [PersonnelController::class, 'patientProfile'])->name('personnel.patientProfile');
    Route::get('patients/documents', [PersonnelController::class, 'documents'])->name('personnel.documents');
});
