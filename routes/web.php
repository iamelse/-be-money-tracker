<?php

use App\Http\Controllers\Web\App\DashboardController;
use App\Http\Controllers\Web\Auth\LoginController;
use App\Http\Controllers\Web\Auth\LogoutController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::prefix('auth')->middleware('costum.guest')->group(function () {
    Route::get('/signin', [LoginController::class, 'showLoginForm'])->name('web.signin');
    Route::post('/signin', [LoginController::class, 'doLogin'])->name('web.do.signin');
});

Route::post('/logout', [LogoutController::class, 'logout'])->name('web.logout');

Route::get('/dashboard', [DashboardController::class, 'index'])->middleware(['costum.auth'])->name('web.app.dashboard');