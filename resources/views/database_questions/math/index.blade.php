<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>StudyLab · Conteúdos</title>
    <link rel="icon" type="image/png" href="{{ asset('favicons/logo/focus-logo.ico') }}">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Unbounded:wght@400;700;900&family=DM+Mono:ital,opsz,wght@0,14,300;0,14,400;0,14,500&display=swap" rel="stylesheet">
    <style>
        :root {
            --ink: #020408; --ink-2: #0a0d14; --ink-3: #111827;
            --acc: #ec4899; --acc2: #9333ea; --white: #f8fafc;
            --md: rgba(248,250,252,0.4); --ld: rgba(255,255,255,0.07);
            --fh: 'Unbounded', sans-serif; --fb: 'DM Mono', monospace;
        }
        * { box-sizing: border-box; margin: 0; padding: 0; }
        body { background: var(--ink); color: var(--white); font-family: var(--fb); }
        body::after {
            content: ''; position: fixed; inset: 0; z-index: 9000; pointer-events: none;
            opacity: 0.04; mix-blend-mode: overlay;
            background-image: url("data:image/svg+xml,%3Csvg viewBox='0 0 512 512' xmlns='http://www.w3.org/2000/svg'%3E%3Cfilter id='n'%3E%3CfeTurbulence type='fractalNoise' baseFrequency='0.88' numOctaves='4' stitchTiles='stitch'/%3E%3C/filter%3E%3Crect width='100%25' height='100%25' filter='url(%23n)'/%3E%3C/svg%3E");
            background-size: 180px 180px;
        }
        /* Orbs */
        .orb { position: fixed; border-radius: 50%; pointer-events: none; filter: blur(100px); z-index: 0; }
        .orb-1 { width: 600px; height: 600px; top: -250px; right: -150px; background: rgba(236,72,153,0.06); }
        .orb-2 { width: 400px; height: 400px; bottom: -200px; left: -100px; background: rgba(147,51,234,0.05); }

        /* SIDEBAR */
        #sidebar { width: 56px; transition: width 0.25s ease; position: relative; z-index: 10; flex-shrink: 0; }
        #sidebar.expanded { width: 200px; }
        .sidebar-label { opacity: 0; transition: opacity 0.2s; white-space: nowrap; }
        #sidebar.expanded .sidebar-label { opacity: 1; }

        /* SEARCH */
        #search-input:focus { border-color: rgba(236,72,153,0.4) !important; outline: none; box-shadow: 0 0 0 3px rgba(236,72,153,0.08); }

        /* CONTENT CARDS */
        .content-card { transition: all 0.2s cubic-bezier(0.23,1,0.32,1); }
        .content-card.card-hidden { display: none; }
        .area-section.section-hidden { display: none; }
        .search-highlight { background: rgba(236,72,153,0.25); color: #f9a8d4; border-radius: 3px; padding: 0 2px; }
        mark.search-highlight { background: rgba(236,72,153,0.25); color: #f9a8d4; border-radius: 3px; padding: 0 2px; }

        /* TAGS */
        .difficulty-tag {
            font-size: 0.5rem; font-family: var(--fh); letter-spacing: 0.1em;
            text-transform: uppercase; padding: 2px 8px; border-radius: 100px;
            font-weight: 700;
        }

        /* FILTER TABS */
        .filter-tab {
            font-family: var(--fb); font-size: 0.65rem; padding: 6px 14px; border-radius: 8px;
            cursor: pointer; border: 1px solid transparent; transition: all 0.2s;
            color: var(--md); background: transparent;
        }
        .filter-tab.active {
            background: rgba(236,72,153,0.1); border-color: rgba(236,72,153,0.25); color: #ec4899;
        }
        .filter-tab:not(.active):hover { background: rgba(255,255,255,0.04); color: var(--white); }

        ::-webkit-scrollbar { width: 3px; }
        ::-webkit-scrollbar-track { background: transparent; }
        ::-webkit-scrollbar-thumb { background: rgba(236,72,153,0.4); border-radius: 2px; }

        @keyframes fadeUp { from{ opacity:0; transform:translateY(12px); } to{ opacity:1; transform:translateY(0); } }
        .anim-fade-up { animation: fadeUp 0.5s cubic-bezier(0.23,1,0.32,1) both; }
    </style>
</head>

<body class="h-screen relative" style="overflow:hidden;">

    <div class="orb orb-1"></div>
    <div class="orb orb-2"></div>

    <div class="flex h-screen" style="position:relative;z-index:1;">

        <!-- SIDEBAR -->
        <aside id="sidebar" class="flex flex-col items-center py-4 gap-1"
               style="background:rgba(255,255,255,0.02);border-right:1px solid var(--ld);">

            <div class="w-9 h-9 rounded-[10px] flex items-center justify-center mb-3 flex-shrink-0 ml-4"></div>

            @php $navItems = [
                ['Focus', '/focus', 'M13 10V3L4 14h7v7l9-11h-7z', false],
                ['Conteúdos', '/contents', 'M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253', true],
                ['Lousa virtual', '/whiteboard', 'M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z', false],
                ['Caderno', '/notebook', 'M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253', false],
                ['Flashcards', '/flashcards', 'M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2', false],
                ['Dashboard', '/dashboard', 'M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6', false],
            ]; @endphp

            @foreach($navItems as $item)
                <div class="sidebar-item w-full h-11 flex items-center gap-3 px-4 cursor-pointer border-l-2 whitespace-nowrap text-sm font-medium transition-colors
                            {{ $item[3] ? 'border-pink-500 text-pink-500' : 'border-transparent text-[#64748b] hover:text-slate-200' }}"
                     style="{{ $item[3] ? 'background:rgba(236,72,153,0.1);' : '' }}">
                    <a class="flex items-center gap-3 w-full" href="{{ $item[1] }}" style="text-decoration:none;color:inherit;">
                        <svg class="w-[18px] h-[18px] flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="{{ $item[2] }}"/>
                        </svg>
                        <span class="sidebar-label text-[13px]">{{ $item[0] }}</span>
                    </a>
                </div>
            @endforeach

            <div id="sidebar-toggle" class="mt-auto w-full flex items-center px-4 h-10 cursor-pointer text-[#64748b] gap-3 hover:text-slate-200 transition-colors">
                <svg id="toggle-arrow" class="w-[18px] h-[18px] flex-shrink-0 transition-transform duration-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                </svg>
                <span class="sidebar-label text-[12px]">Recolher</span>
            </div>
        </aside>

        <!-- MAIN -->
        <div class="flex flex-1 flex-col overflow-hidden">

            <!-- TOPBAR -->
            <div class="h-14 flex items-center justify-between px-6 gap-4 flex-shrink-0"
                 style="border-bottom:1px solid var(--ld);background:rgba(2,4,8,0.6);backdrop-filter:blur(20px);">
                <div class="flex items-center gap-3">
                    <span style="font-family:var(--fh);font-weight:900;font-size:0.65rem;letter-spacing:0.12em;">CONTEÚDOS</span>
                    <div class="px-3 py-1 rounded-full"
                         style="background:rgba(236,72,153,0.1);border:1px solid rgba(236,72,153,0.25);">
                        <span style="font-size:0.58rem;font-family:var(--fh);font-weight:700;color:#ec4899;letter-spacing:0.08em;">Biblioteca</span>
                    </div>
                </div>

                <!-- SEARCH + FILTERS -->
                <div class="flex items-center gap-3 flex-1 max-w-xl">
                    <div class="relative flex-1">
                        <div class="absolute inset-y-0 left-3 flex items-center pointer-events-none">
                            <svg class="w-3.5 h-3.5 text-[#64748b]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/>
                            </svg>
                        </div>
                        <input id="search-input" type="text" placeholder="Pesquisar conteúdos..."
                               class="w-full h-9 pl-9 pr-4 rounded-[10px] text-xs text-slate-200 placeholder-[#475569] transition-all"
                               style="background:rgba(255,255,255,0.04);border:1px solid rgba(255,255,255,0.08);font-family:var(--fb);" />
                        <div id="search-clear" class="hidden absolute inset-y-0 right-2.5 flex items-center cursor-pointer text-[#64748b] hover:text-slate-200">
                            <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                            </svg>
                        </div>
                    </div>
                    <div id="search-count" class="text-[11px] text-[#64748b] whitespace-nowrap hidden">
                        <span id="search-count-num">0</span> resultados
                    </div>
                </div>
            </div>

            <!-- FILTER BAR -->
            <div class="flex items-center gap-2 px-6 py-3 flex-shrink-0 overflow-x-auto"
                 style="border-bottom:1px solid var(--ld);">
                <span style="font-size:0.6rem;color:var(--md);font-family:var(--fb);white-space:nowrap;margin-right:4px;">Filtrar:</span>
                @foreach(['Todos', 'Matemática', 'Física', 'Química', 'Biologia', 'Linguagens', 'Humanas', 'Tecnologia', 'Redação'] as $fi => $f)
                    <button class="filter-tab {{ $fi === 0 ? 'active' : '' }}" data-filter="{{ $f }}">{{ $f }}</button>
                @endforeach
            </div>

            <!-- CONTENT -->
            <div class="flex-1 overflow-y-auto p-6">

                <!-- No results -->
                <div id="no-results" class="hidden flex flex-col items-center justify-center h-64 gap-3">
                    <svg class="w-10 h-10 text-[#334155]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/>
                    </svg>
                    <p style="font-size:0.8rem;color:#475569;">Nenhum conteúdo encontrado para "<span id="no-results-term" style="color:#ec4899;"></span>"</p>
                </div>

                <div id="sections-wrapper" class="flex flex-col gap-10">

                    {{-- ═══ MATEMÁTICA ═══ --}}
                    @php $sections = [
                        [
                            'area' => 'matematica',
                            'label' => 'Matemática',
                            'sublabel' => 'Exatas',
                            'icon_color' => '#ec4899',
                            'bg_color' => 'rgba(236,72,153,0.12)',
                            'border_color' => 'rgba(236,72,153,0.22)',
                            'badge_color' => 'rgba(236,72,153,0.1)',
                            'dot_color' => '#ec4899',
                            'dot_shadow' => 'rgba(236,72,153,0.5)',
                            'hover_color' => '236,72,153',
                            'icon_path' => 'M12 6V4m0 2a2 2 0 100 4m0-4a2 2 0 110 4m-6 8a2 2 0 100-4m0 4a2 2 0 110-4m0 4v2m0-6V4m6 6v10m6-2a2 2 0 100-4m0 4a2 2 0 110-4m0 4v2m0-6V4',
                            'cards' => [
                                ['Álgebra', 'Equações, inequações, polinômios e expressões algébricas', 'Médio'],
                                ['Geometria Plana', 'Áreas, perímetros, ângulos e figuras planas', 'Fácil'],
                                ['Geometria Espacial', 'Sólidos, volumes e superfícies tridimensionais', 'Difícil'],
                                ['Trigonometria', 'Seno, cosseno, tangente e identidades trigonométricas', 'Médio'],
                                ['Funções', 'Funções de 1°, 2° grau, exponencial e logarítmica', 'Médio'],
                                ['Probabilidade', 'Eventos, combinatória e distribuições de probabilidade', 'Difícil'],
                                ['Estatística', 'Média, mediana, moda, desvio padrão e análise de dados', 'Fácil'],
                                ['Matrizes e Determinantes', 'Operações matriciais, sistemas lineares e escalonamento', 'Difícil'],
                                ['Progressões', 'PA, PG, somas e termos gerais de progressões', 'Médio'],
                                ['Números Complexos', 'Forma algébrica, trigonométrica e operações no plano de Argand', 'Difícil'],
                                ['Contagem e Combinatória', 'Princípio multiplicativo, permutações e combinações', 'Médio'],
                                ['Logaritmos', 'Propriedades, equações e inequações logarítmicas', 'Médio'],
                            ],
                        ],
                        [
                            'area' => 'natureza',
                            'label' => 'Ciências da Natureza',
                            'sublabel' => 'Física · Química · Biologia',
                            'icon_color' => '#34d399',
                            'bg_color' => 'rgba(52,211,153,0.12)',
                            'border_color' => 'rgba(52,211,153,0.22)',
                            'badge_color' => 'rgba(52,211,153,0.08)',
                            'dot_color' => '#34d399',
                            'dot_shadow' => 'rgba(52,211,153,0.5)',
                            'hover_color' => '52,211,153',
                            'icon_path' => 'M9.663 17h4.673M12 3v1m6.364 1.636l-.707.707M21 12h-1M4 12H3m3.343-5.657l-.707-.707m2.828 9.9a5 5 0 117.072 0l-.548.547A3.374 3.374 0 0014 18.469V19a2 2 0 11-4 0v-.531c0-.895-.356-1.754-.988-2.386l-.548-.547z',
                            'cards' => [
                                ['Mecânica Clássica', 'Cinemática, dinâmica, leis de Newton, trabalho e energia', 'Médio'],
                                ['Eletromagnetismo', 'Campos elétricos, magnéticos, circuitos e ondas EM', 'Difícil'],
                                ['Termodinâmica', 'Calor, temperatura, leis termodinâmicas e motores', 'Médio'],
                                ['Óptica Geométrica', 'Reflexão, refração, lentes, espelhos e instrumentos ópticos', 'Fácil'],
                                ['Ondas e Som', 'Características de ondas, efeito Doppler e acústica', 'Médio'],
                                ['Física Moderna', 'Relatividade, fotoelétrico, modelos atômicos e radioatividade', 'Difícil'],
                                ['Química Geral', 'Tabela periódica, ligações, soluções e estequiometria', 'Médio'],
                                ['Química Orgânica', 'Hidrocarbonetos, funções orgânicas e reações', 'Difícil'],
                                ['Eletroquímica', 'Células galvânicas, eletrólise e potenciais de redução', 'Difícil'],
                                ['Biologia Celular', 'Organelas, divisão celular, membrana e metabolismo', 'Médio'],
                                ['Genética', 'Hereditariedade, DNA, RNA, mutações e biotecnologia', 'Difícil'],
                                ['Ecologia', 'Ecossistemas, cadeias alimentares, biomas e sustentabilidade', 'Fácil'],
                                ['Evolução', 'Teorias evolutivas, seleção natural e especiação', 'Médio'],
                                ['Fisiologia Humana', 'Sistemas digestório, circulatório, nervoso e endócrino', 'Médio'],
                                ['Botânica', 'Morfologia, fisiologia vegetal, fotossíntese e reprodução', 'Fácil'],
                            ],
                        ],
                        [
                            'area' => 'linguagens',
                            'label' => 'Linguagens',
                            'sublabel' => 'Comunicação e Expressão',
                            'icon_color' => '#fbbf24',
                            'bg_color' => 'rgba(251,191,36,0.12)',
                            'border_color' => 'rgba(251,191,36,0.22)',
                            'badge_color' => 'rgba(251,191,36,0.08)',
                            'dot_color' => '#fbbf24',
                            'dot_shadow' => 'rgba(251,191,36,0.5)',
                            'hover_color' => '251,191,36',
                            'icon_path' => 'M8 10h.01M12 10h.01M16 10h.01M9 16H5a2 2 0 01-2-2V6a2 2 0 012-2h14a2 2 0 012 2v8a2 2 0 01-2 2h-5l-5 5v-5z',
                            'cards' => [
                                ['Gramática', 'Morfologia, sintaxe, concordância verbal e nominal', 'Médio'],
                                ['Literatura Brasileira', 'Movimentos literários, autores e obras nacionais', 'Médio'],
                                ['Literatura Portuguesa', 'Classicismo, romantismo e modernismo em Portugal', 'Médio'],
                                ['Interpretação de Texto', 'Leitura crítica, inferências e coerência textual', 'Fácil'],
                                ['Produção Textual', 'Gêneros textuais, coesão e coerência na escrita', 'Médio'],
                                ['Inglês — Gramática', 'Tempos verbais, preposições e estruturas gramaticais', 'Médio'],
                                ['Inglês — Vocabulário', 'Phrasal verbs, collocations e expressões idiomáticas', 'Difícil'],
                                ['Espanhol', 'Estruturas básicas, verbos irregulares e vocabulário', 'Fácil'],
                                ['Redação Argumentativa', 'Dissertação, proposta de intervenção e repertório cultural', 'Difícil'],
                                ['Semântica e Pragmática', 'Significado, ambiguidade, ironia e atos de fala', 'Difícil'],
                                ['Figuras de Linguagem', 'Metáfora, metonímia, hipérbole e outras figuras', 'Fácil'],
                            ],
                        ],
                        [
                            'area' => 'humanas',
                            'label' => 'Ciências Humanas',
                            'sublabel' => 'História · Geografia · Filosofia',
                            'icon_color' => '#818cf8',
                            'bg_color' => 'rgba(129,140,248,0.12)',
                            'border_color' => 'rgba(129,140,248,0.22)',
                            'badge_color' => 'rgba(129,140,248,0.08)',
                            'dot_color' => '#818cf8',
                            'dot_shadow' => 'rgba(129,140,248,0.5)',
                            'hover_color' => '129,140,248',
                            'icon_path' => 'M3.055 11H5a2 2 0 012 2v1a2 2 0 002 2 2 2 0 012 2v2.945M8 3.935V5.5A2.5 2.5 0 0010.5 8h.5a2 2 0 012 2 2 2 0 104 0 2 2 0 012-2h1.064M15 20.488V18a2 2 0 012-2h3.064',
                            'cards' => [
                                ['História do Brasil', 'Colonização, independência, república e história contemporânea', 'Médio'],
                                ['História Mundial — Antiga', 'Mesopotâmia, Egito, Grécia e Roma', 'Médio'],
                                ['História Medieval', 'Feudalismo, Cruzadas, Igreja e Baixa Idade Média', 'Fácil'],
                                ['História Moderna', 'Renascimento, Reformas, Absolutismo e Iluminismo', 'Médio'],
                                ['História Contemporânea', 'Guerras Mundiais, Guerra Fria e globalização', 'Difícil'],
                                ['Geografia Física', 'Relevo, clima, hidrografia, solos e dinâmica interna', 'Fácil'],
                                ['Geografia Humana', 'Urbanização, migração, populações e geopolítica', 'Médio'],
                                ['Geopolítica', 'Blocos econômicos, conflitos atuais e relações internacionais', 'Difícil'],
                                ['Sociologia', 'Estruturas sociais, estratificação, movimentos e instituições', 'Médio'],
                                ['Filosofia — Ética', 'Teorias éticas, moral, direitos humanos e cidadania', 'Médio'],
                                ['Filosofia — Epistemologia', 'Teoria do conhecimento, razão e empirismo', 'Difícil'],
                                ['Filosofia Política', 'Contratualistas, Estado, democracia e liberalismo', 'Difícil'],
                            ],
                        ],
                        [
                            'area' => 'tecnologia',
                            'label' => 'Tecnologia',
                            'sublabel' => 'Computação & Digital',
                            'icon_color' => '#38bdf8',
                            'bg_color' => 'rgba(56,189,248,0.12)',
                            'border_color' => 'rgba(56,189,248,0.22)',
                            'badge_color' => 'rgba(56,189,248,0.08)',
                            'dot_color' => '#38bdf8',
                            'dot_shadow' => 'rgba(56,189,248,0.5)',
                            'hover_color' => '56,189,248',
                            'icon_path' => 'M9.75 17L9 20l-1 1h8l-1-1-.75-3M3 13h18M5 17h14a2 2 0 002-2V5a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z',
                            'cards' => [
                                ['Algoritmos e Lógica', 'Pseudocódigo, fluxogramas, complexidade e depuração', 'Fácil'],
                                ['Estruturas de Dados', 'Arrays, listas, pilhas, filas, árvores e grafos', 'Difícil'],
                                ['Programação Web', 'HTML, CSS, JavaScript e desenvolvimento frontend', 'Médio'],
                                ['Backend & APIs', 'REST, autenticação, servidores e arquitetura de APIs', 'Difícil'],
                                ['Banco de Dados', 'SQL, modelagem relacional, consultas e NoSQL', 'Médio'],
                                ['Redes de Computadores', 'TCP/IP, HTTP, DNS, segurança e arquiteturas de rede', 'Difícil'],
                                ['Inteligência Artificial', 'Machine learning, redes neurais, NLP e IA generativa', 'Difícil'],
                                ['Segurança da Informação', 'Criptografia, vulnerabilidades, OWASP e boas práticas', 'Difícil'],
                                ['Sistemas Operacionais', 'Processos, memória, sistemas de arquivos e shell Linux', 'Médio'],
                                ['Cloud Computing', 'AWS, Azure, GCP, containers e orquestração com K8s', 'Difícil'],
                            ],
                        ],
                        [
                            'area' => 'redacao',
                            'label' => 'Redação',
                            'sublabel' => 'Escrita e Argumentação',
                            'icon_color' => '#f87171',
                            'bg_color' => 'rgba(248,113,113,0.12)',
                            'border_color' => 'rgba(248,113,113,0.22)',
                            'badge_color' => 'rgba(248,113,113,0.08)',
                            'dot_color' => '#f87171',
                            'dot_shadow' => 'rgba(248,113,113,0.5)',
                            'hover_color' => '248,113,113',
                            'icon_path' => 'M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z',
                            'cards' => [
                                ['Estrutura da Dissertação', 'Introdução, desenvolvimento, conclusão e proposta de intervenção', 'Fácil'],
                                ['Repertório Cultural', 'Como usar citações, filmes, dados e contextos históricos', 'Médio'],
                                ['Coesão e Coerência', 'Conectivos, progressão temática e unidade de sentido', 'Médio'],
                                ['Argumentação', 'Tipos de argumento, contra-argumento e falhas lógicas', 'Difícil'],
                                ['Temas do ENEM', 'Análise dos temas recorrentes e como abordá-los com repertório', 'Médio'],
                                ['Proposta de Intervenção', 'Agente, ação, modo, efeito e detalhamento da solução', 'Difícil'],
                            ],
                        ],
                    ]; @endphp

                    @foreach($sections as $sidx => $section)
                        @if($sidx > 0)
                            <div class="section-divider h-px" style="background:var(--ld);"></div>
                        @endif

                        <section class="area-section anim-fade-up" data-area="{{ $section['area'] }}"
                                 style="animation-delay:{{ $sidx * 0.08 }}s;">
                            <div class="flex items-center gap-3 mb-5">
                                <div class="w-9 h-9 rounded-[12px] flex items-center justify-center flex-shrink-0"
                                     style="background:{{ $section['bg_color'] }};border:1px solid {{ $section['border_color'] }};">
                                    <svg class="w-4 h-4" style="color:{{ $section['icon_color'] }};" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="{{ $section['icon_path'] }}"/>
                                    </svg>
                                </div>
                                <div>
                                    <h2 style="font-family:var(--fh);font-size:0.75rem;font-weight:900;color:var(--white);letter-spacing:-0.01em;">{{ $section['label'] }}</h2>
                                    <p style="font-size:0.6rem;color:var(--md);margin-top:1px;">{{ $section['sublabel'] }}</p>
                                </div>
                                <div class="ml-auto px-3 py-1 rounded-full"
                                     style="background:{{ $section['badge_color'] }};border:1px solid {{ $section['border_color'] }};">
                                    <span class="badge-count" style="font-family:var(--fh);font-size:0.5rem;font-weight:700;color:{{ $section['icon_color'] }};letter-spacing:0.08em;">{{ count($section['cards']) }}</span>
                                    <span style="font-family:var(--fh);font-size:0.5rem;font-weight:700;color:{{ $section['icon_color'] }};letter-spacing:0.08em;"> tópicos</span>
                                </div>
                            </div>

                            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-3 content-grid"
                                 data-color="{{ $section['hover_color'] }}">
                                @foreach($section['cards'] as $card)
                                    <div class="content-card group rounded-[16px] p-4 cursor-pointer"
                                         data-title="{{ $card[0] }}" data-area="{{ $section['area'] }}"
                                         style="background:rgba(255,255,255,0.025);border:1px solid rgba(255,255,255,0.06);">
                                        <div class="flex items-start justify-between mb-3">
                                            <div class="flex items-center gap-2">
                                                <div class="w-2 h-2 rounded-full flex-shrink-0"
                                                     style="background:{{ $section['dot_color'] }};box-shadow:0 0 6px {{ $section['dot_shadow'] }};"></div>
                                                <span class="difficulty-tag"
                                                      style="background:{{ $card[2] === 'Fácil' ? 'rgba(34,197,94,0.1)' : ($card[2] === 'Difícil' ? 'rgba(248,113,113,0.1)' : 'rgba(251,191,36,0.1)') }};
                                                             color:{{ $card[2] === 'Fácil' ? '#4ade80' : ($card[2] === 'Difícil' ? '#f87171' : '#fbbf24') }};
                                                             border:1px solid {{ $card[2] === 'Fácil' ? 'rgba(34,197,94,0.2)' : ($card[2] === 'Difícil' ? 'rgba(248,113,113,0.2)' : 'rgba(251,191,36,0.2)') }};">
                                                    {{ $card[2] }}
                                                </span>
                                            </div>
                                            <svg class="w-3.5 h-3.5 text-[#334155] group-hover:text-current transition-colors flex-shrink-0"
                                                 fill="none" stroke="currentColor" viewBox="0 0 24 24"
                                                 style="color:#334155;">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                                            </svg>
                                        </div>
                                        <h3 class="text-[13px] font-semibold mb-1.5 leading-snug" style="color:var(--white);">{{ $card[0] }}</h3>
                                        <p style="font-size:0.65rem;color:var(--md);line-height:1.6;">{{ $card[1] }}</p>
                                    </div>
                                @endforeach
                            </div>
                        </section>
                    @endforeach

                </div>
            </div>
        </div>
    </div>

    <script>
    (() => {
        'use strict';

        /* ── SIDEBAR ── */
        const sidebar = document.getElementById('sidebar');
        const toggle  = document.getElementById('sidebar-toggle');
        const arrow   = document.getElementById('toggle-arrow');
        let expanded  = false;
        toggle?.addEventListener('click', () => {
            expanded = !expanded;
            sidebar.classList.toggle('expanded', expanded);
            if (arrow) arrow.style.transform = expanded ? 'rotate(180deg)' : '';
            document.querySelectorAll('.sidebar-label').forEach(l => l.style.opacity = expanded ? '1' : '0');
        });

        /* ── SEARCH ── */
        const searchInput   = document.getElementById('search-input');
        const searchClear   = document.getElementById('search-clear');
        const searchCount   = document.getElementById('search-count');
        const searchCountNum= document.getElementById('search-count-num');
        const noResults     = document.getElementById('no-results');
        const noResultsTerm = document.getElementById('no-results-term');
        const sectionsWrapper = document.getElementById('sections-wrapper');
        const allCards      = document.querySelectorAll('.content-card');
        const allSections   = document.querySelectorAll('.area-section');

        function normalize(str) {
            return str.toLowerCase().normalize('NFD').replace(/[\u0300-\u036f]/g, '');
        }
        function escapeRegex(str) { return str.replace(/[.*+?^${}()|[\]\\]/g, '\\$&'); }

        function performSearch(query) {
            const q = normalize(query.trim());
            if (!q) { resetSearch(); return; }
            searchClear.classList.remove('hidden'); searchClear.classList.add('flex');
            searchCount.classList.remove('hidden');
            let total = 0;
            allSections.forEach(section => {
                const cards = section.querySelectorAll('.content-card');
                const badge = section.querySelector('.badge-count');
                let vis = 0;
                cards.forEach(card => {
                    const title = normalize(card.dataset.title || '');
                    const desc  = normalize(card.querySelector('p')?.textContent || '');
                    const match = title.includes(q) || desc.includes(q);
                    card.classList.toggle('card-hidden', !match);
                    if (match) {
                        vis++; total++;
                        const h3 = card.querySelector('h3');
                        if (h3) {
                            const orig = h3.dataset.original || h3.textContent;
                            h3.dataset.original = orig;
                            h3.innerHTML = orig.replace(new RegExp(`(${escapeRegex(query.trim())})`, 'gi'), '<mark class="search-highlight">$1</mark>');
                        }
                    } else {
                        const h3 = card.querySelector('h3');
                        if (h3 && h3.dataset.original) { h3.textContent = h3.dataset.original; delete h3.dataset.original; }
                    }
                });
                section.classList.toggle('section-hidden', vis === 0);
                if (badge) badge.textContent = vis;
            });
            // dividers
            Array.from(sectionsWrapper.children).forEach((el, i, arr) => {
                if (!el.classList.contains('section-divider')) return;
                const prev = arr.slice(0,i).reverse().find(c => c.classList.contains('area-section'));
                const next = arr.slice(i+1).find(c => c.classList.contains('area-section'));
                el.style.display = (prev?.classList.contains('section-hidden') || next?.classList.contains('section-hidden')) ? 'none' : '';
            });
            if (searchCountNum) searchCountNum.textContent = total;
            noResults.classList.toggle('hidden', total !== 0);
            noResults.classList.toggle('flex', total === 0);
            if (noResultsTerm) noResultsTerm.textContent = query.trim();
        }

        function resetSearch() {
            searchClear.classList.add('hidden'); searchClear.classList.remove('flex');
            searchCount.classList.add('hidden');
            noResults.classList.add('hidden'); noResults.classList.remove('flex');
            allCards.forEach(card => {
                card.classList.remove('card-hidden');
                const h3 = card.querySelector('h3');
                if (h3?.dataset.original) { h3.textContent = h3.dataset.original; delete h3.dataset.original; }
            });
            allSections.forEach(s => {
                s.classList.remove('section-hidden');
                const badge = s.querySelector('.badge-count');
                if (badge) badge.textContent = s.querySelectorAll('.content-card').length;
            });
            document.querySelectorAll('.section-divider').forEach(d => d.style.display = '');
        }

        let debounceTimer;
        searchInput?.addEventListener('input', e => {
            clearTimeout(debounceTimer);
            debounceTimer = setTimeout(() => performSearch(e.target.value), 150);
        });
        searchClear?.addEventListener('click', () => { searchInput.value = ''; resetSearch(); searchInput.focus(); });

        /* ── FILTER TABS ── */
        document.querySelectorAll('.filter-tab').forEach(tab => {
            tab.addEventListener('click', () => {
                document.querySelectorAll('.filter-tab').forEach(t => t.classList.remove('active'));
                tab.classList.add('active');
                const f = tab.dataset.filter;
                if (f === 'Todos') { allSections.forEach(s => s.classList.remove('section-hidden')); document.querySelectorAll('.section-divider').forEach(d => d.style.display = ''); return; }
                const map = { 'Matemática': 'matematica', 'Física': 'natureza', 'Química': 'natureza', 'Biologia': 'natureza', 'Linguagens': 'linguagens', 'Humanas': 'humanas', 'Tecnologia': 'tecnologia', 'Redação': 'redacao' };
                const target = map[f];
                allSections.forEach(s => s.classList.toggle('section-hidden', s.dataset.area !== target));
                document.querySelectorAll('.section-divider').forEach(d => {
                    const arr = Array.from(sectionsWrapper.children);
                    const idx = arr.indexOf(d);
                    const prev = arr.slice(0,idx).reverse().find(c => c.classList.contains('area-section'));
                    const next = arr.slice(idx+1).find(c => c.classList.contains('area-section'));
                    d.style.display = (prev?.classList.contains('section-hidden') || next?.classList.contains('section-hidden')) ? 'none' : '';
                });
            });
        });

        /* ── CARD HOVER ── */
        document.querySelectorAll('.content-grid').forEach(grid => {
            const rgb = grid.dataset.color || '255,255,255';
            grid.querySelectorAll('.content-card').forEach(card => {
                card.addEventListener('mouseenter', () => {
                    card.style.background   = `rgba(${rgb},0.07)`;
                    card.style.borderColor  = `rgba(${rgb},0.22)`;
                    card.style.transform    = 'translateY(-2px)';
                    card.style.boxShadow    = `0 8px 28px rgba(${rgb},0.1)`;
                    const arrow = card.querySelector('svg:last-child');
                    if (arrow) arrow.style.color = `rgb(${rgb})`;
                });
                card.addEventListener('mouseleave', () => {
                    card.style.background  = 'rgba(255,255,255,0.025)';
                    card.style.borderColor = 'rgba(255,255,255,0.06)';
                    card.style.transform   = '';
                    card.style.boxShadow   = '';
                    const arrow = card.querySelector('svg:last-child');
                    if (arrow) arrow.style.color = '#334155';
                });
            });
        });

    })();
    </script>
</body>
</html>