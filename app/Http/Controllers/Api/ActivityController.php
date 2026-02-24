<?php

namespace App\Http\Controllers\Api;

use App\Models\Activity;
use App\Http\Requests\ActivityRequest;
use Illuminate\Routing\Controller;

class ActivityController extends Controller
{
    public function index()
    {
        return Activity::all();
    }

    public function store(ActivityRequest $request)
    {
        $activity = Activity::create($request->validated());

        return response()->json([
            'message' => 'Atividade cadastrada com sucesso',
            'data' => $activity
        ], 201);
    }

    public function update(ActivityRequest $request, Activity $activity)
    {
        $activity->update($request->validated());

        return response()->json([
            'message' => 'Atividade atualizada com sucesso',
            'data' => $activity
        ], 200);
    }

    public function destroy(Activity $activity)
    {
        $activity->delete();

        return response()->json([
            'message' => 'Atividade excluída com sucesso',
        ], 200);
    }
}
