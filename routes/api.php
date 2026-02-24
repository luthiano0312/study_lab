<?php

use App\Http\Controllers\Api\ActivityController;
use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\ExamController;
use App\Http\Controllers\Api\GradeController;
use App\Http\Controllers\Api\SubjectController;
use App\Http\Controllers\Api\UserController;
use Illuminate\Support\Facades\Route;

Route::prefix('auth')->group(function () {
    Route::post('/register', [AuthController::class, 'register']);
    Route::post('/login', [AuthController::class, 'login']);
});

Route::middleware('auth:sanctum')->group(function () {
    Route::get('/user', [AuthController::class, 'user']);
    Route::put('/profile', [UserController::class, 'update']);
    Route::delete('/profile', [UserController::class, 'delete']);
    Route::post('/logout', [AuthController::class, 'logout']);

    Route::apiResource('subjects', SubjectController::class);
    Route::apiResource('activities', ActivityController::class);
    Route::apiResource('exams', ExamController::class);
    Route::apiResource('grades', GradeController::class);
});
    