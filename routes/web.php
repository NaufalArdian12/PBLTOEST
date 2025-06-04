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
use App\Http\Controllers\Admin\CampusController;


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

// Dashboard (protected by auth and verified middleware)
Route::middleware(['auth', 'verified'])->group(function () {
    Route::get('/set-password', [VerificationController::class, 'showSetPasswordForm'])->name('password.set');
    Route::post('/set-password', [VerificationController::class, 'storePassword'])->name('password.store');
    Route::get('/dashboard', function () {
        return view('dashboard');
    });
});

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

    // Registration Approval
    Route::patch('/registration/{id}/reject', [RegistrationApprovalController::class, 'reject'])->name('registration.reject');
    Route::patch('/registration/{id}/approve', [RegistrationApprovalController::class, 'approve'])->name('registration.approve');

    // Admin CRUD Routes
    Route::resource('admin', AdminController::class);

    // Major Routes
    Route::prefix('major')->name('major.')->group(function () {
        Route::get('/', [MajorController::class, 'index'])->name('index');
        Route::post('/ajax', [MajorController::class, 'store_ajax']);
        Route::get('/{id}/delete_ajax', [MajorController::class, 'confirm_ajax']);
        Route::get('/{id}/edit_ajax', [MajorController::class, 'edit_ajax']);
        Route::put('/{id}/update_ajax', [MajorController::class, 'update_ajax']);
        Route::delete('/{id}/delete_ajax', [MajorController::class, 'delete_ajax']);
        Route::get('/create_ajax', [MajorController::class, 'create_ajax']);
        Route::get('/{id}/show_ajax', [MajorController::class, 'show_ajax']);
    });

    // Campus Routes
    Route::prefix('campus')->name('campus.')->group(function () {
        Route::get('/', [CampusController::class, 'index'])->name('index');
        Route::post('/ajax', [CampusController::class, 'store_ajax']);
        Route::get('/{id}/delete_ajax', [CampusController::class, 'confirm_ajax']);
        Route::get('/{id}/edit_ajax', [CampusController::class, 'edit_ajax']);
        Route::put('/{id}/update_ajax', [CampusController::class, 'update_ajax']);
        Route::delete('/{id}/delete_ajax', [CampusController::class, 'delete_ajax']);
        Route::get('/create_ajax', [CampusController::class, 'create_ajax']);
        Route::get('/{id}/show_ajax', [CampusController::class, 'show_ajax']);
    });
    // mahasiswa Routes
    Route::prefix('student')->name('student.')->group(function () {
        Route::get('/', [StudentController::class, 'index'])->name('index');
        Route::post('/list', [StudentController::class, 'list']);
        Route::post('/ajax', [StudentController::class, 'store_ajax']);
        Route::get('/{id}/delete_ajax', [StudentController::class, 'confirm_ajax']);
        Route::get('/{id}/edit_ajax', [StudentController::class, 'edit_ajax']);
        Route::put('/{id}/update_ajax', [StudentController::class, 'update_ajax']);
        Route::delete('/{id}/delete_ajax', [StudentController::class, 'delete_ajax']);
        Route::get('/create_ajax', [StudentController::class, 'create_ajax']);
        Route::get('/{id}/show_ajax', [StudentController::class, 'show_ajax']);
    });

    // Study Program Routes
    Route::prefix('studyprogram')->name('studyprogram.')->group(function () {
        Route::get('/', [StudyProgramController::class, 'index'])->name('index');
        Route::post('/list', [StudyProgramController::class, 'list']);
        Route::post('/ajax', [StudyProgramController::class, 'store_ajax']);
        Route::get('/{id}/delete_ajax', [StudyProgramController::class, 'confirm_ajax']);
        Route::get('/{id}/edit_ajax', [StudyProgramController::class, 'edit_ajax']);
        Route::put('/{id}/update_ajax', [StudyProgramController::class, 'update_ajax']);
        Route::delete('/{id}/delete_ajax', [StudyProgramController::class, 'delete_ajax']);
        Route::get('/create_ajax', [StudyProgramController::class, 'create_ajax']);
        Route::get('/{id}/show_ajax', [StudyProgramController::class, 'show_ajax']);
    });

    // Toeic Test Routes
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
