<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>StudyLab — Estude com inteligência</title>
    <link rel="icon" type="image/png" href="{{ asset('favicons/logo/logo.png') }}">
    <meta name="description" content="Plataforma de estudos com IA para estudantes que querem evoluir com dados.">
    <link rel="stylesheet" href="{{ asset('css/home.css') }}">
    @vite('resources/css/app.css')
    <link rel="stylesheet" href="{{ asset('css/home.css') }}">
    <link rel="stylesheet" href="{{ asset('css/pro-max.css') }}">

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Unbounded:wght@400;700;900&family=DM+Mono:ital,opsz,wght@0,14,300;0,14,400;0,14,500;1,14,300&display=swap" rel="stylesheet">


</head>
<body>

    <!-- Scroll progress bar -->
    <div id="prog"></div>

    <!-- Custom cursor -->
    <div id="c-d"></div>
    <div id="c-r"></div>

    <!-- ══════════════════════════════════════
         HEADER
    ══════════════════════════════════════ -->
    <header id="hdr">
        <div class="hi">
            <a href="#" style="cursor:none;"><img src="{{ asset('images/logo-dark-mode.png') }}" alt="StudyLab" style="height:100px;"></a>
            <ul class="hnav">
                <li><a href="#features">Recursos</a></li>
                <li><a href="#app-action">App</a></li>
                <li><a href="#process">Processo</a></li>
                <li><a href="#testi">Histórias</a></li>
                <li><a href="#pricing">Preços</a></li>
            </ul>
            <div style="display:flex;align-items:center;gap:10px;">
                <a href="{{ route('login') }}" class="btn btn-od" style="padding:10px 20px;font-size:.64rem;">Entrar</a>
                <a href="{{ route('register') }}" class="btn btn-r" style="padding:10px 20px;font-size:.64rem;">
                    Começar grátis
                    <svg width="11" height="11" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><path d="M5 12h14M12 5l7 7-7 7"/></svg>
                </a>
            </div>
        </div>
    </header>


    <!-- ══════════════════════════════════════
         HERO
    ══════════════════════════════════════ -->
    <section id="hero">
        <!-- Aurora mesh layer -->
        <div id="hero-aurora"></div>
        <!-- Ambient orbs -->
        <div class="hero-orb hero-orb-1"></div>
        <div class="hero-orb hero-orb-2"></div>

        <!-- Left copy -->
        <div class="hl">
            <div style="margin-bottom:32px;" class="sr">
                <span class="lbl"><span class="acc-bar"></span>Study Lab · 2025</span>
            </div>

            <h1 class="d1" style="margin-bottom:44px;">
                <span class="cw ca1"><span class="ci">ESTUDE</span></span>
                <span class="cw ca2"><span class="ci">COM</span></span>
                <span class="cw ca3"><span class="ci shimmer-acc">INTELI-</span></span>
                <span class="cw ca4"><span class="ci shimmer-acc">GÊNCIA.</span></span>
            </h1>

            <div style="width:44px;height:2px;background:var(--acc);margin-bottom:22px;" class="sr d1s"></div>

            <p class="body-l sr d2s" style="max-width:400px;margin-bottom:40px;">
                Plataforma com IA que rastreia seu progresso e transforma horas de estudo em resultados reais.
            </p>

            <div style="display:flex;align-items:center;gap:12px;flex-wrap:wrap;" class="sr d3s">
                <a href="{{ route('register') }}" class="btn btn-r" style="padding:16px 34px;font-size:.72rem;">
                    Começar gratuitamente
                    <svg width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><path d="M5 12h14M12 5l7 7-7 7"/></svg>
                </a>
                <a href="{{ route('login') }}" class="btn btn-od" style="padding:16px 26px;font-size:.72rem;">Já tenho conta</a>
            </div>

            <!-- Proof numbers -->
            <div style="display:flex;gap:0;margin-top:52px;" class="sr d4s">
                @php $proof = [['12k+', 'estudantes'], ['4.9★', 'avaliação'], ['98%', 'satisfação']]; @endphp
                @foreach($proof as $pi => $p)
                    <div style="padding-right:36px;{{ $pi > 0 ? 'padding-left:36px;border-left:1px solid var(--ld);' : '' }}">
                        <div style="font-family:var(--fh);font-weight:900;font-size:1.65rem;color:var(--white);line-height:1;">{{ $p[0] }}</div>
                        <div style="font-size:.62rem;color:var(--md);text-transform:uppercase;letter-spacing:.1em;margin-top:5px;">{{ $p[1] }}</div>
                    </div>
                @endforeach
            </div>
        </div>

        <!-- Right mockup + floating pills -->
        <div class="hr">

            <!-- Floating glass pill 1 — streak -->
            <div class="fpill gd" id="pill1" style="top:14%;left:-8%;animation: float-a 6s ease-in-out infinite; animation-play-state:paused;">
                <div class="fpill-dot" style="background:#FF1C4B;"></div>
                <span style="font-family:var(--fh);font-size:.62rem;font-weight:700;color:var(--white);">🔥 14 dias de sequência!</span>
            </div>

            <!-- Floating glass pill 2 — goal done -->
            <div class="fpill gd" id="pill2" style="bottom:18%;right:-12%;animation: float-b 7s ease-in-out infinite; animation-play-state:paused;">
                <div class="fpill-dot" style="background:#22C55E;"></div>
                <span style="font-family:var(--fh);font-size:.62rem;font-weight:700;color:var(--white);">✓ Meta diária concluída!</span>
            </div>

            <!-- Floating glass pill 3 — retention -->
            <div class="fpill gd" id="pill3" style="top:42%;right:-16%;animation: float-c 8s ease-in-out infinite; animation-play-state:paused;">
                <div class="fpill-dot" style="background:#818CF8;"></div>
                <span style="font-family:var(--fh);font-size:.62rem;font-weight:700;color:var(--white);">📈 +23% de retenção</span>
            </div>

            <!-- App shell -->
            <div class="app" id="app-sh">
                <div class="atb">
                    <div class="td" style="background:#FF5F57;"></div>
                    <div class="td" style="background:#FFBD2E;"></div>
                    <div class="td" style="background:#28C840;"></div>
                    <span style="font-size:.65rem;color:var(--md);margin-left:10px;font-family:var(--fb);">StudyLab · Modo Foco</span>
                </div>
                <div class="abb">
                    <!-- Pomodoro ring -->
                    <div class="pmw">
                        <svg width="150" height="150" viewBox="0 0 150 150">
                            <circle class="pmk" cx="75" cy="75" r="65"/>
                            <circle class="pmp" cx="75" cy="75" r="65"/>
                        </svg>
                        <div class="pml">
                            <span class="pmt" id="pm-t">24:37</span>
                            <span class="pms">Pomodoro</span>
                        </div>
                    </div>
                    <!-- Subject -->
                    <div style="text-align:center;margin-bottom:18px;">
                        <div style="font-family:var(--fh);font-size:.95rem;color:var(--white);font-weight:700;margin-bottom:3px;">Cálculo III</div>
                        <div style="font-size:.62rem;color:var(--md);">Sessão 3 de 4 · Hoje</div>
                    </div>
                    <!-- Chips -->
                    <div class="cpr">
                        @foreach([['3h12', 'Foco', '#FF1C4B'], ['87%', 'Efic.', '#22C55E'], ['14', 'Cards', '#818CF8']] as $c)
                            <div class="cp">
                                <div class="cpv" style="color:{{ $c[2] }};">{{ $c[0] }}</div>
                                <div class="cpl">{{ $c[1] }}</div>
                            </div>
                        @endforeach
                    </div>
                    <!-- Week -->
                    @php $wkd = ['S', 'T', 'Q', 'Q', 'S', 'S', 'D'];
                    $wkdn = [1, 1, 1, 1, 0, 0, 0]; @endphp
                    <div class="wkr">
                        @foreach($wkd as $wi => $wd)
                            <div class="wkd">
                                <div class="wkb" style="background:{{ $wkdn[$wi] ? 'var(--acc)' : 'rgba(255,255,255,0.04)' }};">
                                    @if($wkdn[$wi])<svg width="8" height="8" viewBox="0 0 24 24" fill="none" stroke="#fff" stroke-width="3"><path d="M20 6L9 17l-5-5"/></svg>@endif
                                </div>
                                <div class="wkl">{{ $wd }}</div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>

        </div>
    </section>


    <!-- ══════════════════════════════════════
         LIVE ACTIVITY MARQUEE
    ══════════════════════════════════════ -->
    <div class="lmb">
        <div class="lmt">
            @php
                $live = [
                    ['Ana C. está estudando Cálculo agora', '#FF1C4B'],
                    ['Pedro concluiu 50 flashcards', '#22C55E'],
                    ['Julia atingiu a meta semanal', '#818CF8'],
                    ['Rafael está em 2h30 de foco contínuo', '#F59E0B'],
                    ['12 estudantes online agora', '#22D3EE'],
                    ['Camila criou um grupo de estudos', '#FF1C4B'],
                    ['Ana C. está estudando Cálculo agora', '#FF1C4B'],
                    ['Pedro concluiu 50 flashcards', '#22C55E'],
                    ['Julia atingiu a meta semanal', '#818CF8'],
                    ['Rafael está em 2h30 de foco contínuo', '#F59E0B'],
                    ['12 estudantes online agora', '#22D3EE'],
                    ['Camila criou um grupo de estudos', '#FF1C4B'],
                ];
            @endphp
            @foreach($live as $li)
                <span class="lmi"><span class="lma" style="color:{{ $li[1] }};">●</span> {{ $li[0] }} <span style="color:var(--ld);margin:0 12px;">·</span></span>
            @endforeach
        </div>
    </div>

    <!-- MARQUEE — red band -->
    <div class="mqb">
        <div class="mqt">
            @php $mw = ['IA de Suporte', 'Flashcards', 'Modo Foco', 'Análise de Dados', 'Cronograma', 'Grupos de Estudo', 'Repetição Espaçada', 'Metas Diárias']; @endphp
            @foreach(array_merge($mw, $mw) as $w)
                <span class="mqi">{{ $w }}<span class="mqsep"> ·</span></span>
            @endforeach
        </div>
    </div>


    <!-- ══════════════════════════════════════
         FEATURES — interactive tabs
    ══════════════════════════════════════ -->
    <section id="features" class="sec">
        <div class="container">

            <div style="display:flex;justify-content:space-between;align-items:flex-end;margin-bottom:48px;flex-wrap:wrap;gap:24px;">
                <div>
                    <span class="lbl sr" style="display:block;margin-bottom:10px;">Recursos</span>
                    <h2 class="d2 sr d1s">Tudo que você<br>precisa para vencer.</h2>
                </div>
                <p class="body-l sr d2s" style="max-width:320px;text-align:left;">Ferramentas construídas para estudantes que levam a sério o próprio desenvolvimento.</p>
            </div>

            <!-- Tabs -->
            @php
                $feats = [
                    ['tab' => 'IA de Suporte', 'title' => 'Planos gerados por inteligência artificial', 'desc' => 'Nossa IA analisa seu ritmo de aprendizado e gera um plano personalizado que evolui com você. Sem fórmulas genéricas — cada plano é único.', 'color' => '#FF1C4B', 'type' => 'ai'],
                    ['tab' => 'Análise', 'title' => 'Dashboards que mostram onde você realmente está', 'desc' => 'Gráficos em tempo real, comparativos semanais e indicadores por matéria. Você sabe onde precisa melhorar antes que seja tarde.', 'color' => '#818CF8', 'type' => 'chart'],
                    ['tab' => 'Flashcards', 'title' => 'Memória de longo prazo com repetição espaçada', 'desc' => 'O sistema aprende quando você está prestes a esquecer e apresenta o conteúdo no momento certo. Ciência aplicada ao estudo.', 'color' => '#22D3EE', 'type' => 'flash'],
                    ['tab' => 'Modo Foco', 'title' => 'Timer Pomodoro com rastreamento automático', 'desc' => 'Entre no flow com o modo foco. Timer pomodoro, sessões registradas automaticamente e músicas para concentração.', 'color' => '#F59E0B', 'type' => 'foco'],
                    ['tab' => 'Grupos', 'title' => 'Aprenda mais rápido em conjunto', 'desc' => 'Crie salas de estudo, compartilhe anotações e compita em rankings semanais. Responsabilidade coletiva mantém a consistência.', 'color' => '#22C55E', 'type' => 'grupo'],
                ];
            @endphp

            <div class="ftb">
                @foreach($feats as $fi => $f)
                    <button class="ftba {{ $fi === 0 ? 'on' : '' }}" onclick="fsw({{ $fi }})">{{ $f['tab'] }}</button>
                @endforeach
            </div>

            @foreach($feats as $fi => $f)
                <div class="fp {{ $fi === 0 ? 'on' : '' }}" id="fp{{$fi}}">
                    <div>
                        <span class="lbl" style="color:{{ $f['color'] }};display:block;margin-bottom:16px;">{{ $f['tab'] }}</span>
                        <h3 class="d3" style="margin-bottom:20px;">{{ $f['title'] }}</h3>
                        <p class="body-l" style="max-width:400px;margin-bottom:32px;">{{ $f['desc'] }}</p>
                        <a href="{{ route('register') }}" class="btn btn-r">Experimentar agora</a>
                    </div>

                    <!-- Animated mini-UI per tab -->
                    <div class="fmb" id="fmb{{$fi}}">
                        <div class="fmb-pad">

                            @if($f['type'] === 'ai')
                                <div style="margin-bottom:14px;">
                                    <span class="lbl" style="color:{{ $f['color'] }};">Plano gerado</span>
                                </div>
                                <div id="tw-box" style="font-size:.78rem;color:var(--md);line-height:1.8;flex:1;">
                                    <span id="tw-text"></span><span class="tw-line" id="tw-cur"></span>
                                </div>
                                <div style="margin-top:auto;padding-top:16px;border-top:1px solid var(--ld);">
                                    @foreach([['Matemática', '#FF1C4B', 75], ['Física', '#818CF8', 55], ['Química', '#22D3EE', 40]] as $pb)
                                        <div style="margin-bottom:8px;">
                                            <div style="display:flex;justify-content:space-between;font-size:.6rem;color:var(--md);margin-bottom:4px;"><span>{{ $pb[0] }}</span><span>{{ $pb[2] }}%</span></div>
                                            <div style="height:3px;background:rgba(255,255,255,.06);border-radius:2px;overflow:hidden;"><div style="height:100%;width:{{ $pb[2] }}%;background:{{ $pb[1] }};border-radius:2px;"></div></div>
                                        </div>
                                    @endforeach
                                </div>

                            @elseif($f['type'] === 'chart')
                                <div style="margin-bottom:14px;">
                                    <span class="lbl" style="color:{{ $f['color'] }};">Semana atual</span>
                                    <div style="font-family:var(--fh);font-size:1.6rem;font-weight:900;color:var(--white);margin-top:4px;">18h 42min</div>
                                    <div style="font-size:.62rem;color:#22C55E;margin-top:2px;">▲ 23% vs semana passada</div>
                                </div>
                                <div class="chart-bars" id="chart-bars">
                                    @foreach([30, 55, 40, 70, 85, 60, 95] as $h)
                                        <div class="cb" style="height:{{ $h }}%;transition-delay:{{ $loop->index * 0.08 }}s;"></div>
                                    @endforeach
                                </div>
                                <div style="display:flex;justify-content:space-between;margin-top:6px;">
                                    @foreach(['S', 'T', 'Q', 'Q', 'S', 'S', 'D'] as $dl)
                                        <div style="flex:1;text-align:center;font-size:.55rem;color:var(--md);">{{ $dl }}</div>
                                    @endforeach
                                </div>

                            @elseif($f['type'] === 'flash')
                                <div style="margin-bottom:14px;">
                                    <span class="lbl" style="color:{{ $f['color'] }};">Flashcard</span>
                                    <div style="font-size:.65rem;color:var(--md);margin-top:4px;">Toque para revelar a resposta</div>
                                </div>
                                <div class="flip-scene">
                                    <div class="flip-card">
                                        <div class="flip-f">O que é a Segunda Lei de Newton?</div>
                                        <div class="flip-b">F = m · a<br><span style="font-size:.75rem;opacity:.8;">Força = massa × aceleração</span></div>
                                    </div>
                                </div>
                                <div style="margin-top:auto;display:flex;gap:8px;padding-top:14px;">
                                    @foreach([['Errei', 'rgba(255,28,75,.15)', 'var(--acc)'], ['Difícil', 'rgba(255,255,255,.06)', 'var(--md)'], ['Acertei', 'rgba(34,197,94,.15)', '#22C55E']] as $fb)
                                        <div style="flex:1;text-align:center;padding:8px;border-radius:8px;background:{{ $fb[1] }};font-size:.6rem;color:{{ $fb[2] }};font-weight:600;cursor:none;">{{ $fb[0] }}</div>
                                    @endforeach
                                </div>

                            @elseif($f['type'] === 'foco')
                                <div style="margin-bottom:14px;">
                                    <span class="lbl" style="color:{{ $f['color'] }};">Modo Foco</span>
                                </div>
                                <div class="mini-timer">
                                    <svg width="130" height="130" viewBox="0 0 130 130">
                                        <circle fill="none" stroke="rgba(255,255,255,0.06)" stroke-width="6" cx="65" cy="65" r="56"/>
                                        <circle fill="none" stroke="{{ $f['color'] }}" stroke-width="6" stroke-linecap="round" cx="65" cy="65" r="56" stroke-dasharray="352" stroke-dashoffset="85" transform="rotate(-90 65 65)" style="animation: pm-tick 2500s linear forwards;"/>
                                        <text x="65" y="62" text-anchor="middle" font-family="'Unbounded',sans-serif" font-weight="900" font-size="18" fill="white" letter-spacing="-1">22:14</text>
                                        <text x="65" y="78" text-anchor="middle" font-family="'DM Mono',monospace" font-size="7" fill="rgba(250,250,247,0.35)" letter-spacing="1.5">POMODORO</text>
                                    </svg>
                                </div>
                                <div style="margin-top:auto;display:grid;grid-template-columns:repeat(3,1fr);gap:8px;padding-top:14px;">
                                    @foreach([['2h48', 'Foco', '#F59E0B'], ['6', 'Sessões', 'var(--white)'], ['92%', 'Efic.', '#22C55E']] as $fc)
                                        <div style="text-align:center;padding:10px 4px;border-radius:8px;background:rgba(255,255,255,0.04);border:1px solid var(--ld);">
                                            <div style="font-family:var(--fh);font-size:.9rem;font-weight:900;color:{{ $fc[2] }};">{{ $fc[0] }}</div>
                                            <div style="font-size:.55rem;color:var(--md);margin-top:3px;text-transform:uppercase;letter-spacing:.1em;">{{ $fc[1] }}</div>
                                        </div>
                                    @endforeach
                                </div>

                            @else {{-- grupo --}}
                                <div style="margin-bottom:16px;">
                                    <span class="lbl" style="color:{{ $f['color'] }};">Sala ativa agora</span>
                                    <div style="font-family:var(--fh);font-size:.85rem;font-weight:700;color:var(--white);margin-top:6px;">Vestibu 2025 · Exatas</div>
                                </div>
                                <div style="display:flex;align-items:center;gap:12px;margin-bottom:20px;">
                                    <div class="gav-stack">
                                        @foreach(['#FF1C4B', '#818CF8', '#22C55E', '#F59E0B'] as $gc)
                                            <div class="gav" style="background:{{ $gc }};">{{ ['A', 'P', 'J', 'M'][$loop->index] }}</div>
                                        @endforeach
                                        <div class="gav" style="background:var(--ink-3);font-size:.55rem;color:var(--md);border:1px solid var(--ld);">+8</div>
                                    </div>
                                    <div>
                                        <div style="font-size:.72rem;color:var(--white);font-weight:600;">12 estudando agora</div>
                                        <div style="font-size:.6rem;color:{{ $f['color'] }};">● Ao vivo</div>
                                    </div>
                                </div>
                                <div style="flex:1;display:flex;flex-direction:column;gap:8px;overflow:hidden;">
                                    @foreach([['Ana', 'Acabei a lista de exercícios!', '2min'], ['Pedro', 'Alguém tem o gabarito de Q5?', '5min'], ['Julia', '✓ Postei no grupo', '8min']] as $gm)
                                        <div style="display:flex;gap:8px;align-items:flex-start;">
                                            <div style="width:22px;height:22px;border-radius:50%;background:var(--acc);flex-shrink:0;display:flex;align-items:center;justify-content:center;font-family:var(--fh);font-size:.5rem;font-weight:900;">{{ substr($gm[0], 0, 1) }}</div>
                                            <div style="flex:1;background:rgba(255,255,255,.04);border-radius:8px;padding:7px 10px;">
                                                <div style="font-size:.6rem;font-weight:600;color:var(--white);margin-bottom:2px;">{{ $gm[0] }}</div>
                                                <div style="font-size:.62rem;color:var(--md);">{{ $gm[1] }}</div>
                                            </div>
                                            <div style="font-size:.55rem;color:var(--md);white-space:nowrap;padding-top:4px;">{{ $gm[2] }}</div>
                                        </div>
                                    @endforeach
                                </div>
                            @endif

                        </div>
                    </div>
                </div>
            @endforeach

        </div>
    </section>

    <hr class="rd">

    <!-- ══════════════════════════════════════
         STATS
    ══════════════════════════════════════ -->
    <div class="stg">
        @php $sts = [['12.000+', 'Estudantes ativos', '12000', '+'], ['98%', 'Taxa de satisfação', '98', '%'], ['4.9★', 'Nota média', '4.9', '★'], ['2M+', 'Horas registradas', '2', 'M+']]; @endphp
        @foreach($sts as $s)
            <div class="stc sr">
                <div class="stn"><span class="cnum" data-t="{{ $s[2] }}" data-sfx="{{ $s[3] }}">{{ $s[0] }}</span></div>
                <div class="stl">{{ $s[1] }}</div>
            </div>
        @endforeach
    </div>

    <hr class="rd">


    <!-- ══════════════════════════════════════
         BENTO GRID — App em ação
    ══════════════════════════════════════ -->
    <section id="app-action" class="sec">
        <div class="container">

            <div style="display:flex;justify-content:space-between;align-items:flex-end;margin-bottom:56px;flex-wrap:wrap;gap:24px;">
                <div>
                    <span class="lbl sr" style="display:block;margin-bottom:10px;">Veja em ação</span>
                    <h2 class="d2 sr d1s">O app que você<br>merecia ter.</h2>
                </div>
                <p class="body-l sr d2s" style="max-width:300px;text-align:right;">Tudo em uma interface limpa, rápida e pensada para o estudante moderno.</p>
            </div>

            <div class="bento">

                <!-- Card 1: AI Plan (large) -->
                <div class="bcard bcard-d bcard-lg srx">
                    <div style="display:flex;justify-content:space-between;align-items:flex-start;margin-bottom:20px;">
                        <div>
                            <div class="lbl" style="margin-bottom:6px;">Plano da semana</div>
                            <div style="font-family:var(--fh);font-size:1.3rem;font-weight:900;color:var(--white);">Gerado pela IA</div>
                        </div>
                        <div style="width:36px;height:36px;border-radius:10px;background:rgba(255,28,75,.15);border:1px solid rgba(255,28,75,.3);display:flex;align-items:center;justify-content:center;">
                            <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="var(--acc)" stroke-width="1.8"><path stroke-linecap="round" stroke-linejoin="round" d="M9.663 17h4.673M12 3v1m6.364 1.636l-.707.707M21 12h-1M4 12H3m3.343-5.657l-.707-.707m2.828 9.9a5 5 0 117.072 0l-.548.547A3.374 3.374 0 0014 18.469V19a2 2 0 11-4 0v-.531c0-.895-.356-1.754-.988-2.386l-.548-.547z"/></svg>
                        </div>
                    </div>
                    @foreach([['Cálculo III', 'Segunda e Quarta · 2h', '#FF1C4B', 80], ['Física II', 'Terça e Quinta · 1h30', '#818CF8', 62], ['Química Org.', 'Sexta · 1h', '#22D3EE', 45], ['Redação', 'Sábado · 45min', '#22C55E', 30]] as $ai)
                        <div style="display:grid;grid-template-columns:1fr auto;align-items:center;gap:12px;margin-bottom:14px;">
                            <div>
                                <div style="font-size:.76rem;color:var(--white);font-weight:600;margin-bottom:4px;">{{ $ai[0] }}</div>
                                <div style="font-size:.62rem;color:var(--md);">{{ $ai[1] }}</div>
                                <div style="height:3px;background:rgba(255,255,255,.06);border-radius:2px;overflow:hidden;margin-top:6px;">
                                    <div style="height:100%;width:{{ $ai[3] }}%;background:{{ $ai[2] }};border-radius:2px;"></div>
                                </div>
                            </div>
                            <div style="font-size:.65rem;font-family:var(--fh);font-weight:700;color:{{ $ai[2] }};">{{ $ai[3] }}%</div>
                        </div>
                    @endforeach
                </div>

                <!-- Card 2: Streak (small) -->
                <div class="bcard bcard-a bcard-sm srr" style="display:flex;flex-direction:column;align-items:center;justify-content:center;text-align:center;">
                    <div style="font-size:3rem;margin-bottom:8px;line-height:1;">🔥</div>
                    <div style="font-family:var(--fh);font-weight:900;font-size:3.5rem;color:#fff;line-height:1;margin-bottom:4px;">14</div>
                    <div style="font-size:.65rem;color:rgba(255,255,255,.7);text-transform:uppercase;letter-spacing:.12em;font-weight:500;">dias seguidos</div>
                    <div style="font-size:.62rem;color:rgba(255,255,255,.55);margin-top:8px;">Continue assim! Seu recorde é 21.</div>
                </div>

                <!-- Card 3: Sparkline (glass, small) -->
                <div class="bcard bcard-g bcard-sm ss">
                    <div class="lbl" style="margin-bottom:6px;">Esta semana</div>
                    <div style="font-family:var(--fh);font-weight:900;font-size:2rem;color:var(--white);line-height:1;">18h<span style="color:var(--acc);">42</span></div>
                    <div style="font-size:.62rem;color:#22C55E;margin-top:4px;margin-bottom:16px;">▲ 23% vs semana passada</div>
                    <svg class="spark" viewBox="0 0 200 60" width="100%" preserveAspectRatio="none" height="60">
                        <defs>
                            <linearGradient id="sg" x1="0" y1="0" x2="0" y2="1">
                                <stop offset="0%" stop-color="#FF1C4B" stop-opacity=".25"/>
                                <stop offset="100%" stop-color="#FF1C4B" stop-opacity="0"/>
                            </linearGradient>
                        </defs>
                        <path d="M0,50 C20,50 30,30 50,26 C70,22 80,42 100,36 C120,30 130,12 150,9 C170,6 180,22 200,4 L200,60 L0,60 Z" fill="url(#sg)"/>
                        <path class="spark-path" id="spark-p" d="M0,50 C20,50 30,30 50,26 C70,22 80,42 100,36 C120,30 130,12 150,9 C170,6 180,22 200,4"/>
                    </svg>
                </div>

                <!-- Card 4: Donut (glass, small) -->
                <div class="bcard bcard-g bcard-sm ss d2s" style="display:flex;flex-direction:column;align-items:center;justify-content:center;text-align:center;">
                    <div class="lbl" style="margin-bottom:12px;">Eficiência</div>
                    <div style="position:relative;display:inline-flex;">
                        <svg width="100" height="100" viewBox="0 0 100 100" transform="rotate(-90 0 0)">
                            <circle class="donut-track" cx="50" cy="50" r="35" transform="rotate(-90 50 50)"/>
                            <circle class="donut-fill" cx="50" cy="50" r="35" stroke="#FF1C4B" transform="rotate(-90 50 50)"/>
                        </svg>
                        <div style="position:absolute;inset:0;display:flex;flex-direction:column;align-items:center;justify-content:center;">
                            <div style="font-family:var(--fh);font-weight:900;font-size:1rem;color:var(--white);line-height:1;">87%</div>
                            <div style="font-size:.55rem;color:var(--md);margin-top:2px;">semanal</div>
                        </div>
                    </div>
                </div>

                <!-- Card 5: Flashcard preview (large) -->
                <div class="bcard bcard-d bcard-lg srr d2s">
                    <div style="display:flex;justify-content:space-between;align-items:center;margin-bottom:20px;">
                        <div>
                            <div class="lbl" style="color:#22D3EE;margin-bottom:6px;">Flashcards</div>
                            <div style="font-family:var(--fh);font-size:1rem;font-weight:700;color:var(--white);">Repetição Espaçada</div>
                        </div>
                        <div style="font-size:.72rem;color:var(--md);">48 para hoje</div>
                    </div>
                    <div style="height:120px;perspective:700px;margin-bottom:16px;">
                        <div style="width:100%;height:100%;position:relative;transform-style:preserve-3d;animation:flip-loop 5s ease-in-out infinite;">
                            <div style="position:absolute;inset:0;border-radius:12px;backface-visibility:hidden;-webkit-backface-visibility:hidden;background:var(--ink-3);border:1px solid var(--ld);display:flex;align-items:center;justify-content:center;padding:20px;font-family:var(--fh);font-size:.85rem;font-weight:700;color:var(--white);text-align:center;">O que é integral definida?</div>
                            <div style="position:absolute;inset:0;border-radius:12px;backface-visibility:hidden;-webkit-backface-visibility:hidden;background:#22D3EE;transform:rotateY(180deg);display:flex;align-items:center;justify-content:center;padding:20px;font-family:var(--fh);font-size:.85rem;font-weight:700;color:#fff;text-align:center;">Área sob a curva num intervalo [a,b]</div>
                        </div>
                    </div>
                    <div style="display:flex;gap:8px;">
                        @foreach([['Errei', 'rgba(255,28,75,.15)', 'var(--acc)'], ['Difícil', 'rgba(255,255,255,.05)', 'var(--md)'], ['Acertei', 'rgba(34,197,94,.15)', '#22C55E']] as $fb)
                            <div style="flex:1;text-align:center;padding:9px;border-radius:8px;background:{{ $fb[1] }};font-size:.62rem;color:{{ $fb[2] }};font-weight:600;cursor:none;border:1px solid rgba(255,255,255,.06);">{{ $fb[0] }}</div>
                        @endforeach
                    </div>
                </div>

            </div>
        </div>
    </section>

    <hr class="rd">


    <!-- ══════════════════════════════════════
         HOW IT WORKS — animated timeline
    ══════════════════════════════════════ -->
    <section id="process" class="sec">
        <div class="container">
            <div style="display:grid;grid-template-columns:1fr 1fr;gap:80px;align-items:start;">

                <div>
                    <span class="lbl sr" style="display:block;margin-bottom:10px;">Processo</span>
                    <h2 class="d2 sr d1s" style="margin-bottom:20px;">Em 4 passos,<br>você já está<br>evoluindo.</h2>
                    <p class="body-l sr d2s" style="max-width:340px;">Simples, rápido, sem enrolação. Em menos de 5 minutos você está estudando de forma inteligente.</p>
                    <a href="{{ route('register') }}" class="btn btn-r sr d3s" style="margin-top:36px;display:inline-flex;">
                        Começar agora
                        <svg width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><path d="M5 12h14M12 5l7 7-7 7"/></svg>
                    </a>
                </div>

                <div class="steps-wrap">
                    <div class="tl-line"><div class="tl-fill" id="tl-fill"></div></div>

                    @php $steps = [
                        ['01', 'Crie sua conta', 'Cadastre-se em 60 segundos. Sem cartão, sem burocracia.', '#FF1C4B'],
                        ['02', 'Configure seu perfil', 'Informe matérias e objetivo. A IA cria o plano — você executa.', '#818CF8'],
                        ['03', 'Entre no modo foco', 'Timer ativo, sessão registrada. Você só precisa estudar.', '#22D3EE'],
                        ['04', 'Evolua com dados', 'Dashboards claros mostram o caminho. Ajuste e vença.', '#22C55E'],
                    ]; @endphp

                    @foreach($steps as $si => $step)
                        <div class="step-row sr d{{ $si + 1 }}s" data-n="{{ $step[0] }}">
                            <h3 class="d4" style="margin-bottom:10px;color:var(--white);">{{ $step[1] }}</h3>
                            <p class="body-l" style="max-width:380px;font-size:.85rem;">{{ $step[2] }}</p>
                        </div>
                    @endforeach
                </div>

            </div>
        </div>
    </section>


    <!-- ══════════════════════════════════════
         TESTIMONIALS — cream + dark glass cards
    ══════════════════════════════════════ -->
    <section id="testi" class="sec" style="background:var(--cream);color:var(--ink);">
        <div class="container">

            <div style="max-width:860px;margin-bottom:80px;" class="srx">
                <span class="qm">"</span>
                <p class="pq">Passei em medicina na USP depois de 10 meses com o Study Lab. O cronograma da IA foi tão preciso que parecia que alguém entendia exatamente o meu jeito de aprender.</p>
                <div style="margin-top:28px;display:flex;align-items:center;gap:14px;">
                    <div class="tav" style="background:var(--acc);">A</div>
                    <div>
                        <div style="font-family:var(--fh);font-weight:700;color:var(--ink);font-size:.75rem;">ANA COSTA</div>
                        <div style="font-size:.62rem;color:var(--ml);text-transform:uppercase;letter-spacing:.1em;margin-top:2px;">Medicina · FMUSP · Aprovada 2024</div>
                    </div>
                </div>
            </div>

            <!-- Dark glass cards on cream = distinctive -->
            <div class="tgrid">
                @php $tests = [
                    ['P', 'Pedro Alves', 'Concurso Federal · Aprovado', 'Passei em 8 meses. O cronograma inteligente me manteve na trilha mesmo nos dias mais difíceis.', '#818CF8'],
                    ['J', 'Julia Mendes', 'Engenharia USP · 3º ano', 'Minha média foi de 6,8 para 9,2 em um semestre usando flashcards de repetição espaçada.', '#22D3EE'],
                    ['R', 'Rafael Souza', 'OAB · Aprovado de primeira', 'Os grupos de estudo me deram a responsabilidade que sempre faltou. Nunca estudei tão bem.', '#22C55E'],
                ]; @endphp
                @foreach($tests as $ti => $t)
                    <div class="tcard sr d{{ $ti + 1 }}s">
                        <div style="display:flex;gap:0.5px;margin-bottom:14px;">
                            @for($s = 0; $s < 5; $s++)<svg width="13" height="13" viewBox="0 0 20 20" fill="#F59E0B"><path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/></svg>@endfor
                        </div>
                        <p style="font-size:.82rem;line-height:1.7;color:rgba(250,250,247,.7);margin-bottom:22px;font-style:italic;">"{{ $t[3] }}"</p>
                        <div style="display:flex;align-items:center;gap:10px;">
                            <div class="tav" style="background:{{ $t[4] }};font-size:.76rem;">{{ $t[0] }}</div>
                            <div>
                                <div style="font-family:var(--fh);font-size:.7rem;font-weight:700;color:var(--white);">{{ $t[1] }}</div>
                                <div style="font-size:.6rem;color:{{ $t[4] }};text-transform:uppercase;letter-spacing:.08em;margin-top:2px;">{{ $t[2] }}</div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>

        </div>
    </section>


    <!-- ══════════════════════════════════════
         PRICING
    ══════════════════════════════════════ -->
    <section id="pricing" class="sec">
        <div class="container">
            <div style="display:flex;justify-content:space-between;align-items:flex-end;margin-bottom:56px;flex-wrap:wrap;gap:24px;">
                <div>
                    <span class="lbl sr" style="display:block;margin-bottom:10px;">Planos</span>
                    <h2 class="d2 sr d1s">Sem pegadinhas.<br>Só resultados.</h2>
                </div>
                <p class="body-l sr d2s" style="max-width:260px;text-align:right;">Cancele quando quiser. Sem multa nem burocracia.</p>
            </div>

            <div class="pgrid sr">
                @php $plans = [
                    ['Aprender', 'R$ 0', 'para sempre', 'Para quem está começando.', ['Até 3 matérias', '5h de estudo/semana', 'Flashcards básicos', 'Dashboard simples'], 'Criar conta grátis', false],
                    ['Dominar', 'R$ 15', '/mês', 'Para quem leva a sério.', ['Matérias ilimitadas', 'Horas ilimitadas', 'IA personalizada completa', 'Grupos de estudo', 'Análise avançada', 'Notificações inteligentes'], 'Começar agora', true],
                    ['Evoluir', 'R$ 10', '/mês', 'Custo-benefício perfeito.', ['Até 10 matérias', 'Modo foco completo', 'Relatórios semanais', 'Suporte prioritário'], 'Escolher plano', false],
                ]; @endphp
                @foreach($plans as $pi => $plan)
                    <div class="pcol {{ $plan[6] ? 'ft' : '' }}">
                        @if($plan[6])
                            <div style="font-size:.6rem;letter-spacing:.14em;text-transform:uppercase;color:rgba(255,255,255,.6);margin-bottom:18px;font-family:var(--fb);">★ Mais escolhido</div>
                        @else
                            <div style="height:26px;margin-bottom:18px;"></div>
                        @endif
                        <div class="pn" style="color:{{ $plan[6] ? '#fff' : 'var(--white)' }};margin-bottom:5px;">{{ $plan[0] }}</div>
                        <p style="font-size:.73rem;color:{{ $plan[6] ? 'rgba(255,255,255,.6)' : 'var(--md)' }};margin-bottom:24px;line-height:1.6;">{{ $plan[3] }}</p>
                        <div style="display:flex;align-items:flex-end;gap:4px;margin-bottom:28px;">
                            <span class="pa">{{ $plan[1] }}</span>
                            <span style="font-size:.72rem;color:{{ $plan[6] ? 'rgba(255,255,255,.55)' : 'var(--md)' }};margin-bottom:6px;">{{ $plan[2] }}</span>
                        </div>
                        <div style="margin-bottom:32px;">
                            @foreach($plan[4] as $feat)
                                <div class="pf">
                                    <svg width="13" height="13" viewBox="0 0 24 24" fill="none" stroke="{{ $plan[6] ? '#fff' : 'var(--acc)' }}" stroke-width="2.5"><path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7"/></svg>
                                    {{ $feat }}
                                </div>
                            @endforeach
                        </div>
                        @if($plan[6])
                            <a href="{{ route('register') }}" class="btn" style="background:#fff;color:var(--acc);width:100%;justify-content:center;font-size:.63rem;padding:14px;">
                                {{ $plan[5] }}
                                <svg width="11" height="11" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><path d="M5 12h14M12 5l7 7-7 7"/></svg>
                            </a>
                        @else
                            <a href="{{ route('register') }}" class="btn btn-od" style="width:100%;justify-content:center;font-size:.63rem;padding:14px;">{{ $plan[5] }}</a>
                        @endif
                    </div>
                @endforeach
            </div>
            <p style="text-align:center;font-size:.65rem;color:var(--md);margin-top:24px;text-transform:uppercase;letter-spacing:.1em;" class="sr">Gratuito para começar · Sem cartão de crédito · Cancele quando quiser</p>
        </div>
    </section>


    <!-- ══════════════════════════════════════
         CTA
    ══════════════════════════════════════ -->
    <section id="cta" class="sec" style="padding:160px 0;text-align:center;">
        <!-- CTA aurora mesh -->
        <div id="cta-aurora"></div>
        <div class="cta-ghost">ESTUDE</div>

        <!-- Floating glass cards in CTA -->
        <div class="cta-glass-card gd" style="left:5%;top:20%;animation:float-a 7s ease-in-out infinite;">
            <div style="font-size:.65rem;color:var(--md);margin-bottom:4px;">Sessão ativa</div>
            <div style="font-family:var(--fh);font-size:.9rem;font-weight:700;color:var(--white);">Cálculo III · 2h14</div>
        </div>
        <div class="cta-glass-card gd" style="right:6%;bottom:25%;animation:float-b 8s ease-in-out infinite;">
            <div style="font-size:.65rem;color:#22C55E;margin-bottom:4px;">✓ Meta atingida</div>
            <div style="font-family:var(--fh);font-size:.9rem;font-weight:700;color:var(--white);">3h de foco hoje</div>
        </div>

        <div class="container" style="position:relative;z-index:2;">
            <span class="lbl sr" style="display:block;margin-bottom:22px;text-align:center;">Comece hoje</span>
            <h2 class="d2 sr d1s" style="margin-bottom:18px;max-width:640px;margin-left:auto;margin-right:auto;">
                Seu próximo nível<br>começa <span style="color:var(--acc);">agora.</span>
            </h2>
            <p class="body-l sr d2s" style="max-width:400px;margin:0 auto 44px;text-align:center;">
                Junte-se a mais de 12.000 estudantes que decidiram estudar com inteligência.
            </p>
            <div style="display:flex;gap:12px;justify-content:center;flex-wrap:wrap;" class="sr d3s">
                <a href="{{ route('register') }}" class="btn btn-r" style="padding:18px 48px;font-size:.75rem;">
                    Criar conta gratuitamente
                    <svg width="13" height="13" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><path d="M5 12h14M12 5l7 7-7 7"/></svg>
                </a>
                <a href="{{ route('login') }}" class="btn btn-od" style="padding:18px 34px;font-size:.75rem;">Já tenho conta</a>
            </div>
        </div>
    </section>


    <!-- ══════════════════════════════════════
         FOOTER
    ══════════════════════════════════════ -->
    <footer id="ftr">
        <div class="container">
            <div style="display:flex;justify-content:space-between;align-items:flex-start;flex-wrap:wrap;gap:48px;margin-bottom:52px;">
                <div style="max-width:260px;">
                    <img src="{{ asset('images/logo-dark-mode.png') }}" alt="StudyLab" style="height:100px;margin-bottom:2px;">
                    <p style="font-size:.76rem;color:var(--md);line-height:1.7;">Plataforma de estudos com IA para quem quer resultados reais, não só horas registradas.</p>
                </div>
                <div style="display:flex;gap:60px;flex-wrap:wrap;">
                    @php $fls = [['Produto', ['Funcionalidades', 'Como funciona', 'Preços', 'Novidades']], ['Legal', ['Privacidade', 'Termos de uso', 'Cookies', 'Contato']]]; @endphp
                    @foreach($fls as $fl)
                        <div>
                            <div style="font-family:var(--fh);font-size:.62rem;font-weight:700;color:var(--white);letter-spacing:.12em;text-transform:uppercase;margin-bottom:18px;">{{ $fl[0] }}</div>
                            <ul style="list-style:none;display:flex;flex-direction:column;gap:10px;">
                                @foreach($fl[1] as $ll)
                                    <li><a href="#" style="font-size:.76rem;color:var(--md);text-decoration:none;transition:color .2s;" onmouseover="this.style.color='var(--white)'" onmouseout="this.style.color='var(--md)'">{{ $ll }}</a></li>
                                @endforeach
                            </ul>
                        </div>
                    @endforeach
                </div>
            </div>
            <hr class="rd" style="margin-bottom:24px;">
            <div style="display:flex;justify-content:space-between;align-items:center;flex-wrap:wrap;gap:12px;">
                <p style="font-size:.66rem;color:var(--md);">© {{ date('Y') }} Study Lab. Todos os direitos reservados.</p>
                <div style="display:flex;align-items:center;gap:6px;">
                    <div style="width:6px;height:6px;border-radius:50%;background:#22C55E;animation:pulse-d 2s ease-in-out infinite;"></div>
                    <span style="font-size:.66rem;color:var(--md);">Todos os sistemas operando</span>
                </div>
            </div>
        </div>
    </footer>
    <script src="{{ asset('js/home.js') }}"></script>
</body>
</html>
