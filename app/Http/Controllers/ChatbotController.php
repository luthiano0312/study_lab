<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Str;

class ChatbotController extends Controller
{
    /**
     * URL do servidor Python Flask.
     * Defina no .env: NIKLOR_AI_URL=http://localhost:5000
     */
    private string $aiUrl;

    public function __construct()
    {
        $this->aiUrl = config('services.niklor_ai.url', 'http://localhost:5000');
    }

    /**
     * Exibe a página do chatbot.
     */
    public function index()
    {
        return view('features.chatbot.index');
    }

    /**
     * Envia uma mensagem para o servidor Python e retorna a resposta.
     * POST /chatbot/send
     */
    public function send(Request $request)
    {
        $request->validate([
            'message' => 'required|string|max:2000',
        ]);

        // Usa a sessão do Laravel para manter o session_id por usuário
        $sessionId = $request->session()->get('ai_session_id', Str::uuid()->toString());
        $request->session()->put('ai_session_id', $sessionId);

        try {
            $response = Http::timeout(30)
                ->post("{$this->aiUrl}/chat", [
                    'message'    => $request->input('message'),
                    'session_id' => $sessionId,
                ]);

            if ($response->successful()) {
                return response()->json([
                    'reply'      => $response->json('reply'),
                    'session_id' => $sessionId,
                ]);
            }

            return response()->json([
                'error' => $response->json('error', 'Erro ao conectar ao servidor de IA.'),
            ], $response->status());

        } catch (\Illuminate\Http\Client\ConnectionException $e) {
            return response()->json([
                'error' => 'Não foi possível conectar ao servidor de IA. Verifique se o servidor Python está rodando.',
            ], 503);
        }
    }

    /**
     * Limpa o histórico da conversa atual.
     * POST /chatbot/clear
     */
    public function clear(Request $request)
    {
        $sessionId = $request->session()->get('ai_session_id');

        if ($sessionId) {
            Http::timeout(10)->delete("{$this->aiUrl}/session/{$sessionId}");
            $request->session()->forget('ai_session_id');
        }

        return response()->json(['message' => 'Conversa reiniciada.']);
    }
}