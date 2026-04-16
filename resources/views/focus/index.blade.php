<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>StudyLab · Focus</title>
    <link rel="icon" type="image/png" href="{{ asset('favicons/logo/focus-logo.ico') }}">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <link rel="stylesheet" href="{{ asset('css/hologram_intro.css') }}">
</head>

<body class="font-sans bg-[#020408] text-slate-200 h-screen overflow-hidden relative">

    <!-- ══════════════════════════════════════════
         HOLOGRAM INTRO OVERLAY
    ══════════════════════════════════════════ -->
    <div id="holo-overlay"
        class="fixed inset-0 z-[9999] bg-[#020408] flex flex-col items-center justify-center overflow-hidden">

        {{-- Canvas de partículas --}}
        <canvas id="particle-canvas" class="absolute inset-0"></canvas>

        {{-- Conteúdo central --}}
        <div class="holo-center relative z-10 flex flex-col items-center">

            <!-- HUD frame -->
            <div class="hud-frame">

                <!-- Cantos HUD -->
                <div class="hud-corner hud-corner-tl"></div>
                <div class="hud-corner hud-corner-tr"></div>
                <div class="hud-corner hud-corner-bl"></div>
                <div class="hud-corner hud-corner-br"></div>

                <!-- Círculos concêntricos -->
                <div class="rings">
                    <div class="ring ring-1"></div>
                    <div class="ring ring-2"></div>
                    <div class="ring ring-3"></div>
                    <div class="ring-arc"></div>
                    <div class="ring-arc-2"></div>
                </div>

                <!-- Logo hexagonal -->
                <div class="holo-hex">
                    <svg class="hex-bg" viewBox="0 0 80 80" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <polygon points="40,4 72,22 72,58 40,76 8,58 8,22" fill="rgba(236,72,153,0.1)"
                            stroke="rgba(236,72,153,0.65)" stroke-width="1.5" />
                        <polygon points="40,12 65,26 65,54 40,68 15,54 15,26" fill="none" stroke="rgba(236,72,153,0.22)"
                            stroke-width="1" />
                    </svg>
                    <svg class="hex-icon" viewBox="0 0 512 512" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path fill="#DB2777"
                            d="M150.25 19.97c-114.48-.574-139.972 184.95 20.563 212.124-29.5.534-55.382 8.11-91.75 25.97C-19.2 306.313.665 462.966 100.874 446c34.48-5.838 51.21-50.325.875-65.375 16.515 29.61-27.968 47.1-41.906 1.938-11.262-36.49 21.145-74.914 52.468-85 30.5-9.82 55.244-10.86 82.47-5.844-36.585 34.247-56.547 80.465-42.376 123.624 44.522 135.595 192.146 82.52 162.844-6.72-10.346-31.506-41.408-46.505-68-10.155 35.164-8.854 50.45 38.75 18.188 49.342-26.355 8.655-60.212-13.527-66.032-41.343-7.82-37.39 19.77-77.195 54.78-95.25 22.176 35.37 38.812 48.68 83.22 72.186 85.843 45.436 212.957-36.54 143.906-110.53-22.626-24.244-54.574-30.02-67.5 13.124 30.188-20.09 60.748 26.8 33.875 47.563-21.95 16.96-61.503 19.135-86.437 5.5-30.797-16.842-53.79-37.798-70.188-66.532 57.07 13.69 119.584-1.065 143-45.342 45.72-86.45-7.046-152.467-59.125-153.375-20.378-.356-40.654 9.237-54.875 31.5-17.85 27.946-9.815 61.533 35.157 59.124-29.11-21.628-1.9-63.623 26.717-45.343 23.378 14.932 22.494 51.88 9.75 77.28-15.165 30.23-60.573 50.738-95.062 24.657-3.008-5.71-5.563-11.683-7.78-17.843 8.99-6.49 14.874-17.028 14.874-28.875 0-17.772-13.252-32.64-30.345-35.218-9.763-47.134-23.34-92.648-84.844-112.594-13.64-4.424-26.437-6.472-38.28-6.53zm117.844 137.405c9.463 0 16.937 7.474 16.937 16.938 0 9.463-7.473 16.937-16.936 16.937-9.463 0-16.906-7.474-16.906-16.938 0-9.463 7.443-16.937 16.906-16.937zm-65.406 10.5c9.463 0 16.937 7.474 16.937 16.938 0 9.463-7.474 16.937-16.938 16.937-9.463 0-16.937-7.474-16.937-16.938 0-9.463 7.474-16.937 16.938-16.937z" />
                    </svg>
                </div>
            </div>{{-- /hud-frame --}}

            <!-- Título -->
            <div class="holo-title">STUDYLAB</div>

            <!-- Subtítulo -->
            <div class="holo-subtitle">Sistema de Foco V4.2 &middot; Modo Focus</div>

            <!-- Data stream decorativo -->
            <div class="holo-data-row">
                <span>SYS::INIT</span>
                <span>MEM:OK</span>
                <span>FOCUS_ENGINE:ON</span>
                <span>SESSION:READY</span>
            </div>

            <!-- Barra de progresso -->
            <div class="holo-bar-wrap">
                <div class="holo-bar-track">
                    <div class="holo-bar-fill"></div>
                </div>
            </div>

            <!-- Status -->
            <div class="holo-status">&#9632; Sistema pronto &mdash; aguardando acesso</div>

            <!-- Botão ACESSAR (único gatilho para entrar) -->
            <button class="holo-btn" id="holo-enter-btn">
                &#9654;&nbsp; ACESSAR
            </button>

        </div>{{-- /holo-center --}}
    </div>{{-- /holo-overlay --}}


    <!-- ══════════════════════════════════════════
         APP (oculto até o clique em ACESSAR)
    ══════════════════════════════════════════ -->
    <div class="app flex h-screen">

        <!-- SIDEBAR -->
        <aside id="sidebar" class="sidebar flex flex-col   items-center py-4 gap-1 flex-shrink-0 z-10 relative"
            style="background:rgba(255,255,255,0.03);border-right:1px solid rgba(255,255,255,0.08);">

            <div class="w-9 h-9 rounded-[10px] flex items-center justify-center mb-3 flex-shrink-0 ml-4"></div>

            {{-- Item ativo: Focus --}}
            <div class="sidebar-item w-full h-11 flex items-center gap-3 px-4 cursor-pointer border-l-2 border-pink-500 text-pink-500 whitespace-nowrap text-sm font-medium"
                style="background:rgba(236,72,153,0.12);">
                <svg class="w-[18px] h-[18px] flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8"
                        d="M13 10V3L4 14h7v7l9-11h-7z" />
                </svg>
                <span class="sidebar-label  opacity-0 transition-opacity duration-200 text-[13px]">Focus</span>
            </div>

            {{-- Lousa virtual --}}
            <div
                class="sidebar-item w-full h-11 flex items-center gap-3 px-4 cursor-pointer border-l-2 border-transparent text-[#64748b] hover:bg-white/5 hover:text-slate-200 whitespace-nowrap text-sm font-medium transition-colors">
                <a class="flex items-center gap-3 w-full" href="/whiteboard">
                    <svg class="w-[18px] h-[18px] flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8"
                            d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z" />
                    </svg>
                    <span class="sidebar-label opacity-0 transition-opacity duration-200 text-[13px]">Lousa
                        virtual</span>
                </a>
            </div>

            {{-- Caderno --}}
            <div
                class="sidebar-item w-full h-11 flex items-center gap-3 px-4 cursor-pointer border-l-2 border-transparent text-[#64748b] hover:bg-white/5 hover:text-slate-200 whitespace-nowrap text-sm font-medium transition-colors">
                <a class="flex items-center gap-3 w-full" href="/notebook">
                    <svg class="w-[18px] h-[18px] flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8"
                            d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                    </svg>
                    <span class="sidebar-label opacity-0 transition-opacity duration-200 text-[13px]">Caderno</span>
                </a>
            </div>

            {{-- Flashcards --}}
            <div
                class="sidebar-item w-full h-11 flex items-center gap-3 px-4 cursor-pointer border-l-2 border-transparent text-[#64748b] hover:bg-white/5 hover:text-slate-200 whitespace-nowrap text-sm font-medium transition-colors">
                <a class="flex items-center gap-3 w-full" href="/flashcards">
                    <svg class="w-[18px] h-[18px] flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8"
                            d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2" />
                    </svg>
                    <span class="sidebar-label opacity-0 transition-opacity duration-200 text-[13px]">Flashcards</span>
                </a>
            </div>

            {{-- Calculadora --}}
            <div
                class="sidebar-item w-full h-11 flex items-center gap-3 px-4 cursor-pointer border-l-2 border-transparent text-[#64748b] hover:bg-white/5 hover:text-slate-200 whitespace-nowrap text-sm font-medium transition-colors">
                <a class="flex items-center gap-3 w-full" href="/calculator">
                    <svg class="w-[18px] h-[18px] flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8"
                            d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0z" />
                    </svg>
                    <span class="sidebar-label opacity-0 transition-opacity duration-200 text-[13px]">Calculadora</span>
                </a>
            </div>

            {{-- Sair do Focus --}}
            <div
                class="sidebar-item w-full h-11 flex items-center gap-3 px-4 cursor-pointer border-l-2 border-transparent text-[#64748b] hover:bg-white/5 hover:text-slate-200 whitespace-nowrap text-sm font-medium transition-colors">
                <a class="flex items-center gap-3 w-full" href="/dashboard">
                    <svg class="w-[18px] h-[18px] flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8"
                            d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0z" />
                    </svg>
                    <span class="sidebar-label opacity-0 transition-opacity duration-200 text-[13px]">Sair do
                        Focus</span>
                </a>
            </div>

            {{-- Toggle collapse --}}
            <div id="sidebar-toggle"
                class="sidebar-toggle mt-auto w-full flex items-center px-4 h-10 cursor-pointer text-[#64748b] text-[13px] gap-3 hover:text-slate-200 whitespace-nowrap transition-colors">
                <svg class="w-[18px] h-[18px] flex-shrink-0 transition-transform duration-300" fill="none"
                    stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                </svg>
                <span class="sidebar-label opacity-0 transition-opacity duration-200 text-[12px]">Recolher</span>
            </div>
        </aside>

        <!-- MAIN -->
        <div class="flex flex-1 flex-col overflow-hidden">

            <!-- Topbar -->
            <div class="h-14 flex items-center justify-between px-6 gap-4 flex-shrink-0"
                style="border-bottom:1px solid rgba(255,255,255,0.08);">
                <div class="flex items-center gap-3">
                    <span class="font-orbitron font-bold text-xs tracking-wide text-slate-200">MODO FOCUS</span>
                    <span class="text-[11px] px-2 py-0.5 rounded-full font-semibold text-pink-500"
                        style="background:rgba(236,72,153,0.12);border:1px solid rgba(236,72,153,0.3);">
                        Sessão ativa
                    </span>
                </div>
                <div class="flex items-center gap-2.5">
                    <button id="support-btn"
                        class="flex items-center gap-1.5 px-3.5 py-1.5 rounded-[10px] text-[#64748b] text-xs font-medium cursor-pointer transition-all hover:border-pink-500 hover:text-pink-500 whitespace-nowrap"
                        style="border:1px solid rgba(255,255,255,0.08);background:rgba(255,255,255,0.04);">
                        <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M18.364 5.636l-3.536 3.536m0 5.656l3.536 3.536M9.172 9.172L5.636 5.636m3.536 9.192L5.636 18.364M21 12a9 9 0 11-18 0 9 9 0 0118 0zm-5 0a4 4 0 11-8 0 4 4 0 018 0z" />
                        </svg>
                        Banco de Questões
                    </button>
                </div>
            </div>

            <!-- Content -->
            <div class="flex-1 overflow-y-auto p-6 flex flex-col gap-5 relative">

                <!-- TIMER CARD -->
                <div class="relative flex items-center gap-8 rounded-[20px] px-8 py-7 overflow-hidden"
                    style="background:rgba(255,255,255,0.04);border:1px solid rgba(255,255,255,0.08);">

                    {{-- Glow decorativo --}}
                    <div class="absolute -right-10 -top-10 w-[180px] h-[180px] rounded-full pointer-events-none"
                        style="background:radial-gradient(circle,rgba(236,72,153,0.12) 0%,transparent 70%);"></div>

                    {{-- Círculo do timer --}}
                    <div class="relative w-[120px] h-[120px] flex-shrink-0">
                        <svg class="absolute top-0 left-0 -rotate-90" width="120" height="120" viewBox="0 0 120 120">
                            <circle cx="60" cy="60" r="52" fill="none" stroke="rgba(255,255,255,0.06)"
                                stroke-width="6" />
                            <circle cx="60" cy="60" r="52" fill="none" stroke="url(#timerGrad)" stroke-width="6"
                                stroke-dasharray="327" stroke-dashoffset="0" stroke-linecap="round" />
                            <defs>
                                <linearGradient id="timerGrad" x1="0%" y1="0%" x2="100%" y2="0%">
                                    <stop offset="0%" stop-color="#ec4899" />
                                    <stop offset="100%" stop-color="#9333ea" />
                                </linearGradient>
                            </defs>
                        </svg>
                        <div class="absolute inset-0 flex flex-col items-center justify-center">
                            <span id="timer-digits"
                                class="font-orbitron text-xl font-bold text-white leading-none">25:00</span>
                            <span class="text-[10px] text-[#64748b] font-medium mt-0.5">restando</span>
                        </div>
                    </div>

                    {{-- Info do timer --}}
                    <div class="flex-1">
                        <div class="text-[11px] font-semibold tracking-[0.08em] uppercase text-pink-500 mb-1">
                            Técnica Pomodoro
                        </div>
                        <div class="font-orbitron text-[13px] font-bold text-white mb-3">Foco Total</div>

                        <div class="timer-controls flex gap-2">
                            {{-- Play / Pause --}}
                            <button id="play-btn"
                                class="btn-play flex items-center gap-1.5 px-[18px] h-9 rounded-[10px] text-white text-xs font-semibold cursor-pointer transition-opacity hover:opacity-85"
                                style="background:linear-gradient(135deg,#ec4899,#9333ea);border:none;">
                                <svg id="play-icon" class="w-3.5 h-3.5" fill="currentColor" viewBox="0 0 24 24">
                                    <path d="M6 4l15 8-15 8V4z" />
                                </svg>
                                <span id="play-label">Iniciar</span>
                            </button>

                            {{-- Reset --}}
                            <div class="btn-icon w-9 h-9 rounded-[10px] flex items-center justify-center cursor-pointer text-[#64748b] transition-all hover:text-pink-500"
                                style="border:1px solid rgba(255,255,255,0.08);background:rgba(255,255,255,0.04);">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15" />
                                </svg>
                            </div>

                            {{-- Skip --}}
                            <div class="btn-icon w-9 h-9 rounded-[10px] flex items-center justify-center cursor-pointer text-[#64748b] transition-all hover:text-pink-500"
                                style="border:1px solid rgba(255,255,255,0.08);background:rgba(255,255,255,0.04);">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M13 5l7 7-7 7M5 5l7 7-7 7" />
                                </svg>
                            </div>
                        </div>
                    </div>
                </div>{{-- /timer-card --}}

                <!-- SUPPORT / BANCO DE QUESTÕES OVERLAY -->
                <div id="support-overlay"
                    class="support-overlay absolute top-0 right-0 w-0 h-full z-[100] overflow-hidden">
                    <div class="flex flex-col w-[280px] h-full rounded-l-xl"
                        style="background:#0a0a0f;border-left:1px solid rgba(255,255,255,0.08);">

                        <div class="flex items-center justify-between px-4 py-3"
                            style="border-bottom:1px solid rgba(255,255,255,0.08);">
                            <span class="font-orbitron text-[11px] font-bold text-slate-200 tracking-wide">
                                BANCO DE QUESTÕES
                            </span>
                            <div id="close-support"
                                class="w-6 h-6 flex items-center justify-center cursor-pointer text-[#64748b] rounded-md transition-all hover:text-slate-200 hover:bg-white/5">
                                <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M6 18L18 6M6 6l12 12" />
                                </svg>
                            </div>
                        </div>

                        <div class="support-content-scroll overflow-y-auto flex-1 pb-5">

                            {{-- ── EXATAS ── --}}
                            <p class="text-[10px] font-bold tracking-[0.12em] uppercase text-[#64748b] px-4 pt-3 pb-1">
                                Exatas</p>

                            <div class="flex items-center gap-3 px-4 h-12 cursor-pointer border-l-2 border-pink-500 text-pink-500 text-[13px] font-medium whitespace-nowrap"
                                style="background:rgba(236,72,153,0.12);">
                                <a class=" flex gap-2"  href="/math">
                                <svg class="w-[18px] h-[18px] flex-shrink-0" fill="none" stroke="currentColor"
                                    viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8"
                                        d="M13 10V3L4 14h7v7l9-11h-7z" />
                                </svg>
                                Matemática</a>
                            </div>

                            <div class="h-px mx-4 my-1.5" style="background:rgba(255,255,255,0.08);"></div>

                            {{-- ── LINGUAGENS ── --}}
                            <p class="text-[10px] font-bold tracking-[0.12em] uppercase text-[#64748b] px-4 pt-2 pb-1">
                                Linguagens</p>

                            @foreach(['Gramática', 'Literatura', 'Interpretação', 'Inglês', 'Espanhol', 'Artes', 'Educação Física'] as $item)
                                <div
                                    class="flex items-center gap-3 px-4 h-12 cursor-pointer border-l-2 border-transparent text-[#64748b] text-[13px] font-medium whitespace-nowrap transition-colors hover:bg-white/[0.04] hover:text-slate-200">
                                    <svg class="w-[18px] h-[18px] flex-shrink-0" fill="none" stroke="currentColor"
                                        viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8"
                                            d="M8 10h.01M12 10h.01M16 10h.01M9 16H5a2 2 0 01-2-2V6a2 2 0 012-2h14a2 2 0 012 2v8a2 2 0 01-2 2h-5l-5 5v-5z" />
                                    </svg>
                                    {{ $item }}
                                </div>
                            @endforeach

                            <div class="h-px mx-4 my-1.5" style="background:rgba(255,255,255,0.08);"></div>

                            {{-- ── HUMANAS ── --}}
                            <p class="text-[10px] font-bold tracking-[0.12em] uppercase text-[#64748b] px-4 pt-2 pb-1">
                                Humanas</p>

                            @foreach(['História', 'Geografia', 'Sociologia', 'Filosofia'] as $item)
                                <div
                                    class="flex items-center gap-3 px-4 h-12 cursor-pointer border-l-2 border-transparent text-[#64748b] text-[13px] font-medium whitespace-nowrap transition-colors hover:bg-white/[0.04] hover:text-slate-200">
                                    <svg class="w-[18px] h-[18px] flex-shrink-0" fill="none" stroke="currentColor"
                                        viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8"
                                            d="M3.055 11H5a2 2 0 012 2v1a2 2 0 002 2 2 2 0 012 2v2.945M8 3.935V5.5A2.5 2.5 0 0010.5 8h.5a2 2 0 012 2 2 2 0 104 0 2 2 0 012-2h1.064M15 20.488V18a2 2 0 012-2h3.064" />
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8"
                                            d="M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                                    </svg>
                                    {{ $item }}
                                </div>
                            @endforeach

                            <div class="h-px mx-4 my-1.5" style="background:rgba(255,255,255,0.08);"></div>

                            {{-- ── NATUREZA ── --}}
                            <p class="text-[10px] font-bold tracking-[0.12em] uppercase text-[#64748b] px-4 pt-2 pb-1">
                                Natureza</p>

                            @foreach(['Física', 'Química', 'Biologia'] as $item)
                                <div
                                    class="flex items-center gap-3 px-4 h-12 cursor-pointer border-l-2 border-transparent text-[#64748b] text-[13px] font-medium whitespace-nowrap transition-colors hover:bg-white/[0.04] hover:text-slate-200">
                                    <svg class="w-[18px] h-[18px] flex-shrink-0" fill="none" stroke="currentColor"
                                        viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8"
                                            d="M9.663 17h4.673M12 3v1m6.364 1.636l-.707.707M21 12h-1M4 12H3m3.343-5.657l-.707-.707m2.828 9.9a5 5 0 117.072 0l-.548.547A3.374 3.374 0 0014 18.469V19a2 2 0 11-4 0v-.531c0-.895-.356-1.754-.988-2.386l-.548-.547z" />
                                    </svg>
                                    {{ $item }}
                                </div>
                            @endforeach

                        </div>{{-- /support-content-scroll --}}
                    </div>
                </div>{{-- /support-overlay --}}

            </div>{{-- /content --}}
        </div>{{-- /main --}}
    </div>{{-- /app --}}

    <script src="{{ asset('js/hologram_intro.js') }}"></script>
</body>

</html>