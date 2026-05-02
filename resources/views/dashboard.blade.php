@extends('layouts.app')

@section('content')
    <div class="min-h-full" style="font-family: 'Unbounded', sans-serif;">

        {{-- MAIN GRID: 2 Columns layout based on reference image --}}
        <div class="grid grid-cols-1 xl:grid-cols-4 gap-6">

            {{-- ════════ LEFT COLUMN (Main Content) ════════ --}}
            <div class="xl:col-span-3 flex flex-col gap-6">

                {{-- Header --}}
                <div
                    class="flex flex-col sm:flex-row sm:items-center justify-between gap-6 bg-white dark:bg-[#18181b] p-8 rounded-3xl border border-gray-100 dark:border-gray-800 shadow-sm relative overflow-hidden group">
                    <div
                        class="absolute right-0 top-0 w-32 h-32 bg-pink-500/5 rounded-full blur-3xl -mr-16 -mt-16 group-hover:bg-pink-500/10 transition-colors">
                    </div>
                    <div class="relative z-10">
                        <div class="flex items-center gap-3 mb-2">
                            <h1 class="text-gray-900 dark:text-white font-black text-3xl leading-none"
                                style="font-family:'Unbounded',sans-serif;">
                                Olá, <span id="greetName">Estudante</span>
                            </h1>
                            <span id="userLevelBadge"
                                class="bg-pink-500 text-white text-[10px] font-black px-3 py-1 rounded-full uppercase tracking-widest shadow-lg shadow-pink-500/20">Nível
                                --</span>
                        </div>
                        <p class="text-gray-500 dark:text-gray-400 text-xs font-semibold">Seu laboratório de estudos está
                            pronto para hoje.</p>
                    </div>

                    <div class="flex items-center gap-4 relative z-10">
                        <div class="text-right">
                            <div id="clock"
                                class="font-black text-gray-900 dark:text-gray-100 tabular-nums leading-none text-2xl"
                                style="font-family:'Unbounded',sans-serif;">00:00</div>
                            <p id="headerDate" class="text-[10px] font-bold text-gray-400 uppercase tracking-widest mt-1">
                                Carregando data...</p>
                        </div>
                    </div>
                </div>

                {{-- Stats Row --}}
                <div class="grid grid-cols-2 lg:grid-cols-4 gap-4">
                    <div
                        class="bg-pink-600 rounded-3xl p-5 border border-pink-500 shadow-lg shadow-pink-500/20 hover:-translate-y-1 transition-all duration-300 group cursor-default relative overflow-hidden">
                        <div
                            class="absolute -right-4 -bottom-4 w-24 h-24 bg-white/10 rounded-full blur-2xl group-hover:bg-white/20 transition-all">
                        </div>
                        <div class="flex items-center justify-between relative z-10">
                            <p class="text-[10px] font-black uppercase tracking-widest text-pink-100">Foco Total</p>
                            <div
                                class="w-8 h-8 rounded-xl bg-white/20 backdrop-blur-md flex items-center justify-center transition-transform duration-300 group-hover:rotate-12">
                                <svg class="w-4 h-4 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5"
                                        d="M13 10V3L4 14h7v7l9-11h-7z" />
                                </svg>
                            </div>
                        </div>
                        <p class="text-5xl font-black tabular-nums text-white leading-none tracking-tighter relative z-10"
                            id="statTotal" data-counter style="font-family:'Unbounded',sans-serif;">—</p>
                        <p class="text-[10px] text-pink-100/80 mt-2 font-semibold uppercase relative z-10">Atividades no
                            Radar</p>
                    </div>

                    {{-- Concluídas Card --}}
                    <div
                        class="bg-white dark:bg-[#18181b] rounded-3xl p-5 border border-gray-100 dark:border-gray-800 hover:-translate-y-1 transition-transform duration-200 cursor-default group">
                        <div class="flex items-center justify-between mb-4">
                            <p
                                class="text-[10px] font-black uppercase tracking-widest text-gray-500 group-hover:text-green-500 transition-colors">
                                Concluídas</p>
                            <div
                                class="w-8 h-8 rounded-xl bg-gray-50 dark:bg-gray-800/50 group-hover:bg-green-50 dark:group-hover:bg-green-900/30 flex items-center justify-center transition-colors">
                                <svg class="w-4 h-4 text-gray-400 group-hover:text-green-500 transition-colors" fill="none"
                                    stroke="currentColor" viewBox="0 0 24 24">
                                    <path d="M20 6L9 17l-5-5" stroke-width="2.5" stroke-linecap="round"
                                        stroke-linejoin="round" />
                                </svg>
                            </div>
                        </div>
                        <p class="text-3xl font-black tabular-nums text-gray-900 dark:text-white leading-none" id="statDone"
                            data-counter style="font-family:'Unbounded',sans-serif;">—</p>
                        <p class="text-[10px] text-gray-400 mt-2 font-semibold uppercase">nos últimos 30 dias</p>
                    </div>

                    {{-- Pendentes Card --}}
                    <div
                        class="bg-white dark:bg-[#18181b] rounded-3xl p-5 border border-gray-100 dark:border-gray-800 hover:-translate-y-1 transition-transform duration-200 cursor-default group">
                        <div class="flex items-center justify-between mb-4">
                            <p
                                class="text-[10px] font-black uppercase tracking-widest text-gray-500 group-hover:text-pink-400 transition-colors">
                                Pendentes</p>
                            <div
                                class="w-8 h-8 rounded-xl bg-gray-50 dark:bg-gray-800/50 group-hover:bg-pink-50 dark:group-hover:bg-pink-900/20 flex items-center justify-center transition-colors">
                                <svg class="w-4 h-4 text-gray-400 group-hover:text-pink-400 transition-colors" fill="none"
                                    stroke="currentColor" viewBox="0 0 24 24">
                                    <circle cx="12" cy="12" r="10" stroke-width="2" />
                                    <path d="M12 6v6l4 2" stroke-width="2" stroke-linecap="round" />
                                </svg>
                            </div>
                        </div>
                        <p class="text-3xl font-black tabular-nums text-gray-900 dark:text-white leading-none"
                            id="statPending" data-counter style="font-family:'Unbounded',sans-serif;">—</p>
                        <p class="text-[10px] text-gray-400 mt-2 font-semibold uppercase">aguardando ação</p>
                    </div>

                    {{-- Atrasadas Card --}}
                    <div
                        class="bg-white dark:bg-[#18181b] rounded-3xl p-5 border border-gray-100 dark:border-gray-800 hover:-translate-y-1 transition-transform duration-200 cursor-default group">
                        <div class="flex items-center justify-between mb-4">
                            <p
                                class="text-[10px] font-black uppercase tracking-widest text-gray-500 group-hover:text-red-500 transition-colors">
                                Atrasadas</p>
                            <div
                                class="w-8 h-8 rounded-xl bg-gray-50 dark:bg-gray-800/50 group-hover:bg-red-50 dark:group-hover:bg-red-900/30 flex items-center justify-center transition-colors">
                                <svg class="w-4 h-4 text-gray-400 group-hover:text-red-500 transition-colors" fill="none"
                                    stroke="currentColor" viewBox="0 0 24 24">
                                    <path
                                        d="M10.29 3.86L1.82 18a2 2 0 001.71 3h16.94a2 2 0 001.71-3L13.71 3.86a2 2 0 00-3.42 0z"
                                        stroke-width="2" />
                                    <line x1="12" y1="9" x2="12" y2="13" stroke-width="2" stroke-linecap="round" />
                                    <line x1="12" y1="17" x2="12.01" y2="17" stroke-width="2" stroke-linecap="round" />
                                </svg>
                            </div>
                        </div>
                        <p class="text-3xl font-black tabular-nums text-gray-900 dark:text-white leading-none"
                            id="statOverdue" data-counter style="font-family:'Unbounded',sans-serif;">—</p>
                        <p class="text-[10px] text-gray-400 mt-2 font-semibold uppercase">requerem atenção</p>
                    </div>
                </div>

                {{-- Row: Shortcuts + Weekly Load --}}
                <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">

                    {{-- Shortcuts --}}
                    <div
                        class="bg-white dark:bg-[#18181b] rounded-3xl border border-gray-100 dark:border-gray-800 shadow-sm p-6 flex flex-col">
                        <div class="flex items-center justify-between mb-5">
                            <h3 class="text-sm font-black text-gray-900 dark:text-white"
                                style="font-family:'Unbounded',sans-serif;">Atalhos Rápidos</h3>
                        </div>
                        <div class="grid grid-cols-2 sm:grid-cols-3 gap-3">
                            @php
                                $shortcuts = [
                                    [
                                        'label' => 'Matérias',
                                        'href' => '/subjects',
                                        'icon' =>
                                            '<path d="M4 19.5A2.5 2.5 0 016.5 17H20" stroke-width="2"/><path d="M6.5 2H20v20H6.5A2.5 2.5 0 014 19.5v-15A2.5 2.5 0 016.5 2z" stroke-width="2"/>',
                                        'bg' => 'bg-pink-50 dark:bg-pink-900/20',
                                        'text' => 'text-pink-600 dark:text-pink-400',
                                        'ic' => 'text-pink-500',
                                    ],
                                    [
                                        'label' => 'Horários',
                                        'href' => '/horary',
                                        'icon' =>
                                            '<circle cx="12" cy="12" r="10" stroke-width="2"/><path d="M12 6v6l4 2" stroke-width="2" stroke-linecap="round"/>',
                                        'bg' => 'bg-blue-50 dark:bg-blue-900/20',
                                        'text' => 'text-blue-600 dark:text-blue-400',
                                        'ic' => 'text-blue-500',
                                    ],
                                    [
                                        'label' => 'Provas',
                                        'href' => '/exams',
                                        'icon' =>
                                            '<path d="M9 11l3 3L22 4" stroke-width="2"/><path d="M21 12v7a2 2 0 01-2 2H5a2 2 0 01-2-2V5a2 2 0 012-2h11" stroke-width="2"/>',
                                        'bg' => 'bg-amber-50 dark:bg-amber-900/20',
                                        'text' => 'text-amber-600 dark:text-amber-400',
                                        'ic' => 'text-amber-500',
                                    ],
                                    [
                                        'label' => 'Trabalhos',
                                        'href' => '/works',
                                        'icon' =>
                                            '<path d="M14 2H6a2 2 0 00-2 2v16a2 2 0 002 2h12a2 2 0 002-2V8z" stroke-width="2"/><path d="M14 2v6h6" stroke-width="2"/>',
                                        'bg' => 'bg-green-50 dark:bg-green-900/20',
                                        'text' => 'text-green-600 dark:text-green-400',
                                        'ic' => 'text-green-500',
                                    ],
                                    [
                                        'label' => 'Boletim',
                                        'href' => '#',
                                        'icon' =>
                                            '<path d="M12 2l3.09 6.26L22 9.27l-5 4.87 1.18 6.88L12 17.77l-6.18 3.25L7 14.14 2 9.27l6.91-1.01L12 2z" stroke-width="2"/>',
                                        'bg' => 'bg-purple-50 dark:bg-purple-900/20',
                                        'text' => 'text-purple-600 dark:text-purple-400',
                                        'ic' => 'text-purple-500',
                                    ],
                                    [
                                        'label' => 'Calendário',
                                        'href' => '#',
                                        'icon' =>
                                            '<rect x="3" y="4" width="18" height="18" rx="2" ry="2" stroke-width="2"/><line x1="16" y1="2" x2="16" y2="6" stroke-width="2"/><line x1="8" y1="2" x2="8" y2="6" stroke-width="2"/><line x1="3" y1="10" x2="21" y2="10" stroke-width="2"/>',
                                        'bg' => 'bg-indigo-50 dark:bg-indigo-900/20',
                                        'text' => 'text-indigo-600 dark:text-indigo-400',
                                        'ic' => 'text-indigo-500',
                                    ],
                                ];
                            @endphp
                            @foreach ($shortcuts as $s)
                                <a href="{{ $s['href'] }}"
                                    class="flex flex-col items-center justify-center gap-2 rounded-2xl p-3 shadow-sm border border-gray-100 dark:border-gray-800 hover:border-pink-200 transition-all duration-200 group w-full {{ $s['bg'] }}">
                                    <svg class="w-5 h-5 {{ $s['ic'] }} group-hover:scale-110 transition-transform" fill="none"
                                        stroke="currentColor" viewBox="0 0 24 24">{!! $s['icon'] !!}</svg>
                                    <span
                                        class="text-[9px] font-black uppercase tracking-wide {{ $s['text'] }}">{{ $s['label'] }}</span>
                                </a>
                            @endforeach
                        </div>
                    </div>

                    {{-- Carga Horária Semanal --}}
                    <div
                        class="bg-white dark:bg-[#18181b] rounded-3xl border border-gray-100 dark:border-gray-800 shadow-sm p-6 flex flex-col">
                        <div class="flex items-center justify-between mb-4">
                            <div>
                                <h3 class="text-sm font-black text-gray-900 dark:text-white"
                                    style="font-family:'Unbounded',sans-serif;">Carga Semanal</h3>
                                <p class="text-[10px] font-semibold text-gray-400 uppercase tracking-widest mt-0.5">
                                    Atividades por Dia</p>
                            </div>
                        </div>
                        <div style="height:200px;position:relative;" class="flex-1 w-full">
                            <canvas id="chartWeeklyLoad"></canvas>
                        </div>
                    </div>
                </div>

                {{-- Volume por Matéria --}}
                <div
                    class="bg-white dark:bg-[#18181b] rounded-3xl border border-gray-100 dark:border-gray-800 shadow-sm p-6 flex flex-col">
                    <div class="flex items-center justify-between mb-4">
                        <div>
                            <h3 class="text-sm font-black text-gray-900 dark:text-white"
                                style="font-family:'Unbounded',sans-serif;">Volume por Matéria</h3>
                            <p class="text-[10px] font-semibold text-gray-400 uppercase tracking-widest mt-0.5">Atividades
                                por Disciplina</p>
                        </div>
                    </div>
                    <div style="height:180px;position:relative;" class="w-full">
                        <canvas id="chartSubjects"></canvas>
                    </div>
                </div>

                {{-- Histórico 7 dias --}}
                <div
                    class="bg-white dark:bg-[#18181b] rounded-3xl border border-gray-100 dark:border-gray-800 shadow-sm p-6">
                    <div class="flex flex-wrap items-center justify-between gap-4 mb-6">
                        <div class="flex items-center gap-3">
                            <div class="w-10 h-10 rounded-2xl bg-gray-50 dark:bg-gray-800 flex items-center justify-center">
                                <svg class="w-5 h-5 text-pink-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path d="M7 12l3-3 3 3 4-4M8 21l4-4 4 4M3 4h18M4 4h16v12a1 1 0 01-1 1H5a1 1 0 01-1-1V4z"
                                        stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                                </svg>
                            </div>
                            <div>
                                <h3 class="text-sm font-black text-gray-900 dark:text-white"
                                    style="font-family:'Unbounded',sans-serif;">Fluxo de Entregas</h3>
                                <p class="text-[10px] font-semibold text-gray-400 uppercase tracking-widest mt-0.5">Últimos
                                    7 dias</p>
                            </div>
                        </div>

                        <div
                            class="flex items-center gap-3 text-[10px] font-bold text-gray-500 bg-gray-50 dark:bg-gray-800/50 px-3 py-1.5 rounded-full border border-gray-100 dark:border-gray-700">
                            <span class="flex items-center gap-1.5"><span
                                    class="w-2 h-2 rounded-full bg-pink-500 inline-block shadow-[0_0_8px_rgba(236,72,153,0.5)]"></span>Concluídas</span>
                            <span class="flex items-center gap-1.5 ml-2"><span
                                    class="w-2 h-2 rounded-full bg-red-400 inline-block"></span>Atrasadas</span>
                        </div>
                    </div>

                    <div style="height:220px; position:relative;" class="w-full">
                        <canvas id="chartWeek"></canvas>
                    </div>
                </div>

                {{-- Histórico de Atividades --}}
                <div
                    class="bg-white dark:bg-[#18181b] rounded-3xl border border-gray-100 dark:border-gray-800 shadow-sm overflow-hidden flex flex-col">
                    <div
                        class="px-6 py-5 flex items-center justify-between border-b border-gray-50 dark:border-gray-800/60">
                        <h3 class="text-sm font-black text-gray-900 dark:text-gray-100"
                            style="font-family:'Unbounded',sans-serif;">Histórico de Atividades</h3>
                        <a href="/activities"
                            class="bg-gray-50 dark:bg-gray-800 hover:bg-gray-100 dark:hover:bg-gray-700 text-gray-600 dark:text-gray-300 text-[10px] font-bold px-3 py-1.5 rounded-lg transition-colors border border-gray-100 dark:border-gray-700 flex items-center gap-1">
                            Ver tudo <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path d="M9 5l7 7-7 7" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                            </svg>
                        </a>
                    </div>

                    <div id="recentActivities" class="flex-1 overflow-y-auto">
                        @for ($i = 0; $i < 4; $i++)
                            <div
                                class="mx-4 my-2 px-6 py-5 flex items-center justify-between bg-gray-50/30 dark:bg-gray-800/20 rounded-2xl animate-pulse">
                                <div class="flex items-center gap-4 flex-1">
                                    <div class="w-12 h-12 rounded-2xl bg-gray-100 dark:bg-gray-800"></div>
                                    <div class="space-y-2 flex-1">
                                        <div class="h-4 w-3/4 bg-gray-100 dark:bg-gray-800 rounded"></div>
                                        <div class="h-2 w-1/4 bg-gray-100 dark:bg-gray-800 rounded"></div>
                                    </div>
                                </div>
                                <div class="w-16 h-6 bg-gray-100 dark:bg-gray-800 rounded-full"></div>
                            </div>
                        @endfor
                    </div>
                </div>
            </div>

            {{-- ════════ RIGHT COLUMN (Sidebar Stats) ════════ --}}
            <div class="xl:col-span-1 flex flex-col gap-6">

                {{-- Próxima Prova Urgente --}}
                <div class="relative rounded-3xl p-6 shadow-xl shadow-pink-500/20 dark:shadow-pink-900/20 overflow-hidden min-h-[220px] flex flex-col justify-between group cursor-default"
                    style="background:linear-gradient(135deg, #db2777 0%, #be185d 100%);">

                    <div
                        class="absolute top-0 right-0 p-4 opacity-10 group-hover:scale-110 transition-transform duration-500 pointer-events-none">
                        <svg class="w-24 h-24 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1"
                                d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253" />
                        </svg>
                    </div>

                    <div class="relative z-10 flex justify-between items-start mb-6">
                        <div
                            class="w-10 h-10 rounded-xl bg-white/10 backdrop-blur-sm border border-white/20 flex items-center justify-center">
                            <svg class="w-5 h-5 text-white/90" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                            </svg>
                        </div>
                        <span
                            class="text-white/80 text-[10px] font-black uppercase tracking-widest bg-white/10 px-2 py-1 rounded-full">Foco
                            Atual</span>
                    </div>

                    <div class="relative z-10 flex-1 mt-2">
                        <h3 class="text-white/90 text-[11px] font-semibold uppercase tracking-[.2em] mb-1">Próxima Prova
                        </h3>
                        <div id="nextExamCard" class="min-h-[60px]">
                            <div class="h-4 w-32 bg-white/20 rounded animate-pulse mb-2"></div>
                            <div class="h-3 w-20 bg-white/10 rounded animate-pulse"></div>
                        </div>
                    </div>

                    <div
                        class="relative z-10 items-center justify-between border-t border-white/20 pt-4 mt-2 hidden lg:flex">
                        <div>
                            <p class="text-white/50 text-[8px] font-black uppercase tracking-widest mb-0.5">Acesso Rápido
                            </p>
                            <p class="text-white font-bold text-xs" style="font-family:'Unbounded',sans-serif;">Ver Agenda
                            </p>
                        </div>
                        <a href="/exams"
                            class="w-8 h-8 rounded-full bg-white/10 hover:bg-white/20 flex items-center justify-center transition-colors border border-white/20">
                            <svg class="w-4 h-4 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path d="M9 5l7 7-7 7" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                            </svg>
                        </a>
                    </div>
                </div>

                {{-- Gamificação --}}
                <div
                    class="bg-white dark:bg-[#18181b] rounded-3xl p-6 border border-gray-100 dark:border-gray-800 shadow-sm overflow-hidden relative group">
                    <div class="absolute top-0 right-0 w-24 h-24 bg-pink-500/5 rounded-full -mr-10 -mt-10 blur-2xl"></div>

                    <div class="flex items-center justify-between mb-6 relative z-10">
                        <div class="flex items-center gap-3">
                            <div
                                class="w-10 h-10 rounded-xl bg-pink-500 flex items-center justify-center text-white shadow-lg shadow-pink-500/30">
                                <span id="userLevel" class="text-sm font-black">1</span>
                            </div>
                            <div>
                                <p class="text-[10px] font-black text-gray-400 uppercase tracking-widest leading-tight">
                                    Nível Atual</p>
                                <p id="rankName" class="text-xs font-bold text-gray-900 dark:text-white"
                                    style="font-family:'Unbounded',sans-serif;">Explorador</p>
                            </div>
                        </div>
                        {{-- Streak / Foguinho --}}
                        <div
                            class="flex items-center gap-2 bg-orange-50 dark:bg-orange-950/20 px-3 py-2 rounded-xl border border-orange-100 dark:border-orange-900/30">
                            <span class="text-lg">🔥</span>
                            <span id="userStreak" class="text-sm font-black text-orange-600 dark:text-orange-500">0</span>
                        </div>
                    </div>

                    <div class="space-y-4 relative z-10">
                        <div>
                            <div class="flex justify-between items-end mb-2">
                                <p class="text-[10px] font-black text-gray-400 uppercase tracking-widest">Progresso do Nível
                                </p>
                                <p class="text-[10px] font-bold text-pink-500"><span id="currentXP">0</span> / 1000 XP</p>
                            </div>
                            <div class="h-2.5 bg-gray-100 dark:bg-gray-800 rounded-full overflow-hidden p-0.5">
                                <div id="xpBar"
                                    class="h-full bg-gradient-to-r from-pink-500 to-rose-400 rounded-full transition-all duration-1000 shadow-sm"
                                    style="width: 0%"></div>
                            </div>
                        </div>

                        <div class="grid grid-cols-2 gap-3">
                            <div
                                class="bg-gray-50 dark:bg-gray-800/40 p-3 rounded-2xl border border-gray-100 dark:border-gray-700/50">
                                <p class="text-[8px] font-black text-gray-400 uppercase tracking-[0.15em] mb-1">XP Total</p>
                                <p id="totalXP" class="text-sm font-black text-gray-900 dark:text-white"
                                    style="font-family:'Unbounded',sans-serif;">0</p>
                            </div>
                            <div
                                class="bg-gray-50 dark:bg-gray-800/40 p-3 rounded-2xl border border-gray-100 dark:border-gray-700/50">
                                <p class="text-[8px] font-black text-gray-400 uppercase tracking-[0.15em] mb-1">Próximo
                                    Marco</p>
                                <p class="text-sm font-black text-pink-500" style="font-family:'Unbounded',sans-serif;">+150
                                    XP</p>
                            </div>
                        </div>
                    </div>
                </div>

                {{-- Eficiência --}}
                <div
                    class="bg-white dark:bg-[#18181b] rounded-3xl border border-gray-100 dark:border-gray-800 shadow-sm p-6">
                    <div class="flex items-center justify-between mb-4">
                        <div class="flex items-center gap-2">
                            <div class="w-7 h-7 rounded-lg bg-pink-50 dark:bg-pink-900/20 flex items-center justify-center">
                                <svg class="w-3.5 h-3.5 text-pink-500" fill="none" stroke="currentColor"
                                    viewBox="0 0 24 24">
                                    <path d="M13 2L3 14h9l-1 8 10-12h-9l1-8z" stroke-width="2" stroke-linecap="round"
                                        stroke-linejoin="round" />
                                </svg>
                            </div>
                            <h3 class="text-sm font-black text-gray-900 dark:text-white"
                                style="font-family:'Unbounded',sans-serif;">Eficiência</h3>
                        </div>
                    </div>

                    <div class="mb-5 flex items-end gap-3">
                        <p id="completionRate" class="text-4xl font-black text-pink-600 dark:text-pink-400 leading-none"
                            style="font-family:'Unbounded',sans-serif;">—</p>
                        <p class="text-xs text-gray-400 font-semibold mb-1 uppercase">concluído</p>
                    </div>

                    <div class="w-full h-2 rounded-full bg-gray-100 dark:bg-gray-800 overflow-hidden mb-5">
                        <div id="completionBar"
                            class="h-full rounded-full bg-gradient-to-r from-pink-500 to-pink-300 transition-all duration-1000"
                            style="width:0%"></div>
                    </div>

                    <div class="space-y-3" id="completionBreakdown">
                        {{-- Filled by JS --}}
                    </div>
                </div>

                {{-- Matérias List --}}
                <div
                    class="bg-white dark:bg-[#18181b] rounded-3xl border border-gray-100 dark:border-gray-800 shadow-sm overflow-hidden flex flex-col">
                    <div
                        class="px-5 py-4 flex items-center justify-between border-b border-gray-50 dark:border-gray-800/60 bg-gray-50/50 dark:bg-gray-800/20">
                        <div class="flex items-center gap-2">
                            <svg class="w-4 h-4 text-pink-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path d="M4 19.5A2.5 2.5 0 016.5 17H20" stroke-width="2" />
                                <path d="M6.5 2H20v20H6.5A2.5 2.5 0 014 19.5v-15A2.5 2.5 0 016.5 2z" stroke-width="2" />
                            </svg>
                            <h3 class="text-sm font-black text-gray-900 dark:text-white"
                                style="font-family:'Unbounded',sans-serif;">Matérias</h3>
                        </div>
                        <span id="statSubjects"
                            class="bg-pink-100 dark:bg-pink-900/30 text-pink-600 dark:text-pink-400 text-[10px] font-black px-2 py-0.5 rounded-md">—</span>
                    </div>
                    <div id="subjectsList" class="flex-1 divide-y divide-gray-50 dark:divide-gray-800/60">
                        @for ($i = 0; $i < 3; $i++)
                            <div class="flex items-center gap-3 px-5 py-3">
                                <div class="w-8 h-8 rounded-lg bg-gray-100 dark:bg-gray-800 animate-pulse shrink-0"></div>
                                <div class="w-full">
                                    <div
                                        class="h-3 w-3/4 max-w-[120px] bg-gray-100 dark:bg-gray-800 rounded animate-pulse mb-1.5">
                                    </div>
                                    <div class="h-2 w-1/2 max-w-[80px] bg-gray-100 dark:bg-gray-800 rounded animate-pulse">
                                    </div>
                                </div>
                            </div>
                        @endfor
                    </div>
                </div>

                {{-- Timeline Visual --}}
                <div
                    class="bg-white dark:bg-[#18181b] rounded-3xl border border-gray-100 dark:border-gray-800 shadow-sm overflow-hidden flex flex-col">
                    <div
                        class="px-5 py-4 flex items-center justify-between border-b border-gray-50 dark:border-gray-800/60 bg-gray-50/30 dark:bg-gray-800/20">
                        <h3 class="text-sm font-black text-gray-900 dark:text-white"
                            style="font-family:'Unbounded',sans-serif;">Timeline de Entregas</h3>
                    </div>
                    <div id="visualTimeline" class="px-5 py-3 space-y-3">
                        {{-- Filled by JS --}}
                    </div>

                    {{-- Slider Motivacional --}}
                    <div
                        class="relative rounded-3xl overflow-hidden bg-gradient-to-br from-pink-600 to-rose-400 p-6 shadow-lg shadow-pink-500/20 group">
                        <div class="absolute top-0 right-0 p-4 opacity-20 group-hover:scale-110 transition-transform">
                            <svg class="w-12 h-12 text-white" fill="currentColor" viewBox="0 0 24 24">
                                <path
                                    d="M14.017 21L14.017 18C14.017 16.8954 13.1216 16 12.017 16H8.01703V12H12.017C14.2261 12 16.017 10.2091 16.017 8C16.017 5.79086 14.2261 4 12.017 4H5.01703V21H14.017ZM19.017 21V4H21.017V21H19.017Z"
                                    opacity="0.3" />
                                <path
                                    d="M11.19 2H5V22H11.19K11.19 2C13.84 2 16 4.16 16 6.81C16 9.46 13.84 11.62 11.19 11.62H5"
                                    fill="none" stroke="white" stroke-width="1.5" />
                            </svg>
                        </div>
                        <div class="relative z-10 min-h-[80px] flex flex-col justify-center">
                            <p id="slideQuote"
                                class="text-white font-bold text-sm leading-relaxed mb-3 transition-opacity duration-500 italic"
                                style="font-family:'Unbounded',sans-serif;">
                                "A educação é a arma mais poderosa que você pode usar para mudar o mundo."
                            </p>
                            <p id="slideAuthor"
                                class="text-pink-100 text-[9px] font-black uppercase tracking-[0.2em] transition-opacity duration-500">
                                Nelson Mandela
                            </p>
                        </div>
                        <div class="flex gap-1.5 mt-4">
                            <div class="h-1 w-6 bg-white rounded-full opacity-100" id="dot0"></div>
                            <div class="h-1 w-2 bg-white/30 rounded-full" id="dot1"></div>
                            <div class="h-1 w-2 bg-white/30 rounded-full" id="dot2"></div>
                        </div>
                    </div>

                </div>
            </div>
        </div>

        {{-- Chart.js --}}
        <script src="https://cdn.jsdelivr.net/npm/chart.js@4.4.0/dist/chart.umd.min.js"></script>
        <script src="{{ asset('js/dashboard.js') }}"></script>
@endsection