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
    Route::get('dashboard', [App\Http\Controllers\DashboardController::class, 'index'])->name('admin.dashboard');
    Route::resource('categories', App\Http\Controllers\CategoryController::class);
    Route::resource('products', App\Http\Controllers\ProductController::class);
    Route::resource('users', App\Http\Controllers\UserController::class);
    Route::get('reports', [App\Http\Controllers\ReportController::class, 'index'])->name('reports.index');
    Route::resource('umkm-profiles', App\Http\Controllers\UMKMProfileController::class);
});

// Owner routes
Route::prefix('owner')->group(function () {
    Route::get('dashboard', function () {
        return view('owner.dashboard.dashboard');
    })->name('owner.dashboard');
    Route::resource('products', App\Http\Controllers\OwnerProductController::class, [
        'as' => 'owner'
    ]);
    Route::get('categories', function () {
        $categories = \App\Models\Category::all();
        return view('owner.categories.index', compact('categories'));
    })->name('owner.categories.index');
    Route::get('umkm-profile', function () {
        $umkm = \App\Models\UMKMProfile::with('user')->first();
        return view('owner.umkm-profile.index', compact('umkm'));
    })->name('owner.umkm-profile');
    // ...route fitur owner lain nanti di sini...
});
