<?php

use App\Http\Controllers\Web\App\DashboardController;
use App\Http\Controllers\Web\App\TransactionController;
use Illuminate\Support\Facades\Route;

Route::get('/dashboard', [DashboardController::class, 'index'])->middleware(['costum.auth'])->name('web.app.dashboard');

Route::get('/transactions', [TransactionController::class, 'index'])->name('web.app.transactions.index');
Route::get('/transactions/create', [TransactionController::class, 'create'])->name('web.app.transactions.create');
Route::post('/transactions', [TransactionController::class, 'store'])->name('web.app.transactions.store');
Route::get('/transactions/{transaction}/edit', [TransactionController::class, 'edit'])->name('web.app.transactions.edit');
Route::put('/transactions/{transaction}', [TransactionController::class, 'update'])->name('web.app.transactions.update');
Route::delete('/transactions/{transaction}', [TransactionController::class, 'destroy'])->name('web.app.transactions.destroy');