<?php

use App\Http\Controllers\api\v1\AuthApiController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::prefix('v1/{lang}')->group(function () {

    Route::prefix('user')->group(function () {
        Route::get('/google/callback', [AuthApiController::class, 'handleProviderCallback'])->name('google.redirect');
        Route::group(['middleware' => ['web']], function () {
            Route::get('/{provider}', [AuthApiController::class, 'redirectToProvider']);
        });
        Route::post('/phone', [AuthApiController::class, 'phone']);
        Route::post('/register', [AuthApiController::class, 'register']);
        Route::post('/login', [AuthApiController::class, 'login']);
    });


    Route::middleware('auth:sanctum')->group(function () {

        Route::prefix('user')->group(function () {

            Route::post('/logout', [AuthApiController::class, 'logout']);
        });
    });
});
