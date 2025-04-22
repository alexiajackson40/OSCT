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
use App\Http\Controllers\ParentController;

// Main Route (public)
Route::get('/', fn () => redirect()->route('login'));

// Login & Register (for Guests)
Route::middleware('guest')->group(function () {
    Route::view('/login', 'login')->name('login');
    Route::post('/login', [AuthController::class, 'authenticate'])->name('login.post');

    Route::get('/register', [AuthController::class, 'showRegisterForm'])->name('register');
    Route::post('/register', [AuthController::class, 'register'])->name('register.post');
});

// Patient Sign-Up Route
Route::get('/signup', fn () => view('patient_user.sign_up'))->name('signup');
Route::post('/signup', [UserController::class, 'signup'])->name('signup');

// Admin Routes
Route::prefix('admin')->middleware('auth:admin')->group(function () {
    Route::get('home', [AdminController::class, 'home'])->name('admin.home');
    Route::get('profile', [AdminController::class, 'profile'])->name('admin.profile');
    Route::get('profile/edit', [AdminController::class, 'editProfile'])->name('admin.editProfile');
    Route::put('profile/update', [AdminController::class, 'updateProfile'])->name('update.profile');

    Route::get('/admin/change-password', [AdminController::class, 'changePasswordForm'])->name('admin.changePassword');
    Route::put('/admin/update-password', [AdminController::class, 'updatePassword'])->name('admin.updatePassword');

    Route::get('header_admin', fn () => view('admin_user.header_admin'))->name('admin.header_admin');

    Route::get('users', [AdminController::class, 'users'])->name('admin.users');
    Route::get('users/add', [AdminController::class, 'addUser'])->name('admin.addUser');
    Route::post('users/add', [AdminController::class, 'storeUser'])->name('add-user.store');
    Route::get('users/edit/{id}', [AdminController::class, 'editUser'])->name('admin.users.edit');
    Route::delete('users/{id}', [AdminController::class, 'destroyUser'])->name('admin.users.destroy');
    Route::put('users/update/{id}', [AdminController::class, 'updateUser'])->name('admin.users.update');

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
    Route::delete('/admin/users/admin/remove/{id}', [AdminUsersController::class, 'removeAdmin'])->name('admin.removeAdmin');
    Route::delete('/users/personnel/remove/{id}', [AdminUsersController::class, 'removePersonnel'])->name('admin.removePersonnel');
    Route::get('users/personnel/profile/{id}', [AdminUsersController::class, 'personnelProfile'])->name('admin.users.personnel_profile');

    Route::get('users/patient/profile/{id}', [AdminUsersController::class, 'patientProfile'])->name('admin.users.patient_profile');
    Route::put('users/patient/profile/{id}/update', [AdminUsersController::class, 'updatePatient'])->name('admin.updatePatient');
    Route::get('users/patient/measurements/{id}', [AdminUsersController::class, 'patientMeasurements'])->name('admin.users.patient_measurements');
    Route::post('users/patient/measurements/upload/{id}', [AdminUsersController::class, 'uploadMeasurement'])->name('admin.uploadMeasurement');
    Route::put('users/patient/measurements/{id}/update', [AdminUsersController::class, 'updateMeasurement'])->name('admin.updateMeasurement');

    Route::get('users/patient/documents/{id}', [AdminUsersController::class, 'allPatientDocuments'])->name('admin.users.patient_documents');
    Route::get('users/patient/labResults/{id}', [AdminUsersController::class, 'patientLabResults'])->name('admin.users.patient_labResults');

    Route::post('labResult/upload/{id}', [AdminUsersController::class, 'uploadLabResult'])->name('admin.uploadLabResult');
    Route::get('labResult/download/{id}', [AdminUsersController::class, 'downloadLabResult'])->name('admin.labResultDownload');
    Route::delete('labResult/delete/{id}', [AdminUsersController::class, 'deleteLabResult'])->name('admin.deleteLabResult');

    Route::get('documents/{documentId}/download', [AdminUsersController::class, 'downloadDocument'])->name('admin.downloadDocument');
    Route::post('documents/upload/{id?}', [AdminUsersController::class, 'uploadDocument'])->name('admin.uploadDocument');
    Route::delete('documents/{documentId}/delete', [AdminUsersController::class, 'deleteDocument'])->name('admin.deleteDocument');

    Route::get('schedule', [AdminController::class, 'schedule'])->name('schedule.index');
    Route::get('schedule/edit/{id}', [AdminController::class, 'scheduleEdit'])->name('schedule.edit');
    Route::post('schedule/upload', [AdminController::class, 'uploadSchedule'])->name('admin.uploadSchedule');
    Route::get('schedule/edit/{id}', [AdminController::class, 'scheduleEdit'])->name('schedule.edit');
    Route::put('schedule/update/{id}', [AdminController::class, 'scheduleUpdate'])->name('schedule.update');
    

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

// Personnel Routes
Route::prefix('personnel')->middleware('auth:personnel')->group(function () {
    Route::get('home', [PersonnelController::class, 'home'])->name('personnel.home');
    Route::get('profile/{id}', [PersonnelController::class, 'personnelProfile'])->name('personnel.profile');
    Route::get('profile/edit/{id}', [PersonnelController::class, 'editProfile'])->name('personnel.editProfile');
    Route::put('profile/update/{id}', [PersonnelController::class, 'updateProfile'])->name('personnel.updateProfile');
    
    Route::get('/profile/{id}/change-password', [PersonnelController::class, 'changePasswordForm'])->name('personnel.changePasswordForm');
    Route::put('/personnel/change-password/{id}', [PersonnelController::class, 'changePassword'])->name('personnel.changePassword');

    Route::get('schedule', [PersonnelController::class, 'schedule'])->name('personnel.schedule');
    Route::get('users', [PersonnelController::class, 'users'])->name('personnel.users');

    Route::get('patients/{id}/profile', [PersonnelController::class, 'patientProfile'])->name('personnel.patientProfile');
    Route::put('patients/{id}/update', [PersonnelController::class, 'updatePatient'])->name('personnel.updatePatient');

    Route::get('patients/{id}/measurements', [PersonnelController::class, 'patientMeasurements'])->name('personnel.patientMeasurements');
    Route::put('patient/measurements/{id}/update', [PersonnelController::class, 'updateMeasurement'])->name('personnel.updateMeasurement');

    Route::get('patients/{id}/documents', [PersonnelController::class, 'documents'])->name('personnel.documents');
    Route::post('patients/{id}/documents/upload', [PersonnelController::class, 'uploadDocument'])->name('personnel.uploadDocument');
    Route::delete('documents/{id}/delete', [PersonnelController::class, 'deleteDocument'])->name('personnel.deleteDocument');

    Route::get('patients/{id}/lab-results', [PersonnelController::class, 'patientLabResults'])->name('personnel.patientLabResults');
    Route::post('patients/{id}/lab-results/upload', [PersonnelController::class, 'uploadLabResult'])->name('personnel.uploadLabResult');
    Route::get('lab-results/download/{id}', [PersonnelController::class, 'downloadLabResult'])->name('personnel.labResultDownload');
    Route::delete('lab-results/{id}/delete', [PersonnelController::class, 'deleteLabResult'])->name('personnel.deleteLabResult');
});

// Patient Routes
Route::prefix('patient')->middleware('auth:parent')->group(function () {
    Route::get('home', [PatientController::class, 'home'])->name('patient.home');
    Route::get('profile', [PatientController::class, 'profile'])->name('patient.profile');
    Route::get('documents', [PatientController::class, 'documents'])->name('patient.documents');
    Route::get('lab-results', [PatientController::class, 'labResults'])->name('patient.lab_results');
    Route::get('schedule', [PatientController::class, 'schedule'])->name('patient.schedule');
    Route::get('signup', [PatientController::class, 'signUp'])->name('patient.signup');
});

// Routes for parent (patient-style) users
Route::middleware('auth:parent')->group(function () {
    Route::get('/patient/home', [ParentController::class, 'home'])->name('patient.home');
    Route::get('/patient/profile', [PatientController::class, 'profile'])->name('patient.profile');
    Route::get('/patient/documents', [PatientController::class, 'documents'])->name('patient.documents');
    Route::get('/patient/lab-results', [PatientController::class, 'labResults'])->name('patient.lab_results');
    Route::get('/patient/documents', [ParentController::class, 'documents'])->name('patient.documents');
    Route::get('/patient/lab-results', [ParentController::class, 'labResults'])->name('patient.lab_results');
    Route::get('/patient/documents/{id}/download', [ParentController::class, 'downloadDocument'])->name('parent.documents.download');
    Route::get('/patient/lab-results/{id}/download', [ParentController::class, 'downloadLabResult'])->name('parent.labResults.download');
    Route::post('/parent/logout', function () {
        Auth::logout();              // Log the user out
        request()->session()->invalidate(); // Invalidate session
        request()->session()->regenerateToken(); // Regenerate CSRF token
    
        return redirect('/login'); // Or wherever your login page is
    })->name('parent.logout');
    Route::get('/patient/measurements', [ParentController::class, 'measurements'])->name('patient.measurements');
});

// Fallback for Storage Access
Route::get('storage/{path}', function ($path) {
    $decodedPath = urldecode($path);
    $filePath = storage_path('app/public/' . $decodedPath);

    if (!file_exists($filePath)) {
        abort(404, 'File not found.');
    }

    return response()->file($filePath);
})->where('path', '.*');
