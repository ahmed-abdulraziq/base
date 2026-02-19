<?php

/**
 * Dashboard routes: مشترك بين الأدمن والطبيب وأي أدوار أخرى (الدخول، الصفحة الرئيسية، الإشعارات، العيادة).
 * Admin controllers: إدارة الأدمن، الإعدادات، الصلاحيات، الأدوار، المستخدمين.
 */

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Dashboard\AuthController;
use App\Http\Controllers\Dashboard\DashboardController;
use App\Http\Controllers\Dashboard\NotificationController;
use App\Http\Controllers\Dashboard\AdminContactController;
use App\Http\Controllers\Dashboard\SpecializationController;
use App\Http\Controllers\Dashboard\DoctorController;
use App\Http\Controllers\Dashboard\EmployeeController;
use App\Http\Controllers\Dashboard\PatientController;
use App\Http\Controllers\Dashboard\MedicationController;
use App\Http\Controllers\Dashboard\AppointmentController;
use App\Http\Controllers\Dashboard\PrescriptionController;
use App\Http\Controllers\Dashboard\MedicalExaminationController;
use App\Http\Controllers\Admin\SettingsController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\RoleController;
use App\Http\Controllers\Admin\PermissionController;
use App\Http\Controllers\Admin\PrescriptionOptionSettingController;

// Guest routes (لا أدمن ولا طبيب معتمد مسجّل)
Route::middleware('guest.dashboard')->group(function () {
    Route::get('login', [AuthController::class, 'showLoginForm'])->name('login');
    Route::post('login', [AuthController::class, 'login']);
    Route::get('register', [AuthController::class, 'showRegisterForm'])->name('register');
    Route::post('register', [AuthController::class, 'register']);
    Route::get('google', [AuthController::class, 'redirectToGoogle'])->name('login.google');
    Route::get('google/callback', [AuthController::class, 'handleGoogleCallback']);
});

// Authenticated routes (admin أو طبيب معتمد)
Route::middleware('dashboard')->group(function () {
    Route::get('/', [DashboardController::class, 'index'])->name('home');
    Route::post('logout', [AuthController::class, 'logout'])->name('logout');

    // Notifications (مشترك)
    Route::get('notifications', [NotificationController::class, 'index'])->name('notifications.index');
    Route::get('notifications/mark-all-read', [NotificationController::class, 'markAllAsRead'])->name('notifications.markAllRead');
    Route::get('notifications/{id}/read', [NotificationController::class, 'markAsRead'])->name('notifications.read');
    Route::get('notifications/check', [NotificationController::class, 'check'])->name('notifications.check');

    // Contact Messages
    Route::prefix('contact-messages')->name('contact_messages.')->group(function () {
        Route::get('/', [AdminContactController::class, 'index'])->name('index');
        Route::get('{contactMessage}', [AdminContactController::class, 'show'])->name('show');
        Route::delete('{contactMessage}', [AdminContactController::class, 'destroy'])->name('destroy');
        Route::patch('{contactMessage}/mark-as-read', [AdminContactController::class, 'markAsRead'])->name('markAsRead');
    });

    Route::prefix('settings')->name('settings.')->group(function () {
        Route::get('/', [SettingsController::class, 'index'])->name('index');
        Route::get('profile', [SettingsController::class, 'profile'])->name('profile');
        Route::put('profile', [SettingsController::class, 'updateProfile'])->name('profile.update');

        Route::get('roles/data', [RoleController::class, 'data'])->name('roles.data');
        Route::resource('roles', RoleController::class)->except(['show']);

        Route::get('permissions/data', [PermissionController::class, 'data'])->name('permissions.data');
        Route::resource('permissions', PermissionController::class)->except(['show']);

        Route::get('prescription-options', [PrescriptionOptionSettingController::class, 'index'])->name('prescription-options.index');
        Route::post('prescription-options', [PrescriptionOptionSettingController::class, 'store'])->name('prescription-options.store');
        Route::delete('prescription-options/{prescriptionOptionSetting}', [PrescriptionOptionSettingController::class, 'destroy'])->name('prescription-options.destroy');
    });

    // Users (المستخدمون)
    Route::get('users/data', [UserController::class, 'data'])->name('users.data');
    Route::resource('users', UserController::class)->except(['show']);

    // Admins (المدراء)
    Route::get('admins/data', [AdminController::class, 'data'])->name('admins.data');
    Route::resource('admins', AdminController::class)->except(['show']);

    // Clinic (العيادة)
    Route::prefix('clinic')->name('clinic.')->group(function () {
        Route::get('specializations/data', [SpecializationController::class, 'data'])->name('specializations.data');
        Route::resource('specializations', SpecializationController::class)->except(['show']);

        Route::get('doctors/data', [DoctorController::class, 'data'])->name('doctors.data');
        Route::post('doctors/{doctor}/approve', [DoctorController::class, 'approve'])->name('doctors.approve');
        Route::resource('doctors', DoctorController::class)->except(['show']);

        Route::get('employees/data', [EmployeeController::class, 'data'])->name('employees.data');
        Route::post('employees/{employee}/approve', [EmployeeController::class, 'approve'])->name('employees.approve');
        Route::resource('employees', EmployeeController::class)->except(['show']);

        Route::get('patients/data', [PatientController::class, 'data'])->name('patients.data');
        Route::resource('patients', PatientController::class);

        Route::get('medications/data', [MedicationController::class, 'data'])->name('medications.data');
        Route::resource('medications', MedicationController::class)->except(['show']);

        Route::get('appointments/data', [AppointmentController::class, 'data'])->name('appointments.data');
        Route::resource('appointments', AppointmentController::class)->except(['show']);

        Route::get('prescriptions/data', [PrescriptionController::class, 'data'])->name('prescriptions.data');
        Route::get('prescriptions/{prescription}/pdf', [PrescriptionController::class, 'pdf'])->name('prescriptions.pdf');
        Route::resource('prescriptions', PrescriptionController::class)->except(['show']);

        Route::get('examinations/data', [MedicalExaminationController::class, 'data'])->name('examinations.data');
        Route::resource('examinations', MedicalExaminationController::class)->except(['show']);
    });
});
