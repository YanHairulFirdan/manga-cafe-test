<?php

use App\Http\Controllers\API\Mobile\V1\Auth\CheckEmailController;
use App\Http\Controllers\API\Mobile\V1\Auth\LoginController;
use App\Http\Controllers\API\Mobile\V1\Auth\OtpController;
use App\Http\Controllers\API\Mobile\V1\Auth\RegisterController;
use Illuminate\Support\Facades\Route;

Route::prefix('auth')->as('auth.')->group(function () {
    Route::post('check-email', [CheckEmailController::class, 'check'])->name('check-email');
    Route::post('register', [RegisterController::class, 'store'])->name('register');
    
    Route::post('login', [LoginController::class, 'login'])->name('login');
});

Route::name('profile')->prefix('profile.')->middleware('auth:sanctum')->group(function () {
    Route::delete('logout', [LoginController::class, 'logout'])->name('logout');
});

Route::prefix('otp')->as('otp.')->group(function () {
    Route::post('request', [OtpController::class, 'request'])->name('request');
    Route::post('validate', [OtpController::class, 'check'])->name('validate');
});