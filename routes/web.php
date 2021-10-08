<?php

use App\Http\Controllers\AddFeedbackController;
use App\Http\Controllers\Admin\DashboardController as AdminDashboardController;
use App\Http\Controllers\Admin\ReplyToFeedbackController;
use App\Http\Controllers\DashboardController;
use App\Http\Middleware\VerifyCommonUser;
use App\Http\Middleware\VerifyManager;
use Illuminate\Support\Facades\Route;

/* Common user routes */
Route::middleware([VerifyCommonUser::class])->group(function () {
    Route::get('/', DashboardController::class)->name('home');

    Route::post('/save-feedback', AddFeedbackController::class)->name('save-feedback');
});

/* Manager routes */
Route::middleware([VerifyManager::class])->group(function () {
    Route::get('admin-panel', [AdminDashboardController::class, 'index'])->name('admin-panel');

    Route::post('reply-to-feedback/{feedback}', ReplyToFeedbackController::class)->name('reply-to-feedback');
});
