<?php

use App\Http\Controllers\Api\ActivityController;
use App\Http\Controllers\Api\ExamController;
use App\Http\Controllers\Api\GradeController;
use App\Http\Controllers\Api\SubjectController;
use App\Http\Controllers\Api\AuthController;
use Illuminate\Support\Facades\Route;

Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);

Route::middleware('auth:sanctum')->group(function () {
    Route::get('/user', [AuthController::class, 'user']);
    Route::post('/logout', [AuthController::class, 'logout']);

    Route::apiResource('subjects', SubjectController::class);
    Route::apiResource('activities', ActivityController::class);
    Route::apiResource('grades', GradeController::class);
    Route::apiResource('exams', ExamController::class);
});
