<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>StudyLab · Conteúdos</title>
    <link rel="icon" type="image/png" href="{{ asset('favicons/logo/focus-logo.ico') }}">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <link rel="stylesheet" href="{{ asset('css/index-bq.css') }}">
</head>

<body class="font-sans bg-[#020408] text-slate-200 h-screen relative">

<div class="app flex h-screen">

    <!-- SIDEBAR -->
    <aside id="sidebar"
        class="sidebar flex flex-col items-center py-4 gap-1 flex-shrink-0 z-10 relative"
        style="background:rgba(255,255,255,0.03);border-right:1px solid rgba(255,255,255,0.08);">

        <div class="w-9 h-9 rounded-[10px] flex items-center justify-center mb-3 flex-shrink-0 ml-4"></div>

        {{-- Focus --}}
        <div class="sidebar-item w-full h-11 flex items-center gap-3 px-4 cursor-pointer border-l-2 border-transparent text-[#64748b] hover:bg-white/5 hover:text-slate-200 whitespace-nowrap text-sm font-medium transition-colors">
            <a class="flex items-center gap-3 w-full" href="/focus">
                <svg class="w-[18px] h-[18px] flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M13 10V3L4 14h7v7l9-11h-7z" />
                </svg>
                <span class="sidebar-label opacity-0 transition-opacity duration-200 text-[13px]">Focus</span>
            </a>
        </div>

        {{-- Conteúdos (ativo) --}}
        <div class="sidebar-item w-full h-11 flex items-center gap-3 px-4 cursor-pointer border-l-2 border-pink-500 text-pink-500 whitespace-nowrap text-sm font-medium"
            style="background:rgba(236,72,153,0.12);">
            <svg class="w-[18px] h-[18px] flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8"
                    d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253" />
            </svg>
            <span class="sidebar-label opacity-0 transition-opacity duration-200 text-[13px]">Conteúdos</span>
        </div>

        {{-- Lousa virtual --}}
        <div class="sidebar-item w-full h-11 flex items-center gap-3 px-4 cursor-pointer border-l-2 border-transparent text-[#64748b] hover:bg-white/5 hover:text-slate-200 whitespace-nowrap text-sm font-medium transition-colors">
            <a class="flex items-center gap-3 w-full" href="/whiteboard">
                <svg class="w-[18px] h-[18px] flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8"
                        d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z" />
                </svg>
                <span class="sidebar-label opacity-0 transition-opacity duration-200 text-[13px]">Lousa virtual</span>
            </a>
        </div>

        {{-- Caderno --}}
        <div class="sidebar-item w-full h-11 flex items-center gap-3 px-4 cursor-pointer border-l-2 border-transparent text-[#64748b] hover:bg-white/5 hover:text-slate-200 whitespace-nowrap text-sm font-medium transition-colors">
            <a class="flex items-center gap-3 w-full" href="/notebook">
                <svg class="w-[18px] h-[18px] flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8"
                        d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                </svg>
                <span class="sidebar-label opacity-0 transition-opacity duration-200 text-[13px]">Caderno</span>
            </a>
        </div>

        {{-- Flashcards --}}
        <div class="sidebar-item w-full h-11 flex items-center gap-3 px-4 cursor-pointer border-l-2 border-transparent text-[#64748b] hover:bg-white/5 hover:text-slate-200 whitespace-nowrap text-sm font-medium transition-colors">
            <a class="flex items-center gap-3 w-full" href="/flashcards">
                <svg class="w-[18px] h-[18px] flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8"
                        d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2" />
                </svg>
                <span class="sidebar-label opacity-0 transition-opacity duration-200 text-[13px]">Flashcards</span>
            </a>
        </div>

        {{-- Dashboard --}}
        <div class="sidebar-item w-full h-11 flex items-center gap-3 px-4 cursor-pointer border-l-2 border-transparent text-[#64748b] hover:bg-white/5 hover:text-slate-200 whitespace-nowrap text-sm font-medium transition-colors">
            <a class="flex items-center gap-3 w-full" href="/dashboard">
                <svg class="w-[18px] h-[18px] flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8"
                        d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6" />
                </svg>
                <span class="sidebar-label opacity-0 transition-opacity duration-200 text-[13px]">Dashboard</span>
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
                <span class="font-orbitron font-bold text-xs tracking-wide text-slate-200">CONTEÚDOS</span>
                <span class="text-[11px] px-2 py-0.5 rounded-full font-semibold text-pink-500"
                    style="background:rgba(236,72,153,0.12);border:1px solid rgba(236,72,153,0.3);">
                    Biblioteca
                </span>
            </div>

            {{-- Search bar --}}
            <div class="relative flex-1 max-w-sm">
                <div class="absolute inset-y-0 left-3 flex items-center pointer-events-none">
                    <svg class="w-3.5 h-3.5 text-[#64748b]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                    </svg>
                </div>
                <input id="search-input" type="text" placeholder="Pesquisar conteúdos..."
                    class="w-full h-9 pl-9 pr-4 rounded-[10px] text-xs text-slate-200 placeholder-[#475569] outline-none transition-all"
                    style="background:rgba(255,255,255,0.04);border:1px solid rgba(255,255,255,0.08);" />
                <div id="search-clear"
                    class="hidden absolute inset-y-0 right-2.5 flex items-center cursor-pointer text-[#64748b] hover:text-slate-200">
                    <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </div>
            </div>

            <div id="search-count" class="text-[11px] text-[#64748b] whitespace-nowrap hidden">
                <span id="search-count-num">0</span> resultados
            </div>
        </div>

        <!-- Content area -->
        <div class="flex-1 overflow-y-auto p-6">

            {{-- No results --}}
            <div id="no-results" class="hidden flex flex-col items-center justify-center h-64 gap-3">
                <svg class="w-10 h-10 text-[#334155]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                        d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                </svg>
                <p class="text-[#475569] text-sm">Nenhum conteúdo encontrado para "<span id="no-results-term" class="text-pink-500"></span>"</p>
            </div>

            {{-- Sections --}}
            <div id="sections-wrapper" class="flex flex-col gap-8">

                {{-- ═══ MATEMÁTICA ═══ --}}
                <section class="area-section" data-area="matematica">
                    <div class="flex items-center gap-3 mb-4">
                        <div class="area-icon w-8 h-8 rounded-[10px] flex items-center justify-center flex-shrink-0"
                            style="background:rgba(236,72,153,0.15);border:1px solid rgba(236,72,153,0.25);">
                            <svg class="w-4 h-4 text-pink-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8"
                                    d="M12 6V4m0 2a2 2 0 100 4m0-4a2 2 0 110 4m-6 8a2 2 0 100-4m0 4a2 2 0 110-4m0 4v2m0-6V4m6 6v10m6-2a2 2 0 100-4m0 4a2 2 0 110-4m0 4v2m0-6V4" />
                            </svg>
                        </div>
                        <div>
                            <h2 class="text-sm font-bold text-slate-200 tracking-wide">Matemática</h2>
                            <p class="text-[11px] text-[#475569]">Exatas</p>
                        </div>
                        <div class="area-badge ml-auto text-[10px] font-semibold px-2 py-0.5 rounded-full text-pink-400"
                            style="background:rgba(236,72,153,0.12);border:1px solid rgba(236,72,153,0.2);">
                            <span class="badge-count">8</span> tópicos
                        </div>
                    </div>
                    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-3 content-grid"
                        data-color="pink">
                        @foreach([
                            ['Álgebra', 'Equações, inequações, polinômios e expressões algébricas', 'M'],
                            ['Geometria Plana', 'Áreas, perímetros, ângulos e figuras planas', 'M'],
                            ['Geometria Espacial', 'Sólidos, volumes e superfícies tridimensionais', 'M'],
                            ['Trigonometria', 'Seno, cosseno, tangente e identidades', 'M'],
                            ['Funções', 'Funções de 1°, 2° grau, exponencial e logarítmica', 'M'],
                            ['Probabilidade', 'Eventos, combinações e distribuições', 'M'],
                            ['Estatística', 'Média, mediana, moda e desvio padrão', 'M'],
                            ['Matrizes e Determinantes', 'Operações matriciais e sistemas lineares', 'M'],
                        ] as [$title, $desc, $area])
                        <div class="content-card group rounded-[14px] p-4 cursor-pointer transition-all duration-200"
                            data-title="{{ $title }}" data-area="{{ $area }}"
                            style="background:rgba(255,255,255,0.03);border:1px solid rgba(255,255,255,0.07);">
                            <div class="flex items-start justify-between mb-3">
                                <div class="card-dot w-2 h-2 rounded-full mt-1 flex-shrink-0"
                                    style="background:#ec4899;box-shadow:0 0 6px rgba(236,72,153,0.5);"></div>
                                <svg class="w-3.5 h-3.5 text-[#334155] group-hover:text-pink-500 transition-colors" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                                </svg>
                            </div>
                            <h3 class="text-[13px] font-semibold text-slate-200 mb-1 leading-snug">{{ $title }}</h3>
                            <p class="text-[11px] text-[#475569] leading-relaxed">{{ $desc }}</p>
                        </div>
                        @endforeach
                    </div>
                </section>

                <div class="section-divider h-px" style="background:rgba(255,255,255,0.06);"></div>

                {{-- ═══ NATUREZA ═══ --}}
                <section class="area-section" data-area="natureza">
                    <div class="flex items-center gap-3 mb-4">
                        <div class="area-icon w-8 h-8 rounded-[10px] flex items-center justify-center flex-shrink-0"
                            style="background:rgba(52,211,153,0.15);border:1px solid rgba(52,211,153,0.25);">
                            <svg class="w-4 h-4 text-emerald-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8"
                                    d="M9.663 17h4.673M12 3v1m6.364 1.636l-.707.707M21 12h-1M4 12H3m3.343-5.657l-.707-.707m2.828 9.9a5 5 0 117.072 0l-.548.547A3.374 3.374 0 0014 18.469V19a2 2 0 11-4 0v-.531c0-.895-.356-1.754-.988-2.386l-.548-.547z" />
                            </svg>
                        </div>
                        <div>
                            <h2 class="text-sm font-bold text-slate-200 tracking-wide">Ciências da Natureza</h2>
                            <p class="text-[11px] text-[#475569]">Natureza</p>
                        </div>
                        <div class="area-badge ml-auto text-[10px] font-semibold px-2 py-0.5 rounded-full text-emerald-400"
                            style="background:rgba(52,211,153,0.10);border:1px solid rgba(52,211,153,0.2);">
                            <span class="badge-count">9</span> tópicos
                        </div>
                    </div>
                    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-3 content-grid"
                        data-color="emerald">
                        @foreach([
                            ['Mecânica', 'Cinemática, dinâmica, leis de Newton e energia', 'N'],
                            ['Eletromagnetismo', 'Campos elétricos, circuitos e ondas eletromagnéticas', 'N'],
                            ['Termodinâmica', 'Calor, temperatura, leis termodinâmicas', 'N'],
                            ['Óptica', 'Reflexão, refração, lentes e espelhos', 'N'],
                            ['Química Geral', 'Tabela periódica, ligações e reações', 'N'],
                            ['Química Orgânica', 'Hidrocarbonetos, funções e reações orgânicas', 'N'],
                            ['Biologia Celular', 'Células, divisão celular e biomoléculas', 'N'],
                            ['Genética', 'Hereditariedade, DNA, RNA e mutações', 'N'],
                            ['Ecologia', 'Ecossistemas, cadeias alimentares e biomas', 'N'],
                        ] as [$title, $desc, $area])
                        <div class="content-card group rounded-[14px] p-4 cursor-pointer transition-all duration-200"
                            data-title="{{ $title }}" data-area="{{ $area }}"
                            style="background:rgba(255,255,255,0.03);border:1px solid rgba(255,255,255,0.07);">
                            <div class="flex items-start justify-between mb-3">
                                <div class="card-dot w-2 h-2 rounded-full mt-1 flex-shrink-0"
                                    style="background:#34d399;box-shadow:0 0 6px rgba(52,211,153,0.5);"></div>
                                <svg class="w-3.5 h-3.5 text-[#334155] group-hover:text-emerald-400 transition-colors" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                                </svg>
                            </div>
                            <h3 class="text-[13px] font-semibold text-slate-200 mb-1 leading-snug">{{ $title }}</h3>
                            <p class="text-[11px] text-[#475569] leading-relaxed">{{ $desc }}</p>
                        </div>
                        @endforeach
                    </div>
                </section>

                <div class="section-divider h-px" style="background:rgba(255,255,255,0.06);"></div>

                {{-- ═══ LINGUAGENS ═══ --}}
                <section class="area-section" data-area="linguagens">
                    <div class="flex items-center gap-3 mb-4">
                        <div class="area-icon w-8 h-8 rounded-[10px] flex items-center justify-center flex-shrink-0"
                            style="background:rgba(251,191,36,0.15);border:1px solid rgba(251,191,36,0.25);">
                            <svg class="w-4 h-4 text-amber-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8"
                                    d="M8 10h.01M12 10h.01M16 10h.01M9 16H5a2 2 0 01-2-2V6a2 2 0 012-2h14a2 2 0 012 2v8a2 2 0 01-2 2h-5l-5 5v-5z" />
                            </svg>
                        </div>
                        <div>
                            <h2 class="text-sm font-bold text-slate-200 tracking-wide">Linguagens</h2>
                            <p class="text-[11px] text-[#475569]">Comunicação e Expressão</p>
                        </div>
                        <div class="area-badge ml-auto text-[10px] font-semibold px-2 py-0.5 rounded-full text-amber-400"
                            style="background:rgba(251,191,36,0.10);border:1px solid rgba(251,191,36,0.2);">
                            <span class="badge-count">7</span> tópicos
                        </div>
                    </div>
                    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-3 content-grid"
                        data-color="amber">
                        @foreach([
                            ['Gramática', 'Morfologia, sintaxe, concordância e regência', 'L'],
                            ['Literatura Brasileira', 'Movimentos literários, autores e obras nacionais', 'L'],
                            ['Literatura Portuguesa', 'Classicismo, romantismo e modernismo em Portugal', 'L'],
                            ['Interpretação de Texto', 'Leitura crítica, inferências e coerência textual', 'L'],
                            ['Inglês', 'Gramática, vocabulário e compreensão em inglês', 'L'],
                            ['Espanhol', 'Estruturas básicas e intermediárias do espanhol', 'L'],
                            ['Redação', 'Dissertação argumentativa, estrutura e coesão', 'L'],
                        ] as [$title, $desc, $area])
                        <div class="content-card group rounded-[14px] p-4 cursor-pointer transition-all duration-200"
                            data-title="{{ $title }}" data-area="{{ $area }}"
                            style="background:rgba(255,255,255,0.03);border:1px solid rgba(255,255,255,0.07);">
                            <div class="flex items-start justify-between mb-3">
                                <div class="card-dot w-2 h-2 rounded-full mt-1 flex-shrink-0"
                                    style="background:#fbbf24;box-shadow:0 0 6px rgba(251,191,36,0.5);"></div>
                                <svg class="w-3.5 h-3.5 text-[#334155] group-hover:text-amber-400 transition-colors" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                                </svg>
                            </div>
                            <h3 class="text-[13px] font-semibold text-slate-200 mb-1 leading-snug">{{ $title }}</h3>
                            <p class="text-[11px] text-[#475569] leading-relaxed">{{ $desc }}</p>
                        </div>
                        @endforeach
                    </div>
                </section>

                <div class="section-divider h-px" style="background:rgba(255,255,255,0.06);"></div>

                {{-- ═══ HUMANAS ═══ --}}
                <section class="area-section" data-area="humanas">
                    <div class="flex items-center gap-3 mb-4">
                        <div class="area-icon w-8 h-8 rounded-[10px] flex items-center justify-center flex-shrink-0"
                            style="background:rgba(129,140,248,0.15);border:1px solid rgba(129,140,248,0.25);">
                            <svg class="w-4 h-4 text-indigo-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8"
                                    d="M3.055 11H5a2 2 0 012 2v1a2 2 0 002 2 2 2 0 012 2v2.945M8 3.935V5.5A2.5 2.5 0 0010.5 8h.5a2 2 0 012 2 2 2 0 104 0 2 2 0 012-2h1.064M15 20.488V18a2 2 0 012-2h3.064" />
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8"
                                    d="M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                            </svg>
                        </div>
                        <div>
                            <h2 class="text-sm font-bold text-slate-200 tracking-wide">Ciências Humanas</h2>
                            <p class="text-[11px] text-[#475569]">Humanas</p>
                        </div>
                        <div class="area-badge ml-auto text-[10px] font-semibold px-2 py-0.5 rounded-full text-indigo-400"
                            style="background:rgba(129,140,248,0.10);border:1px solid rgba(129,140,248,0.2);">
                            <span class="badge-count">6</span> tópicos
                        </div>
                    </div>
                    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-3 content-grid"
                        data-color="indigo">
                        @foreach([
                            ['História do Brasil', 'Colonização, independência, república e contemporaneidade', 'H'],
                            ['História Mundial', 'Antiguidade, medievalidade, modernidade e guerras', 'H'],
                            ['Geografia Física', 'Relevo, clima, hidrografia e solos', 'H'],
                            ['Geografia Humana', 'População, urbanização, economias e geopolítica', 'H'],
                            ['Sociologia', 'Estruturas sociais, instituições e movimentos', 'H'],
                            ['Filosofia', 'Epistemologia, ética, política e estética', 'H'],
                        ] as [$title, $desc, $area])
                        <div class="content-card group rounded-[14px] p-4 cursor-pointer transition-all duration-200"
                            data-title="{{ $title }}" data-area="{{ $area }}"
                            style="background:rgba(255,255,255,0.03);border:1px solid rgba(255,255,255,0.07);">
                            <div class="flex items-start justify-between mb-3">
                                <div class="card-dot w-2 h-2 rounded-full mt-1 flex-shrink-0"
                                    style="background:#818cf8;box-shadow:0 0 6px rgba(129,140,248,0.5);"></div>
                                <svg class="w-3.5 h-3.5 text-[#334155] group-hover:text-indigo-400 transition-colors" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                                </svg>
                            </div>
                            <h3 class="text-[13px] font-semibold text-slate-200 mb-1 leading-snug">{{ $title }}</h3>
                            <p class="text-[11px] text-[#475569] leading-relaxed">{{ $desc }}</p>
                        </div>
                        @endforeach
                    </div>
                </section>

                <div class="section-divider h-px" style="background:rgba(255,255,255,0.06);"></div>

                {{-- ═══ TECNOLOGIA ═══ --}}
                <section class="area-section" data-area="tecnologia">
                    <div class="flex items-center gap-3 mb-4">
                        <div class="area-icon w-8 h-8 rounded-[10px] flex items-center justify-center flex-shrink-0"
                            style="background:rgba(56,189,248,0.15);border:1px solid rgba(56,189,248,0.25);">
                            <svg class="w-4 h-4 text-sky-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8"
                                    d="M9.75 17L9 20l-1 1h8l-1-1-.75-3M3 13h18M5 17h14a2 2 0 002-2V5a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
                            </svg>
                        </div>
                        <div>
                            <h2 class="text-sm font-bold text-slate-200 tracking-wide">Tecnologia</h2>
                            <p class="text-[11px] text-[#475569]">Computação & Digital</p>
                        </div>
                        <div class="area-badge ml-auto text-[10px] font-semibold px-2 py-0.5 rounded-full text-sky-400"
                            style="background:rgba(56,189,248,0.10);border:1px solid rgba(56,189,248,0.2);">
                            <span class="badge-count">8</span> tópicos
                        </div>
                    </div>
                    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-3 content-grid"
                        data-color="sky">
                        @foreach([
                            ['Algoritmos', 'Lógica de programação, pseudocódigo e fluxogramas', 'T'],
                            ['Estruturas de Dados', 'Arrays, listas, pilhas, filas, árvores e grafos', 'T'],
                            ['Programação Web', 'HTML, CSS, JavaScript e desenvolvimento frontend', 'T'],
                            ['Banco de Dados', 'SQL, modelagem relacional e NoSQL', 'T'],
                            ['Redes de Computadores', 'Protocolos, TCP/IP, HTTP e segurança de redes', 'T'],
                            ['Inteligência Artificial', 'Machine learning, redes neurais e IA generativa', 'T'],
                            ['Segurança da Informação', 'Criptografia, vulnerabilidades e boas práticas', 'T'],
                            ['Sistemas Operacionais', 'Processos, memória, sistemas de arquivos e shell', 'T'],
                        ] as [$title, $desc, $area])
                        <div class="content-card group rounded-[14px] p-4 cursor-pointer transition-all duration-200"
                            data-title="{{ $title }}" data-area="{{ $area }}"
                            style="background:rgba(255,255,255,0.03);border:1px solid rgba(255,255,255,0.07);">
                            <div class="flex items-start justify-between mb-3">
                                <div class="card-dot w-2 h-2 rounded-full mt-1 flex-shrink-0"
                                    style="background:#38bdf8;box-shadow:0 0 6px rgba(56,189,248,0.5);"></div>
                                <svg class="w-3.5 h-3.5 text-[#334155] group-hover:text-sky-400 transition-colors" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                                </svg>
                            </div>
                            <h3 class="text-[13px] font-semibold text-slate-200 mb-1 leading-snug">{{ $title }}</h3>
                            <p class="text-[11px] text-[#475569] leading-relaxed">{{ $desc }}</p>
                        </div>
                        @endforeach
                    </div>
                </section>

            </div>{{-- /sections-wrapper --}}
        </div>{{-- /content --}}
    </div>{{-- /main --}}
</div>{{-- /app --}}

<script src="{{ asset('js/index-bq.js') }}"></script>
</body>
</html>