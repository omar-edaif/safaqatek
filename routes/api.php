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


    /*  Product */

    Route::prefix('product')->group(function () {
        Route::get('/', [productController::class, 'products']);
    });


    /*  Slider */

    Route::prefix('slider')->group(function () {

        Route::post('/', [SliderController::class, 'sliders']);
    });

    /*  config && settings  */
    Route::prefix('settings')->group(function () {

        Route::get('/', [SettingController::class, 'index']);
        Route::post('/contuct', [SettingController::class, 'contuctUs']);
    });

    Route::middleware('auth:sanctum')->group(function () {

        Route::prefix('user')->group(function () {

            Route::get('/profile', [AuthApiController::class, 'profile']);
            Route::post('/profile/update', [AuthApiController::class, 'update']);
            Route::get('/coupons', [AuthApiController::class, 'coupons']);
            Route::get('/wishlists', [AuthApiController::class, 'wishLists']);
            Route::post('/purchase', [AuthApiController::class, 'purchase']);
            Route::post('/logout', [AuthApiController::class, 'logout']);
        });

        /*  Product */
        Route::prefix('product')->group(function () {
            Route::get('/wishlist/add/{id}', [productController::class, 'addToWishlist']);
            Route::get('/wishlist/delete/{id}', [productController::class, 'deleteFromWishlist']);
            Route::get('/winners', [productController::class, 'winners']);
        });
    });
});
