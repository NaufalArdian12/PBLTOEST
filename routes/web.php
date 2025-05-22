<?php

use Illuminate\Support\Facades\Route;
<<<<<<< Updated upstream
<<<<<<< HEAD
=======
>>>>>>> Stashed changes
use App\Http\Controllers\AuthController;

use App\Http\Controllers\majorController;
use App\Http\Controllers\MahasiswaController;
use App\Http\Controllers\Auth\SocialiteController;
<<<<<<< Updated upstream
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
=======
use App\Http\Controllers\admin\toeicTestController;
use App\Http\Controllers\Auth\VerificationController;
use App\Http\Controllers\admin\studyProgramController;
>>>>>>> Stashed changes

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

<<<<<<< Updated upstream
Route::post('/logout', [SocialiteController::class, 'logout'])->name('logout');
=======
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

Route::prefix('major')->group(function () {
    Route::get('/', [majorController::class, 'index']);
    Route::post('/list', [majorController::class, 'list']);
    Route::post('/ajax', [majorController::class, 'store_ajax']);
    Route::get('/{id}/delete_ajax', [majorController::class, 'confirm_ajax']);
    Route::get('/{id}/edit_ajax', [majorController::class, 'edit_ajax']);
    Route::put('/{id}/update_ajax', [majorController::class, 'update_ajax']);
    Route::delete('/{id}/delete_ajax', [majorController::class, 'delete_ajax']);
    Route::get('/create_ajax', [majorController::class, 'create_ajax']);
    Route::get('/{id}/show_ajax', [majorController::class, 'show_ajax']);
});

Route::prefix('studyProgram')->group(function () {
    Route::get('/', [studyProgramController::class, 'index']);
    Route::post('/list', [studyProgramController::class, 'list']);
    Route::post('/ajax', [studyProgramController::class, 'store_ajax']);
    Route::get('/{id}/delete_ajax', [studyProgramController::class, 'confirm_ajax']);
    Route::get('/{id}/edit_ajax', [studyProgramController::class, 'edit_ajax']);
    Route::put('/{id}/update_ajax', [studyProgramController::class, 'update_ajax']);
    Route::delete('/{id}/delete_ajax', [studyProgramController::class, 'delete_ajax']);
    Route::get('/create_ajax', [studyProgramController::class, 'create_ajax']);
    Route::get('/{id}/show_ajax', [studyProgramController::class, 'show_ajax']);
});

Route::prefix('toeicTest')->group(function () {
    Route::get('/', [toeicTestController::class, 'index']);
    Route::post('/list', [toeicTestController::class, 'list']);
    Route::post('/ajax', [toeicTestController::class, 'store_ajax']);
    Route::get('/{id}/delete_ajax', [toeicTestController::class, 'confirm_ajax']);
    Route::get('/{id}/edit_ajax', [toeicTestController::class, 'edit_ajax']);
    Route::put('/{id}/update_ajax', [toeicTestController::class, 'update_ajax']);
    Route::delete('/{id}/delete_ajax', [toeicTestController::class, 'delete_ajax']);
    Route::get('/create_ajax', [toeicTestController::class, 'create_ajax']);
    Route::get('/{id}/show_ajax', [toeicTestController::class, 'show_ajax']);
});

>>>>>>> Stashed changes
