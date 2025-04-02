<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminUsersController;
use App\Http\Controllers\PersonnelController;

// Main Route
Route::get('/', fn () => view('home'));

// Admin User Routes
Route::prefix('admin')->group(function () {
    Route::get('home', [AdminUsersController::class, 'home']);
    Route::get('profile', [AdminUsersController::class, 'profile']);
    Route::get('profile/edit', [AdminUsersController::class, 'editProfile'])->name('edit.profile');
    Route::put('profile/edit', [AdminUsersController::class, 'updateProfile'])->name('update.profile');

    // Admin > Users
    Route::get('users', [AdminUsersController::class, 'adminUsers'])->name('admin.adminUsers');
    Route::get('add-user', [AdminUsersController::class, 'addUser'])->name('admin.addUser');
    
    // Store user route
    Route::post('add-user', [AdminUsersController::class, 'storeUser'])->name('add-user.store');

    // Admin > Users > Profile Routes
    Route::get('users/patient', [AdminUsersController::class, 'patientUsers'])->name('admin.users.patientUsers');
    Route::get('users/patient/profile/{id}', [AdminUsersController::class, 'patientProfile'])->name('admin.users.patientProfile');
    Route::get('users/personnel', [AdminUsersController::class, 'personnelUsers']);
    Route::get('users/personnel/profile/{id}', [AdminUsersController::class, 'personnelProfile']);
    Route::get('users/admin', [AdminUsersController::class, 'adminUsers']);
    Route::get('users/admin/profile/{id}', [AdminUsersController::class, 'adminProfile']);

    // Admin > Schedule
    Route::get('schedule', [AdminUsersController::class, 'showSchedule'])->name('schedule.index');
    Route::get('schedule/edit/{id}', [AdminUsersController::class, 'editSchedule'])->name('schedule.edit');
});

// Personnel User Routes
Route::prefix('personnel')->group(function () {
    Route::get('home', [PersonnelController::class, 'home'])->name('personnel.home');
    Route::get('profile/{id}', [PersonnelController::class, 'personnelProfile'])->name('personnel.profile');
    Route::get('schedule', [PersonnelController::class, 'schedule'])->name('personnel.schedule');
    Route::get('patients/{id}/lab-results', [PersonnelController::class, 'patientLabResults'])->name('personnel.patientLabResults');
    Route::get('patients/{id}/measurements', [PersonnelController::class, 'patientMeasurements'])->name('personnel.patientMeasurements');
    Route::get('patients/{id}/profile', [PersonnelController::class, 'patientProfile'])->name('personnel.patientProfile');
    Route::get('patients/documents', [PersonnelController::class, 'documents'])->name('personnel.documents');
});
