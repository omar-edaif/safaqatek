<?php

use App\Http\Controllers\AuthSocialiteController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;


// Route::get('/{provider}/redirect', [AuthSocialiteController::class, 'redirectToProvider']);
Route::get('/', function () {
    return redirect('/docs');
});

Auth::routes();
Route::as('users')->prefix('users')->group(function () {
    Route::get('/', [UserController::class, 'index'])->name('.index');
});
