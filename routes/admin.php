<?php

use App\Http\Controllers\dashbord\DashbordController;
use App\Http\Controllers\dashbord\ProductController;
use App\Http\Controllers\dashbord\UserController;
use Illuminate\Support\Facades\Route;

Route::get('/', [DashbordController::class, 'index'])->name('home');




Route::as('users')->prefix('users')->group(function () {
    Route::get('/', [UserController::class, 'index'])->name('.index');
});



Route::as('products')->prefix('products')->group(function () {
    Route::get('/', [ProductController::class, 'index'])->name('.index');
    Route::get('/orders', [ProductController::class, 'orders'])->name('.orders');
});
