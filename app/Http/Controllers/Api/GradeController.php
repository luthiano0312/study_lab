<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Grade;
use Illuminate\Http\Request;

class GradeController extends Controller
{
    public function index()
    {
        return Grade::all();
    }

    public function store(Request $request)
    {
        $grade = Grade::create($request->all());

        return response()->json([
            'message' => 'matéria cadastrada com sucesso',
            'data' => $grade
        ], 201);
    }

    public function update(Request $request, Grade $grade)
    {
        $updated = $grade->update($request->all());

        return response()->json([
            'message' => 'matéria atualizada com sucesso',
            'data' => $updated
        ], 200);
    }

    public function destroy(Grade $grade)
    {
        $grade->delete();

        return response()->json([
            'message' => 'matéria excluída com sucesso',
        ], 200);
    }
}
