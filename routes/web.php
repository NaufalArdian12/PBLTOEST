<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\Auth\VerificationController;
use App\Http\Controllers\Auth\SocialiteController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Mahasiswa\MahasiswaController;
use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\CampusController;
use App\Http\Controllers\Admin\EduStaffController;
use App\Http\Controllers\Admin\MajorController;
use App\Http\Controllers\Admin\RegistrationApprovalController;
use App\Http\Controllers\Admin\StudentController;
use App\Http\Controllers\Admin\StudyProgramController;
use App\Http\Controllers\Admin\ToeicTestController;
use App\Http\Controllers\Mahasiswa\RegistrationController;
use App\Http\Controllers\Mahasiswa\EnrollmentController;

// Public Routes
Route::get('/', fn() => view('welcome'))->name('home');
Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
Route::post('/login', [AuthController::class, 'login']);
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
Route::get('/logout', [AuthController::class, 'logout'])->name('logout');
Route::get('/register', [AuthController::class, 'registerForm']);
Route::post('/register', [AuthController::class, 'register'])->name('register');
Route::get('/verify-email', [VerificationController::class, 'show'])->name('verification.notice');
Route::get('/email/verify/{id}/{hash}', [VerificationController::class, 'verify'])->name('verification.verify');
Route::post('/email/resend', [VerificationController::class, 'resend'])->name('verification.resend');
Route::get('/auth/redirect', [SocialiteController::class, 'redirect'])->name('auth.redirect');
Route::get('/auth/google/callback', [SocialiteController::class, 'callback']);

// Admin Role Routes (no prefix)
Route::middleware(['auth', 'verified', 'role:Admin'])->group(function () {
    Route::get('/profile', [AdminController::class, 'profile'])->name('profile');
    Route::patch('/registration/{id}/reject', [RegistrationApprovalController::class, 'reject'])->name('registration.reject');
    Route::patch('/registration/{id}/approve', [RegistrationApprovalController::class, 'approve'])->name('registration.approve');

    Route::get('/registration', [RegistrationApprovalController::class, 'index'])->name('registration.index');

    Route::get('/major', [MajorController::class, 'index'])->name('major.index');
    Route::post('/major/store_ajax', [MajorController::class, 'store_ajax'])->name('major.store');
    Route::delete('/major/{id}', [MajorController::class, 'destroy_ajax'])->name('major.delete');
    Route::get('/major/{id}/edit_ajax', [MajorController::class, 'edit'])->name('major.edit');
    Route::put('/major/{id}/update_ajax', [MajorController::class, 'update_ajax'])->name('major.update');
    Route::get('/major/create', [MajorController::class, 'create'])->name('major.create');
    Route::get('/major/{id}/show_ajax', [MajorController::class, 'show_ajax']);

    Route::get('/admin', [AdminController::class, 'index'])->name('admin.index');

    Route::get('/campus', [CampusController::class, 'index'])->name('campus.index');
    Route::delete('/campus/{id}/delete_ajax', [CampusController::class, 'confirm_ajax']);
    Route::get('/campus/{id}/edit_ajax', [CampusController::class, 'edit_ajax']);
    Route::put('/campus/{id}', [CampusController::class, 'update_ajax'])->name('campus.update');
    Route::delete('/campus/{id}', [CampusController::class, 'destroy_ajax'])->name('campus.delete');
    Route::get('/campus/create', [CampusController::class, 'create'])->name('campus.create');
    Route::post('/campus/store_ajax', [CampusController::class, 'store_ajax'])->name('campus.store');
    Route::get('/campus/{id}/show', [CampusController::class, 'show'])->name('campus.show');
    Route::get('/campus/{id}/edit', [CampusController::class, 'edit'])->name('campus.edit');

    Route::get('/student', [StudentController::class, 'index'])->name('student.index');
    Route::post('/student/list', [StudentController::class, 'list']);
    Route::post('/student/ajax', [StudentController::class, 'store_ajax']);
    Route::get('/student/{id}/delete_ajax', [StudentController::class, 'confirm_ajax']);
    Route::get('/student/{id}/edit_ajax', [StudentController::class, 'edit_ajax']);
    Route::put('/student/{id}/update_ajax', [StudentController::class, 'update_ajax']);
    Route::delete('/student/{id}/delete_ajax', [StudentController::class, 'delete_ajax']);
    Route::get('/student/create', [StudentController::class, 'create']);
    Route::get('/student/{id}/show_ajax', [StudentController::class, 'show_ajax']);

    Route::get('/educationalstaff', [EduStaffController::class, 'index'])->name('educationalstaff.index');
    Route::post('/educationalstaff/list', [EduStaffController::class, 'list']);
    Route::post('/educationalstaff/ajax', [EduStaffController::class, 'store_ajax']);
    Route::get('/educationalstaff/{id}/delete_ajax', [EduStaffController::class, 'confirm_ajax']);
    Route::get('/educationalstaff/{id}/edit_ajax', [EduStaffController::class, 'edit_ajax']);
    Route::put('/educationalstaff/{id}/update_ajax', [EduStaffController::class, 'update_ajax']);
    Route::delete('/educationalstaff/{id}/delete_ajax', [EduStaffController::class, 'delete_ajax']);
    Route::get('/educationalstaff/create', [EduStaffController::class, 'create']);
    Route::get('/educationalstaff/{id}/show_ajax', [EduStaffController::class, 'show_ajax']);

    Route::get('/studyprogram', [StudyProgramController::class, 'index'])->name('studyprogram.index');
    Route::post('/studyprogram/list', [StudyProgramController::class, 'list']);
    Route::post('/studyprogram/ajax', [StudyProgramController::class, 'store_ajax']);
    Route::get('/studyprogram/{id}/delete_ajax', [StudyProgramController::class, 'confirm_ajax']);
    Route::get('/studyprogram/{id}/edit_ajax', [StudyProgramController::class, 'edit_ajax']);
    Route::put('/studyprogram/{id}/update_ajax', [StudyProgramController::class, 'update_ajax']);
    Route::delete('/studyprogram/{id}/delete_ajax', [StudyProgramController::class, 'delete_ajax']);
    Route::get('/studyprogram/create', [StudyProgramController::class, 'create']);
    Route::get('/studyprogram/{id}/show_ajax', [StudyProgramController::class, 'show_ajax']);

    Route::get('/toeic-test', [ToeicTestController::class, 'index'])->name('toeic.index');
    Route::post('/toeic-test/list', [ToeicTestController::class, 'list']);
    Route::post('/toeic-test/ajax', [ToeicTestController::class, 'store_ajax']);
    Route::get('/toeic-test/{id}/delete_ajax', [ToeicTestController::class, 'confirm_ajax']);
    Route::get('/toeic-test/{id}/edit_ajax', [ToeicTestController::class, 'edit_ajax']);
    Route::put('/toeic-test/{id}/update_ajax', [ToeicTestController::class, 'update_ajax']);
    Route::delete('/toeic-test/{id}/delete_ajax', [ToeicTestController::class, 'delete_ajax']);
    Route::get('/toeic-test/create', [ToeicTestController::class, 'create']);
    Route::get('/toeic-test/{id}/show_ajax', [ToeicTestController::class, 'show_ajax']);

});

// Student Role Routes (no prefix)
Route::middleware(['auth', 'verified', 'role:Student'])->group(function () {
    Route::get('/profile', [MahasiswaController::class, 'profile'])->name('profile');
    Route::get('/sertifikat', [MahasiswaController::class, 'sertifikat'])->name('sertifikat');
    Route::get('/pendaftaran', [EnrollmentController::class, 'create'])->name('pendaftaran.create');
    Route::post('/pendaftaran', [EnrollmentController::class, 'store'])->name('pendaftaran.store');
    Route::get('/registrasi/create', [RegistrationController::class, 'create'])->name('registrasi.create');
    Route::post('/registrasi', [RegistrationController::class, 'store'])->name('registrasi.store');
});

// Universal Authenticated Routes
Route::middleware(['auth', 'verified'])->group(function () {
    Route::get('/set-password', [VerificationController::class, 'showSetPasswordForm'])->name('password.set');
    Route::post('/set-password', [VerificationController::class, 'storePassword'])->name('password.store');

    // Gunakan controller yang sama dengan logika berbeda
Route::get('/dashboard', [DashboardController::class, 'index'])
    ->name('dashboard')
    ->middleware(['auth', 'verified']);

// Di DashboardController:

});
