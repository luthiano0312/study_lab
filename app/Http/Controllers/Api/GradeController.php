<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Grade;
use App\Http\Requests\GradeRequest;

class GradeController extends Controller
{
    public function index()
    {
        return Grade::all();
    }

    public function store(GradeRequest $request)
    {
        $grade = Grade::create($request->validated());

        return response()->json([
            'message' => 'Nota cadastrada com sucesso',
            'data' => $grade
        ], 201);
    }

    public function update(GradeRequest $request, Grade $grade)
    {
        $grade->update($request->validated());

        return response()->json([
            'message' => 'Nota atualizada com sucesso',
            'data' => $grade
        ], 200);
    }

    public function destroy(Grade $grade)
    {
        $grade->delete();

        return response()->json([
            'message' => 'Nota excluída com sucesso',
        ], 200);
    }
}
