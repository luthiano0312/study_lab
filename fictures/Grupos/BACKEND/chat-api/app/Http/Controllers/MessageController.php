<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Message;

class MessageController extends Controller
{
    public function store(Request $request)
    {
        $path = null;

        if ($request->hasFile('file')) {
            $path = $request->file('file')->store('uploads', 'public');
        }

        $message = Message::create([
            'user' => $request->user ?? 'Anonimo',
            'text' => $request->text ?? '',
            'file' => $path
        ]);

        return response()->json($message);
    }
}
