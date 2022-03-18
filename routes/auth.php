<?php

use App\Http\Controllers\Auth\AuthenticatedSessionController;
use App\Http\Controllers\Auth\ConfirmablePasswordController;
use App\Http\Controllers\Auth\EmailVerificationNotificationController;
use App\Http\Controllers\Auth\EmailVerificationPromptController;
use App\Http\Controllers\Auth\NewPasswordController;
use App\Http\Controllers\Auth\PasswordResetLinkController;
use App\Http\Controllers\Auth\RegisteredUserController;
use App\Http\Controllers\Auth\VerifyEmailController;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\DiscordController;

Route::redirect('/login', 'https://discord.com/oauth2/authorize?client_id=' . config('larascord.client_id')
    . '&redirect_uri=' . config('larascord.redirect_uri')
    . '&response_type=code&scope=' . implode('%20', explode('&', config('larascord.scopes')))
    . '&prompt=' . config('larascord.prompt', 'none'))
    ->name('login');

Route::get('/confirm-password', [ConfirmablePasswordController::class, 'show'])
    ->middleware(['web', 'auth'])
    ->name('password.confirm');

//Route::get('/logout', [AuthenticatedSessionController::class, 'destroy'])->middleware(['auth'])->name('logout');

Route::group(['prefix' => config('larascord.prefix'), 'middleware' => ['web']], function() {
    Route::get('/callback', [DiscordController::class, 'handle'])->name('larascord.login');
    Route::redirect('/refresh-token', '/login')->name('larascord.refresh_token');
});

Route::get('/logout', [AuthenticatedSessionController::class, 'destroy'])->middleware('auth')->name('logout');




//Route::get('/register', [RegisteredUserController::class, 'create'])->middleware('guest');
//Route::post('/register', [RegisteredUserController::class, 'store'])->middleware('guest');

//Route::get('/login', [AuthenticatedSessionController::class, 'create'])->middleware('guest');
//Route::post('/login', [AuthenticatedSessionController::class, 'store'])->middleware('guest');

/*Route::get('/forgot-password', [PasswordResetLinkController::class, 'create'])
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

Route::post('/confirm-password', [ConfirmablePasswordController::class, 'store'])->middleware('auth');*/
