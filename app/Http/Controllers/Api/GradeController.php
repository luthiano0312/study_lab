<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Grade;
use App\Http\Requests\GradeRequest;

class GradeController extends Controller
{
    public function index()
    {
        return auth()->user()->grades()->get();
    }

    public function store(GradeRequest $request)
    {
        $grade = auth()->user()->grades()->create($request->validated());

        return response()->json([
            'message' => 'Nota cadastrada com sucesso',
            'data' => $grade
        ], 201);
    }

    public function update(GradeRequest $request, Grade $grade)
    {
        abort_if($grade->user_id !== auth()->id(), 403, 'Não autorizado.');

        $grade->update($request->validated());

        return response()->json([
            'message' => 'Nota atualizada com sucesso',
            'data' => $grade
        ], 200);
    }

    public function destroy(Grade $grade)
    {
        abort_if($grade->user_id !== auth()->id(), 403, 'Não autorizado.');

        $grade->delete();

        return response()->json([
            'message' => 'Nota excluída com sucesso',
        ], 200);
    }
}
