<?php

use App\Http\Controllers\API\Mobile\V1\Auth\CheckEmailController;
use Illuminate\Support\Facades\Route;

Route::prefix('auth')->as('auth.')->group(function () {
    Route::post('check-email', [CheckEmailController::class, 'check'])->name('check-email');
});