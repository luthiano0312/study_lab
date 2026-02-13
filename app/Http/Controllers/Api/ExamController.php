<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Exam;
use Illuminate\Http\Request;

class ExamController extends Controller
{
    public function index()
    {
        return Exam::all();
    }

    public function store(Request $request)
    {
        $exam = Exam::create($request->all());

        return response()->json([
            'message' => 'matéria cadastrada com sucesso',
            'data' => $exam
        ], 201);
    }

    public function update(Request $request, Exam $exam)
    {
        $updated = $exam->update($request->all());

        return response()->json([
            'message' => 'matéria atualizada com sucesso',
            'data' => $updated
        ], 200);
    }

    public function destroy(Exam $exam)
    {
        $exam->delete();

        return response()->json([
            'message' => 'matéria excluída com sucesso',
        ], 200);
    }
}
