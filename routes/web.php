<?php

use App\Http\Controllers\Auth\SocialiteController;
use Illuminate\Support\Facades\Route;

Route::get('/login', function () {
    return view('auth.login');
})->name('login');
Route::get('/', function () {
    return view('welcome');
<<<<<<< Updated upstream
});

Route::get('/auth/redirect', [SocialiteController::class, 'redirect']);

Route::get('/auth/google/callback', [SocialiteController::class, 'callback']);
=======
})->name('home');
>>>>>>> Stashed changes
