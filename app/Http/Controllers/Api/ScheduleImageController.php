<?php

namespace App\Http\Controllers\Api;

use App\Models\ScheduleImage;
use App\Http\Requests\ScheduleImageRequest;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;

class ScheduleImageController extends Controller
{
    public function index()
    {
        $schedules = auth()->user()->scheduleImages()->latest()->get();

        return response()->json([
            'data' => $schedules->map(fn ($s) => [
                'id'         => $s->id,
                'title'      => $s->title,
                'image_url'  => $s->image_url,
                'created_at' => $s->created_at,
                'updated_at' => $s->updated_at,
            ]),
        ]);
    }

    public function store(ScheduleImageRequest $request)
    {
        $path = $request->file('image')->store(
            'schedules/' . auth()->id(),
            'supabase'
        );

        $schedule = auth()->user()->scheduleImages()->create([
            'title'      => $request->title,
            'image_path' => $path,
        ]);

        return response()->json([
            'message' => 'Horário enviado com sucesso',
            'data'    => [
                'id'         => $schedule->id,
                'title'      => $schedule->title,
                'image_url'  => $schedule->image_url,
                'created_at' => $schedule->created_at,
            ],
        ], 201);
    }

    public function update(ScheduleImageRequest $request, ScheduleImage $scheduleImage)
    {
        $data = [];

        if ($request->has('title')) {
            $data['title'] = $request->title;
        }

        if ($request->hasFile('image')) {
            // Remove a imagem antiga do Supabase
            if ($scheduleImage->image_path) {
                Storage::disk('supabase')->delete($scheduleImage->image_path);
            }

            $path = $request->file('image')->store(
                'schedules/' . auth()->id(),
                'supabase'
            );
            $data['image_path'] = $path;
        }

        $scheduleImage->update($data);
        $scheduleImage->refresh();

        return response()->json([
            'message' => 'Horário atualizado com sucesso',
            'data'    => [
                'id'         => $scheduleImage->id,
                'title'      => $scheduleImage->title,
                'image_url'  => $scheduleImage->image_url,
                'updated_at' => $scheduleImage->updated_at,
            ],
        ]);
    }

    public function destroy(ScheduleImage $scheduleImage)
    {
        // Remove a imagem do Supabase
        if ($scheduleImage->image_path) {
            Storage::disk('supabase')->delete($scheduleImage->image_path);
        }

        $scheduleImage->delete();

        return response()->json([
            'message' => 'Horário excluído com sucesso',
        ]);
    }
}
