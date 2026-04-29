<?php

namespace App\Http\Controllers\Api;

use App\Models\Activity;
use App\Http\Requests\ActivityRequest;
use Illuminate\Routing\Controller;

class ActivityController extends Controller
{
    public function index()
    {
        return auth()->user()->activities()->get();
    }

    public function store(ActivityRequest $request)
    {
        $activity = $request->user()->activities()->create($request->validated());

        return response()->json([
            'message' => 'Atividade cadastrada com sucesso',
            'data' => $activity
        ], 201);
    }

    public function update(ActivityRequest $request, Activity $activity)
    {
        abort_if($activity->user_id !== auth()->id(), 403, 'Não autorizado.');

        $activity->update($request->validated());

        return response()->json([
            'message' => 'Atividade atualizada com sucesso',
            'data' => $activity
        ], 200);
    }

    public function destroy(Activity $activity)
    {
        abort_if($activity->user_id !== auth()->id(), 403, 'Não autorizado.');

        $activity->delete();

        return response()->json([
            'message' => 'Atividade excluída com sucesso',
        ], 200);
    }
}
