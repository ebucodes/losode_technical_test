<?php

use App\Http\Controllers\v1\AuthController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

// login function
Route::post('login', [AuthController::class, 'login']);

// get all users
Route::get('all-users', [AuthController::class, 'fetchAllUser']);

// get single user
Route::get('user/{uuid}', [AuthController::class, 'fetchSingleUser']);
