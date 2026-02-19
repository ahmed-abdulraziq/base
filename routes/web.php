<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\HomeController;
use App\Http\Controllers\ContactController;
use App\Models\Doctor;
use App\Models\Patient;
use App\Models\Specialization;

Route::get('/', [HomeController::class, 'index'])->name('welcome');

Route::post('/contact', [ContactController::class, 'store'])->name('contact.store');

// لتوافق Laravel مع route('login') - توجيه إلى لوحة التحكم
Route::get('/login', fn () => redirect()->route('dashboard.login'))->name('login');

Route::prefix('dashboard')->name('dashboard.')->group(function () {
    require base_path('routes/dashboard.php');
});

require base_path('routes/doctor.php');
require base_path('routes/employee.php');
require base_path('routes/patient.php');
