<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminUsersController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\PersonnelController;
use App\Http\Controllers\PatientController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\HomeController;

// Main Route
Route::get('/', [HomeController::class, 'home'])->name('home');

// Login Route
Route::view('/login', 'login')->name('login'); // Login form
Route::post('/login', [AuthController::class, 'authenticate'])->name('login'); // Handle login request

// Register Route
Route::get('/register', [AuthController::class, 'showRegisterForm'])->name('register');
Route::post('/register', [AuthController::class, 'register'])->name('register');

// Admin Routes
Route::prefix('admin')->group(function () {
    // Admin Home Page
    Route::get('home', [AdminController::class, 'home'])->name('admin.home');

    // Admin Profile Routes
    Route::get('profile', [AdminController::class, 'profile'])->name('admin.profile');
    Route::get('profile/edit', [AdminController::class, 'editProfile'])->name('admin.editProfile');
    Route::put('profile/update', [AdminController::class, 'updateProfile'])->name('update.profile');

    // Admin Header Route (Static View)
    Route::get('header_admin', function () {
        return view('admin_user.header_admin');
    })->name('admin.header_admin');

    // Admin User Management Routes
    Route::get('users', [AdminController::class, 'users'])->name('admin.users');
    Route::get('users/add', [AdminController::class, 'addUser'])->name('admin.addUser');
    Route::post('users/add', [AdminController::class, 'storeUser'])->name('add-user.store');
    Route::get('users/edit/{id}', [AdminController::class, 'editUser'])->name('admin.users.edit'); // Edit user
    Route::delete('users/{id}', [AdminController::class, 'destroyUser'])->name('admin.users.destroy'); // Delete user

    // Admin > Specific User Groups
    Route::get('users/patient', [AdminUsersController::class, 'patientUsers'])->name('admin.patientUsers');
    Route::post('users/patient/add', [AdminUsersController::class, 'addPatient'])->name('admin.addPatient');
    Route::delete('users/patient/remove/{id}', [AdminUsersController::class, 'removePatient'])->name('admin.removePatient');
    Route::post('users/patient/import', [AdminUsersController::class, 'importPatients'])->name('admin.importPatients');
    Route::get('users/personnel', [AdminUsersController::class, 'personnelUsers'])->name('admin.personnelUsers');
    Route::get('users/admin', [AdminUsersController::class, 'adminUsers'])->name('admin.adminUsers');
    Route::get('users/admin/profile/{id}', [AdminUsersController::class, 'adminProfile'])->name('admin.users.admin_profile');
    Route::put('users/admin/profile/{id}/update', [AdminUsersController::class, 'updateAdmin'])->name('admin.updateAdmin');
    Route::get('users/personnel/profile/{id}', [AdminUsersController::class, 'personnelProfile'])->name('admin.users.personnel_profile');
    Route::put('users/personnel/profile/{id}/update', [AdminUsersController::class, 'updatePersonnel'])->name('admin.updatePersonnel');

    // Patient-Specific Routes
    Route::get('users/patient/profile/{id}', [AdminUsersController::class, 'patientProfile'])->name('admin.users.patient_profile');
    Route::put('users/patient/profile/{id}/update', [AdminUsersController::class, 'updatePatient'])->name('admin.updatePatient');
    Route::get('users/patient/measurements/{id}', [AdminUsersController::class, 'patientMeasurements'])->name('admin.users.patient_measurements');
    Route::post('users/patient/measurements/upload/{id}', [AdminUsersController::class, 'uploadMeasurement'])->name('admin.uploadMeasurement');
    Route::get('users/patient/documents/{id}', [AdminUsersController::class, 'allPatientDocuments'])->name('admin.users.patient_documents');
    Route::get('users/patient/labResults/{id}', [AdminUsersController::class, 'patientLabResults'])->name('admin.users.patient_labResults');

    // Document Routes
    Route::get('documents/{documentId}/download', [AdminUsersController::class, 'downloadDocument'])->name('admin.downloadDocument');
    Route::post('documents/upload/{id?}', [AdminUsersController::class, 'uploadDocument'])->name('admin.uploadDocument');
    Route::delete('documents/{documentId}/delete', [AdminUsersController::class, 'deleteDocument'])->name('admin.deleteDocument');

    // Lab Result Routes
    Route::get('labResult/download/{id}', [AdminUsersController::class, 'downloadLabResult'])->name('admin.labResultDownload');
    Route::post('labResult/upload/{id}', [AdminUsersController::class, 'uploadLabResult'])->name('admin.uploadLabResult');
    Route::delete('labResult/delete/{id}', [AdminUsersController::class, 'deleteLabResult'])->name('admin.deleteLabResult');

    // Admin Schedule Routes
    Route::get('schedule', [AdminController::class, 'schedule'])->name('schedule.index');
    Route::get('schedule/edit/{id}', [AdminController::class, 'scheduleEdit'])->name('schedule.edit');

    // Logout Route
    Route::post('/logout', function () {
        Auth::guard('admin')->logout();
        request()->session()->invalidate();
        request()->session()->regenerateToken();
        return redirect()->route('login');
    })->name('logout');
});

// Personnel Routes
Route::prefix('personnel')->group(function () {
    Route::get('home', [PersonnelController::class, 'home'])->name('personnel.home');
    Route::get('profile/{id}', [PersonnelController::class, 'personnelProfile'])->name('personnel.profile');
    Route::get('schedule', [PersonnelController::class, 'schedule'])->name('personnel.schedule');
    Route::get('patients/{id}/lab-results', [PersonnelController::class, 'patientLabResults'])->name('personnel.patientLabResults');
    Route::get('patients/{id}/measurements', [PersonnelController::class, 'patientMeasurements'])->name('personnel.patientMeasurements');
    Route::get('patients/{id}/profile', [PersonnelController::class, 'patientProfile'])->name('personnel.patientProfile');
    Route::get('patients/documents', [PersonnelController::class, 'documents'])->name('personnel.documents');
});

// Patient Routes
Route::prefix('patient')->group(function () {
    Route::get('home', [PatientController::class, 'home'])->name('patient.home');
    Route::get('profile', [PatientController::class, 'profile'])->name('patient.profile');
    Route::get('documents', [PatientController::class, 'documents'])->name('patient.documents');
    Route::get('lab-results', [PatientController::class, 'labResults'])->name('patient.lab_results');
    Route::get('schedule', [PatientController::class, 'schedule'])->name('patient.schedule');
    Route::get('signup', [PatientController::class, 'signUp'])->name('patient.signup');
});

// Parent Routes
Route::prefix('parent')->group(function () {
    Route::get('home', [ParentController::class, 'home'])->name('parent.home');
    Route::get('profile', [ParentController::class, 'profile'])->name('parent.profile');
});
