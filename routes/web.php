<?php

use App\Http\Controllers\AuthSocialiteController;
use Illuminate\Support\Facades\Route;


Route::get('/{provider}/redirect', [AuthSocialiteController::class, 'redirectToProvider']);
Route::get('/callback', 'Auth\LoginController@handleProviderCallback');
