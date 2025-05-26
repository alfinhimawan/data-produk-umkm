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

// Dashboard
Route::get('/dashboard', function () {
    return view('admin.index');
});

// Components
Route::prefix('components')->group(function () {
    Route::get('/buttons', function () {
        return view('admin.buttons');
    });

    Route::get('/cards', function () {
        return view('admin.cards');
    });
});

// Utilities
Route::prefix('utilities')->group(function () {
    Route::get('/color', function () {
        return view('admin.utilities-color');
    });

    Route::get('/border', function () {
        return view('admin.utilities-border');
    });

    Route::get('/animation', function () {
        return view('admin.utilities-animation');
    });

    Route::get('/other', function () {
        return view('admin.utilities-other');
    });
});

// Pages
Route::prefix('pages')->group(function () {
    Route::get('/404', function () {
        return view('admin.404');
    });

    Route::get('/blank', function () {
        return view('admin.blank');
    });
});

// Charts and Tables
Route::get('/charts', function () {
    return view('admin.charts');
});

Route::get('/tables', function () {
    return view('admin.tables');
});
