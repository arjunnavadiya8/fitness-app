<?php

use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Auth\LoginController;
use Illuminate\Support\Facades\Route;

// Home Page
Route::get('/', function () {
    return view('welcome');
});

// Register Routes
Route::get('/register', [RegisterController::class, 'showRegisterForm'])->name('register');
Route::post('/register', [RegisterController::class, 'register']);

// Login Routes
Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
Route::post('/login', [LoginController::class, 'login']);

// User Dashboard (Only for users)
Route::middleware(['auth', 'role:user'])->group(function () {
    Route::get('/dashboard/user', function () {
        return view('dashboard.user');
    })->name('user.dashboard');
});

// Admin Dashboard (Only for admins)
Route::middleware(['auth', 'role:admin'])->group(function () {
    Route::get('/dashboard/admin', function () {
        return view('dashboard.admin');
    })->name('admin.dashboard');
});

// Logout Route
Route::post('/logout', [LoginController::class, 'logout'])->name('logout');
