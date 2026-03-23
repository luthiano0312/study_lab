<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Exam;
use App\Http\Requests\ExamRequest;

class ExamController extends Controller
{
    public function index()
    {
        return auth()->user()->exams()->get();
    }

    public function store(ExamRequest $request)
    {
        $exam = auth()->user()->exams()->create($request->validated());

        return response()->json([
            'message' => 'Prova cadastrada com sucesso',
            'data'    => $exam
        ], 201);
    }

    public function update(ExamRequest $request, Exam $exam)
    {
        $exam->update($request->validated());

        return response()->json([
            'message' => 'Prova atualizada com sucesso',
            'data'    => $exam
        ], 200);
    }

    public function destroy(Exam $exam)
    {
        $exam->delete();

        return response()->json([
            'message' => 'Prova excluída com sucesso',
        ], 200);
    }
}