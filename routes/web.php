<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\WorkoutController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Auth\ForgotPasswordController;
use App\Http\Controllers\Auth\ResetPasswordController;
use App\Http\Controllers\UserDashboardController;
use App\Http\Controllers\AdminController;

// Home Page
// Route::get('/', function () {
//     return view('welcome');
// });

// User home
Route::get('/', function () {
    return view('welcome');
})->name('welcome');

// Register Routes
Route::get('/register', [RegisterController::class, 'showRegistrationForm'])->name('register');
Route::post('/register', [RegisterController::class, 'register']);

// Login Routes
Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
Route::post('/login', [LoginController::class, 'login']);

// Forgot Password Routes
Route::get('/password/reset', [ForgotPasswordController::class, 'showLinkRequestForm'])->name('password.request');
Route::post('/password/email', [ForgotPasswordController::class, 'sendResetLinkEmail'])->name('password.email');

// Password Reset Routes
Route::get('/password/reset/{token}', [ResetPasswordController::class, 'showResetForm'])->name('password.reset');
Route::post('/password/reset', [ResetPasswordController::class, 'reset'])->name('password.update');

// User Dashboard (Only for users)
// Route::middleware(['auth', 'role:user'])->group(function () {
//     Route::get('/dashboard/user', function () {
//         return view('dashboard.user');
//     })->name('user.dashboard');
// });


Route::middleware(['auth', 'role:user'])->group(function () {
    Route::get('/user/home', function () {
        return view('user.home');
    })->name('user.home');
});


// Admin Dashboard (Only for admins)
Route::middleware(['auth', 'role:admin'])->group(function () {
    Route::get('/dashboard/admin', function () {
        return view('dashboard.admin');
    })->name('admin.dashboard');
});

Route::middleware(['auth', 'role:admin'])->group(function () {
    Route::get('/admin/home', function () {
        return view('admin.home');
    })->name('admin.home');
});

// Logout Route
Route::post('/logout', [LoginController::class, 'logout'])->name('logout');


// User Workouts Page
Route::middleware(['auth'])->group(function () {
    Route::get('/workouts', [WorkoutController::class, 'index'])->name('workouts.index');
});

// Admin Manage Workouts
Route::middleware(['auth', 'role:admin'])->group(function () {
    Route::get('/admin/workouts', [WorkoutController::class, 'index'])->name('admin.workouts.index');
    Route::get('/admin/workouts/create', [WorkoutController::class, 'create'])->name('admin.workouts.create');
    Route::post('/admin/workouts', [WorkoutController::class, 'store'])->name('admin.workouts.store');
});


// User profile
Route::middleware(['auth'])->group(function () {
    Route::get('/profile', function () {
        return view('user.profile');
    })->name('profile');

    Route::get('/profile/edit', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::put('/profile/update', [ProfileController::class, 'update'])->name('profile.update');
});

// User Dashboard Route
// Route::middleware(['auth'])->group(function () {
//     Route::get('/dashboard/user', [UserDashboardController::class, 'index'])->name('dashboard');
// });

Route::get('/dashboard/user', function () {
    return view('dashboard.user');
})->name('user.dashboard');

Route::prefix('admin')->middleware(['auth'])->group(function () {
//    Route::get('/dashboard', [AdminController::class, 'dashboard'])->name('admin.dashboard');
    Route::get('/manage-users', [AdminController::class, 'manageUsers'])->name('admin.manage-users');
    Route::get('/settings', [AdminController::class, 'settings'])->name('admin.settings');
});

Route::prefix('admin')->middleware(['auth'])->group(function () {
    Route::get('/manage-users', [AdminController::class, 'manageUsers'])->name('admin.manage-users');
    Route::get('/edit-user/{id}', [AdminController::class, 'editUser'])->name('admin.edit-user');
    Route::put('/update-user/{id}', [AdminController::class, 'updateUser'])->name('admin.update-user');
    Route::delete('/delete-user/{id}', [AdminController::class, 'deleteUser'])->name('admin.delete-user');
});

Route::prefix('admin')->middleware(['auth'])->group(function () {
    Route::get('/dashboard', [AdminController::class, 'dashboard'])->name('admin.dashboard');
});
