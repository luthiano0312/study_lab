<?php

use App\Http\Controllers\Api\ActivityController;
use App\Http\Controllers\Api\GradeController;
use App\Http\Controllers\Api\SubjectController;
use App\Http\Controllers\Api\ExamController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::apiResource("/subjects", SubjectController::class);

Route::apiResource("/activities", ActivityController::class);

Route::apiResource("/grades", GradeController::class);

Route::apiResource("/exams", ExamController::class);