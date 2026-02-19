<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Patient\DashboardController as PatientDashboardController;
use App\Http\Controllers\Dashboard\AuthController;
use App\Http\Controllers\Dashboard\NotificationController;

Route::prefix('patient')->name('patient.')->group(function () {
    // Guest routes
    Route::get('register', [AuthController::class, 'showPatientRegisterForm'])->name('register');
    Route::post('register', [AuthController::class, 'patientRegister'])->name('register.store');

    // Authenticated routes
    Route::middleware(['auth:web'])->group(function () {
        Route::get('/', [PatientDashboardController::class, 'index'])->name('home');

        // Notifications
        Route::get('notifications', [NotificationController::class, 'index'])->name('notifications.index');
        Route::get('notifications/mark-all-read', [NotificationController::class, 'markAllAsRead'])->name('notifications.markAllRead');
        Route::get('notifications/{id}/read', [NotificationController::class, 'markAsRead'])->name('notifications.read');
        Route::get('notifications/check', [NotificationController::class, 'check'])->name('notifications.check');
    });
});
