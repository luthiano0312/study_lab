from flask import Flask, request, jsonify
from flask_cors import CORS
import requests

app = Flask(__name__)
CORS(app)

OLLAMA_URL = "http://localhost:11434/api/chat"
MODEL      = "qwen2.5:0.5b"

sessions: dict = {}

@app.route('/health', methods=['GET'])
def health():
    return jsonify({"status": "ok", "service": "Niklor AI (Ollama)"})

@app.route('/chat', methods=['POST'])
def chat():
    data = request.get_json(silent=True)
    if not data or not data.get('message', '').strip():
        return jsonify({"error": "Campo 'message' é obrigatório."}), 400

    message    = data['message'].strip()
    session_id = data.get('session_id', 'default')

    if session_id not in sessions:
        sessions[session_id] = [
            {"role": "system", "content": "Você é o Niklor AI, assistente simpático. Responda em português brasileiro."}
        ]

    sessions[session_id].append({"role": "user", "content": message})

    try:
        response = requests.post(OLLAMA_URL, json={
            "model":    MODEL,
            "messages": sessions[session_id],
            "stream":   False
        }, timeout=60)

        print("STATUS:", response.status_code)
        print("BODY:", response.text)

        body  = response.json()
        reply = body["message"]["content"]
        sessions[session_id].append({"role": "assistant", "content": reply})

        return jsonify({"reply": reply, "session_id": session_id})

    except Exception as e:
        print("ERRO COMPLETO:", e)
        return jsonify({"error": f"Erro: {str(e)}"}), 500

@app.route('/session/<session_id>', methods=['DELETE'])
def clear_session(session_id):
    sessions.pop(session_id, None)
    return jsonify({"message": "Sessão encerrada."})

if __name__ == '__main__':
    print("=" * 50)
    print("  Niklor AI (Ollama) em http://localhost:5000")
    print("=" * 50)
    app.run(host='0.0.0.0', port=5000, debug=True)