<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

Route::get('/home', function () {
    return view('admin_user.home');
});

Route::get('/', function () {
    return view('admin_user.home');
});

Route::get('/schedule', function () {
    return view('admin_user.schedule');
});

Route::get('/users', function () {
    return view('admin_user.users');
});

Route::get('/documents', function () {
    return view('admin_user.documents');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
