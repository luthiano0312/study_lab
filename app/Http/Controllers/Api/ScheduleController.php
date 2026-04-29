<?php

namespace App\Http\Controllers\Api;

use App\Models\Schedule;
use App\Http\Requests\ScheduleRequest;
use App\Http\Controllers\Controller;

class ScheduleController extends Controller
{
    public function index()
    {
        return response()->json([
            'data' => auth()->user()->schedules()->latest()->get(),
        ]);
    }

    public function store(ScheduleRequest $request)
    {
        $schedule = auth()->user()->schedules()->create($request->validated());

        return response()->json([
            'message' => 'Horário criado com sucesso',
            'data'    => $schedule,
        ], 201);
    }

    public function update(ScheduleRequest $request, Schedule $schedule)
    {
        abort_if($schedule->user_id !== auth()->id(), 403, 'Não autorizado.');

        $schedule->update($request->validated());

        return response()->json([
            'message' => 'Horário atualizado com sucesso',
            'data'    => $schedule,
        ]);
    }

    public function destroy(Schedule $schedule)
    {
        abort_if($schedule->user_id !== auth()->id(), 403, 'Não autorizado.');

        $schedule->delete();

        return response()->json([
            'message' => 'Horário excluído com sucesso',
        ]);
    }
}
