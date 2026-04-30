<!DOCTYPE html>
<html lang="pt-BR">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<meta name="csrf-token" content="{{ csrf_token() }}">
<title>Niklor AI</title>
<link rel="preconnect" href="https://fonts.googleapis.com">
<link href="https://fonts.googleapis.com/css2?family=Instrument+Serif:ital@0;1&family=Geist:wght@300;400;500;600&display=swap" rel="stylesheet">
<script src="https://cdn.tailwindcss.com"></script>
<style>
  [data-chat] { font-family: 'Geist', sans-serif; }
  .font-display { font-family: 'Instrument Serif', serif; }

  @keyframes fade-up {
    from { opacity: 0; transform: translateY(8px); }
    to   { opacity: 1; transform: translateY(0); }
  }
  @keyframes blink {
    0%, 100% { opacity: 1; } 50% { opacity: 0.2; }
  }
  @keyframes pulse-ring {
    0%   { box-shadow: 0 0 0 0 rgba(219,39,119,0.35); }
    70%  { box-shadow: 0 0 0 7px rgba(219,39,119,0); }
    100% { box-shadow: 0 0 0 0 rgba(219,39,119,0); }
  }

  .msg-in    { animation: fade-up 0.28s cubic-bezier(0.22,1,0.36,1) both; }
  .dot-blink { animation: blink 1.1s infinite; }
  .dot-blink:nth-child(2) { animation-delay: 0.18s; }
  .dot-blink:nth-child(3) { animation-delay: 0.36s; }
  .pulse-ring { animation: pulse-ring 2.2s infinite; }

  #messages::-webkit-scrollbar { width: 3px; }
  #messages::-webkit-scrollbar-track { background: transparent; }
  #messages::-webkit-scrollbar-thumb { background: #27272a; border-radius: 99px; }
</style>
</head>
<body data-chat class="flex flex-col h-screen bg-[#0c0c0e] text-zinc-100 overflow-hidden relative">


  <div class="absolute inset-0 pointer-events-none" style="background-image: radial-gradient(circle at 20% 50%, rgba(219,39,119,0.04) 0%, transparent 60%), radial-gradient(circle at 80% 20%, rgba(219,39,119,0.03) 0%, transparent 50%); z-index:0;"></div>
  <div class="absolute top-0 left-0 right-0 h-px bg-gradient-to-r from-transparent via-pink-600/40 to-transparent z-10"></div>


  <header class="relative z-10 flex items-center justify-between px-6 py-4 border-b border-white/[0.05] bg-[#0c0c0e]/80 backdrop-blur-xl flex-shrink-0">
    <div class="flex items-center gap-3">
      <div class="w-9 h-9 rounded-xl bg-pink-600/10 border border-pink-600/20 flex items-center justify-center pulse-ring">
        <svg width="17" height="17" viewBox="0 0 24 24" fill="none" stroke="#db2777" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round">
          <path d="M21 15a2 2 0 0 1-2 2H7l-4 4V5a2 2 0 0 1 2-2h14a2 2 0 0 1 2 2z"/>
        </svg>
      </div>
      <div>
        <p class="font-display text-lg leading-none text-white tracking-tight">Niklor <span class="text-pink-500">AI</span></p>
        <p class="text-[10px] text-zinc-500 font-medium tracking-widest uppercase mt-0.5">Assistente</p>
      </div>
    </div>

    <div class="flex items-center gap-3">
      <div class="flex items-center gap-2 px-3 py-1.5 rounded-full border border-white/[0.06] bg-white/[0.03]">
        <span class="w-1.5 h-1.5 rounded-full bg-emerald-400 shadow-[0_0_6px_rgba(52,211,153,0.8)]"></span>
        <span class="text-[11px] text-zinc-400 font-medium">Online</span>
      </div>
      <button id="clearBtn" class="flex items-center gap-1.5 px-3 py-1.5 rounded-lg border border-white/[0.06] bg-white/[0.03] text-zinc-500 hover:text-red-400 hover:border-red-500/30 hover:bg-red-500/5 transition-all duration-200 text-[11px] font-medium">
        <svg width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
          <polyline points="3 6 5 6 21 6"/><path d="M19 6l-1 14H6L5 6"/><path d="M9 6V4h6v2"/>
        </svg>
        Limpar
      </button>
    </div>
  </header>


  <div id="messages" class="relative z-10 flex-1 overflow-y-auto px-6 py-8 flex flex-col gap-5 scroll-smooth">

    <div id="emptyState" class="flex flex-col items-center justify-center flex-1 gap-5 py-20 select-none">
      <div class="w-16 h-16 rounded-2xl bg-pink-600/8 border border-pink-600/15 flex items-center justify-center">
        <svg width="28" height="28" viewBox="0 0 24 24" fill="none" stroke="#db2777" stroke-width="1.2" stroke-linecap="round" stroke-linejoin="round">
          <path d="M21 15a2 2 0 0 1-2 2H7l-4 4V5a2 2 0 0 1 2-2h14a2 2 0 0 1 2 2z"/>
        </svg>
      </div>
      <div class="text-center">
        <p class="font-display text-2xl text-white/80 mb-1">Como posso ajudar?</p>
        <p class="text-sm text-zinc-600 max-w-xs leading-relaxed">Faça qualquer pergunta. Estou aqui para ajudar.</p>
      </div>
      <div class="flex flex-wrap gap-2 justify-center mt-2">
        <button onclick="fillSuggestion('O que você consegue fazer?')" class="px-4 py-2 rounded-full border border-white/[0.07] bg-white/[0.03] text-xs text-zinc-400 hover:text-zinc-200 hover:border-pink-600/30 hover:bg-pink-600/5 transition-all duration-200">O que você consegue fazer?</button>
        <button onclick="fillSuggestion('Como funciona uma API REST?')" class="px-4 py-2 rounded-full border border-white/[0.07] bg-white/[0.03] text-xs text-zinc-400 hover:text-zinc-200 hover:border-pink-600/30 hover:bg-pink-600/5 transition-all duration-200">Como funciona uma API REST?</button>
        <button onclick="fillSuggestion('Me dê dicas de produtividade')" class="px-4 py-2 rounded-full border border-white/[0.07] bg-white/[0.03] text-xs text-zinc-400 hover:text-zinc-200 hover:border-pink-600/30 hover:bg-pink-600/5 transition-all duration-200">Dicas de produtividade</button>
      </div>
    </div>

  </div>


  <div class="relative z-10 px-6 pb-6 pt-3 flex-shrink-0">
    <div class="flex items-end gap-3 bg-white/[0.04] border border-white/[0.08] rounded-2xl px-4 py-3 transition-all duration-200 focus-within:border-pink-600/40 focus-within:bg-pink-600/[0.03] focus-within:shadow-[0_0_0_3px_rgba(219,39,119,0.08)]">
      <textarea
        id="messageInput"
        placeholder="Mensagem..."
        rows="1"
        class="flex-1 bg-transparent border-none outline-none resize-none text-sm text-zinc-100 placeholder-zinc-600 leading-relaxed max-h-36 overflow-y-auto py-0.5"
      ></textarea>
      <button id="sendBtn"
        class="w-9 h-9 rounded-xl bg-pink-600 hover:bg-pink-500 active:scale-95 flex items-center justify-center transition-all duration-150 flex-shrink-0 disabled:opacity-30 disabled:cursor-not-allowed shadow-[0_2px_12px_rgba(219,39,119,0.35)]">
        <svg width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="white" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round">
          <line x1="22" y1="2" x2="11" y2="13"/><polygon points="22 2 15 22 11 13 2 9 22 2"/>
        </svg>
      </button>
    </div>
    <p class="text-center text-[10px] text-zinc-700 mt-2.5 tracking-wide">
      <kbd class="font-sans bg-white/5 border border-white/10 rounded px-1.5 py-0.5">Enter</kbd> enviar
      &nbsp;·&nbsp;
      <kbd class="font-sans bg-white/5 border border-white/10 rounded px-1.5 py-0.5">Shift+Enter</kbd> nova linha
    </p>
  </div>

</body>

<script>
const messagesEl = document.getElementById('messages');
const inputEl    = document.getElementById('messageInput');
const sendBtn    = document.getElementById('sendBtn');
const clearBtn   = document.getElementById('clearBtn');
const emptyState = document.getElementById('emptyState');
const csrfToken  = document.querySelector('meta[name="csrf-token"]').content;

let isLoading = false;

inputEl.addEventListener('input', () => {
  inputEl.style.height = 'auto';
  inputEl.style.height = Math.min(inputEl.scrollHeight, 144) + 'px';
});

inputEl.addEventListener('keydown', e => {
  if (e.key === 'Enter' && !e.shiftKey) { e.preventDefault(); sendMessage(); }
});

sendBtn.addEventListener('click', sendMessage);

clearBtn.addEventListener('click', async () => {
  try {
    await fetch('{{ route("chatbot.clear") }}', {
      method: 'POST',
      headers: { 'X-CSRF-TOKEN': csrfToken, 'Accept': 'application/json' }
    });
  } catch (_) {}
  messagesEl.innerHTML = '';
  messagesEl.appendChild(emptyState);
  emptyState.style.display = 'flex';
});

function fillSuggestion(text) {
  inputEl.value = text;
  inputEl.focus();
  inputEl.dispatchEvent(new Event('input'));
}

function appendMessage(role, text, isError = false) {
  emptyState.style.display = 'none';

  const wrap = document.createElement('div');
  wrap.className = 'msg-in flex gap-3 ' + (role === 'user' ? 'flex-row-reverse' : '');

  const av = document.createElement('div');
  av.className = 'flex-shrink-0 w-7 h-7 rounded-lg flex items-center justify-center mt-0.5 ' +
    (role === 'user'
      ? 'bg-pink-600/15 border border-pink-600/20'
      : 'bg-zinc-800 border border-white/[0.06]');

  av.innerHTML = role === 'user'
    ? `<svg width="13" height="13" viewBox="0 0 24 24" fill="none" stroke="#db2777" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"/><circle cx="12" cy="7" r="4"/></svg>`
    : `<svg width="13" height="13" viewBox="0 0 24 24" fill="none" stroke="#71717a" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"><path d="M21 15a2 2 0 0 1-2 2H7l-4 4V5a2 2 0 0 1 2-2h14a2 2 0 0 1 2 2z"/></svg>`;

  const bubble = document.createElement('div');
  const base   = 'max-w-[72%] px-4 py-3 rounded-2xl text-sm leading-relaxed ';

  if (isError) {
    bubble.className = base + 'bg-red-500/8 border border-red-500/20 text-red-400';
  } else if (role === 'user') {
    bubble.className = base + 'bg-pink-600/15 border border-pink-600/20 text-pink-100 rounded-tr-sm';
  } else {
    bubble.className = base + 'bg-white/[0.04] border border-white/[0.07] text-zinc-200 rounded-tl-sm';
  }

  bubble.innerHTML = escapeHtml(text);
  wrap.appendChild(av);
  wrap.appendChild(bubble);
  messagesEl.appendChild(wrap);
  scrollToBottom();
}

function showTyping() {
  const wrap = document.createElement('div');
  wrap.id = 'typingIndicator';
  wrap.className = 'msg-in flex gap-3';
  wrap.innerHTML = `
    <div class="flex-shrink-0 w-7 h-7 rounded-lg flex items-center justify-center mt-0.5 bg-zinc-800 border border-white/[0.06]">
      <svg width="13" height="13" viewBox="0 0 24 24" fill="none" stroke="#71717a" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"><path d="M21 15a2 2 0 0 1-2 2H7l-4 4V5a2 2 0 0 1 2-2h14a2 2 0 0 1 2 2z"/></svg>
    </div>
    <div class="px-4 py-3.5 rounded-2xl rounded-tl-sm bg-white/[0.04] border border-white/[0.07] flex items-center gap-1.5">
      <span class="w-1.5 h-1.5 rounded-full bg-zinc-500 dot-blink"></span>
      <span class="w-1.5 h-1.5 rounded-full bg-zinc-500 dot-blink"></span>
      <span class="w-1.5 h-1.5 rounded-full bg-zinc-500 dot-blink"></span>
    </div>
  `;
  messagesEl.appendChild(wrap);
  scrollToBottom();
}

function hideTyping() { document.getElementById('typingIndicator')?.remove(); }

async function sendMessage() {
  const text = inputEl.value.trim();
  if (!text || isLoading) return;

  isLoading = true;
  sendBtn.disabled = true;
  appendMessage('user', text);
  inputEl.value = '';
  inputEl.style.height = 'auto';
  showTyping();

  try {
    const res  = await fetch('{{ route("chatbot.send") }}', {
      method: 'POST',
      headers: {
        'Content-Type': 'application/json',
        'X-CSRF-TOKEN': csrfToken,
        'Accept': 'application/json',
      },
      body: JSON.stringify({ message: text }),
    });

    const data = await res.json();
    hideTyping();

    if (res.ok && data.reply) appendMessage('bot', data.reply);
    else appendMessage('bot', data.error || 'Ocorreu um erro inesperado.', true);

  } catch (err) {
    hideTyping();
    appendMessage('bot', 'Falha na conexão. Verifique se o servidor está rodando.', true);
  }

  isLoading = false;
  sendBtn.disabled = false;
  inputEl.focus();
}

function scrollToBottom() { messagesEl.scrollTop = messagesEl.scrollHeight; }

function escapeHtml(t) {
  return t.replace(/&/g,'&amp;').replace(/</g,'&lt;').replace(/>/g,'&gt;').replace(/"/g,'&quot;').replace(/\n/g,'<br>');
}
</script>
</html>