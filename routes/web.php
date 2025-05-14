<?php

use App\Http\Controllers\Auth\SocialiteController;
use Illuminate\Support\Facades\Route;

Route::get('/login', function () {
    return view('auth.login');
})->name('login');
Route::get('/', function () {
    return view('welcome');
})->name('home');

Route::get('/auth/redirect', [SocialiteController::class, 'redirect'])->name('auth.redirect');

Route::get('/auth/google/callback', [SocialiteController::class, 'callback']);
