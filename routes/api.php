<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\admin\CampusController;
use App\Http\Controllers\admin\MajorController;
use App\Http\Controllers\admin\ToeicTestController;
use App\Http\Controllers\admin\StudyProgramController;

Route::middleware('api')->prefix('toeicTest')->group(function () {
    Route::get('/trashed', [ToeicTestController::class, 'trashed']); 
    Route::put('/restore/{id}', [ToeicTestController::class, 'restore']);
    Route::delete('/force-delete/{id}', [ToeicTestController::class, 'forceDelete']);
    Route::get('/', [ToeicTestController::class, 'index']);
    Route::post('/', [ToeicTestController::class, 'store']);
    Route::get('/{id}', [ToeicTestController::class, 'show']);
    Route::put('/{id}', [ToeicTestController::class, 'update']);
    Route::delete('/{id}', [ToeicTestController::class, 'destroy']);
});

Route::middleware('api')->prefix('major')->group(function () {
    Route::get('/trashed', [MajorController::class, 'trash']); 
    Route::put('/restore/{id}', [MajorController::class, 'restore']);
    Route::delete('/force-delete/{id}', [MajorController::class, 'forceDelete']);
    
    Route::get('/', [MajorController::class, 'index']);
    Route::post('/', [MajorController::class, 'store']);
    Route::get('/{id}', [MajorController::class, 'show']);
    Route::put('/{id}', [MajorController::class, 'update']);
    Route::delete('/{id}', [MajorController::class, 'destroy']);
});

Route::middleware('api')->prefix('studyProgram')->group(function () {
    Route::get('/trashed', [StudyProgramController::class, 'trashed']); 
    Route::put('/restore/{id}', [StudyProgramController::class, 'restore']);
    Route::delete('/force-delete/{id}', [StudyProgramController::class, 'forceDelete']);
    Route::get('/', [StudyProgramController::class, 'index']);
    Route::post('/', [StudyProgramController::class, 'store']);
    Route::get('/{id}', [StudyProgramController::class, 'show']);
    Route::put('/{id}', [StudyProgramController::class, 'update']);
    Route::delete('/{id}', [StudyProgramController::class, 'destroy']);
});
Route::middleware('api')->prefix('campus')->group(function () {
    Route::get('/trashed', [CampusController::class, 'trashed']); 
    Route::put('/restore/{id}', [CampusController::class, 'restore']);
    Route::delete('/force-delete/{id}', [CampusController::class, 'forceDelete']);
    Route::get('/', [CampusController::class, 'index']);
    Route::post('/', [CampusController::class, 'store']);
    Route::get('/{id}', [CampusController::class, 'show']);
    Route::put('/{id}', [CampusController::class, 'update']);
    Route::delete('/{id}', [CampusController::class, 'destroy']);
});