<?php

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminUsersController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\PersonnelController;
use App\Http\Controllers\PatientController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\UserController;

// Main Route (public)
Route::get('/', [HomeController::class, 'home'])->name('home');

// Login & Register (for Guests)
Route::middleware('guest')->group(function () {
    // Only one set of login routes is defined.
    Route::view('/login', 'login')->name('login');
    Route::post('/login', [AuthController::class, 'authenticate'])->name('login.post');

    // Register routes
    Route::get('/register', [AuthController::class, 'showRegisterForm'])->name('register');
    Route::post('/register', [AuthController::class, 'register'])->name('register.post');
});

// Patient Sign-Up Route (public)
Route::get('/signup', function () {
    return view('patient_user.sign_up');
})->name('signup');
Route::post('/signup', [UserController::class, 'signup'])->name('signup');

// Admin Routes (using the admin guard)
Route::prefix('admin')->middleware('auth:admin')->group(function () {
    // Admin Home Page
    Route::get('home', [AdminController::class, 'home'])->name('admin.home');

    // Admin Profile Routes
    Route::get('profile', [AdminController::class, 'profile'])->name('admin.profile');
    Route::get('profile/edit', [AdminController::class, 'editProfile'])->name('admin.editProfile');
    Route::put('profile/update', [AdminController::class, 'updateProfile'])->name('update.profile');

    // Static Admin Header
    Route::get('header_admin', function () {
        return view('admin_user.header_admin');
    })->name('admin.header_admin');

    // User Management Routes
    Route::get('users', [AdminController::class, 'users'])->name('admin.users');
    Route::get('users/add', [AdminController::class, 'addUser'])->name('admin.addUser');
    Route::post('users/add', [AdminController::class, 'storeUser'])->name('add-user.store');
    Route::get('users/edit/{id}', [AdminController::class, 'editUser'])->name('admin.users.edit');
    Route::delete('users/{id}', [AdminController::class, 'destroyUser'])->name('admin.users.destroy');

    // Specific User Groups
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

    // Patient-Specific Routes (Admin Panel)
    Route::get('users/patient/profile/{id}', [AdminUsersController::class, 'patientProfile'])
        ->name('admin.users.patient_profile');
    Route::put('users/patient/profile/{id}/update', [AdminUsersController::class, 'updatePatient'])
        ->name('admin.updatePatient');
    Route::get('users/patient/measurements/{id}', [AdminUsersController::class, 'patientMeasurements'])
        ->name('admin.users.patient_measurements');
    Route::post('users/patient/measurements/upload/{id}', [AdminUsersController::class, 'uploadMeasurement'])
        ->name('admin.uploadMeasurement');
    Route::put('users/patient/measurements/{id}/update', [AdminUsersController::class, 'updateMeasurement'])->name('admin.updateMeasurement');
    Route::get('users/patient/documents/{id}', [AdminUsersController::class, 'allPatientDocuments'])
        ->name('admin.users.patient_documents');
        Route::get('users/patient/labResults/{id}', [AdminUsersController::class, 'patientLabResults'])
        ->name('admin.users.patient_labResults');
    Route::post('labResult/upload/{id}', [AdminUsersController::class, 'uploadLabResult'])
        ->name('admin.uploadLabResult');
    Route::get('labResult/download/{id}', [AdminUsersController::class, 'downloadLabResult'])
        ->name('admin.labResultDownload');
    Route::delete('labResult/delete/{id}', [AdminUsersController::class, 'deleteLabResult'])
        ->name('admin.deleteLabResult');
    
    // Document Routes
    Route::get('documents/{documentId}/download', [AdminUsersController::class, 'downloadDocument'])
        ->name('admin.downloadDocument');
    Route::post('documents/upload/{id?}', [AdminUsersController::class, 'uploadDocument'])
        ->name('admin.uploadDocument');
    Route::delete('documents/{documentId}/delete', [AdminUsersController::class, 'deleteDocument'])
        ->name('admin.deleteDocument');

    // Lab Result Routes
    Route::get('labResult/download/{id}', [AdminUsersController::class, 'downloadLabResult'])
        ->name('admin.labResultDownload');
    Route::post('labResult/upload/{id}', [AdminUsersController::class, 'uploadLabResult'])
        ->name('admin.uploadLabResult');
    Route::delete('labResult/delete/{id}', [AdminUsersController::class, 'deleteLabResult'])
        ->name('admin.deleteLabResult');

    // Admin Schedule Routes
    Route::get('schedule', [AdminController::class, 'schedule'])->name('schedule.index');
    Route::get('schedule/edit/{id}', [AdminController::class, 'scheduleEdit'])->name('schedule.edit');
    Route::post('schedule/upload', [AdminController::class, 'uploadSchedule'])->name('admin.uploadSchedule');

    Route::post('/logout', function () {
        if (Auth::guard('admin')->check()) {
            Auth::guard('admin')->logout();
        } elseif (Auth::guard('personnel')->check()) {
            Auth::guard('personnel')->logout();
        }
    
        request()->session()->invalidate();
        request()->session()->regenerateToken();
        return redirect()->route('login');
    })->name('logout');
});

// Personnel Routes (protected with auth middleware)
Route::prefix('personnel')->middleware('auth:personnel')->group(function () {
    Route::get('home', [PersonnelController::class, 'home'])->name('personnel.home');
    Route::get('profile/{id}', [PersonnelController::class, 'personnelProfile'])->name('personnel.profile');
    Route::get('profile/edit/{id}', [PersonnelController::class, 'editProfile'])->name('personnel.editProfile');
    Route::put('profile/update/{id}', [PersonnelController::class, 'updateProfile'])->name('personnel.updateProfile');
    Route::get('schedule', [PersonnelController::class, 'schedule'])->name('personnel.schedule');
    Route::get('users', [\App\Http\Controllers\PersonnelController::class, 'users'])->name('personnel.users');
    Route::get('patients/{id}/lab-results', [PersonnelController::class, 'patientLabResults'])->name('personnel.patientLabResults');
    Route::get('lab-results/download/{id}', [\App\Http\Controllers\PersonnelController::class, 'downloadLabResult'])->name('personnel.labResultDownload');
    Route::get('patients/{id}/measurements', [PersonnelController::class, 'patientMeasurements'])->name('personnel.patientMeasurements');
    Route::get('patients/{id}/profile', [PersonnelController::class, 'patientProfile'])->name('personnel.patientProfile');
    Route::get('patients/{id}/documents', [PersonnelController::class, 'documents'])->name('personnel.documents');
});

// Patient Routes (protected with auth middleware)
Route::prefix('patient')->middleware('auth')->group(function () {
    Route::get('home', [PatientController::class, 'home'])->name('patient.home');
    Route::get('profile', [PatientController::class, 'profile'])->name('patient.profile');
    Route::get('documents', [PatientController::class, 'documents'])->name('patient.documents');
    Route::get('lab-results', [PatientController::class, 'labResults'])->name('patient.lab_results');
    Route::get('schedule', [PatientController::class, 'schedule'])->name('patient.schedule');
    Route::get('signup', [PatientController::class, 'signUp'])->name('patient.signup');
});

// Parent Routes (protected with auth middleware)
Route::prefix('parent')->middleware('auth')->group(function () {
    Route::get('home', [ParentController::class, 'home'])->name('parent.home');
    Route::get('profile', [ParentController::class, 'profile'])->name('parent.profile');
});

// Fallback Route for Storage Files
Route::get('storage/{path}', function ($path) {
    $decodedPath = urldecode($path);
    $filePath = storage_path('app/public/' . $decodedPath);

    if (!file_exists($filePath)) {
        abort(404, 'File not found.');
    }

    return response()->file($filePath);
})->where('path', '.*');
