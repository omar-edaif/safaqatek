<?php

use App\Http\Controllers\dashbord\DashbordController;
use App\Http\Controllers\dashbord\ProductController;
use App\Http\Controllers\dashbord\SliderController;
use App\Http\Controllers\dashbord\UserController;
use Illuminate\Support\Facades\Route;

Route::get('/', [DashbordController::class, 'index'])->name('home');

Route::get('upload', [DashbordController::class, 'upload']);
Route::post('upload', [DashbordController::class, 'upload']);
Route::Delete('upload', [DashbordController::class, 'filedelete']);


Route::as('users')->prefix('users')->group(function () {
    Route::get('/', [UserController::class, 'index'])->name('.index');
    Route::delete('/delete/{id}', [UserController::class, 'delete'])->name('.delete');
});


//  ! product routes

Route::as('products')->prefix('products')->group(function () {
    Route::get('/', [ProductController::class, 'index'])->name('.index');
    Route::get('/orders', [ProductController::class, 'orders'])->name('.orders');
    Route::get('/create', [ProductController::class, 'create'])->name('.create');
    Route::post('/create', [ProductController::class, 'store'])->name('.store');
    Route::get('/edit/{id}', [ProductController::class, 'edit'])->name('.edit');
    Route::post('/edit/{id}', [ProductController::class, 'update'])->name('.update');
    Route::delete('delete/{id}', [ProductController::class, 'delete'])->name('.delete');
});


//  ! sliders routes
Route::as('sliders')->prefix('sliders')->group(function () {
    Route::get('/', [SliderController::class, 'index'])->name('.index');
    Route::view('/create', 'dashbord.sliders.create')->name('.create');
    Route::post('/create', [SliderController::class, 'store'])->name('.store');
    Route::get('/edit/{id}', [SliderController::class, 'edit'])->name('.edit');
    Route::post('/edit/{id}', [SliderController::class, 'update'])->name('.update');
    Route::delete('delete/{id}', [SliderController::class, 'delete'])->name('.delete');
});
