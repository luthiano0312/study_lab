@extends('layouts.app')

@section('content')
    <div class="min-h-full space-y-10" style="font-family:'DM Sans',sans-serif;">


        <section class="space-y-4">

            <div class="grid grid-cols-1 lg:grid-cols-5 gap-4">

                <div class="lg:col-span-3 relative rounded-3xl overflow-hidden min-h-[200px]"
                    style="background:linear-gradient(130deg,#9d174d 0%,#db2777 42%,#ec4899 74%,#fda4af 100%);">
                    <div class="absolute inset-0 pointer-events-none opacity-[.08]"
                        style="background-image:radial-gradient(#fff 1px,transparent 1px);background-size:20px 20px;"></div>
                    <div class="absolute -top-10 -right-10 w-52 h-52 rounded-full pointer-events-none opacity-[.15]"
                        style="background:radial-gradient(circle,#fff,transparent 70%);"></div>
                    <div class="relative z-10 p-7 flex flex-col justify-between h-full gap-5">
                        <div>
                            <p class="text-pink-200 text-[10px] font-black uppercase tracking-[.22em] mb-1">StudyLab</p>
                            <h1 class="text-white font-black leading-[1.1] mb-1.5"
                                style="font-family:'Syne',sans-serif;font-size:clamp(1.65rem,3.5vw,2.4rem);">
                                Olá, <span id="greetName">Estudante</span>
                            </h1>
                            <p class="text-pink-100/80 text-sm">Pronto pra mais um dia de foco?</p>
                        </div>
                        <div
                            class="flex items-center gap-3 bg-white/10 border border-white/20 rounded-2xl px-4 py-2.5 w-fit backdrop-blur-sm">
                            <div
                                class="w-8 h-8 rounded-xl overflow-hidden bg-white/20 flex-shrink-0 flex items-center justify-center border border-white/20">
                                <img id="userAvatar" src="" alt="" class="w-full h-full object-cover hidden">
                                <div id="avatarFallback">
                                    <svg class="w-4 h-4 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <circle cx="12" cy="8" r="4" stroke-width="2" />
                                        <path d="M4 20c0-4 3.6-7 8-7s8 3 8 7" stroke-width="2" stroke-linecap="round" />
                                    </svg>
                                </div>
                            </div>
                            <div class="leading-tight">
                                <p class="text-pink-200 text-[10px] font-semibold">Bem-vindo de volta</p>
                                <p id="userName" class="text-white text-[13px] font-black">Estudante</p>
                            </div>
                        </div>
                    </div>
                </div>

                <div
                    class="lg:col-span-2 bg-white  dark:bg-[#18181b] rounded-3xl border border-pink-100 dark:border-gray-800 shadow-sm p-7 flex flex-col justify-between gap-4 transition-colors duration-200">
                    <div class="flex gap-10">
                        <div>
                            <p class="text-[10px] font-black uppercase tracking-[.22em] text-pink-400 mb-3">Agora</p>
                            <div id="clock" class="font-black text-gray-900 dark:text-gray-100 tabular-nums leading-none"
                                style="font-family:'Syne',sans-serif;font-size:clamp(2.6rem,6vw,4rem);">00:00</div>
                            <p class="text-sm font-semibold text-gray-400 mt-2">{{ now()->translatedFormat('l') }}</p>
                            <p class="text-xs text-gray-300 mt-0.5">{{ now()->translatedFormat('d \d\e F \d\e Y') }}</p>
                        </div>
                        <div>
                            <img class="w-[300px]" src="{{ asset('images/image.png') }}" alt="">
                        </div>
                    </div>

                </div>
            </div>

            <div class="relative">
                <div class="overflow-hidden rounded-2xl">
                    <div id="carouselTrack" class="flex" style="transition:transform .42s cubic-bezier(.4,0,.2,1);">

                        @php
                            $slides = [
                                [
                                    'grad' => '#be185d,#ec4899',
                                    'title' => 'Mantenha o foco',
                                    'sub' => 'Revise suas atividades pendentes e priorize o que importa hoje.',
                                    'href' => '/activities',
                                    'cta' => 'Ver atividades',
                                    'icon' =>
                                        '<path d="M9 11l3 3L22 4" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"/><path d="M21 12v7a2 2 0 01-2 2H5a2 2 0 01-2-2V5a2 2 0 012-2h11" stroke-width="2" stroke-linecap="round"/>',
                                ],
                                [
                                    'grad' => '#7c3aed,#db2777',
                                    'title' => 'Provas chegando',
                                    'sub' => 'Confira o calendário e planeje seus estudos com antecedência.',
                                    'href' => '/exams',
                                    'cta' => 'Ver provas',
                                    'icon' =>
                                        '<rect x="3" y="4" width="18" height="18" rx="2" stroke-width="2.5"/><path d="M16 2v4M8 2v4M3 10h18" stroke-width="2.5" stroke-linecap="round"/>',
                                ],
                                [
                                    'grad' => '#9d174d,#7c3aed',
                                    'title' => 'Organize as matérias',
                                    'sub' => 'Mantenha suas matérias atualizadas para não perder nenhum prazo.',
                                    'href' => '/subject',
                                    'cta' => 'Ver matérias',
                                    'icon' =>
                                        '<path d="M4 19.5A2.5 2.5 0 016.5 17H20" stroke-width="2.5" stroke-linecap="round"/><path d="M6.5 2H20v20H6.5A2.5 2.5 0 014 19.5v-15A2.5 2.5 0 016.5 2z" stroke-width="2.5"/>',
                                ],
                                [
                                    'grad' => '#db2777,#f43f5e',
                                    'title' => 'Nova atividade',
                                    'sub' => 'Registre tarefas rapidamente antes de esquecer.',
                                    'href' => '/activities/create',
                                    'cta' => 'Criar agora',
                                    'icon' => '<path d="M12 5v14M5 12h14" stroke-width="2.5" stroke-linecap="round"/>',
                                ],
                            ];
                        @endphp

                        @foreach ($slides as $slide)
                            <div class="min-w-full">
                                <div class="rounded-2xl px-6 py-5 flex items-center justify-between gap-4 relative overflow-hidden"
                                    style="background:linear-gradient(120deg,{{ $slide['grad'] }});">
                                    <div class="absolute inset-0 pointer-events-none opacity-[.08]"
                                        style="background-image:radial-gradient(#fff 1px,transparent 1px);background-size:16px 16px;">
                                    </div>
                                    <div class="relative z-10 flex items-center gap-4 min-w-0">
                                        <div
                                            class="w-10 h-10 rounded-xl bg-white/20 flex items-center justify-center flex-shrink-0">
                                            <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor"
                                                viewBox="0 0 24 24">{!! $slide['icon'] !!}</svg>
                                        </div>
                                        <div class="min-w-0">
                                            <p class="text-white font-black text-base leading-tight truncate"
                                                style="font-famkily:'Syne',sans-serif;">{{ $slide['title'] }}</p>
                                            <p class="text-white/65 text-xs mt-0.5 line-clamp-1">{{ $slide['sub'] }}</p>
                                        </div>
                                    </div>
                                    <a href="{{ $slide['href'] }}"
                                        class="relative z-10 flex-shrink-0 bg-white/20 hover:bg-white/30 border border-white/30
                                                                                                                                                                              text-white text-[11px] font-black uppercase tracking-wide
                                                                                                                                                                              px-4 py-2 rounded-xl transition-all duration-200 whitespace-nowrap">
                                        {{ $slide['cta'] }} →
                                    </a>
                                </div>
                            </div>
                        @endforeach

                    </div>
                </div>
                <div id="carouselDots" class="flex items-center justify-center gap-1.5 mt-2.5">
                    @foreach ($slides as $i => $_)
                        <button data-dot="{{ $i }}"
                            class="h-1.5 rounded-full transition-all duration-300 {{ $i === 0 ? 'bg-pink-500 w-4' : 'bg-pink-200 w-1.5' }}">
                        </button>
                    @endforeach
                </div>
            </div>

        </section>

        <section class="space-y-4">

            <div class="flex items-center gap-2">
                <span class="w-1 h-5 rounded-full bg-gradient-to-b from-pink-600 to-pink-300"></span>
                <h2 class="text-sm font-black text-gray-800 dark:text-gray-100 uppercase tracking-widest"
                    style="font-family:'Syne',sans-serif;">Atalhos</h2>
            </div>

            <div class="grid grid-cols-2 sm:grid-cols-3 lg:grid-cols-6 gap-3">
                @php
                    $shortcuts = [
                        [
                            'href' => '/activities',
                            'label' => 'Atividades',
                            'bg' => 'bg-pink-50 dark:bg-pink-900/20 hover:bg-pink-100 dark:hover:bg-pink-900/40',
                            'text' => 'text-pink-600 dark:text-pink-400',
                            'ibg' => 'bg-white dark:bg-gray-800',
                            'ic' => 'text-pink-500 dark:text-pink-400',
                            'icon' =>
                                '<path d="M9 11l3 3L22 4" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"/><path d="M21 12v7a2 2 0 01-2 2H5a2 2 0 01-2-2V5a2 2 0 012-2h11" stroke-width="2" stroke-linecap="round"/>',
                        ],
                        [
                            'href' => '/exams',
                            'label' => 'Provas',
                            'bg' => 'bg-rose-50 dark:bg-rose-900/20 hover:bg-rose-100 dark:hover:bg-rose-900/40',
                            'text' => 'text-rose-600 dark:text-rose-400',
                            'ibg' => 'bg-white dark:bg-gray-800',
                            'ic' => 'text-rose-500 dark:text-rose-400',
                            'icon' =>
                                '<rect x="3" y="4" width="18" height="18" rx="2" stroke-width="2"/><path d="M16 2v4M8 2v4M3 10h18" stroke-width="2" stroke-linecap="round"/>',
                        ],
                        [
                            'href' => '/subject',
                            'label' => 'Matérias',
                            'bg' => 'bg-fuchsia-50 dark:bg-fuchsia-900/20 hover:bg-fuchsia-100 dark:hover:bg-fuchsia-900/40',
                            'text' => 'text-fuchsia-600 dark:text-fuchsia-400',
                            'ibg' => 'bg-white dark:bg-gray-800',
                            'ic' => 'text-fuchsia-500 dark:text-fuchsia-400',
                            'icon' =>
                                '<path d="M4 19.5A2.5 2.5 0 016.5 17H20" stroke-width="2"/><path d="M6.5 2H20v20H6.5A2.5 2.5 0 014 19.5v-15A2.5 2.5 0 016.5 2z" stroke-width="2"/>',
                        ],
                        [
                            'href' => '/profile',
                            'label' => 'Perfil',
                            'bg' => 'bg-gray-50 dark:bg-[#18181b] hover:bg-gray-100 dark:hover:bg-gray-800',
                            'text' => 'text-gray-600 dark:text-gray-300',
                            'ibg' => 'bg-white dark:bg-gray-800',
                            'ic' => 'text-gray-500 dark:text-gray-400',
                            'icon' =>
                                '<circle cx="12" cy="8" r="4" stroke-width="2"/><path d="M4 20c0-4 3.6-7 8-7s8 3 8 7" stroke-width="2" stroke-linecap="round"/>',
                        ],
                        [
                            'href' => '/horary',
                            'label' => 'Horários',
                            'bg' => 'bg-gray-50 dark:bg-[#18181b] hover:bg-gray-100 dark:hover:bg-gray-800',
                            'text' => 'text-gray-600 dark:text-gray-300',
                            'ibg' => 'bg-white dark:bg-gray-800',
                            'ic' => 'text-gray-500 dark:text-gray-400',
                            'icon' =>
                                '<rect x="3" y="4" width="18" height="18" rx="2" stroke-width="2"/><path d="M16 2v4M8 2v4M3 10h18" stroke-width="2" stroke-linecap="round"/><path d="M8 14h.01M12 14h.01M16 14h.01" stroke-width="2.5" stroke-linecap="round"/>',
                        ],
                        [
                            'href' => '/activities/create',
                            'label' => 'Nova Ativ.',
                            'bg' => 'bg-pink-600 hover:bg-pink-700',
                            'text' => 'text-white',
                            'ibg' => 'bg-white/20',
                            'ic' => 'text-white',
                            'icon' => '<path d="M12 5v14M5 12h14" stroke-width="2.5" stroke-linecap="round"/>',
                        ],
                    ];
                @endphp

                @foreach ($shortcuts as $s)
                    <a href="{{ $s['href'] }}"
                        class="flex flex-col items-center gap-2.5 rounded-2xl p-5 shadow-sm border border-transparent
                                                                                                                                                              hover:border-pink-100 hover:-translate-y-1 transition-all duration-200 group {{ $s['bg'] }}">
                        <div
                            class="w-10 h-10 rounded-xl {{ $s['ibg'] }} flex items-center justify-center shadow-sm group-hover:scale-110 transition-transform duration-200">
                            <svg class="w-5 h-5 {{ $s['ic'] }}" fill="none" stroke="currentColor"
                                viewBox="0 0 24 24">{!! $s['icon'] !!}</svg>
                        </div>
                        <span class="text-[11px] font-black uppercase tracking-wide {{ $s['text'] }}">{{ $s['label'] }}</span>
                    </a>
                @endforeach
            </div>
        </section>

        <section class="space-y-5">

            <div class="flex items-center gap-2">
                <span class="w-1 h-5 rounded-full bg-gradient-to-b from-pink-600 to-pink-300"></span>
                <h2 class="text-sm font-black text-gray-800 dark:text-gray-100 uppercase tracking-widest"
                    style="font-family:'Syne',sans-serif;">Seus dados</h2>
            </div>

            <div class="grid grid-cols-2 sm:grid-cols-4 gap-3">

                <div
                    class="bg-white dark:bg-[#18181b] rounded-2xl p-4 border-gray-300 dark:border-gray-500 ring-1 ring-white dark:ring-gray-500 shadow-sm hover:-translate-y-1 transition-transform duration-200 cursor-default">
                    <div class="flex items-center justify-between mb-3">
                        <div class="w-8 h-8 rounded-xl bg-gray-200 dark:bg-white/20 flex items-center justify-center">
                            <svg class="w-4 h-4 text-black dark:text-white" fill="none" stroke="currentColor"
                                viewBox="0 0 24 24">
                                <circle cx="12" cy="12" r="10" stroke-width="2" />
                                <path d="M12 6v6l4 2" stroke-width="2" stroke-linecap="round" />
                            </svg>
                        </div>
                        <span class="w-2 h-2 rounded-full bg-gray-500/40"></span>
                    </div>
                    <p class="text-3xl  font-black tabular-nums text-black dark:text-white leading-none" id="statPending"
                        data-counter style="font-family:'Syne',sans-serif;">—</p>
                    <p class="text-[10px] font-bold uppercase tracking-widest text-gray-500 mt-1.5">Pendentes</p>
                </div>

                <div
                    class="bg-white dark:bg-[#18181b] rounded-2xl p-4 border border-green-100 dark:border-gray-800 ring-1 ring-green-200 dark:ring-green-900 shadow-sm hover:-translate-y-1 transition-transform duration-200 cursor-default">
                    <div class="flex items-center justify-between mb-3">
                        <div class="w-8 h-8 rounded-xl bg-green-50 dark:bg-green-900/30 flex items-center justify-center">
                            <svg class="w-4 h-4 text-green-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path d="M20 6L9 17l-5-5" stroke-width="2.5" stroke-linecap="round"
                                    stroke-linejoin="round" />
                            </svg>
                        </div>
                        <span class="w-2 h-2 rounded-full bg-green-400"></span>
                    </div>
                    <p class="text-3xl font-black tabular-nums text-gray-900 dark:text-gray-100 leading-none" id="statDone"
                        data-counter style="font-family:'Syne',sans-serif;">—</p>
                    <p class="text-[10px] font-bold uppercase tracking-widest text-gray-400 dark:text-gray-500 mt-1.5">
                        Concluídas</p>
                </div>

                <div
                    class="bg-white dark:bg-[#18181b] rounded-2xl p-4 border border-red-100 dark:border-gray-800 ring-1 ring-red-200 dark:ring-red-900 shadow-sm hover:-translate-y-1 transition-transform duration-200 cursor-default">
                    <div class="flex items-center justify-between mb-3">
                        <div class="w-8 h-8 rounded-xl bg-red-50 dark:bg-red-900/30 flex items-center justify-center">
                            <svg class="w-4 h-4 text-red-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path
                                    d="M10.29 3.86L1.82 18a2 2 0 001.71 3h16.94a2 2 0 001.71-3L13.71 3.86a2 2 0 00-3.42 0z"
                                    stroke-width="2" />
                                <line x1="12" y1="9" x2="12" y2="13" stroke-width="2" stroke-linecap="round" />
                                <line x1="12" y1="17" x2="12.01" y2="17" stroke-width="2" stroke-linecap="round" />
                            </svg>
                        </div>
                        <span class="w-2 h-2 rounded-full bg-red-400"></span>
                    </div>
                    <p class="text-3xl font-black tabular-nums text-gray-900 dark:text-gray-100 leading-none"
                        id="statOverdue" data-counter style="font-family:'Syne',sans-serif;">—</p>
                    <p class="text-[10px] font-bold uppercase tracking-widest text-gray-400 dark:text-gray-500 mt-1.5">
                        Atrasadas</p>
                </div>

                <div
                    class="bg-pink-50 dark:bg-pink-900/20 rounded-2xl p-4 border border-pink-100 dark:border-pink-900/40 ring-1 ring-pink-200 dark:ring-pink-900 shadow-sm hover:-translate-y-1 transition-transform duration-200 cursor-default">
                    <div class="flex items-center justify-between mb-3">
                        <div class="w-8 h-8 rounded-xl bg-pink-100 flex items-center justify-center">
                            <svg class="w-4 h-4 text-pink-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <rect x="9" y="9" width="13" height="13" rx="2" stroke-width="2" />
                                <path d="M5 15H4a2 2 0 01-2-2V4a2 2 0 012-2h9a2 2 0 012 2v1" stroke-width="2" />
                            </svg>
                        </div>
                        <span class="w-2 h-2 rounded-full bg-pink-400"></span>
                    </div>
                    <p class="text-3xl font-black tabular-nums text-pink-700 leading-none" id="statTotal" data-counter
                        style="font-family:'Syne',sans-serif;">—</p>
                    <p class="text-[10px] font-bold uppercase tracking-widest text-pink-400 mt-1.5">Total</p>
                </div>

            </div>

            <div class="grid grid-cols-1 lg:grid-cols-5 gap-4">

                <div
                    class="lg:col-span-3 bg-white dark:bg-[#18181b] rounded-3xl border border-gray-100 dark:border-gray-800 shadow-sm overflow-hidden flex flex-col transition-colors duration-200">
                    <div class="h-[3px] bg-linear-to-r from-pink-600 via-pink-400 to-pink-200"></div>
                    <div class="px-6 py-4 flex items-center justify-between border-b border-gray-50 dark:border-gray-800">
                        <div class="flex items-center gap-2">
                            <span class="w-1.5 h-5 rounded-full bg-gradient-to-b from-pink-600 to-pink-300"></span>
                            <h3 class="text-sm font-black text-gray-900 dark:text-gray-100"
                                style="font-family:'Syne',sans-serif;">Atividades
                                recentes</h3>
                        </div>
                        <a href="/activities"
                            class="text-[11px] font-bold text-pink-500 hover:text-pink-700 transition-colors flex items-center gap-0.5">Ver
                            todas →</a>
                    </div>
                    <div id="recentActivities" class="flex-1 divide-y divide-gray-50 dark:divide-gray-800">
                        @for ($i = 0; $i < 4; $i++)
                            <div class="flex items-center justify-between px-6 py-3">
                                <div class="flex items-center gap-3">
                                    <div class="w-2 h-2 rounded-full bg-pink-100 dark:bg-pink-900 animate-pulse shrink-0"></div>
                                    <div>
                                        <div class="h-3 w-44 bg-gray-100 dark:bg-gray-800 rounded animate-pulse mb-1.5"></div>
                                        <div class="h-2 w-28 bg-gray-100 dark:bg-gray-800 rounded animate-pulse"></div>
                                    </div>
                                </div>
                                <div class="h-5 w-16 bg-gray-100 dark:bg-gray-800 rounded-full animate-pulse"></div>
                            </div>
                        @endfor
                    </div>
                    <div class="px-6 py-4 border-t border-gray-50 dark:border-gray-800 flex justify-center">
                        <a href="/activities/create"
                            class="inline-flex items-center gap-1.5 text-[11px] font-bold text-pink-500 border border-pink-200 hover:bg-pink-500 hover:text-white hover:border-pink-500 px-4 py-2 rounded-xl transition-all duration-200">
                            <svg class="w-3 h-3 shrink-0" fill="none" stroke="currentColor" stroke-width="3"
                                viewBox="0 0 24 24">
                                <line x1="12" y1="5" x2="12" y2="19" />
                                <line x1="5" y1="12" x2="19" y2="12" />
                            </svg>
                            Nova atividade
                        </a>
                    </div>
                </div>

                <div class="lg:col-span-2 flex flex-col gap-4">

                    <div
                        class="bg-white dark:bg-[#18181b] rounded-3xl border border-gray-100 dark:border-gray-800 shadow-sm overflow-hidden flex flex-col flex-1 transition-colors duration-200">
                        <div class="h-[3px] bg-linear-to-r from-pink-400 to-rose-300"></div>
                        <div
                            class="px-5 py-3.5 flex items-center justify-between border-b border-gray-50 dark:border-gray-800">
                            <div class="flex items-center gap-2">
                                <span class="w-1.5 h-4 rounded-full bg-gradient-to-b from-pink-400 to-pink-200"></span>
                                <h3 class="text-sm font-black text-gray-900 dark:text-gray-100"
                                    style="font-family:'Syne',sans-serif;">
                                    Próximas provas</h3>
                            </div>
                            <a href="/exams"
                                class="text-[11px] font-bold text-pink-500 hover:text-pink-700 transition-colors">Ver todas
                                →</a>
                        </div>
                        <div id="upcomingExams" class="flex-1 divide-y divide-gray-50 dark:divide-gray-800">
                            @for ($i = 0; $i < 3; $i++)
                                <div class="flex items-center justify-between px-5 py-3">
                                    <div>
                                        <div class="h-3 w-28 bg-gray-100 dark:bg-gray-800 rounded animate-pulse mb-1.5"></div>
                                        <div class="h-2 w-20 bg-gray-100 dark:bg-gray-800 rounded animate-pulse"></div>
                                    </div>
                                    <div class="h-3 w-14 bg-gray-100 dark:bg-gray-800 rounded animate-pulse"></div>
                                </div>
                            @endfor
                        </div>
                    </div>

                    <div class="bg-pink-600 rounded-3xl overflow-hidden flex flex-col flex-1 shadow-lg shadow-pink-200/40">
                        <div class="px-5 py-3.5 flex items-center justify-between border-b border-pink-500/60">
                            <div class="flex items-center gap-2">
                                <span class="w-1.5 h-4 rounded-full bg-pink-300"></span>
                                <h3 class="text-sm font-black text-white" style="font-family:'Syne',sans-serif;">Matérias
                                </h3>
                                <span id="statSubjects"
                                    class="bg-pink-500 text-pink-100 text-[10px] font-black px-2 py-0.5 rounded-full leading-none">—</span>
                            </div>
                            <a href="/subject"
                                class="text-[11px] font-bold text-pink-200 hover:text-white transition-colors">Ver todas
                                →</a>
                        </div>
                        <div id="subjectsList" class="flex-1 divide-y divide-pink-500/30">
                            @for ($i = 0; $i < 4; $i++)
                                <div class="flex items-center gap-3 px-5 py-2.5">
                                    <div class="w-7 h-7 rounded-lg bg-pink-500/50 animate-pulse shrink-0"></div>
                                    <div>
                                        <div class="h-3 w-28 bg-pink-500/40 rounded animate-pulse mb-1"></div>
                                        <div class="h-2 w-20 bg-pink-500/30 rounded animate-pulse"></div>
                                    </div>
                                </div>
                            @endfor
                        </div>
                        <div class="px-5 py-3 border-t border-pink-500/40 flex justify-center">
                            <a href="/subject/create"
                                class="inline-flex items-center gap-1.5 text-[11px] font-bold text-pink-100 border border-pink-400/70 hover:bg-white hover:text-pink-600 hover:border-white px-4 py-2 rounded-xl transition-all duration-200">
                                <svg class="w-3 h-3 shrink-0" fill="none" stroke="currentColor" stroke-width="3"
                                    viewBox="0 0 24 24">
                                    <line x1="12" y1="5" x2="12" y2="19" />
                                    <line x1="5" y1="12" x2="19" y2="12" />
                                </svg>
                                Nova matéria
                            </a>
                        </div>
                    </div>

                </div>
            </div>
        </section>
        <div class="rounded-3xl overflow-hidden relative shadow-sm"
            style="background:linear-gradient(130deg,#9d174d 0%,#db2777 50%,#fda4af 100%);">
            <div class="absolute inset-0 pointer-events-none opacity-[.08]"
                style="background-image:radial-gradient(#fff 1px,transparent 1px);background-size:18px 18px;"></div>
            <div class="relative z-10 px-8 py-6 flex flex-col sm:flex-row items-center justify-between gap-4">
                <div>
                    <p class="text-pink-200 text-[10px] font-black uppercase tracking-[.22em] mb-1">Motivação</p>
                    <blockquote class="text-white font-black text-lg leading-snug max-w-lg"
                        style="font-family:'Syne',sans-serif;">
                        "A educação é a arma mais poderosa que você pode usar para mudar o mundo."
                    </blockquote>
                    <p class="text-pink-300 text-xs font-semibold mt-1.5">— Nelson Mandela</p>
                </div>
            </div>
        </div>
    </div>

    <script src="{{ asset('js/dashboard.js') }}"></script>
@endsection