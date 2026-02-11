<?php

namespace App\Http\Controllers\Api;

use App\Models\Subject;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class SubjectController extends Controller
{
    public function index()
    {
        return Subject::all();
    }

    public function store(Request $request)
    {
        $subject = Subject::create($request->all());

        return response()->json([
            'message' => 'matéria cadastrada com sucesso',
            'data' => $subject
        ], 201);
    }

    public function update(Request $request, Subject $subject)
    {
        $updated = $subject->update($request->all());

        return response()->json([
            'message' => 'matéria atualizada com sucesso',
            'data' => $updated
        ], 200);
    }

    public function destroy(Subject $subject)
    {
        $subject->delete();

        return response()->json([
            'message' => 'matéria excluída com sucesso',
        ], 200);
    }
}
