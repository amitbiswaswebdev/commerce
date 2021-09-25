<?php

use Illuminate\Support\Facades\Route;
use Easy\Customer\Http\Controllers\Auth\AuthenticatedSessionController;
use Easy\Customer\Http\Controllers\Auth\ConfirmablePasswordController;
use Easy\Customer\Http\Controllers\Auth\EmailVerificationNotificationController;
use Easy\Customer\Http\Controllers\Auth\EmailVerificationPromptController;
use Easy\Customer\Http\Controllers\Auth\NewPasswordController;
use Easy\Customer\Http\Controllers\Auth\PasswordResetLinkController;
use Easy\Customer\Http\Controllers\Auth\RegisteredUserController;
use Easy\Customer\Http\Controllers\Auth\VerifyEmailController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
Route::middleware(['web'])->group( function () {
    Route::get('/home', function () {
        return view('dashboard');
    })->middleware(['auth'])->name('dashboard');
    
    
    Route::get('/register', [RegisteredUserController::class, 'create'])
                    ->middleware('guest')
                    ->name('register');
    
    Route::post('/register', [RegisteredUserController::class, 'store'])
                    ->middleware('guest');
    
    Route::get('/login', [AuthenticatedSessionController::class, 'create'])
                    ->middleware('guest')
                    ->name('login');
    
    Route::post('/login', [AuthenticatedSessionController::class, 'store'])
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

