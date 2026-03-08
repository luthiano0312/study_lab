<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Exam;
use App\Http\Requests\ExamRequest;
use Illuminate\Http\Request;

class ExamController extends Controller
{
    public function index()
    {
        return Exam::where('user_id', auth()->id())->get();
    }

    public function store(ExamRequest $request)
    {
        $exam = Exam::create([
            ...$request->validated(),
            'user_id' => auth()->id(),
        ]);

        return response()->json([
            'message' => 'Prova cadastrada com sucesso',
            'data'    => $exam
        ], 201);
    }

    public function update(ExamRequest $request, Exam $exam)
    {
        $this->authorizeExam($exam);

        $exam->update($request->validated());

        return response()->json([
            'message' => 'Prova atualizada com sucesso',
            'data'    => $exam
        ], 200);
    }

    public function destroy(Exam $exam)
    {
        $this->authorizeExam($exam);

        $exam->delete();

        return response()->json([
            'message' => 'Prova excluída com sucesso',
        ], 200);
    }

    private function authorizeExam(Exam $exam)
    {
        if ($exam->user_id !== auth()->id()) {
            abort(403, 'Ação não autorizada.');
        }
    }
}