<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Personalizar conta - StudyLab</title>
    <link rel="icon" type="image/png" href="{{ asset('favicons/icone-onbarding.ico') }}">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <link rel="stylesheet" href="{{ asset('css/onboarding.css') }}">
</head>

<body class="bg-[#09090e] text-slate-200 h-screen w-screen overflow-hidden font-sans">


    <div id="step0" class="ob-step fixed inset-0 bg-[#09090e] flex flex-col items-center justify-center">
        <div class="flex-1 flex flex-col items-center justify-center w-full max-w-lg px-10 text-center">
            <div class="w-[130px] h-[130px] mb-2">
                <img class="w-full h-full object-contain" src="{{ asset('images/logo-invertida-1.png') }}"
                    alt="StudyLab">
            </div>
            <h1 class="text-[30px] font-bold text-pink-500 mb-2">Bem-vindo ao StudyLab</h1>
            <p class="text-sm text-slate-500">Vamos configurar sua conta em poucos passos.</p>
        </div>
        <div class="w-full px-11 pb-8 flex items-center justify-between shrink-0">
            <span class="invisible text-sm">Voltar</span>
            <div class="flex gap-2 items-center" id="dots0"></div>
            <x-ob-btn :step="1" label="COMEÇAR" />
        </div>
    </div>

    <div id="step1"
        class="ob-step fixed inset-0 bg-[#09090e] flex flex-col items-center justify-center opacity-0 pointer-events-none">
        <div class="flex-1 flex flex-col items-start justify-center w-full max-w-lg px-10">
            <h2 class="text-[22px] font-semibold text-slate-100 mb-2">Como quer ser chamado?</h2>
            <p class="text-[13px] text-slate-500 mb-7">Esse nome aparece na sua carteira de estudante.</p>
            <label class="text-[11px] font-semibold text-slate-500 uppercase tracking-widest mb-2">Nome completo</label>
            <input id="nameInput" type="text" maxlength="50" autocomplete="off" placeholder="Ex: Ana Lima"
                class="w-full px-3.5 py-2.5 bg-[#18181f] border border-white/[.08] focus:border-pink-500 focus:ring-2 focus:ring-pink-500/20 rounded-xl text-slate-100 text-[14px] outline-none placeholder:text-slate-700 mb-2.5 transition-all">
            <div
                class="w-full flex items-center gap-2 px-3.5 py-2 bg-[#18181f] border border-white/[.08] rounded-xl text-[12px] text-slate-500">
                <svg width="10" height="10" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                    <rect x="2" y="5" width="20" height="14" rx="2" />
                </svg>
                Na carteira: <span id="namePreviewVal" class="text-pink-500 font-semibold ml-1">—</span>
            </div>
        </div>
        <div class="w-full px-11 pb-8 flex items-center justify-between shrink-0">
            <button onclick="goStep(0)"
                class="text-[13px] text-slate-500 hover:text-slate-200 bg-transparent border-none cursor-pointer transition-colors">Voltar</button>
            <div class="flex gap-2 items-center" id="dots1"></div>
            <x-ob-btn id="nextStep1" :step="2" label="PRÓXIMO" disabled />
        </div>
    </div>

    <div id="step2"
        class="ob-step fixed inset-0 bg-[#09090e] flex flex-col items-center justify-center opacity-0 pointer-events-none">
        <div class="flex-1 flex flex-col items-center justify-center w-full max-w-lg px-10 text-center">
            <h2 class="text-[22px] font-semibold text-slate-100 mb-2">Escolha um tema visual</h2>
            <p class="text-[13px] text-slate-500 mb-7">Clique ou use as setas ← → para selecionar.</p>
            <div class="grid grid-cols-2 gap-4 w-full max-w-xs mx-auto" id="themeGrid"></div>
        </div>
        <div class="w-full px-11 pb-8 flex items-center justify-between shrink-0">
            <button onclick="goStep(1)"
                class="text-[13px] text-slate-500 hover:text-slate-200 bg-transparent border-none cursor-pointer transition-colors">Voltar</button>
            <div class="flex gap-2 items-center" id="dots2"></div>
            <x-ob-btn :step="3" label="PRÓXIMO" />
        </div>
    </div>

    <div id="step3"
        class="ob-step fixed inset-0 bg-[#09090e] flex flex-col items-center justify-center opacity-0 pointer-events-none">
        <div class="flex-1 flex flex-col items-center justify-center w-full max-w-lg px-10 text-center">
            <h2 class="text-[22px] font-semibold text-slate-100 mb-2">Escolha seu avatar</h2>
            <p class="text-[13px] text-slate-500 mb-5">Selecione um dos avatares ou envie uma foto sua.</p>
            <div class="w-full border border-white/[.08] rounded-xl overflow-hidden">
                <div class="px-5 pb-5 pt-4 flex flex-col gap-2.5 bg-[#111118]">
                    <div class="grid grid-cols-4 gap-2" id="avatarGrid">
                        @for($i = 0; $i < 16; $i++)
                            <div class="aspect-square rounded-lg ob-skel"></div>
                        @endfor
                    </div>
                    <label for="avatarFileInput"
                        class="flex items-center justify-center gap-2 w-full py-2.5 border border-dashed border-white/10 hover:border-pink-500 text-slate-500 hover:text-pink-500 text-[12px] rounded-xl cursor-pointer transition-colors">
                        <svg width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                            stroke-width="2" stroke-linecap="round">
                            <path d="M21 15v4a2 2 0 01-2 2H5a2 2 0 01-2-2v-4" />
                            <polyline points="17 8 12 3 7 8" />
                            <line x1="12" y1="3" x2="12" y2="15" />
                        </svg>
                        Upload de foto própria
                    </label>
                    <input type="file" id="avatarFileInput" accept="image/*" class="hidden">
                </div>
            </div>
        </div>
        <div class="w-full px-11 pb-8 flex items-center justify-between shrink-0">
            <button onclick="goStep(2)"
                class="text-[13px] text-slate-500 hover:text-slate-200 bg-transparent border-none cursor-pointer transition-colors">Voltar</button>
            <div class="flex gap-2 items-center" id="dots3"></div>
            <x-ob-btn :step="4" label="PRÓXIMO" />
        </div>
    </div>

    <div id="step4"
        class="ob-step fixed inset-0 bg-[#09090e] flex flex-col items-center justify-center opacity-0 pointer-events-none">
        <div class="flex-1 flex flex-col items-center justify-center w-full max-w-lg px-10 text-center">
            <h2 class="text-[22px] font-semibold text-slate-100 mb-2">Cor da carteira</h2>
            <p class="text-[13px] text-slate-500 mb-5">Escolha a paleta da sua carteira de estudante.</p>
            <div class="grid grid-cols-4 gap-2.5 w-full mb-4" id="colorGrid"></div>
            <div id="cardPreview" class="w-full rounded-xl overflow-hidden p-3.5 relative transition-all duration-500"
                style="background:linear-gradient(135deg,#be185d 0%,#db2777 40%,#f472b6 100%);">
                <div class="absolute inset-0 opacity-5"
                    style="background-image:repeating-linear-gradient(45deg,#fff 0,#fff 1px,transparent 0,transparent 50%);background-size:10px 10px;">
                </div>
                <div class="relative flex items-center gap-3">
                    <div id="previewPhotoMini"
                        class="w-9 h-11 rounded-lg border-2 border-white/25 bg-white/15 shrink-0 flex items-center justify-center overflow-hidden">
                        <svg width="13" height="13" viewBox="0 0 24 24" fill="none" stroke="rgba(255,255,255,.4)"
                            stroke-width="1.5">
                            <circle cx="12" cy="8" r="4" />
                            <path d="M4 20c0-4 3.6-7 8-7s8 3 8 7" />
                        </svg>
                    </div>
                    <div class="flex-1 min-w-0 text-left">
                        <div id="previewName"
                            class="text-[10.5px] font-black text-white tracking-wide uppercase truncate">SEU NOME</div>
                        <div class="text-[7.5px] text-white/50 mt-0.5">STUDYLAB ACADEMY · GRADUAÇÃO</div>
                        <div class="text-[7px] text-white/30 mt-1">SL-000001</div>
                    </div>
                    <div class="text-[8px] font-black text-white/60 bg-white/15 px-2 py-0.5 rounded shrink-0">
                        {{ date('Y') }}
                    </div>
                </div>
            </div>
        </div>
        <div class="w-full px-11 pb-8 flex items-center justify-between shrink-0">
            <button onclick="goStep(3)"
                class="text-[13px] text-slate-500 hover:text-slate-200 bg-transparent border-none cursor-pointer transition-colors">Voltar</button>
            <div class="flex gap-2 items-center" id="dots4"></div>
            <x-ob-btn :step="5" label="PRÓXIMO" />
        </div>
    </div>

    <div id="step5"
        class="ob-step fixed inset-0 bg-[#09090e] flex flex-col items-center justify-center opacity-0 pointer-events-none">
        <div class="flex-1 flex flex-col items-center justify-center w-full max-w-lg px-10 text-center">
            <p class="text-[10px] font-black tracking-widest uppercase text-pink-500 mb-1">Planos</p>
            <h2 class="text-[22px] font-semibold text-slate-100 mb-1">Escolha seu plano</h2>
            <p class="text-[13px] text-slate-500 mb-6">Você pode mudar de plano a qualquer momento.</p>
            <div class="flex gap-3 w-[full] h-[full]">
                <x-choose-plane />
            </div>
        </div>
        <div class="w-full px-11 pb-8 flex items-center justify-between shrink-0">
            <button onclick="goStep(4)"
                class="text-[13px] text-slate-500 hover:text-slate-200 bg-transparent border-none cursor-pointer transition-colors">Voltar</button>
            <div class="flex gap-2 items-center" id="dots5"></div>
            <x-ob-btn :step="6" label="PRÓXIMO" />
        </div>
    </div>

    <div id="step6"
        class="ob-step fixed inset-0 bg-[#09090e] flex flex-col items-center justify-center opacity-0 pointer-events-none">
        <div class="flex-1 flex flex-col items-center justify-center w-full max-w-lg px-10 text-center">
            <div
                class="w-14 h-14 bg-pink-500/10 border border-pink-500/30 rounded-xl flex items-center justify-center mb-6">
                <svg width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="#db2777" stroke-width="2.2"
                    stroke-linecap="round">
                    <polyline points="20 6 9 17 4 12" />
                </svg>
            </div>
            <h2 class="text-[22px] font-semibold text-slate-100 mb-2">Tudo pronto!</h2>
            <p class="text-[13px] text-slate-500 mb-8">Sua conta está configurada. Bem-vindo ao StudyLab.</p>
            <x-final-bt id="finishBtn" />
        </div>
        <div class="w-full px-11 pb-8 flex items-center justify-between shrink-0">
            <button onclick="goStep(5)"
                class="text-[13px] text-slate-500 hover:text-slate-200 bg-transparent border-none cursor-pointer transition-colors">Voltar</button>
            <div class="flex gap-2 items-center" id="dots6"></div>
            <span class="invisible text-sm">X</span>
        </div>
    </div>

    <div id="loadingScreen" class="hidden fixed inset-0 z-50 bg-[#09090e] flex-col items-center justify-center gap-5">
        <div class="relative w-44 h-44 flex items-center justify-center">
            <div class="ob-orbit w-36 h-36 border border-pink-500/20"></div>
            <div class="ob-orbit-r absolute w-44 h-44 border border-pink-500/10"></div>
            <img src="{{ asset('images/logo-dark-mode.png') }}" class="relative z-10 w-26 h-auto" alt="StudyLab">
        </div>
        <div class="w-48 h-0.5 bg-white/5 rounded-full overflow-hidden">
            <div id="progressBar" class="h-full w-0 ob-prog-bar rounded-full transition-all duration-300"></div>
        </div>
        <div class="flex gap-1.5">
            <div class="ob-dot-anim w-1.5 h-1.5 rounded-full bg-pink-500/60" style="animation-delay:0s"></div>
            <div class="ob-dot-anim w-1.5 h-1.5 rounded-full bg-pink-500/60" style="animation-delay:.2s"></div>
            <div class="ob-dot-anim w-1.5 h-1.5 rounded-full bg-pink-500/60" style="animation-delay:.4s"></div>
        </div>
        <p id="statusLabel" class="text-[13px] font-semibold text-slate-500 tracking-wide">Configurando sua conta...</p>
    </div>

    <script src="{{ asset('js/onboarding.js') }}"></script>
</body>

</html>