<?php

namespace App\Http\Controllers\Api;

use App\Models\Content;
use App\Http\Requests\ContentRequest;
use App\Http\Controllers\Controller;

class ContentController extends Controller
{
    public function index()
    {
        return auth()->user()->contents()->get();
    }

    public function store(ContentRequest $request)
    {
        $content = auth()->user()->contents()->create($request->validated());

        return response()->json([
            'message' => 'Conteúdo cadastrado com sucesso',
            'data' => $content
        ], 201);
    }

    public function update(ContentRequest $request, Content $content)
    {
        $content->update($request->validated());

        return response()->json([
            'message' => 'Conteúdo atualizado com sucesso',
            'data' => $content
        ], 200);
    }

    public function destroy(Content $content)
    {
        $content->delete();

        return response()->json([
            'message' => 'Conteúdo excluído com sucesso',
        ], 200);
    }
}
