<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Dashboard\AuthController;
use App\Http\Controllers\Dashboard\DashboardController;
use App\Http\Controllers\Dashboard\SettingsController;
use App\Http\Controllers\Dashboard\UserController;
use App\Http\Controllers\Dashboard\AdminController;
use App\Http\Controllers\Dashboard\RoleController;
use App\Http\Controllers\Dashboard\PermissionController;

// Guest routes (no auth required)
Route::middleware('guest:admin')->group(function () {
    Route::get('login', [AuthController::class, 'showLoginForm'])->name('login');
    Route::post('login', [AuthController::class, 'login']);
    Route::get('register', [AuthController::class, 'showRegisterForm'])->name('register');
    Route::post('register', [AuthController::class, 'register']);
    Route::get('google', [AuthController::class, 'redirectToGoogle'])->name('login.google');
    Route::get('google/callback', [AuthController::class, 'handleGoogleCallback']);
});

// Authenticated routes
Route::middleware('auth:admin')->group(function () {
    Route::get('/', [DashboardController::class, 'index'])->name('home');
    Route::post('logout', [AuthController::class, 'logout'])->name('logout');

    Route::prefix('settings')->name('settings.')->group(function () {
        Route::get('/', [SettingsController::class, 'index'])->name('index');
        Route::get('profile', [SettingsController::class, 'profile'])->name('profile');
        Route::put('profile', [SettingsController::class, 'updateProfile'])->name('profile.update');

        Route::get('roles/data', [RoleController::class, 'data'])->name('roles.data');
        Route::resource('roles', RoleController::class)->except(['show']);

        Route::get('permissions/data', [PermissionController::class, 'data'])->name('permissions.data');
        Route::resource('permissions', PermissionController::class)->except(['show']);
    });

    // Users (المستخدمون)
    Route::get('users/data', [UserController::class, 'data'])->name('users.data');
    Route::resource('users', UserController::class)->except(['show']);

    // Admins (المدراء)
    Route::get('admins/data', [AdminController::class, 'data'])->name('admins.data');
    Route::resource('admins', AdminController::class)->except(['show']);
});
