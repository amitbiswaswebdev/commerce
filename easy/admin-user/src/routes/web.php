<?php

use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;
use Easy\AdminUser\Http\Controllers\Auth\AuthenticatedSessionController;
use Easy\AdminUser\Http\Controllers\Auth\ConfirmablePasswordController;
use Easy\AdminUser\Http\Controllers\Auth\EmailVerificationNotificationController;
use Easy\AdminUser\Http\Controllers\Auth\EmailVerificationPromptController;
use Easy\AdminUser\Http\Controllers\Auth\NewPasswordController;
use Easy\AdminUser\Http\Controllers\Auth\PasswordResetLinkController;
use Easy\AdminUser\Http\Controllers\Auth\RegisteredUserController;
use Easy\AdminUser\Http\Controllers\Auth\VerifyEmailController;


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
    })->middleware(['auth', 'verified'])->name('dashboard');

    Route::get('/login', [AuthenticatedSessionController::class, 'create'])
                    ->middleware('guest')
                    ->name('login');
    
    Route::post('/login', [AuthenticatedSessionController::class, 'store'])
                    ->middleware('guest');

    Route::get('/register', [RegisteredUserController::class, 'create'])
                    ->middleware('guest')
                    ->name('register');
    
    Route::post('/register', [RegisteredUserController::class, 'store'])
                    ->middleware('guest');

    Route::get('/forgot-password', [PasswordResetLinkController::class, 'create'])
                    ->middleware('guest')
                    ->name('password.request');
    
    Route::post('/forgot-password', [PasswordResetLinkController::class, 'store'])
                    ->middleware('guest')
                    ->name('password.email');
    
    Route::get('/reset-password/{token}', [NewPasswordController::class, 'create'])
                    ->middleware('guest')
                    ->name('password.reset');
    
    Route::post('/reset-password', [NewPasswordController::class, 'store'])
                    ->middleware('guest')
                    ->name('password.update');
    
    Route::get('/verify-email', [EmailVerificationPromptController::class, '__invoke'])
                    ->middleware('auth')
                    ->name('verification.notice');
    
    Route::get('/verify-email/{id}/{hash}', [VerifyEmailController::class, '__invoke'])
                    ->middleware(['auth', 'signed', 'throttle:6,1'])
                    ->name('verification.verify');
    
    Route::post('/email/verification-notification', [EmailVerificationNotificationController::class, 'store'])
                    ->middleware(['auth', 'throttle:6,1'])
                    ->name('verification.send');
    
    Route::get('/confirm-password', [ConfirmablePasswordController::class, 'show'])
                    ->middleware('auth')
                    ->name('password.confirm');
    
    Route::post('/confirm-password', [ConfirmablePasswordController::class, 'store'])
                    ->middleware('auth');
    
    Route::post('/logout', [AuthenticatedSessionController::class, 'destroy'])
                    ->middleware('auth')
                    ->name('logout');
});
