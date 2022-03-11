<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\AuthenticatedSessionController;
use App\Http\Controllers\Auth\ConfirmablePasswordController;
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
