<?php

use App\Http\Controllers\API\Mobile\V1\Auth\CheckEmailController;
use App\Http\Controllers\API\Mobile\V1\Auth\OtpController;
use Illuminate\Support\Facades\Route;

Route::prefix('auth')->as('auth.')->group(function () {
    Route::post('check-email', [CheckEmailController::class, 'check'])->name('check-email');
});
Route::prefix('otp')->as('otp.')->group(function () {
    Route::post('request', [OtpController::class, 'request'])->name('request');
    Route::post('validate', [OtpController::class, 'check'])->name('validate');
});