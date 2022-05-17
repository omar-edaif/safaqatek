<?php

use App\Http\Controllers\dashbord\DashbordController;
use App\Http\Controllers\dashbord\ProductController;
use App\Http\Controllers\dashbord\UserController;
use Illuminate\Support\Facades\Route;

Route::get('/', [DashbordController::class, 'index'])->name('home');

Route::get('upload', [DashbordController::class, 'upload']);
Route::post('upload', [DashbordController::class, 'upload']);
Route::Delete('upload', [DashbordController::class, 'filedelete']);


Route::as('users')->prefix('users')->group(function () {
    Route::get('/', [UserController::class, 'index'])->name('.index');
});



Route::as('products')->prefix('products')->group(function () {
    Route::get('/', [ProductController::class, 'index'])->name('.index');
    Route::get('/orders', [ProductController::class, 'orders'])->name('.orders');
    Route::get('/create', [ProductController::class, 'create'])->name('.create');
    Route::post('/create', [ProductController::class, 'store'])->name('.store');
    Route::get('/edit/{id}', [ProductController::class, 'edit'])->name('.edit');
    Route::post('/edit/{id}', [ProductController::class, 'update'])->name('.update');
    Route::delete('delete/{id}', [ProductController::class, 'delete'])->name('.delete');
});
