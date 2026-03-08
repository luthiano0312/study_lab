<!DOCTYPE html>
<html lang="pt-BR">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Personalizar conta - StudyLab</title>
  @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="min-h-screen bg-[#fdf4f8] flex flex-col items-center justify-center px-4 py-10 relative ">

  <div class="fixed inset-0 pointer-events-none" style="background-image:radial-gradient(circle,#f9a8d4 1.2px,transparent 1.2px);background-size:30px 30px;opacity:.4;"></div>
  <div class="fixed -top-20 -right-20 w-72 h-72 rounded-full pointer-events-none" style="background:radial-gradient(circle at 40% 40%,#f9a8d4 0%,#fce7f3 55%,transparent 80%);opacity:.5;"></div>
  <div class="fixed -bottom-14 -left-14 w-52 h-52 rounded-full pointer-events-none" style="background:radial-gradient(circle at 60% 60%,#fbcfe8 0%,transparent 70%);opacity:.4;"></div>

  <div class="relative z-10 w-full max-w-md bg-white rounded-3xl border border-pink-100 shadow-xl shadow-pink-100/50 overflow-hidden">

    <div class="h-1 w-full bg-gradient-to-r from-pink-600 via-pink-400 to-pink-300"></div>

    <div class="px-8 py-7">

      <div class="h-1 bg-pink-50 rounded-full overflow-hidden mb-2">
        <div id="progressFill" class="h-full bg-gradient-to-r from-pink-600 to-pink-400 rounded-full transition-all duration-500" style="width:33.33%"></div>
      </div>
      <div class="flex justify-between items-center mb-6">
        <span id="stepLabel" class="text-[10px] font-bold tracking-widest uppercase text-pink-300">Passo 1 de 3</span>
        <div class="flex gap-1.5">
          <div id="dot1" class="w-1.5 h-1.5 rounded-full bg-pink-600 scale-125 transition-all duration-300"></div>
          <div id="dot2" class="w-1.5 h-1.5 rounded-full bg-pink-100 transition-all duration-300"></div>
          <div id="dot3" class="w-1.5 h-1.5 rounded-full bg-pink-100 transition-all duration-300"></div>
        </div>
      </div>

      <div class="flex items-end gap-3 mb-6">
        <img src="/images/mascote.png" id="mascotImg"
             class="w-16 flex-shrink-0 object-contain drop-shadow-md"
             style="animation:bob 3.5s ease-in-out infinite;"
             alt="Prof. Lab">
        <div id="mascotBubble"
             class="flex-1 bg-pink-50 border border-pink-100 rounded-2xl rounded-bl-sm px-3.5 py-2.5 text-xs text-gray-400 leading-relaxed italic">
          Olá! Eu sou o <strong class="text-pink-500 not-italic">Prof. Niklor</strong>. Vamos deixar sua conta com a sua cara!
        </div>
      </div>

      <div id="step1" class="ob-step">
        <p class="text-[10px] font-bold tracking-widest uppercase text-pink-300 mb-1">Identidade</p>
        <h2 class="text-2xl font-black text-gray-900 leading-tight mb-1">Como quer<br>ser chamado?</h2>
        <p class="text-xs text-gray-400 mb-5 leading-relaxed">Esse nome aparece na sua carteira de estudante.</p>

        <input id="nameInput" type="text" maxlength="50" autocomplete="off"
               placeholder="Seu nome completo"
               class="w-full bg-pink-50 border-2 border-pink-100 rounded-2xl px-4 py-3.5 text-lg font-bold text-gray-900 outline-none transition-all focus:border-pink-400 focus:bg-white focus:ring-4 focus:ring-pink-100 placeholder:text-pink-200 placeholder:font-normal caret-pink-500">

        <div class="flex items-center gap-2 mt-2.5 px-3.5 py-2 bg-pink-50 rounded-xl border border-pink-100">
          <svg class="text-pink-300 flex-shrink-0" width="10" height="10" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><rect x="2" y="5" width="20" height="14" rx="2"/></svg>
          <span class="text-[11px] text-pink-300">Na carteira:</span>
          <span id="namePreviewVal" class="text-[11px] font-black text-pink-500 tracking-wide">—</span>
        </div>

        <div class="flex items-center justify-between mt-6">
          <button id="skipAll" class="text-[11px] text-pink-200 hover:text-gray-400 underline underline-offset-4 transition-colors">Pular tudo →</button>
          <button id="nextStep1" disabled
                  class="flex items-center gap-2 bg-pink-600 disabled:opacity-30 hover:bg-pink-700 text-white font-bold text-sm px-5 py-2.5 rounded-xl shadow-md shadow-pink-200 transition-all hover:-translate-y-0.5 disabled:cursor-not-allowed disabled:hover:translate-y-0">
            Continuar
            <svg width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><path d="M5 12h14M13 6l6 6-6 6"/></svg>
          </button>
        </div>
      </div>

      <div id="step2" class="ob-step hidden">
        <p class="text-[10px] font-bold tracking-widest uppercase text-pink-300 mb-1">Visual</p>
        <h2 class="text-2xl font-black text-gray-900 leading-tight mb-1">Cor da sua carteira</h2>
        <p class="text-xs text-gray-400 mb-5 leading-relaxed">Escolha a que mais combina com você.</p>

        <div id="colorGrid" class="grid grid-cols-3 gap-2.5 mb-4"></div>

        <div id="cardPreview" class="relative rounded-2xl overflow-hidden p-3.5 mb-5 shadow-lg transition-all duration-500"
             style="background:linear-gradient(135deg,#be185d 0%,#db2777 40%,#f472b6 100%);">
          <div class="absolute inset-0 opacity-5" style="background-image:repeating-linear-gradient(45deg,#fff 0,#fff 1px,transparent 0,transparent 50%);background-size:9px 9px;"></div>
          <div class="relative flex items-center gap-3">
            <div id="previewPhotoMini"
                 class="w-10 h-12 rounded-xl border-2 border-white/40 bg-white/20 overflow-hidden flex-shrink-0 flex items-center justify-center">
              <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="rgba(255,255,255,.55)" stroke-width="1.5"><circle cx="12" cy="8" r="4"/><path d="M4 20c0-4 3.6-7 8-7s8 3 8 7"/></svg>
            </div>
            <div class="flex-1 min-w-0">
              <p id="previewName" class="text-white font-black text-sm leading-tight truncate">SEU NOME</p>
              <p class="text-white/50 text-[8.5px] mt-0.5 font-medium">STUDYLAB ACADEMY · GRADUAÇÃO</p>
              <p id="previewId" class="text-white/30 text-[7.5px] mt-1 font-bold tracking-widest">SL-000001</p>
            </div>
            <div class="bg-white/20 rounded-lg px-2 py-1 text-white/70 text-[8px] font-black flex-shrink-0">{{ date('Y') }}</div>
          </div>
        </div>

        <div class="flex justify-between items-center">
          <button id="backStep2" class="text-sm font-semibold text-pink-300 border border-pink-100 hover:border-pink-300 hover:text-pink-500 px-4 py-2 rounded-xl transition-colors">← Voltar</button>
          <button id="nextStep2" class="flex items-center gap-2 bg-pink-600 hover:bg-pink-700 text-white font-bold text-sm px-5 py-2.5 rounded-xl shadow-md shadow-pink-200 transition-all hover:-translate-y-0.5">
            Continuar
            <svg width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><path d="M5 12h14M13 6l6 6-6 6"/></svg>
          </button>
        </div>
      </div>

      <div id="step3" class="ob-step hidden">
        <p class="text-[10px] font-bold tracking-widest uppercase text-pink-300 mb-1">Avatar</p>
        <h2 class="text-2xl font-black text-gray-900 leading-tight mb-1">Escolha seu avatar</h2>
        <p class="text-xs text-gray-400 mb-5 leading-relaxed">Selecione um ou envie uma foto sua.</p>

        <div id="avatarGrid" class="grid grid-cols-4 gap-2.5 mb-3"></div>

        <label for="avatarFileInput"
               class="flex items-center justify-center gap-2 w-full border-2 border-dashed border-pink-100 hover:border-pink-400 bg-pink-50/60 hover:bg-pink-50 text-pink-300 hover:text-pink-500 font-medium text-xs rounded-2xl py-3 cursor-pointer transition-all mb-5">
          <svg width="13" height="13" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round">
            <path d="M21 15v4a2 2 0 01-2 2H5a2 2 0 01-2-2v-4"/><polyline points="17 8 12 3 7 8"/><line x1="12" y1="3" x2="12" y2="15"/>
          </svg>
          Fazer upload de foto
        </label>
        <input type="file" id="avatarFileInput" accept="image/*" class="hidden">

        <div class="flex justify-between items-center">
          <button id="backStep3" class="text-sm font-semibold text-pink-300 border border-pink-100 hover:border-pink-300 hover:text-pink-500 px-4 py-2 rounded-xl transition-colors">← Voltar</button>
          <button id="finishBtn" class="bg-gradient-to-r from-pink-600 to-pink-500 hover:from-pink-700 hover:to-pink-600 text-white font-bold text-sm px-5 py-2.5 rounded-xl shadow-md shadow-pink-200 transition-all hover:-translate-y-0.5">
            Entrar na StudyLab
          </button>
        </div>
      </div>

    </div>
  </div>

  <p class="relative z-10 text-[11px] text-pink-300 mt-4">Pode alterar tudo depois em <span class="font-bold">Perfil</span>.</p>

  <div id="loadingScreen" class="hidden fixed inset-0 z-50 bg-[#fdf4f8]/90 backdrop-blur-sm flex flex-col items-center justify-center gap-4">
    <div class="w-10 h-10 rounded-full border-4 border-pink-100 border-t-pink-500" style="animation:spin .75s linear infinite;"></div>
    <p class="text-[11px] font-black tracking-widest uppercase text-pink-400">Personalizando...</p>
  </div>
    <script src="{{ asset('js/onboarding.js') }}"></script>

</body>
</html>