<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminUsersController;
use App\Http\Controllers\PatientController;

// Main Route
Route::get('/', fn () => view('home'));

// Admin User Routes
Route::prefix('admin')->group(function () {
    Route::get('home', [AdminUsersController::class, 'home']);
    Route::get('profile', [AdminUsersController::class, 'profile']);
    Route::get('admin/users', [AdminUsersController::class, 'adminUsers'])->name('admin.adminUsers');
    Route::get('admin/add-user', [AdminUsersController::class, 'addUser']);
    
    // Store user route
    Route::post('admin/add-user', [AdminUsersController::class, 'storeUser'])->name('add-user.store'); 

    // Admin > Users
    Route::get('users/patient', [AdminUsersController::class, 'patientUsers'])->name('admin.users.patientUsers');
    Route::get('users/patient/profile/{id}', [AdminUsersController::class, 'patientProfile'])->name('admin.users.patientProfile');
    Route::get('users/personnel', [AdminUsersController::class, 'personnelUsers']);
    Route::get('users/personnel/profile/{id}', [AdminUsersController::class, 'personnelProfile']);
    Route::get('users/admin', [AdminUsersController::class, 'adminUsers']);
    Route::get('users/admin/profile/{id}', [AdminUsersController::class, 'adminProfile']);
    
    // Admin > User Data (Measurement, Documents, Lab Results)
    Route::get('users/patient/{id}/measurements', [AdminUsersController::class, 'patientMeasurements']);
    Route::get('users/patient/{id}/documents', [AdminUsersController::class, 'patientDocuments']);
    Route::get('users/patient/{id}/lab-results', [AdminUsersController::class, 'patientLabResults']);
    
    // Admin > Schedule
    Route::get('schedule', [AdminUsersController::class, 'showSchedule'])->name('schedule.index');
    Route::get('schedule/edit/{id}', [AdminUsersController::class, 'editSchedule'])->name('schedule.edit');

    // Document Routes
    Route::get('users/patient/{id}/documents', [AdminUsersController::class, 'patientDocuments'])->name('admin.users.patientDocuments');
    Route::get('users/patient/{id}/documents/download/{documentId}', [AdminUsersController::class, 'downloadDocument'])->name('admin.users.patientDocuments.download');
    Route::post('users/patient/{id}/upload-document', [AdminUsersController::class, 'uploadDocument'])->name('admin.users.uploadDocument');
});

// Patient User Routes
Route::prefix('patient')->group(function () {
    Route::get('profile', [PatientController::class, 'profile'])->name('patient.profile');
    Route::get('documents', [PatientController::class, 'documents'])->name('patient.documents');
    Route::get('lab-results', [PatientController::class, 'labResults'])->name('patient.labResults');
    Route::get('schedule', [PatientController::class, 'schedule'])->name('patient.schedule');
    Route::get('measurements', [PatientController::class, 'measurements'])->name('patient.measurements');
});
