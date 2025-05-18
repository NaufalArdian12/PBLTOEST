<?php
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\MahasiswaController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\Auth\SocialiteController;
use App\Http\Controllers\Auth\VerificationController;

// Route untuk halaman register dan login
Route::get('/register', [AuthController::class, 'registerForm']);
Route::post('/register', [AuthController::class, 'register'])->name('register');

// Login
Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
Route::post('/login', [AuthController::class, 'login']);
Route::post('/logout', [AuthController::class, 'logout'])->name('logout')
// Verifikasi Email
Route::get('/verify-email', [VerificationController::class, 'show'])->name('verification.notice');
Route::get('/email/verify/{id}/{hash}', [VerificationController::class, 'verify'])->name('verification.verify');
Route::post('/email/resend', [VerificationController::class, 'resend'])->name('verification.resend');

// Home
Route::get('/', function () {
    return view('welcome');
})->name('home');

// Google OAuth
Route::get('/auth/redirect', [SocialiteController::class, 'redirect'])->name('auth.redirect');
Route::get('/auth/google/callback', [SocialiteController::class, 'callback']);

Route::get('/dashboard', [MahasiswaController::class, 'dashboard'])->name('mahasiswa.dashboard');
Route::get('/sertifikat', [MahasiswaController::class, 'sertifikat'])->name('mahasiswa.sertifikat');
// Dashboard (protected by auth and verified middleware)
Route::middleware(['auth', 'verified'])->group(function () {
    Route::get('/set-password', [VerificationController::class, 'showSetPasswordForm'])->name('password.set');
    Route::post('/set-password', [VerificationController::class, 'storePassword'])->name('password.store');
    Route::get('/dashboard', function () {
        return view('dashboard');
    });
});


