<?php

namespace App\Http\Controllers\Api;

use App\Models\Subject;
use App\Http\Requests\SubjectRequest;
use App\Http\Controllers\Controller;

class SubjectController extends Controller
{
    public function index()
    {
        return auth()->user()->subjects()->get();
    }

    public function store(SubjectRequest $request)
    {
        $subject = auth()->user()->subjects()->create($request->validated());

        return response()->json([
            'message' => 'Matéria cadastrada com sucesso',
            'data' => $subject
        ], 201);
    }

    public function update(SubjectRequest $request, Subject $subject)
    {
        $subject->update($request->validated());

        return response()->json([
            'message' => 'Matéria atualizada com sucesso',
            'data' => $subject
        ], 200);
    }

    public function destroy(Subject $subject)
    {
        $subject->delete();

        return response()->json([
            'message' => 'Matéria excluída com sucesso',
        ], 200);
    }
}