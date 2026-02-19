<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Doctor\DashboardController as DoctorDashboardController;
use App\Http\Controllers\Doctor\AppointmentController as DoctorAppointmentController;
use App\Http\Controllers\Doctor\PrescriptionController as DoctorPrescriptionController;
use App\Http\Controllers\Doctor\EmployeeController as DoctorEmployeeController;
use App\Http\Controllers\Dashboard\AuthController;

Route::prefix('doctor')->name('doctor.')->middleware(['web', 'auth:doctor', \App\Http\Middleware\EnsureDoctorApproved::class])->group(function () {
    Route::get('/', [DoctorDashboardController::class, 'index'])->name('home');
    Route::get('appointments', [DoctorAppointmentController::class, 'index'])->name('appointments.index');
    Route::get('appointments/data', [DoctorAppointmentController::class, 'data'])->name('appointments.data');
    Route::get('appointments/create', [DoctorAppointmentController::class, 'create'])->name('appointments.create');
    Route::post('appointments', [DoctorAppointmentController::class, 'store'])->name('appointments.store');
    Route::get('appointments/{appointment}/edit', [DoctorAppointmentController::class, 'edit'])->name('appointments.edit');
    Route::put('appointments/{appointment}', [DoctorAppointmentController::class, 'update'])->name('appointments.update');
    Route::delete('appointments/{appointment}', [DoctorAppointmentController::class, 'destroy'])->name('appointments.destroy');
    Route::get('prescriptions', [DoctorPrescriptionController::class, 'index'])->name('prescriptions.index');
    Route::get('prescriptions/data', [DoctorPrescriptionController::class, 'data'])->name('prescriptions.data');
    Route::get('prescriptions/create', [DoctorPrescriptionController::class, 'create'])->name('prescriptions.create');
    Route::post('prescriptions', [DoctorPrescriptionController::class, 'store'])->name('prescriptions.store');
    Route::get('prescriptions/{prescription}/pdf', [DoctorPrescriptionController::class, 'pdf'])->name('prescriptions.pdf');
    Route::get('employees', [DoctorEmployeeController::class, 'index'])->name('employees.index');
    Route::get('employees/data', [DoctorEmployeeController::class, 'data'])->name('employees.data');
    Route::get('employees/create', [DoctorEmployeeController::class, 'create'])->name('employees.create');
    Route::post('employees', [DoctorEmployeeController::class, 'store'])->name('employees.store');
    Route::get('employees/{employee}/edit', [DoctorEmployeeController::class, 'edit'])->name('employees.edit');
    Route::put('employees/{employee}', [DoctorEmployeeController::class, 'update'])->name('employees.update');
    Route::delete('employees/{employee}', [DoctorEmployeeController::class, 'destroy'])->name('employees.destroy');
    Route::get('examinations', [\App\Http\Controllers\Doctor\MedicalExaminationController::class, 'index'])->name('examinations.index');
    Route::get('examinations/data', [\App\Http\Controllers\Doctor\MedicalExaminationController::class, 'data'])->name('examinations.data');
    Route::get('examinations/create', [\App\Http\Controllers\Doctor\MedicalExaminationController::class, 'create'])->name('examinations.create');
    Route::post('examinations', [\App\Http\Controllers\Doctor\MedicalExaminationController::class, 'store'])->name('examinations.store');
    Route::get('examinations/{examination}/edit', [\App\Http\Controllers\Doctor\MedicalExaminationController::class, 'edit'])->name('examinations.edit');
    Route::put('examinations/{examination}', [\App\Http\Controllers\Doctor\MedicalExaminationController::class, 'update'])->name('examinations.update');
    Route::delete('examinations/{examination}', [\App\Http\Controllers\Doctor\MedicalExaminationController::class, 'destroy'])->name('examinations.destroy');
    Route::post('examinations/{examination}/upload', [\App\Http\Controllers\Doctor\MedicalExaminationController::class, 'upload'])->name('examinations.upload');
    Route::delete('attachments/{attachment}', [\App\Http\Controllers\Doctor\MedicalExaminationController::class, 'deleteAttachment'])->name('attachments.delete');

    // Patients
    Route::get('patients', [\App\Http\Controllers\Doctor\PatientController::class, 'index'])->name('patients.index');
    Route::get('patients/data', [\App\Http\Controllers\Doctor\PatientController::class, 'data'])->name('patients.data');
    Route::get('patients/{id}', [\App\Http\Controllers\Doctor\PatientController::class, 'show'])->name('patients.show');

    // Notifications
    Route::get('notifications', [\App\Http\Controllers\Dashboard\NotificationController::class, 'index'])->name('notifications.index');
    Route::get('notifications/mark-all-read', [\App\Http\Controllers\Dashboard\NotificationController::class, 'markAllAsRead'])->name('notifications.markAllRead');
    Route::get('notifications/{id}/read', [\App\Http\Controllers\Dashboard\NotificationController::class, 'markAsRead'])->name('notifications.read');
    Route::get('notifications/check', [\App\Http\Controllers\Dashboard\NotificationController::class, 'check'])->name('notifications.check');

    Route::post('logout', [AuthController::class, 'logout'])->name('logout');
});
