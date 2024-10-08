<?php

use App\Http\Controllers\Web\App\DashboardController;
use Illuminate\Support\Facades\Route;

Route::get('/dashboard', [DashboardController::class, 'index'])->middleware(['costum.auth'])->name('web.app.dashboard');