<?php

use App\Http\Controllers\api\v1\AuthApiController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::prefix('v1')->group(function () {

    Route::get('/google/callback', [AuthApiController::class, 'handleProviderCallback'])->name('google.redirect');
    Route::prefix('user')->group(function () {
        Route::post('/register', [AuthApiController::class, 'register']);
        Route::post('/login', [AuthApiController::class, 'login']);
        Route::post('/logout', [AuthApiController::class, 'login']);
    });
});
