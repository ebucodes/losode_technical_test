<?php

use App\Http\Controllers\v1\AuthController;
use App\Http\Controllers\v1\UserController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

// login function
Route::post('login', [AuthController::class, 'login']);

Route::middleware('auth:sanctum')->group(function () {
    // get all users
    Route::get('/user', [UserController::class, 'getAllUsers']);
    // log out
    Route::post('logout', [AuthController::class, 'logout']);
});
