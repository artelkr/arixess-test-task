<?php

use App\Http\Controllers\Admin\DashboardController as AdminDashboardController;
use App\Http\Controllers\DashboardController;
use App\Http\Middleware\VerifyManager;
use Illuminate\Support\Facades\Route;

/* Common user routes */
Route::get('/', DashboardController::class)->name('home');

/* Manager routes */
Route::middleware([VerifyManager::class])->group(function () {
    Route::get('admin-panel', [AdminDashboardController::class, 'index'])->name('admin-panel');
});
