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
use App\Http\Controllers\ProfileController;

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

    Route::get('/major', [MajorController::class, 'index'])->name('major.index');
    Route::post('/major/store_ajax', [MajorController::class, 'store_ajax'])->name('major.store');
    Route::delete('/major/{id}', [MajorController::class, 'destroy_ajax'])->name('major.delete');
    Route::get('/major/{id}/edit_ajax', [MajorController::class, 'edit'])->name('major.edit');
    Route::put('/major/{id}/update_ajax', [MajorController::class, 'update_ajax'])->name('major.update');
    Route::get('/major/create', [MajorController::class, 'create'])->name('major.create');
    Route::get('/major/{id}/show_ajax', [MajorController::class, 'show'])->name('major.show');


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
    Route::delete('/student/{id}', [StudentController::class, 'destroy'])->name('student.delete');
    Route::get('/student/create', [StudentController::class, 'create'])->name('student.create');
    Route::post('/student', [StudentController::class, 'store'])->name('student.store');
    Route::get('/student/{id}/edit', [StudentController::class, 'edit'])->name('student.edit');
    Route::put('/student/{id}/update', [StudentController::class, 'update'])->name('student.update');
    Route::delete('/student/{id}/delete_ajax', [StudentController::class, 'delete_ajax']);
    Route::get('/student/{id}/show', [StudentController::class, 'show'])->name('student.show');
    Route::get('/student/{id}/scan-ktp', [StudentController::class, 'showKtp'])->name('student.showKtp');
    Route::get('/student/{id}/scan-ktm', [StudentController::class, 'showKtm'])->name('student.showKtm');
    Route::get('/student/{id}/pas-photo', [StudentController::class, 'showPasPhoto'])->name('student.showPasPhoto');

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
    Route::delete('/studyprogram/{id}/', [StudyProgramController::class, 'destroy'])->name('studyprogram.delete');
    Route::get('/studyprogram/create', [StudyProgramController::class, 'create'])->name('studyprogram.create');
    Route::post('/studyprogram/', [StudyProgramController::class, 'store'])->name('studyprogram.store');
    Route::get('/studyprogram/{id}/edit', [StudyProgramController::class, 'edit'])->name('studyprogram.edit');
    Route::put('/studyprogram/{id}/update', [StudyProgramController::class, 'update'])->name('studyprogram.update');
    Route::get('/studyprogram/{id}/show', [StudyProgramController::class, 'show'])->name('studyprogram.show');

    Route::get('/toeic-test', [ToeicTestController::class, 'index'])->name('toeic.index');
    Route::post('/toeic-test/', [ToeicTestController::class, 'store'])->name('toeic.store');
    Route::get('/toeic-test/{id}/edit', [ToeicTestController::class, 'edit'])->name('toeic.edit');
    Route::put('/toeic-test/{id}/', [ToeicTestController::class, 'update'])->name('toeic.update');
    Route::delete('/toeic-test/{id}/delete', [ToeicTestController::class, 'delete'])->name('toeic.destroy');
    Route::get('/toeic-test/create', [ToeicTestController::class, 'create'])->name('toeic.create');
    Route::get('/toeic-test/{id}/show', [ToeicTestController::class, 'show'])->name('toeic.show');

    Route::get('/admin', [AdminController::class, 'index'])->name('admin.index');
    Route::get('/admin/create', [AdminController::class, 'create'])->name('admin.create');
    Route::post('/admin/store', [AdminController::class, 'store'])->name('admin.store');
    Route::get('/admin/{id}/show', [AdminController::class, 'show'])->name('admin.show');
    Route::put('/admin/{id}/update', [AdminController::class, 'update'])->name('admin.update');
    Route::get('/admin/{id}/edit', [AdminController::class, 'edit'])->name('admin.edit');
    Route::delete('/admin/{id}/', [AdminController::class, 'delete_ajax'])->name('admin.delete');

    //registration
    Route::get('/registration', [RegistrationApprovalController::class, 'index'])->name('registration.index');
    Route::patch('/registration/{id}/reject', [RegistrationApprovalController::class, 'reject'])->name('registration.reject');
    Route::patch('/registration/{id}/approve', [RegistrationApprovalController::class, 'approve'])->name('registration.approve');
    Route::get('/registration/{id}/show', [RegistrationApprovalController::class, 'show'])->name('registration.show');
    Route::get('/registration/{id}/edit', [RegistrationApprovalController::class, 'edit'])->name('registration.edit');
    Route::put('/registration/{id}/', [RegistrationApprovalController::class, 'update'])->name('registration.update');
    Route::get('/registration/create', [RegistrationApprovalController::class, 'create'])->name('registration.create');
    Route::post('/registration/store', [RegistrationApprovalController::class, 'store'])->name('registration.store');
    Route::get('/registration/{id}/delete_ajax', [RegistrationApprovalController::class, 'delete'])->name('registration.delete');

});

// Student Role Routes (no prefix)
Route::middleware(['auth', 'verified', 'role:Student'])->group(function () {
    Route::get('/sertifikat', [MahasiswaController::class, 'sertifikat'])->name('sertifikat');
    Route::get('/pendaftaran', [EnrollmentController::class, 'create'])->name('pendaftaran.create');
    Route::post('/pendaftaran', [EnrollmentController::class, 'store'])->name('pendaftaran.store');
    Route::get('/registrasi/create', [RegistrationController::class, 'create'])->name('registrasi.create');
    Route::post('/registrasi', [RegistrationController::class, 'store'])->name('registrasi.store');
});

// Universal Authenticated Routes
Route::middleware(['auth', 'verified'])->group(function () {
    Route::get('/student/{id}/scan-ktp', [StudentController::class, 'showKtp'])->name('student.showKtp');
    Route::get('/student/{id}/scan-ktm', [StudentController::class, 'showKtm'])->name('student.showKtm');
    Route::get('/student/{id}/pas-photo', [StudentController::class, 'showPasPhoto'])->name('student.showPasPhoto');

    Route::get('/set-profile', [VerificationController::class, 'showSetPasswordForm'])->name('password.set');
    Route::post('/set-profile', [VerificationController::class, 'storePassword'])->name('password.store');

    // Gunakan controller yang sama dengan logika berbeda
    Route::get('/dashboard', [DashboardController::class, 'index'])
        ->name('dashboard')
        ->middleware(['auth', 'verified']);

    Route::get('download-ktp/{filename}', [StudentController::class, 'downloadKtp'])->middleware(['auth', 'verified'])->name('download.ktp');

    //gunakan controller profile
    Route::get('/profile', [ProfileController::class, 'index'])->name('profile')->middleware(['auth', 'verified']);
    Route::put('/profile', [ProfileController::class, 'update'])->name('profile.update')->middleware(['auth', 'verified']);

    // Di DashboardController:

});
