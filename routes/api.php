<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\admin\MajorController;
use App\Http\Controllers\admin\ToeicTestController;

Route::middleware('api')->prefix('toeicTest')->group(function () {
    Route::get('/', [ToeicTestController::class, 'index']);
    Route::post('/', [ToeicTestController::class, 'store']);
    Route::get('/{id}', [ToeicTestController::class, 'show']);
    Route::put('/{id}', [ToeicTestController::class, 'update']);
    Route::delete('/{id}', [ToeicTestController::class, 'destroy']);
});

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