<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminUsersController;
use App\Http\Controllers\PersonnelController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\HomeController; // Import the HomeController

// Main Route
Route::get('/', [HomeController::class, 'home']); // Main route for home page

// Login Route
Route::get('/login', [HomeController::class, 'login'])->name('login'); // Define the login route with the 'login' name

// Register RouteS
Route::get('/register', [AuthController::class, 'showRegisterForm'])->name('register');

// Admin User Routes
Route::prefix('admin')->group(function () {
    Route::get('home', [AdminUsersController::class, 'home']);
    Route::get('profile', [AdminUsersController::class, 'profile'])->name('admin.profile');
    Route::get('profile/edit', [AdminUsersController::class, 'editProfile'])->name('edit.profile');
    Route::put('profile/edit', [AdminUsersController::class, 'updateProfile'])->name('update.profile');
    
    // Admin Header Route
    Route::get('header_admin', function () {
        return view('admin_user.header_admin');
    })->name('admin.header_admin');

    // Admin > Users
    Route::get('users', [AdminUsersController::class, 'adminUsers'])->name('admin.admin_users');
    Route::get('add-user', [AdminUsersController::class, 'addUser'])->name('admin.add_user');
    
    // Store user route
    Route::post('add-user', [AdminUsersController::class, 'storeUser'])->name('add-user.store');
    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

    // Admin > Users > Profile Routes
    Route::get('users/patient', [AdminUsersController::class, 'patientUsers'])->name('admin.users.patient_users');
    Route::get('users/patient/profile/{id}', [AdminUsersController::class, 'patientProfile'])->name('admin.users.patient_profile');
    Route::get('users/personnel', [AdminUsersController::class, 'personnelUsers'])->name('admin.users.personnel_users');
    Route::get('users/personnel/profile/{id}', [AdminUsersController::class, 'personnelProfile'])->name('admin.users.personnel_profile');
    Route::get('users/admin', [AdminUsersController::class, 'adminUsers'])->name('admin.users.admin_users');
    Route::get('users/admin/profile/{id}', [AdminUsersController::class, 'adminProfile'])->name('admin.users.admin_profile');

    // Admin > Schedule
    Route::get('schedule', [AdminUsersController::class, 'showSchedule'])->name('schedule.index');
    Route::get('schedule/edit/{id}', [AdminUsersController::class, 'editSchedule'])->name('schedule.edit');
});

// Personnel User Routes
Route::prefix('personnel')->group(function () {
    Route::get('home', [PersonnelController::class, 'home'])->name('personnel.home');
    Route::get('profile/{id}', [PersonnelController::class, 'personnelProfile'])->name('personnel.profile');
    Route::get('schedule', [PersonnelController::class, 'schedule'])->name('personnel.schedule');
    Route::get('patients/{id}/lab-results', [PersonnelController::class, 'patientLabResults'])->name('personnel.patient_lab_results');
    Route::get('patients/{id}/measurements', [PersonnelController::class, 'patientMeasurements'])->name('personnel.patient_measurements');
    Route::get('patients/{id}/profile', [PersonnelController::class, 'patientProfile'])->name('personnel.patient_profile');
    Route::get('patients/documents', [PersonnelController::class, 'documents'])->name('personnel.documents');
});
