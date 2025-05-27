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
    Route::view('/products', 'admin.products.index')->name('products.index');
    Route::view('/categories', 'admin.categories.index')->name('categories.index');
    Route::view('/users', 'admin.users.index')->name('users.index');
    Route::view('/reports', 'admin.reports.index')->name('reports.index');
    Route::view('/products/search', 'admin.products.search')->name('products.search');
    Route::view('/umkm-profiles', 'admin.umkm_profiles.index')->name('umkm-profiles.index');
});
