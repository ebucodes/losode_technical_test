<?php

use App\Http\Controllers\v1\JobListingController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::group(['prefix' => 'my', 'middleware' => ['auth:sanctum', 'business']], function () {
    Route::get('jobs', [JobListingController::class, 'index']);
    Route::post('jobs', [JobListingController::class, 'store']);
    Route::get('jobs/{job_id}', [JobListingController::class, 'view']);
    Route::patch('jobs/{job_id}', [JobListingController::class, 'update']);
    Route::delete('jobs/{job_id}', [JobListingController::class, 'destroy']);
});
