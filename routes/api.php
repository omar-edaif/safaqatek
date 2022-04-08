<?php

use App\Http\Controllers\api\v1\AuthApiController;
use App\Http\Controllers\api\v1\productController;
use App\Http\Controllers\api\v1\SettingController;
use App\Http\Controllers\api\v1\SliderController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::prefix('v1/{lang}')->group(function () {

    Route::prefix('user')->group(function () {
        Route::get('/google/callback', [AuthApiController::class, 'handleProviderCallback'])->name('google.redirect');
        Route::group(['middleware' => ['web']], function () {
            //   Route::get('/{provider}', [AuthApiController::class, 'redirectToProvider']);
        });
        Route::post('/phone', [AuthApiController::class, 'phone']);
        Route::post('/register', [AuthApiController::class, 'register']);
        Route::post('/login', [AuthApiController::class, 'login']);
        Route::post('/new/password', [AuthApiController::class, 'newPassword']);
    });


    Route::middleware('auth:sanctum')->group(function () {

        Route::prefix('user')->group(function () {

            Route::get('/profile', [AuthApiController::class, 'profile']);
            Route::get('/coupons', [AuthApiController::class, 'coupons']);
            Route::post('/purchase', [AuthApiController::class, 'purchase']);
            Route::post('/logout', [AuthApiController::class, 'logout']);
        });

        /*  Product */
        Route::prefix('product')->group(function () {

            Route::post('/', [productController::class, 'products']);
        });

        /*  Slider */

        Route::prefix('slider')->group(function () {

            Route::post('/', [SliderController::class, 'sliders']);
        });
        /*  config && settings  */

        Route::get('/settings', [SettingController::class, 'index']);
    });
});
