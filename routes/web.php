<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Mahasiswa\MahasiswaController;
use App\Http\Controllers\Admin\StudentController;
use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\Admin\MajorController;
use App\Http\Controllers\Auth\SocialiteController;
use App\Http\Controllers\Admin\ToeicTestController;
use App\Http\Controllers\Auth\VerificationController;
use App\Http\Controllers\Mahasiswa\RegistrationController;
use App\Http\Controllers\Mahasiswa\EnrollmentController;
use App\Http\Controllers\Admin\StudyProgramController;
use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\RegistrationApprovalController;


// Route untuk halaman login dan register
Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
Route::post('/login', [AuthController::class, 'login']);
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
Route::get('/logout', [AuthController::class, 'logout'])->name('logout');
// Removed GET logout route to avoid ambiguity
Route::get('/register', [AuthController::class, 'registerForm']);
Route::post('/register', [AuthController::class, 'register'])->name('register');

// Verifikasi Email
Route::get('/verify-email', [VerificationController::class, 'show'])->name('verification.notice');
Route::get('/email/verify/{id}/{hash}', [VerificationController::class, 'verify'])->name('verification.verify');
Route::post('/email/resend', [VerificationController::class, 'resend'])->name('verification.resend');

// Dashboard Mahasiswa
Route::get('/', function () {
    return view('welcome');
})->name('home');

// Google Auth
Route::get('/auth/redirect', [SocialiteController::class, 'redirect'])->name('auth.redirect');
Route::get('/auth/google/callback', [SocialiteController::class, 'callback']);

// Dashboard Mahasiswa
Route::middleware(['auth', 'verified', 'role:3'])->group(function () {

    // Dashboard Mahasiswa
    Route::get('/mahasiswa/dashboard', [MahasiswaController::class, 'index'])->name('mahasiswa.dashboard');
    Route::get('/mahasiswa/profile', [MahasiswaController::class, 'profile'])->name('mahasiswa.profile');
    Route::get('/sertifikat', [MahasiswaController::class, 'sertifikat'])->name('mahasiswa.sertifikat');
    Route::resource('mahasiswa', MahasiswaController::class);

    // Fitur Soft Delete
    Route::get('mahasiswa/trashed', [StudentController::class, 'trashed'])->name('mahasiswa.trashed');
    Route::patch('mahasiswa/{id}/restore', [StudentController::class, 'restore'])->name('mahasiswa.restore');
    Route::delete('mahasiswa/{id}/force-delete', [StudentController::class, 'forceDelete'])->name('mahasiswa.force-delete');

    // Registrasi Mahasiswa
    Route::prefix('mahasiswa')->name('mahasiswa.')->group(function () {
        Route::get('/registrasi/create', [RegistrationController::class, 'create'])->name('registrasi.create');
        Route::post('/registrasi', [RegistrationController::class, 'store'])->name('registrasi.store');
    });

    // Pendaftaran Mahasiswa
    Route::prefix('mahasiswa')->group(function () {
        Route::get('/pendaftaran', [EnrollmentController::class, 'create'])->name('pendaftaran.create');
        Route::post('/pendaftaran', [EnrollmentController::class, 'store'])->name('pendaftaran.store');
    });
});

// Grup Admin
Route::middleware(['auth', 'verified', 'role:1'])->prefix('admin')->name('admin.')->group(function () {

    // Dashboard Admin
    Route::get('dashboard', [DashboardController::class, 'index'])->name('dashboard');

    Route::patch('/admin/registration/{id}/reject', [RegistrationApprovalController::class, 'reject'])->name('registration.reject');
    Route::patch('/admin/registration/{id}/approve', [RegistrationApprovalController::class, 'approve'])->name('registration.approve');

    // Admin CRUD Routes
    Route::get('/', [AdminController::class, 'index'])->name('admin.index');
    Route::get('/{id}', [AdminController::class, 'show_ajax'])->name('admin.show');
    Route::get('/{id}/edit', [AdminController::class, 'edit_ajax'])->name('admin.edit');
    Route::post('/', [AdminController::class, 'store_ajax'])->name('admin.store');
    Route::put('/{id}', [AdminController::class, 'update_ajax'])->name('admin.update');
    Route::delete('/{id}', [AdminController::class, 'delete_ajax'])->name('admin.delete');
    Route::get('/trashed', [AdminController::class, 'trashed'])->name('admin.trashed');
    Route::patch('/{id}/restore', [AdminController::class, 'restore'])->name('admin.restore');
    Route::delete('/{id}/force-delete', [AdminController::class, 'forceDelete'])->name('admin.forceDelete');

    // Admin CRUD Routes
    Route::prefix('major')->group(function () {
        Route::get('/', [MajorController::class, 'index']);
        Route::post('/list', [MajorController::class, 'list']);
        Route::post('/ajax', [MajorController::class, 'store_ajax']);
        Route::get('/{id}/delete_ajax', [MajorController::class, 'confirm_ajax']);
        Route::get('/{id}/edit_ajax', [MajorController::class, 'edit_ajax']);
        Route::put('/{id}/update_ajax', [MajorController::class, 'update_ajax']);
        Route::delete('/{id}/delete_ajax', [MajorController::class, 'delete_ajax']);
        Route::get('/create_ajax', [MajorController::class, 'create_ajax']);
        Route::get('/{id}/show_ajax', [MajorController::class, 'show_ajax']);
    });

    Route::prefix('studyProgram')->group(function () {
        Route::get('/', [StudyProgramController::class, 'index']);
        Route::post('/list', [StudyProgramController::class, 'list']);
        Route::post('/ajax', [StudyProgramController::class, 'store_ajax']);
        Route::get('/{id}/delete_ajax', [StudyProgramController::class, 'confirm_ajax']);
        Route::get('/{id}/edit_ajax', [StudyProgramController::class, 'edit_ajax']);
        Route::put('/{id}/update_ajax', [StudyProgramController::class, 'update_ajax']);
        Route::delete('/{id}/delete_ajax', [StudyProgramController::class, 'delete_ajax']);
        Route::get('/create_ajax', [StudyProgramController::class, 'create_ajax']);
        Route::get('/{id}/show_ajax', [StudyProgramController::class, 'show_ajax']);
    });

    Route::prefix('toeicTest')->group(function () {
        Route::get('/', [ToeicTestController::class, 'index']);
        Route::post('/list', [ToeicTestController::class, 'list']);
        Route::post('/ajax', [ToeicTestController::class, 'store_ajax']);
        Route::get('/{id}/delete_ajax', [ToeicTestController::class, 'confirm_ajax']);
        Route::get('/{id}/edit_ajax', [ToeicTestController::class, 'edit_ajax']);
        Route::put('/{id}/update_ajax', [ToeicTestController::class, 'update_ajax']);
        Route::delete('/{id}/delete_ajax', [ToeicTestController::class, 'delete_ajax']);
        Route::get('/create_ajax', [ToeicTestController::class, 'create_ajax']);
        Route::get('/{id}/show_ajax', [ToeicTestController::class, 'show_ajax']);
    });
});
