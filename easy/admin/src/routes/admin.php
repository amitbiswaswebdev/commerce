<?php

use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;
use Easy\Admin\Http\Controllers\Auth\AuthenticatedSessionController;
use Easy\Admin\Http\Controllers\Auth\ConfirmablePasswordController;
use Easy\Admin\Http\Controllers\Auth\EmailVerificationNotificationController;
use Easy\Admin\Http\Controllers\Auth\EmailVerificationPromptController;
use Easy\Admin\Http\Controllers\Auth\NewPasswordController;
use Easy\Admin\Http\Controllers\Auth\PasswordResetLinkController;
use Easy\Admin\Http\Controllers\Auth\RegisteredUserController;
use Easy\Admin\Http\Controllers\Auth\VerifyEmailController;

Route::prefix('admin')->name('admin.')->middleware(['web'])->group( function () {
    Route::get('/welcome', function () {
        return Inertia::render('Welcome', [
            'canLogin' => Route::has('admin.login'),
            'canRegister' => Route::has('admin.register'),
            'laravelVersion' => Application::VERSION,
            'phpVersion' => PHP_VERSION,
        ]);
    });
    
    Route::get('/dashboard', function () {
        return Inertia::render('Dashboard');
    })->middleware(['auth:admin', 'verified'])->name('dashboard');

    Route::get('/login', [AuthenticatedSessionController::class, 'create'])
                    ->middleware('guest:admin')
                    ->name('login');
    
    Route::post('/login', [AuthenticatedSessionController::class, 'store'])
                    ->middleware('guest:admin');

    Route::get('/register', [RegisteredUserController::class, 'create'])
                    ->middleware('guest:admin')
                    ->name('register');
    
    Route::post('/register', [RegisteredUserController::class, 'store'])
                    ->middleware('guest:admin');

    Route::get('/forgot-password', [PasswordResetLinkController::class, 'create'])
                    ->middleware('guest:admin')
                    ->name('password.request');
    
    Route::post('/forgot-password', [PasswordResetLinkController::class, 'store'])
                    ->middleware('guest:admin')
                    ->name('password.email');
    
    Route::get('/reset-password/{token}', [NewPasswordController::class, 'create'])
                    ->middleware('guest:admin')
                    ->name('password.reset');
    
    Route::post('/reset-password', [NewPasswordController::class, 'store'])
                    ->middleware('guest:admin')
                    ->name('password.update');
    
    Route::get('/verify-email', [EmailVerificationPromptController::class, '__invoke'])
                    ->middleware('auth:admin')
                    ->name('verification.notice');
    
    Route::get('/verify-email/{id}/{hash}', [VerifyEmailController::class, '__invoke'])
                    ->middleware(['auth:admin', 'signed', 'throttle:6,1'])
                    ->name('verification.verify');
    
    Route::post('/email/verification-notification', [EmailVerificationNotificationController::class, 'store'])
                    ->middleware(['auth:admin', 'throttle:6,1'])
                    ->name('verification.send');
    
    Route::get('/confirm-password', [ConfirmablePasswordController::class, 'show'])
                    ->middleware('auth:admin')
                    ->name('password.confirm');
    
    Route::post('/confirm-password', [ConfirmablePasswordController::class, 'store'])
                    ->middleware('auth:admin');
    
    Route::post('/logout', [AuthenticatedSessionController::class, 'destroy'])
                    ->middleware('auth:admin')
                    ->name('logout');
});
