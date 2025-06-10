<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\GoogleController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ReportController;
use App\Http\Controllers\UMKMProfileController;
use App\Http\Controllers\OwnerDashboardController;
use App\Http\Controllers\OwnerProductController;
use App\Http\Controllers\OwnerUMKMProfileController;

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

// ------------------- AUTH -------------------
Route::get('/', [AuthController::class, 'showLoginForm'])->name('login');
Route::post('/login', [AuthController::class, 'login'])->name('login.attempt');
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
Route::post('/login-owner', [GoogleController::class, 'loginOwnerWithEmail'])->name('login.owner');

// ------------------- GOOGLE AUTH (OWNER) -------------------
Route::get('auth/google', [GoogleController::class, 'redirectToGoogle'])->name('google.login');
Route::get('auth/google/callback', [GoogleController::class, 'handleGoogleCallback'])->name('google.callback');
Route::get('verify/{token}', [GoogleController::class, 'verifyEmail'])->name('google.verify');

// ------------------- ADMIN -------------------
Route::prefix('admin')->middleware(['auth', 'role:admin'])->group(function () {
    Route::get('dashboard', [DashboardController::class, 'index'])->name('admin.dashboard');
    Route::resource('categories', CategoryController::class);
    Route::resource('products', ProductController::class);
    Route::resource('users', UserController::class);
    Route::get('reports', [ReportController::class, 'index'])->name('reports.index');
    Route::get('reports/export', [ReportController::class, 'export'])->name('reports.export');
    Route::resource('umkm-profiles', UMKMProfileController::class)->except(['create', 'store', 'edit', 'update']);
    Route::patch('umkm-profiles/{id}/status/{status}', [UMKMProfileController::class, 'setStatus'])->name('umkm-profiles.setStatus');
    Route::get('/admin/users/trashed', [UserController::class, 'trashed'])->name('users.trashed');
    Route::post('/admin/users/{id}/restore', [UserController::class, 'restore'])->name('users.restore');
});

// ------------------- OWNER -------------------
Route::prefix('owner')->middleware(['auth', 'role:umkm_owner', 'umkmprofile.exists'])->group(function () {
    Route::get('dashboard', [OwnerDashboardController::class, 'index'])->name('owner.dashboard');
    Route::resource('products', OwnerProductController::class, [ 'as' => 'owner' ]);
    Route::get('categories', function () {
        $categories = \App\Models\Category::all();
        return view('owner.categories.index', compact('categories'));
    })->name('owner.categories.index');
    Route::get('umkm-profile', function () {
        $umkm = \App\Models\UMKMProfile::with('user')->where('id_users', auth()->id())->first();
        return view('owner.umkm-profile.index', compact('umkm'));
    })->name('owner.umkm-profile');
    Route::post('umkm-profile', [OwnerUMKMProfileController::class, 'store'])->name('owner.umkm-profile.store');
    Route::match(['put', 'patch'], 'umkm-profile/{id}', [OwnerUMKMProfileController::class, 'update'])->name('owner.umkm-profile.update');
});
