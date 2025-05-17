<?php

use Illuminate\Support\Facades\Route;
<<<<<<< HEAD
use App\Http\Controllers\AuthController;
use App\Http\Controllers\Auth\SocialiteController;
use Illuminate\Foundation\Auth\EmailVerificationRequest;
=======
<<<<<<< Updated upstream
use Illuminate\Support\Facades\Auth;
use Illuminate\Foundation\Auth\EmailVerificationRequest;
use Illuminate\Http\Request;
=======
use App\Http\Controllers\AuthController;
use App\Http\Controllers\Auth\SocialiteController;
use Illuminate\Foundation\Auth\EmailVerificationRequest;
>>>>>>> Stashed changes
>>>>>>> cdd0f97b7d6443ae8689f3f379c3fc6b900d5894

Route::get('/login', function () {
    return view('auth.login');
})->name('login');

<<<<<<< HEAD
=======
<<<<<<< Updated upstream
=======
>>>>>>> cdd0f97b7d6443ae8689f3f379c3fc6b900d5894
Route::get('/register', [AuthController::class, 'registerForm']);

Route::post('/register', [AuthController::class, 'register'])->name('register');

Route::get('/email/verify', function () {
    return view('auth.verify-email');
})->middleware('auth')->name('verification.notice');

Route::get('/email/verify/{id}/{hash}', function (EmailVerificationRequest $req) {
    $req->fulfill();
    return redirect('/dashboard');
})->middleware(['auth', 'signed'])->name('verification.verify');

<<<<<<< HEAD
=======
>>>>>>> Stashed changes
>>>>>>> cdd0f97b7d6443ae8689f3f379c3fc6b900d5894
Route::get('/', function () {
    return view('welcome');
})->name('home');

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth','verified'])->name('dashboard');

Route::get('/auth/redirect', [SocialiteController::class, 'redirect'])->name('auth.redirect');

Route::get('/auth/google/callback', [SocialiteController::class, 'callback']);

Route::post('/logout', [SocialiteController::class, 'logout'])->name('logout');