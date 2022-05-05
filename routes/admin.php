<?php

use App\Http\Controllers\dashbord\DashbordController;
use App\Http\Controllers\dashbord\UserController;
use Illuminate\Support\Facades\Route;

Route::get('/', [DashbordController::class, 'index'])->name('home');




Route::as('users')->prefix('users')->group(function () {
    Route::get('/', [UserController::class, 'index'])->name('.index');
});
