<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

// Authentication
Route::get('/', function () {
    return view('auth.login');
});

Route::get('/forgot-password', function () {
    return view('auth.forgot-password');
});


// Admin routes
Route::prefix('admin')->group(function () {
    Route::view('/dashboard', 'admin.dashboard.index')->name('admin.dashboard');
    Route::resource('categories', App\Http\Controllers\CategoryController::class);
    Route::resource('products', App\Http\Controllers\ProductController::class);
    Route::resource('users', App\Http\Controllers\UserController::class);
    Route::view('/reports', 'admin.reports.index')->name('reports.index');
    Route::get('/products/search', [App\Http\Controllers\ProductController::class, 'search'])->name('products.search');
    Route::resource('umkm-profiles', App\Http\Controllers\UMKMProfileController::class);
});
