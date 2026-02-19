<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Employee\DashboardController as EmployeeDashboardController;
use App\Http\Controllers\Dashboard\AuthController;
use App\Http\Controllers\Dashboard\NotificationController;

Route::prefix('employee')->name('employee.')->middleware(['web', 'auth:employee'])->group(function () {
    Route::get('/', [EmployeeDashboardController::class, 'index'])->name('home');

    // Notifications
    Route::get('notifications', [NotificationController::class, 'index'])->name('notifications.index');
    Route::get('notifications/mark-all-read', [NotificationController::class, 'markAllAsRead'])->name('notifications.markAllRead');
    Route::get('notifications/{id}/read', [NotificationController::class, 'markAsRead'])->name('notifications.read');
    Route::get('notifications/check', [NotificationController::class, 'check'])->name('notifications.check');

    Route::post('logout', [AuthController::class, 'logout'])->name('logout');
});
