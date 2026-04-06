<!DOCTYPE html>
<html lang="pt-BR" class="scroll-smooth">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>StudyLab — Estude com inteligência</title>
    <meta name="description" content="Plataforma de estudos com IA para estudantes que querem evoluir com dados.">


    {{-- Tailwind CDN (substituir por build local em produção) --}}
    @vite('resources/css/app.css')
    <link rel="stylesheet" href="{{ asset('css/home.css') }}">
</head>

<body class="bg-[#0a0a0f] text-slate-200 font-body">

    <!-- ════════════════════════════════════════════
        STICKY HEADER
    ════════════════════════════════════════════ -->
    <header id="header" class="fixed top-0 left-0 right-0 z-50 transition-all duration-300"
        style="background: rgba(10,10,15,0.7); backdrop-filter: blur(20px); border-bottom: 1px solid transparent;">
        <nav class="max-w-7xl mx-auto px-6 h-16 flex items-center justify-between">

            {{-- Logo --}}
            <img src="{{ asset('images/logo-dark-mode.png') }}" class="flex h-[100px] items-center gap-2.5 group alt="
                StudyLab">


            {{-- Nav links (desktop) --}}
            <ul class="hidden md:flex items-center gap-8 text-sm font-medium">
                <li><a href="#features" class="nav-link">Funcionalidades</a></li>
                <li><a href="#how-it-works" class="nav-link">Como funciona</a></li>
                <li><a href="#testimonials" class="nav-link">Depoimentos</a></li>
                <li><a href="#pricing" class="nav-link">Preços</a></li>
            </ul>

            {{-- CTA ghost --}}
            <div class="flex items-center gap-3">
                <a href="{{ route('login') }}" class="hidden sm:block text-sm nav-link">Entrar</a>
                <a href="{{ route('register') }}" class="btn-outline px-5 py-2 rounded-lg text-sm">
                    Começar grátis
                </a>
            </div>

            {{-- Mobile hamburger --}}
            <button id="menu-toggle" class="md:hidden text-white p-2" aria-label="Menu">
                <svg id="icon-open" class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                </svg>
                <svg id="icon-close" class="w-5 h-5 hidden" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                </svg>
            </button>
        </nav>

        {{-- Mobile menu --}}
        <div id="mobile-menu" class="hidden md:hidden px-6 pb-6 pt-2 space-y-4 text-sm font-medium border-t"
            style="border-color: var(--border);">
            <a href="#features" class="block nav-link py-2">Funcionalidades</a>
            <a href="#how-it-works" class="block nav-link py-2">Como funciona</a>
            <a href="#testimonials" class="block nav-link py-2">Depoimentos</a>
            <a href="#pricing" class="block nav-link py-2">Preços</a>
            <a href="{{ route('register') }}" class="btn-pink block text-center px-6 py-3 rounded-xl mt-2">Começar
                gratuitamente</a>
        </div>
    </header>


    <!-- ════════════════════════════════════════════
        HERO SECTION
    ════════════════════════════════════════════ -->
    <section class="relative min-h-screen flex items-center overflow-hidden pt-16">

        {{-- Background mesh --}}
        <div class="hero-mesh"></div>

        {{-- Floating blobs --}}
        <div class="shape-blob absolute w-96 h-96 bg-pink-500 -top-20 -left-20 animate-float"
            style="animation-duration: 8s;"></div>
        <div class="shape-blob absolute w-64 h-64 bg-violet-600 top-1/3 right-10 animate-float-delayed"
            style="animation-duration: 10s;"></div>
        <div class="shape-blob absolute w-48 h-48 bg-pink-500 bottom-10 left-1/3"
            style="opacity:0.07; filter: blur(80px);"></div>

        {{-- Particles --}}
        <div id="particles" class="absolute inset-0 pointer-events-none overflow-hidden"></div>

        <div class="relative z-10 max-w-7xl mx-auto px-6 py-24 grid lg:grid-cols-2 gap-16 items-center w-full">

            {{-- Left: copy --}}
            <div>
                <div class="inline-flex items-center gap-2 px-3 py-1.5 rounded-full text-xs font-medium mb-6 border"
                    style="background: rgba(236,72,153,0.1); border-color: rgba(236,72,153,0.3); color: #ec4899; animation: fade-up 0.5s ease forwards;">
                    <span class="w-1.5 h-1.5 rounded-full bg-pink-500 animate-pulse"></span>
                    Feito por Estudantes para Estudantes
                </div>

                <h1 class="font-display text-5xl sm:text-6xl xl:text-7xl font-extrabold leading-[1.05] text-white mb-6"
                    style="animation: fade-up 0.7s 0.1s ease both;">
                    Estude com<br>
                    <span
                        style="background: linear-gradient(90deg, #ec4899, #f472b6, #d91956); -webkit-background-clip: text; -webkit-text-fill-color: transparent; background-clip: text;">
                        inteligência.
                    </span><br>
                    Evolua com dados.
                </h1>

                <p class="text-lg text-slate-400 leading-relaxed mb-10 max-w-lg"
                    style="animation: fade-up 0.7s 0.2s ease both;">
                    Study Lab usa praticidade e rapidez para auxiliar  sua jornada de aprendizado, rastrear seu
                    progresso e transformar horas de estudo em resultados reais.
                </p>

                <div class="flex flex-wrap gap-4" style="animation: fade-up 0.7s 0.3s ease both;">
                    <a href="{{ route('register') }}"
                        class="btn-pink px-8 py-4 rounded-xl text-base inline-flex items-center gap-2">
                        Começar gratuitamente
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M17 8l4 4m0 0l-4 4m4-4H3" />
                        </svg>
                    </a>
                    <a href="#how-it-works"
                        class="flex items-center gap-2 text-slate-400 hover:text-white transition-colors text-sm font-medium py-4">
                        <div class="w-10 h-10 rounded-full border flex items-center justify-center"
                            style="border-color: var(--border);">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M14.752 11.168l-3.197-2.132A1 1 0 0010 9.87v4.263a1 1 0 001.555.832l3.197-2.132a1 1 0 000-1.664z" />
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                            </svg>
                        </div>
                        Ver como funciona
                    </a>
                </div>

                
            </div>

            {{-- Right: Dashboard Mockup --}}
            {{-- Scroll indicator --}}
            <div
                class="absolute bottom-8 left-1/2 -translate-x-1/2 flex flex-col items-center gap-2 text-slate-600 text-xs">
                <span>Scroll</span>
                <div class="w-px h-12 bg-gradient-to-b from-pink-500 to-transparent animate-pulse"></div>
            </div>
    </section>


    <!-- ════════════════════════════════════════════
        FEATURES SECTION
    ════════════════════════════════════════════ -->
    <section id="features" class="py-32 relative">
        <div class="shape-blob absolute w-80 h-80 bg-violet-600 right-0 top-20"
            style="opacity:0.07; filter:blur(80px);"></div>

        <div class="max-w-7xl mx-auto px-6">

            <div class="text-center mb-16 reveal">
                <span class="text-xs font-semibold tracking-widest uppercase"
                    style="color: #ec4899;">Funcionalidades</span>
                <h2 class="font-display text-4xl sm:text-5xl font-extrabold text-white mt-3 leading-tight">
                    Tudo que você precisa<br>
                    <span style="color: #ec4899;">em um só lugar</span>
                </h2>
                <p class="text-slate-400 mt-4 max-w-xl mx-auto text-lg">
                    Ferramentas pensadas para estudantes que levam a sério seu desenvolvimento.
                </p>
            </div>

            <div class="grid md:grid-cols-2 lg:grid-cols-3 gap-6">
                @php
                    $features = [
                        [
                            'icon' => '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M9.663 17h4.673M12 3v1m6.364 1.636l-.707.707M21 12h-1M4 12H3m3.343-5.657l-.707-.707m2.828 9.9a5 5 0 117.072 0l-.548.547A3.374 3.374 0 0014 18.469V19a2 2 0 11-4 0v-.531c0-.895-.356-1.754-.988-2.386l-.548-.547z"/>',
                            'title' => 'IA de Suporte',
                            'desc' => 'Planos de estudo auxiliados por inteligência artificial, adaptados ao seu ritmo e objetivos.',
                            'color' => '#ec4899',
                        ],
                        [
                            'icon' => '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"/>',
                            'title' => 'Análise de Desempenho',
                            'desc' => 'Dashboards em tempo real com gráficos de progresso, pontos fortes e áreas de melhoria.',
                            'color' => '#a855f7',
                        ],
                        [
                            'icon' => '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/>',
                            'title' => 'Cronograma Inteligente',
                            'desc' => 'Organize seu tempo com lembretes automáticos e blocos de estudo baseados na sua agenda.',
                            'color' => '#06b6d4',
                        ],
                        [
                            'icon' => '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-6 9l2 2 4-4"/>',
                            'title' => 'Flashcards & Revisão',
                            'desc' => 'Sistema de repetição espaçada que garante que você revise no momento certo para fixar o conteúdo.',
                            'color' => '#10b981',
                        ],
                        [
                            'icon' => '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0z"/>',
                            'title' => 'Grupos de Estudo',
                            'desc' => 'Crie salas virtuais, compartilhe anotações e estude colaborativamente com seus colegas.',
                            'color' => '#f59e0b',
                        ],
                        [
                            'icon' => '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9"/>',
                            'title' => 'Notificações & Metas',
                            'desc' => 'Defina metas semanais, receba alertas personalizados e celebre cada conquista na sua jornada.',
                            'color' => '#ec4899',
                        ],
                    ];
                @endphp

                @foreach($features as $i => $f)
                    <div class="glass-card rounded-2xl p-6 reveal reveal-delay-{{ ($i % 3) + 1 }}">
                        <div class="w-12 h-12 rounded-xl flex items-center justify-center mb-4"
                            style="background: {{ $f['color'] }}18; border: 1px solid {{ $f['color'] }}40;">
                            <svg class="w-6 h-6" fill="none" stroke="{{ $f['color'] }}" viewBox="0 0 24 24">
                                {!! $f['icon'] !!}
                            </svg>
                        </div>
                        <h3 class="font-display font-bold text-white text-lg mb-2">{{ $f['title'] }}</h3>
                        <p class="text-slate-400 text-sm leading-relaxed">{{ $f['desc'] }}</p>
                    </div>
                @endforeach
            </div>
        </div>
    </section>


    <!-- ════════════════════════════════════════════
        HOW IT WORKS
    ════════════════════════════════════════════ -->
    <section id="how-it-works" class="py-32 relative overflow-hidden">
        <div class="shape-blob absolute w-96 h-96 bg-pink-500 -left-20 bottom-0"
            style="opacity:0.06; filter:blur(100px);"></div>

        <div class="max-w-7xl mx-auto px-6">

            <div class="text-center mb-20 reveal">
                <span class="text-xs font-semibold tracking-widest uppercase" style="color: #ec4899;">Processo</span>
                <h2 class="font-display text-4xl sm:text-5xl font-extrabold text-white mt-3">
                    Simples assim
                </h2>
                <p class="text-slate-400 mt-4 max-w-lg mx-auto">
                    Em menos de 5 minutos você já está estudando de forma inteligente.
                </p>
            </div>

            <div class="grid md:grid-cols-4 gap-8 relative">
                {{-- Connecting line (desktop) --}}
                <div class="hidden md:block absolute top-10 left-[12.5%] right-[12.5%] h-px"
                    style="background: linear-gradient(90deg, #ec4899, rgba(236,72,153,0.1) 60%, transparent);"></div>

                @php
                    $steps = [
                        ['num' => '01', 'title' => 'Crie sua conta', 'desc' => 'Cadastre-se em segundos, sem cartão de crédito.'],
                        ['num' => '02', 'title' => 'Configure seu perfil', 'desc' => 'Informe suas matérias, objetivos e disponibilidade de tempo.'],
                        ['num' => '03', 'title' => 'Entre no foco', 'desc' => 'Acesse nossa pagina de focus para começar os estudos da melhor forma possivel.'],
                        ['num' => '04', 'title' => 'Evolua com dados', 'desc' => 'Acompanhe métricas reais e ajuste sua estratégia continuamente.'],
                    ];
                @endphp

                @foreach($steps as $i => $step)
                    <div class="text-center reveal reveal-delay-{{ $i + 1 }}">
                        <div class="relative inline-flex w-20 h-20 rounded-full items-center justify-center mb-5 mx-auto"
                            style="background: {{ $i === 0 ? 'linear-gradient(135deg, #ec4899, #9333ea)' : 'rgba(255,255,255,0.04)' }};
                                                                                                                                                                    border: 1px solid {{ $i === 0 ? 'transparent' : 'rgba(255,255,255,0.08)' }};
                                                                                                                                                                    box-shadow: {{ $i === 0 ? '0 0 40px rgba(236,72,153,0.4)' : 'none' }};">
                            <span
                                class="font-display font-extrabold text-xl {{ $i === 0 ? 'text-white' : 'text-slate-500' }}">
                                {{ $step['num'] }}
                            </span>
                        </div>
                        <h3 class="font-display font-bold text-white text-lg mb-2">{{ $step['title'] }}</h3>
                        <p class="text-slate-400 text-sm leading-relaxed">{{ $step['desc'] }}</p>
                    </div>
                @endforeach
            </div>

            {{-- Decorative code block --}}
            <div class="mt-20 max-w-2xl mx-auto reveal">
                <div class="glass-card rounded-2xl overflow-hidden" style="border-color: rgba(236,72,153,0.2);">
                    <div class="flex items-center gap-2 px-4 py-3 border-b"
                        style="border-color: var(--border); background: rgba(255,255,255,0.02);">
                        <div class="flex gap-1.5">
                            <div class="w-3 h-3 rounded-full" style="background: #ff5f57;"></div>
                            <div class="w-3 h-3 rounded-full" style="background: #ffbd2e;"></div>
                            <div class="w-3 h-3 rounded-full" style="background: #28c840;"></div>
                        </div>
                        <span class="text-xs text-slate-500 ml-2">plano-de-estudos</span>
                    </div>
                    <pre class="p-6 text-sm overflow-x-auto"
                        style="font-family: 'JetBrains Mono', monospace; line-height: 1.6;"><code><span style="color:#718096;"></span></code></pre>
                </div>
            </div>
        </div>
    </section>


    <!-- ════════════════════════════════════════════
        TESTIMONIALS
    ════════════════════════════════════════════ -->
    <section id="testimonials" class="py-32 relative">
        <div class="max-w-7xl mx-auto px-6">

            <div class="text-center mb-16 reveal">
                <span class="text-xs font-semibold tracking-widest uppercase" style="color: #ec4899;">Depoimentos</span>
                <h2 class="font-display text-4xl sm:text-5xl font-extrabold text-white mt-3">
                    Quem usa, aprova
                </h2>
            </div>

            <div class="grid md:grid-cols-3 gap-6">
                @php
                    $testimonials = [
                        [
                            'name' => 'Indefinido',
                            'role' => '*',
                            'text' => 'O Study Lab mudou completamente minha forma de estudar. O plano da IA é absurdamente preciso e os dashboards me motivam todo dia.',
                            'avatar' => '#ec4899',
                            'letter' => 'A',
                        ],
                        [
                            'name' => 'indefinido',
                            'role' => '#',
                            'text' => 'Passei no concurso em 8 meses seguindo o cronograma inteligente. Nunca tinha conseguido manter uma sequência tão longa de estudos.',
                            'avatar' => '#9333ea',
                            'letter' => 'P',
                        ],
                        [
                            'name' => 'indefinido',
                            'role' => '#',
                            'text' => 'Os flashcards com repetição espaçada são incríveis. Minha retenção de conteúdo aumentou tanto que minha média foi de 7 para 9,4.',
                            'avatar' => '#06b6d4',
                            'letter' => 'J',
                        ],
                    ];
                @endphp

                @foreach($testimonials as $i => $t)
                    <div class="glass-card rounded-2xl p-6 reveal reveal-delay-{{ $i + 1 }}">
                        <div class="flex gap-0.5 mb-4">
                            @for($s = 0; $s < 5; $s++)
                                <svg class="w-4 h-4 star" fill="currentColor" viewBox="0 0 20 20">
                                    <path
                                        d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z" />
                                </svg>
                            @endfor
                        </div>
                        <p class="text-slate-300 text-sm leading-relaxed mb-5 italic">"{{ $t['text'] }}"</p>
                        <div class="flex items-center gap-3">
                            <div class="w-9 h-9 rounded-full flex items-center justify-center text-sm font-bold text-white"
                                style="background: {{ $t['avatar'] }};">
                                {{ $t['letter'] }}
                            </div>
                            <div>
                                <div class="text-white text-sm font-semibold">{{ $t['name'] }}</div>
                                <div class="text-slate-500 text-xs">{{ $t['role'] }}</div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </section>


    <!-- ════════════════════════════════════════════
        PRICING
    ════════════════════════════════════════════ -->
    <section id="pricing" class="py-32 relative overflow-hidden">
        <div class="shape-blob absolute w-96 h-96 bg-pink-500 right-0 top-0" style="opacity:0.06; filter:blur(100px);">
        </div>

        <div class="max-w-7xl mx-auto px-6">

            <div class="text-center mb-4 reveal">
                <span class="text-xs font-semibold tracking-widest uppercase" style="color: #ec4899;">Planos</span>
                <h2 class="font-display text-4xl sm:text-5xl font-extrabold text-white mt-3">
                    Invista no seu futuro
                </h2>
                <p class="text-slate-400 mt-4">Sem surpresas. Cancele quando quiser.</p>
            </div>

            <div class="grid md:grid-cols-3 gap-8 items-start">
                @php
                    $plans = [
                        [
                            'name' => 'Aprender',
                            'price' => 'R$ 0',
                            'period' => 'para sempre',
                            'desc' => 'Perfeito para começar',
                            'features' => ['Até 3 matérias', '5h de estudo/semana', 'Flashcards básicos', 'Dashboard simples'],
                            'cta' => 'Criar conta grátis',
                            'recommended' => false,
                        ],
                        [
                            'name' => 'Dominar',
                            'price' => 'R$ 15',
                            'period' => '/mês',
                            'desc' => 'Para quem leva a sério',
                            'features' => ['Matérias ilimitadas', 'Horas ilimitadas', 'IA personalizada', 'Grupos de estudo', 'Análise avançada', 'Notificações inteligentes'],
                            'cta' => 'Começar agora',
                            'recommended' => true,
                        ],
                        [
                            'name' => 'Evoluir',
                            'price' => 'R$ 10',
                            'period' => '/mês',
                            'desc' => 'Para quem quer melhorar',
                            'features' => ['Tudo do Pro', 'Até 10 membros', 'Dashboard do grupo', 'Relatórios de turma', 'Suporte prioritário'],
                            'cta' => 'Falar com vendas',
                            'recommended' => false,
                        ],
                    ];
                @endphp

                @foreach($plans as $i => $plan)
                    <div class="reveal  reveal-delay-{{ $i + 1 }} {{ $plan['recommended'] ? '-mt-4' : '' }}">
                        @if($plan['recommended'])
                            <div class="text-center mb-3">
                                
                            </div>
                        @endif

                        <div
                            class="rounded-2xl p-7 {{ $plan['recommended'] ? 'pricing-recommended' : 'glass-card' }} relative">

                            <div class="mb-6">
                                <div
                                    class="font-display font-bold text-lg mb-1 {{ $plan['recommended'] ? 'text-white' : 'text-white' }}">
                                    {{ $plan['name'] }}
                                </div>
                                <div class="{{ $plan['recommended'] ? 'text-pink-100' : 'text-slate-400' }} text-sm mb-4">
                                    {{ $plan['desc'] }}
                                </div>
                                <div class="flex items-end gap-1">
                                    <span
                                        class="font-display font-extrabold text-4xl text-white">{{ $plan['price'] }}</span>
                                    <span
                                        class="{{ $plan['recommended'] ? 'text-pink-200' : 'text-slate-500' }} text-sm mb-1">{{ $plan['period'] }}</span>
                                </div>
                            </div>

                            <ul class="space-y-3 mb-8">
                                @foreach($plan['features'] as $feature)
                                    <li
                                        class="flex items-center gap-2.5 text-sm {{ $plan['recommended'] ? 'text-white' : 'text-slate-300' }}">
                                        <svg class="w-4 h-4 flex-shrink-0 {{ $plan['recommended'] ? 'text-white' : '' }}"
                                            fill="none" stroke="{{ $plan['recommended'] ? '#fff' : '#ec4899' }}"
                                            viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5"
                                                d="M5 13l4 4L19 7" />
                                        </svg>
                                        {{ $feature }}
                                    </li>
                                @endforeach
                            </ul>

                            @if($plan['recommended'])
                                <a href="{{ route('register') }}"
                                    class="block text-center py-3 rounded-xl font-display font-bold text-sm transition-all"
                                    style="background: rgba(255,255,255,0.2); color: #fff; border: 1px solid rgba(255,255,255,0.3);"
                                    onmouseover="this.style.background='rgba(255,255,255,0.3)'"
                                    onmouseout="this.style.background='rgba(255,255,255,0.2)'">
                                    {{ $plan['cta'] }}
                                </a>
                            @else
                                <a href="{{ route('register') }}" class="btn-outline block text-center py-3 rounded-xl text-sm">
                                    {{ $plan['cta'] }}
                                </a>
                            @endif
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </section>


    <!-- ════════════════════════════════════════════
        FINAL CTA
    ════════════════════════════════════════════ -->
    <section class="py-40 relative overflow-hidden">
        <div class="hero-mesh"></div>
        <div class="shape-blob absolute w-[500px] h-[500px] bg-pink-500 left-1/2 top-1/2 -translate-x-1/2 -translate-y-1/2"
            style="opacity:0.08; filter:blur(120px);"></div>

        <div class="relative z-10 max-w-4xl mx-auto px-6 text-center reveal">
            <div class="inline-flex items-center gap-2 px-3 py-1.5 rounded-full text-xs font-medium mb-8 border"
                style="background: rgba(236,72,153,0.1); border-color: rgba(236,72,153,0.3); color: #ec4899;">
                <span class="w-1.5 h-1.5 rounded-full bg-pink-500 animate-pulse"></span>
                Comece hoje mesmo
            </div>

            <h2 class="font-display text-5xl sm:text-6xl xl:text-7xl font-extrabold text-white leading-tight mb-6">
                Seu próximo<br>
                <span
                    style="background: linear-gradient(90deg, #ec4899, #f472b6, #a855f7); -webkit-background-clip: text; -webkit-text-fill-color: transparent; background-clip: text;">
                    nível começa aqui.
                </span>
            </h2>

            <p class="text-slate-400 text-lg mb-10 max-w-xl mx-auto">
                Junte-se a milhares de estudantes que já transformaram sua rotina de estudos com o Study Lab.
            </p>

            <div class="flex flex-wrap gap-4 justify-center">
                <a href="{{ route('register') }}"
                    class="btn-pink px-10 py-4 rounded-xl text-base inline-flex items-center gap-2 animate-pulse-pink">
                    Criar conta gratuitamente
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M17 8l4 4m0 0l-4 4m4-4H3" />
                    </svg>
                </a>
            </div>

            <p class="text-slate-600 text-sm mt-6">Gratuito para começar · Sem cartão de crédito · Cancele quando quiser
            </p>
        </div>
    </section>


    <!-- ════════════════════════════════════════════
        FOOTER
    ════════════════════════════════════════════ -->
    <footer class="border-t py-12" style="border-color: var(--border);">
        <div class="max-w-7xl mx-auto px-6">
            <div class="flex flex-col md:flex-row items-center justify-between gap-6">
                <a href="#">
                    <img src="{{ asset('images/logo-dark-mode.png') }}" alt="StudyLab" class="h-28">
                </a>

                <div class="flex gap-6 text-sm text-slate-500">
                    <a href="#" class="hover:text-white transition-colors">Privacidade</a>
                    <a href="#" class="hover:text-white transition-colors">Termos</a>
                    <a href="#" class="hover:text-white transition-colors">Contato</a>
                </div>

                <p class="text-slate-600 text-sm">
                    © {{ date('Y') }} Study Lab. Todos os direitos reservados.
                </p>
            </div>
        </div>
    </footer>

    <script src="{{ asset('js/home.js') }}"></script>
</body>

</html>