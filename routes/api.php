<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\API\UserController;

// API Resource Route for User Management
Route::apiResource('users', UserController::class);
