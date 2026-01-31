<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

// لتوافق Laravel مع route('login') - توجيه إلى لوحة التحكم
Route::get('/login', fn () => redirect()->route('dashboard.login'))->name('login');

Route::prefix('dashboard')->name('dashboard.')->group(function () {
    require base_path('routes/dashboard.php');
});
