<?php

namespace App\Http\Controllers\Api;

use App\Models\Activity;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;

class ActivityController extends Controller
{
    public function index()
    {
        return Activity::all();
    }

    public function store(Request $request)
    {
        $activity = Activity::create($request->all());

        return response()->json([
            'message' => 'matéria cadastrada com sucesso',
            'data' => $activity
        ], 201);
    }

    public function update(Request $request, Activity $activity)
    {
        $updated = $activity->update($request->all());

        return response()->json([
            'message' => 'matéria atualizada com sucesso',
            'data' => $updated
        ], 200);
    }

    public function destroy(Activity $activity)
    {
        $activity->delete();

        return response()->json([
            'message' => 'matéria excluída com sucesso',
        ], 200);
    }
}
