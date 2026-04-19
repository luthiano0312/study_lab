<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>StudyLab · Focus</title>
    <link rel="icon" type="image/png" href="{{ asset('favicons/logo/focus-logo.ico') }}">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Unbounded:wght@400;700;900&family=DM+Mono:ital,opsz,wght@0,14,300;0,14,400;0,14,500&display=swap" rel="stylesheet">
    <style>
        :root {
            --ink: #020408;
            --ink-2: #0a0d14;
            --ink-3: #111827;
            --acc: #ec4899;
            --acc2: #9333ea;
            --white: #f8fafc;
            --md: rgba(248,250,252,0.4);
            --ld: rgba(255,255,255,0.07);
            --fh: 'Unbounded', sans-serif;
            --fb: 'DM Mono', monospace;
        }
        * { box-sizing: border-box; margin: 0; padding: 0; }
        body { background: var(--ink); color: var(--white); font-family: var(--fb); overflow: hidden; }
        body::after {
            content: ''; position: fixed; inset: 0; z-index: 9000; pointer-events: none;
            opacity: 0.04; mix-blend-mode: overlay;
            background-image: url("data:image/svg+xml,%3Csvg viewBox='0 0 512 512' xmlns='http://www.w3.org/2000/svg'%3E%3Cfilter id='n'%3E%3CfeTurbulence type='fractalNoise' baseFrequency='0.88' numOctaves='4' stitchTiles='stitch'/%3E%3C/filter%3E%3Crect width='100%25' height='100%25' filter='url(%23n)'/%3E%3C/svg%3E");
            background-size: 180px 180px;
        }
        /* Orb background */
        .orb {
            position: fixed; border-radius: 50%; pointer-events: none; z-index: 0;
            filter: blur(90px);
        }
        .orb-1 { width: 500px; height: 500px; top: -200px; right: -100px; background: rgba(236,72,153,0.08); }
        .orb-2 { width: 400px; height: 400px; bottom: -150px; left: -100px; background: rgba(147,51,234,0.07); }

        /* TUTORIAL OVERLAY */
        #tutorial-overlay {
            position: fixed; inset: 0; z-index: 8000;
            background: rgba(2,4,8,0.92);
            backdrop-filter: blur(16px);
            display: flex; align-items: center; justify-content: center;
            opacity: 1; transition: opacity 0.5s ease;
        }
        #tutorial-overlay.hide { opacity: 0; pointer-events: none; }

        .tutorial-card {
            background: linear-gradient(135deg, rgba(255,255,255,0.05), rgba(255,255,255,0.02));
            border: 1px solid rgba(236,72,153,0.25);
            border-radius: 24px;
            padding: 52px 48px;
            max-width: 540px;
            width: 90%;
            position: relative;
            overflow: hidden;
        }
        .tutorial-card::before {
            content: ''; position: absolute;
            top: 0; left: 0; right: 0; height: 1px;
            background: linear-gradient(90deg, transparent, rgba(236,72,153,0.6), transparent);
        }
        .tutorial-card::after {
            content: ''; position: absolute;
            top: -60px; right: -60px; width: 200px; height: 200px;
            border-radius: 50%; background: radial-gradient(circle, rgba(236,72,153,0.12) 0%, transparent 70%);
            pointer-events: none;
        }

        .tut-step {
            display: none;
        }
        .tut-step.active { display: block; }

        .step-dots { display: flex; gap: 6px; justify-content: center; margin-top: 36px; }
        .step-dot {
            width: 6px; height: 6px; border-radius: 50%;
            background: rgba(255,255,255,0.15);
            transition: all 0.3s;
        }
        .step-dot.active {
            width: 24px; border-radius: 3px;
            background: linear-gradient(90deg, #ec4899, #9333ea);
        }

        /* SIDEBAR */
        #sidebar {
            width: 56px; transition: width 0.25s ease;
            position: relative; z-index: 10;
            background: rgba(255,255,255,0.02);
            border-right: 1px solid var(--ld);
            flex-shrink: 0;
        }
        #sidebar.expanded { width: 200px; }
        .sidebar-label { opacity: 0; transition: opacity 0.2s; white-space: nowrap; }
        #sidebar.expanded .sidebar-label { opacity: 1; }
        .sidebar-item { transition: all 0.2s; }

        /* TIMER RING */
        .timer-ring-track { stroke: rgba(255,255,255,0.05); }
        .timer-ring-fill {
            stroke: url(#ringGrad);
            stroke-linecap: round;
            stroke-dasharray: 565;
            stroke-dashoffset: 0;
            transition: stroke-dashoffset 1s linear;
        }

        /* GLASS CARDS */
        .glass-card {
            background: rgba(255,255,255,0.03);
            border: 1px solid rgba(255,255,255,0.07);
            border-radius: 20px;
            backdrop-filter: blur(10px);
            transition: border-color 0.3s, transform 0.3s;
        }
        .glass-card:hover { border-color: rgba(236,72,153,0.2); transform: translateY(-1px); }

        /* SUPPORT OVERLAY */
        #support-overlay {
            width: 0; overflow: hidden;
            transition: width 0.3s cubic-bezier(0.23,1,0.32,1);
            position: absolute; top: 0; right: 0; height: 100%; z-index: 100;
        }
        #support-overlay.open { width: 290px; }

        /* SESSION CHIP */
        @keyframes pulse-acc { 0%,100%{ box-shadow: 0 0 0 0 rgba(236,72,153,0.4); } 50%{ box-shadow: 0 0 0 6px rgba(236,72,153,0); } }
        .session-dot { animation: pulse-acc 2s ease-in-out infinite; }

        /* SUBJECT TAGS */
        .subject-tag {
            padding: 6px 14px; border-radius: 100px; font-family: var(--fh);
            font-size: 0.55rem; font-weight: 700; letter-spacing: 0.08em;
            cursor: pointer; border: 1px solid transparent;
            transition: all 0.2s;
        }
        .subject-tag.active {
            background: linear-gradient(135deg, rgba(236,72,153,0.2), rgba(147,51,234,0.2));
            border-color: rgba(236,72,153,0.4); color: #ec4899;
        }
        .subject-tag:not(.active) {
            background: rgba(255,255,255,0.04);
            border-color: rgba(255,255,255,0.08);
            color: rgba(248,250,252,0.45);
        }
        .subject-tag:not(.active):hover { border-color: rgba(236,72,153,0.25); color: rgba(248,250,252,0.8); }

        /* STAT BOX */
        .stat-box {
            background: rgba(255,255,255,0.03);
            border: 1px solid rgba(255,255,255,0.06);
            border-radius: 14px; padding: 16px 18px;
            transition: border-color 0.3s;
        }
        .stat-box:hover { border-color: rgba(236,72,153,0.2); }

        /* WEEK BAR */
        .week-bar { border-radius: 3px 3px 0 0; background: rgba(255,255,255,0.06); transition: all 0.5s; }
        .week-bar.done { background: linear-gradient(180deg, #ec4899, #9333ea); }
        .week-bar.today { background: linear-gradient(180deg, #f472b6, #a855f7); box-shadow: 0 0 12px rgba(236,72,153,0.4); }

        /* BTN PLAY */
        .btn-play {
            background: linear-gradient(135deg, #ec4899, #9333ea);
            border: none; border-radius: 14px; cursor: pointer;
            font-family: var(--fh); font-size: 0.65rem; font-weight: 700;
            letter-spacing: 0.06em; color: #fff; padding: 14px 28px;
            display: inline-flex; align-items: center; gap: 8px;
            transition: transform 0.2s, box-shadow 0.2s;
            position: relative; overflow: hidden;
            box-shadow: 0 8px 32px rgba(236,72,153,0.3);
        }
        .btn-play::before {
            content: ''; position: absolute; inset: 0;
            background: rgba(255,255,255,0.15);
            transform: translateX(-110%) skewX(-20deg);
            transition: transform 0.4s ease;
        }
        .btn-play:hover::before { transform: translateX(120%) skewX(-20deg); }
        .btn-play:hover { transform: translateY(-2px); box-shadow: 0 16px 48px rgba(236,72,153,0.5); }
        .btn-play:active { transform: translateY(0); }

        .btn-icon-circle {
            width: 44px; height: 44px; border-radius: 12px;
            display: flex; align-items: center; justify-content: center;
            background: rgba(255,255,255,0.04);
            border: 1px solid rgba(255,255,255,0.08);
            cursor: pointer; color: rgba(248,250,252,0.4);
            transition: all 0.2s;
        }
        .btn-icon-circle:hover { border-color: rgba(236,72,153,0.3); color: #ec4899; background: rgba(236,72,153,0.06); }

        /* scrollbar */
        ::-webkit-scrollbar { width: 3px; }
        ::-webkit-scrollbar-track { background: transparent; }
        ::-webkit-scrollbar-thumb { background: rgba(236,72,153,0.4); border-radius: 2px; }

        /* ANIMATIONS */
        @keyframes floatY { 0%,100%{ transform:translateY(0); } 50%{ transform:translateY(-8px); } }
        @keyframes spinRing { to{ transform:rotate(360deg); } }
        @keyframes fadeUp { from{ opacity:0; transform:translateY(16px); } to{ opacity:1; transform:translateY(0); } }
        .anim-float { animation: floatY 5s ease-in-out infinite; }
        .anim-fade-up { animation: fadeUp 0.6s cubic-bezier(0.23,1,0.32,1) both; }
        .d1 { animation-delay: 0.1s; }
        .d2 { animation-delay: 0.2s; }
        .d3 { animation-delay: 0.3s; }
        .d4 { animation-delay: 0.4s; }

        /* PROGRESS GLOW */
        .progress-track { background: rgba(255,255,255,0.05); border-radius: 4px; overflow: hidden; }
        .progress-fill {
            height: 100%; border-radius: 4px;
            background: linear-gradient(90deg, #ec4899, #9333ea);
            box-shadow: 0 0 12px rgba(236,72,153,0.4);
            transition: width 1s ease;
        }

        /* MARQUEE mini */
        @keyframes mq-scroll { from{ transform:translateX(0); } to{ transform:translateX(-50%); } }
        .mq-inner { display:flex; white-space:nowrap; animation: mq-scroll 22s linear infinite; }
        .mq-item { font-family:var(--fh); font-size:0.5rem; letter-spacing:0.14em; text-transform:uppercase; padding:0 18px; color:rgba(236,72,153,0.5); }

        /* TIMER PULSE when running */
        @keyframes ring-pulse { 0%,100%{ filter:drop-shadow(0 0 8px rgba(236,72,153,0.3)); } 50%{ filter:drop-shadow(0 0 20px rgba(236,72,153,0.7)); } }
        .timer-running .timer-ring-fill { animation: ring-pulse 2s ease-in-out infinite; }
    </style>
</head>

<body class="font-sans h-screen overflow-hidden relative">

    <!-- BG ORBS -->
    <div class="orb orb-1"></div>
    <div class="orb orb-2"></div>

    <!-- ══════════════════════════════════════
         TUTORIAL OVERLAY
    ══════════════════════════════════════ -->
    <div id="tutorial-overlay">
        <div class="tutorial-card">

            <!-- Step 1 -->
            <div class="tut-step active" id="step-1">
                <div class="flex items-center gap-3 mb-6">
                    <div class="w-10 h-10 rounded-[12px] flex items-center justify-center flex-shrink-0"
                         style="background:linear-gradient(135deg,rgba(236,72,153,0.2),rgba(147,51,234,0.2));border:1px solid rgba(236,72,153,0.3);">
                        <svg class="w-5 h-5" style="color:#ec4899;" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M13 10V3L4 14h7v7l9-11h-7z"/>
                        </svg>
                    </div>
                    <div>
                        <div style="font-family:var(--fh);font-size:0.55rem;letter-spacing:0.14em;color:#ec4899;text-transform:uppercase;margin-bottom:3px;">Modo Focus · Guia</div>
                        <div style="font-family:var(--fh);font-size:1rem;font-weight:900;color:var(--white);">Bem-vindo ao Focus</div>
                    </div>
                </div>
                <p style="font-size:0.8rem;line-height:1.8;color:var(--md);margin-bottom:8px;">
                    O Modo Focus é o ambiente de concentração máxima do StudyLab. Aqui você usa a <span style="color:#ec4899;font-weight:600;">Técnica Pomodoro</span> para estudar com mais eficiência e menos distrações.
                </p>
                <p style="font-size:0.8rem;line-height:1.8;color:var(--md);">
                    Cada sessão tem <strong style="color:var(--white);">25 minutos de foco total</strong> seguidos de <strong style="color:var(--white);">5 minutos de pausa</strong>. Após 4 ciclos, você ganha uma pausa longa de 15 minutos. Álem do mais temos nosso banco de questões com o apoio de nossos "professores", dentre eles são:
                </p>
            </div>

            <!-- Step 2 -->
            <div class="tut-step" id="step-2">
                <div style="font-family:var(--fh);font-size:0.55rem;letter-spacing:0.14em;color:#ec4899;text-transform:uppercase;margin-bottom:16px;">O que você vai encontrar</div>
                <div class="flex flex-col gap-3">
                    @php $features = [
                        ['⏱', 'Timer Pomodoro', 'Gerencie seus ciclos de foco e pausa. O timer só começa quando você apertar Iniciar.'],
                        ['📚', 'Banco de Questões', 'Acesse questões por matéria clicando em "Banco de Questões" no topo.'],
                        ['📊', 'Estatísticas da sessão', 'Veja em tempo real quantas sessões completou e seu tempo total de foco hoje.'],
                        ['🎯', 'Metas diárias', 'Defina sua matéria e acompanhe o progresso da semana.'],
                    ]; @endphp
                    @foreach($features as $f)
                        <div class="flex items-start gap-3" style="padding:12px;background:rgba(255,255,255,0.03);border:1px solid rgba(255,255,255,0.06);border-radius:12px;">
                            <span style="font-size:1.1rem;flex-shrink:0;margin-top:1px;">{{ $f[0] }}</span>
                            <div>
                                <div style="font-family:var(--fh);font-size:0.62rem;font-weight:700;color:var(--white);margin-bottom:3px;">{{ $f[1] }}</div>
                                <div style="font-size:0.7rem;color:var(--md);line-height:1.6;">{{ $f[2] }}</div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>

            <!-- Step 3 -->
            <div class="tut-step" id="step-3">
                <div style="font-family:var(--fh);font-size:0.55rem;letter-spacing:0.14em;color:#ec4899;text-transform:uppercase;margin-bottom:16px;">Dicas de uso</div>
                <div class="flex flex-col gap-4 mb-4">
                    @php $tips = [
                        ['1', 'Escolha sua matéria antes de começar — isso ajuda o sistema a registrar seu progresso corretamente.'],
                        ['2', 'Mantenha o celular longe durante o Pomodoro. 25 minutos sem distrações fazem toda a diferença.'],
                        ['3', 'Nas pausas, levante, alongue-se e beba água. Pausas de qualidade melhoram o foco no próximo ciclo.'],
                        ['4', 'Após 4 pomodoros completos, você merece a pausa longa. Não a pule!'],
                    ]; @endphp
                    @foreach($tips as $t)
                        <div class="flex items-start gap-4">
                            <div class="flex-shrink-0 w-6 h-6 rounded-full flex items-center justify-center text-xs font-bold"
                                 style="background:linear-gradient(135deg,rgba(236,72,153,0.2),rgba(147,51,234,0.2));border:1px solid rgba(236,72,153,0.3);color:#ec4899;font-family:var(--fh);">
                                {{ $t[0] }}
                            </div>
                            <p style="font-size:0.76rem;line-height:1.7;color:var(--md);margin-top:2px;">{{ $t[1] }}</p>
                        </div>
                    @endforeach
                </div>
                <button id="start-focus-btn" class="btn-play w-full justify-center mt-6" style="padding:16px;">
                    <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 24 24"><path d="M6 4l15 8-15 8V4z"/></svg>
                    Entrar no Modo Focus
                </button>
            </div>

            <!-- Nav -->
            <div class="flex items-center justify-between mt-8" id="tut-nav">
                <button id="tut-back" class="text-xs px-4 py-2 rounded-[10px] transition-all hidden"
                        style="background:rgba(255,255,255,0.04);border:1px solid rgba(255,255,255,0.08);color:var(--md);font-family:var(--fb);cursor:pointer;">
                    ← Anterior
                </button>
                <div class="step-dots" id="step-dots">
                    <div class="step-dot active"></div>
                    <div class="step-dot"></div>
                    <div class="step-dot"></div>
                </div>
                <button id="tut-next"
                        class="text-xs px-5 py-2 rounded-[10px] transition-all"
                        style="background:linear-gradient(135deg,rgba(236,72,153,0.15),rgba(147,51,234,0.15));border:1px solid rgba(236,72,153,0.3);color:#ec4899;font-family:var(--fh);font-weight:700;letter-spacing:0.06em;cursor:pointer;font-size:0.58rem;">
                    PRÓXIMO →
                </button>
            </div>

        </div>
    </div>

    <!-- ══════════════════════════════════════
         APP
    ══════════════════════════════════════ -->
    <div class="flex h-screen" style="position:relative;z-index:1;">

        <!-- SIDEBAR -->
        <aside id="sidebar" class="flex flex-col items-center py-4 gap-1">

            <div class="w-9 h-9 rounded-[10px] flex items-center justify-center mb-3 flex-shrink-0 ml-4"></div>

            {{-- Focus (ativo) --}}
            <div class="sidebar-item w-full h-11 flex items-center gap-3 px-4 cursor-pointer border-l-2 border-pink-500 text-pink-500 whitespace-nowrap text-sm font-medium"
                 style="background:rgba(236,72,153,0.1);">
                <svg class="w-[18px] h-[18px] flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M13 10V3L4 14h7v7l9-11h-7z"/>
                </svg>
                <span class="sidebar-label text-[13px]">Focus</span>
            </div>

            @php $navItems = [
                ['Lousa virtual', '/whiteboard', 'M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z'],
                ['Caderno', '/notebook', 'M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253'],
                ['Flashcards', '/flashcards', 'M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2'],
                ['Dashboard', '/dashboard', 'M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6'],
            ]; @endphp

            @foreach($navItems as $item)
                <div class="sidebar-item w-full h-11 flex items-center gap-3 px-4 cursor-pointer border-l-2 border-transparent text-[#64748b] hover:text-slate-200 whitespace-nowrap text-sm font-medium transition-colors"
                     style="hover:background:rgba(255,255,255,0.05);">
                    <a class="flex items-center gap-3 w-full" href="{{ $item[1] }}">
                        <svg class="w-[18px] h-[18px] flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="{{ $item[2] }}"/>
                        </svg>
                        <span class="sidebar-label text-[13px]">{{ $item[0] }}</span>
                    </a>
                </div>
            @endforeach

            {{-- Toggle --}}
            <div id="sidebar-toggle" class="mt-auto w-full flex items-center px-4 h-10 cursor-pointer text-[#64748b] gap-3 hover:text-slate-200 transition-colors">
                <svg id="toggle-arrow" class="w-[18px] h-[18px] flex-shrink-0 transition-transform duration-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                </svg>
                <span class="sidebar-label text-[12px] whitespace-nowrap">Recolher</span>
            </div>
        </aside>

        <!-- MAIN -->
        <div class="flex flex-1 flex-col overflow-hidden">

            <!-- TOPBAR -->
            <div class="h-14 flex items-center justify-between px-6 gap-4 flex-shrink-0"
                 style="border-bottom:1px solid var(--ld);background:rgba(2,4,8,0.6);backdrop-filter:blur(20px);">
                <div class="flex items-center gap-3">
                    <span style="font-family:var(--fh);font-weight:900;font-size:0.65rem;letter-spacing:0.12em;color:var(--white);">MODO FOCUS</span>
                    <div class="flex items-center gap-1.5 px-3 py-1 rounded-full"
                         style="background:rgba(236,72,153,0.1);border:1px solid rgba(236,72,153,0.25);">
                        <div class="w-1.5 h-1.5 rounded-full session-dot" style="background:#ec4899;"></div>
                        <span style="font-size:0.58rem;font-family:var(--fh);font-weight:700;color:#ec4899;letter-spacing:0.08em;">SESSÃO ATIVA</span>
                    </div>
                    <!-- Mini marquee in topbar -->
                    <div class="hidden lg:block overflow-hidden" style="width:220px;">
                        <div class="mq-inner">
                            @foreach(['Pomodoro', 'Foco Total', '25min Work', '5min Break', 'Repetição', 'Deep Work', 'Pomodoro', 'Foco Total', '25min Work', '5min Break', 'Repetição', 'Deep Work'] as $mw)
                                <span class="mq-item">{{ $mw }} <span style="color:rgba(147,51,234,0.4);">·</span></span>
                            @endforeach
                        </div>
                    </div>
                </div>
                <div class="flex items-center gap-2">
                    <button id="tutorial-reopen"
                            class="flex items-center gap-1.5 px-3 py-1.5 rounded-[10px] transition-all text-xs"
                            style="background:rgba(255,255,255,0.04);border:1px solid var(--ld);color:var(--md);font-family:var(--fb);cursor:pointer;"
                            title="Ver tutorial novamente">
                        <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8.228 9c.549-1.165 2.03-2 3.772-2 2.21 0 4 1.343 4 3 0 1.4-1.278 2.575-3.006 2.907-.542.104-.994.54-.994 1.093m0 3h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                        </svg>
                        Tutorial
                    </button>
                    <button id="support-btn"
                            class="flex items-center gap-1.5 px-3.5 py-1.5 rounded-[10px] transition-all text-xs whitespace-nowrap"
                            style="background:rgba(236,72,153,0.08);border:1px solid rgba(236,72,153,0.2);color:#ec4899;font-family:var(--fh);font-weight:700;letter-spacing:0.06em;cursor:pointer;font-size:0.58rem;">
                        <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M18.364 5.636l-3.536 3.536m0 5.656l3.536 3.536M9.172 9.172L5.636 5.636m3.536 9.192L5.636 18.364M21 12a9 9 0 11-18 0 9 9 0 0118 0zm-5 0a4 4 0 11-8 0 4 4 0 018 0z"/>
                        </svg>
                        Banco de Questões
                    </button>
                </div>
            </div>

            <!-- CONTENT -->
            <div class="flex-1 overflow-y-auto p-6 flex flex-col gap-5 relative">

                <!-- ── ROW 1: TIMER + STATS ── -->
                <div class="grid gap-5" style="grid-template-columns:1fr 320px;">

                    <!-- TIMER CARD -->
                    <div class="glass-card p-8 anim-fade-up d1 relative overflow-hidden">
                        <!-- Decorative grid lines -->
                        <div style="position:absolute;inset:0;background-image:linear-gradient(rgba(255,255,255,0.02) 1px,transparent 1px),linear-gradient(90deg,rgba(255,255,255,0.02) 1px,transparent 1px);background-size:40px 40px;pointer-events:none;"></div>
                        <!-- Corner accent -->
                        <div style="position:absolute;top:0;right:0;width:200px;height:200px;background:radial-gradient(circle,rgba(236,72,153,0.08) 0%,transparent 70%);pointer-events:none;"></div>

                        <div class="flex items-center gap-10 relative z-10">

                            <!-- Timer ring -->
                            <div class="relative flex-shrink-0" id="timer-wrap">
                                <svg width="160" height="160" viewBox="0 0 160 160" style="transform:rotate(-90deg);">
                                    <defs>
                                        <linearGradient id="ringGrad" x1="0%" y1="0%" x2="100%" y2="100%">
                                            <stop offset="0%" stop-color="#ec4899"/>
                                            <stop offset="100%" stop-color="#9333ea"/>
                                        </linearGradient>
                                    </defs>
                                    <!-- Outer glow ring -->
                                    <circle cx="80" cy="80" r="72" fill="none" stroke="rgba(236,72,153,0.04)" stroke-width="18"/>
                                    <!-- Track -->
                                    <circle cx="80" cy="80" r="70" fill="none" class="timer-ring-track" stroke-width="7"/>
                                    <!-- Fill -->
                                    <circle cx="80" cy="80" r="70" fill="none" class="timer-ring-fill" stroke-width="7" id="ring-fill" stroke-dasharray="440" stroke-dashoffset="0"/>
                                    <!-- Tick marks -->
                                    @for($i = 0; $i < 60; $i++)
                                        @php $angle = $i * 6;
                                            $isMain = $i % 5 === 0;
                                            $r = 80;
                                            $len = $isMain ? 8 : 4;
                                            $x1 = 80 + $r * cos(deg2rad($angle));
                                            $y1 = 80 + $r * sin(deg2rad($angle));
                                            $x2 = 80 + ($r - $len) * cos(deg2rad($angle));
                                        $y2 = 80 + ($r - $len) * sin(deg2rad($angle)); @endphp
                                        <line x1="{{ $x1 }}" y1="{{ $y1 }}" x2="{{ $x2 }}" y2="{{ $y2 }}"
                                              stroke="{{ $isMain ? 'rgba(236,72,153,0.3)' : 'rgba(255,255,255,0.06)' }}"
                                              stroke-width="{{ $isMain ? 1.5 : 1 }}"/>
                                    @endfor
                                </svg>
                                <!-- Center content -->
                                <div class="absolute inset-0 flex flex-col items-center justify-center">
                                    <div id="phase-label" style="font-family:var(--fh);font-size:0.45rem;letter-spacing:0.14em;text-transform:uppercase;color:#ec4899;margin-bottom:4px;">Pronto</div>
                                    <div id="timer-digits" style="font-family:var(--fh);font-weight:900;font-size:2rem;color:var(--white);letter-spacing:-0.04em;line-height:1;">25:00</div>
                                    <div style="font-size:0.5rem;color:var(--md);margin-top:4px;font-family:var(--fb);">restando</div>
                                </div>
                            </div>

                            <!-- Timer info + controls -->
                            <div class="flex-1">
                                <div style="font-family:var(--fh);font-size:0.55rem;letter-spacing:0.12em;text-transform:uppercase;color:#ec4899;margin-bottom:8px;">Técnica Pomodoro</div>
                                <h2 style="font-family:var(--fh);font-size:1.4rem;font-weight:900;color:var(--white);line-height:1.1;margin-bottom:6px;">Foco Total</h2>
                                <p style="font-size:0.72rem;color:var(--md);line-height:1.7;margin-bottom:24px;max-width:260px;">
                                    25min de foco · 5min de pausa · Repita 4x para uma pausa longa de 15min.
                                </p>

                                <!-- Cycle indicator -->
                                <div class="flex items-center gap-2 mb-6">
                                    <span style="font-size:0.6rem;color:var(--md);font-family:var(--fb);">Ciclo</span>
                                    @for($i = 1; $i <= 4; $i++)
                                        <div class="cycle-dot w-3 h-3 rounded-full transition-all"
                                             style="background:rgba(255,255,255,0.08);border:1px solid rgba(255,255,255,0.12);"
                                             id="cycle-{{ $i }}"></div>
                                    @endfor
                                    <span id="cycle-label" style="font-size:0.6rem;color:var(--md);font-family:var(--fh);font-weight:700;margin-left:4px;">0/4</span>
                                </div>

                                <!-- Controls -->
                                <div class="flex items-center gap-3">
                                    <button id="play-btn" class="btn-play">
                                        <svg id="play-icon" class="w-4 h-4" fill="currentColor" viewBox="0 0 24 24"><path d="M6 4l15 8-15 8V4z"/></svg>
                                        <span id="play-label">Iniciar</span>
                                    </button>
                                    <button class="btn-icon-circle" id="reset-btn" title="Resetar">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15"/>
                                        </svg>
                                    </button>
                                    <button class="btn-icon-circle" id="skip-btn" title="Pular fase">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 5l7 7-7 7M5 5l7 7-7 7"/>
                                        </svg>
                                    </button>
                                    <div style="width:1px;height:24px;background:var(--ld);margin:0 4px;"></div>
                                    <!-- Volume toggle -->
                                    <button class="btn-icon-circle" id="sound-btn" title="Som">
                                        <svg class="w-4 h-4" id="sound-icon" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.536 8.464a5 5 0 010 7.072M12 6v12m0 0l-3-3m3 3l3-3M6.343 6.343a8 8 0 000 11.314"/>
                                        </svg>
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- SESSION STATS -->
                    <div class="flex flex-col gap-3 anim-fade-up d2">
                        <div class="stat-box flex flex-col gap-1">
                            <div style="font-size:0.58rem;font-family:var(--fh);letter-spacing:0.1em;text-transform:uppercase;color:var(--md);">Sessões hoje</div>
                            <div style="font-family:var(--fh);font-weight:900;font-size:1.8rem;color:var(--white);line-height:1;" id="stat-sessions">0</div>
                            <div class="progress-track w-full" style="height:3px;margin-top:6px;">
                                <div class="progress-fill" id="sessions-bar" style="width:0%;"></div>
                            </div>
                            <div style="font-size:0.58rem;color:var(--md);margin-top:3px;">Meta: 4 sessões</div>
                        </div>
                        <div class="stat-box flex flex-col gap-1">
                            <div style="font-size:0.58rem;font-family:var(--fh);letter-spacing:0.1em;text-transform:uppercase;color:var(--md);">Foco total hoje</div>
                            <div style="font-family:var(--fh);font-weight:900;font-size:1.8rem;color:var(--white);line-height:1;" id="stat-focus">0<span style="font-size:0.8rem;">min</span></div>
                        </div>
                        <div class="stat-box flex flex-col gap-1">
                            <div style="font-size:0.58rem;font-family:var(--fh);letter-spacing:0.1em;text-transform:uppercase;color:var(--md);">Fase atual</div>
                            <div style="display:flex;align-items:center;gap:8px;margin-top:4px;">
                                <div id="phase-badge" class="px-3 py-1 rounded-full text-xs font-bold"
                                     style="background:rgba(236,72,153,0.12);border:1px solid rgba(236,72,153,0.25);color:#ec4899;font-family:var(--fh);font-size:0.55rem;letter-spacing:0.08em;">
                                    FOCO
                                </div>
                            </div>
                            <div style="font-size:0.62rem;color:var(--md);margin-top:4px;">Próximo: pausa curta</div>
                        </div>
                    </div>
                </div>

                <!-- ── ROW 2: SUBJECT + WEEK ── -->
                <div class="grid gap-5 anim-fade-up d3" style="grid-template-columns:1fr 1fr;">

                    <!-- SUBJECT SELECTOR -->
                    <div class="glass-card p-6">
                        <div style="font-family:var(--fh);font-size:0.55rem;letter-spacing:0.12em;text-transform:uppercase;color:#ec4899;margin-bottom:14px;">Matéria atual</div>
                        <div class="flex flex-wrap gap-2" id="subject-tags">
                            @foreach(['Matemática', 'Física', 'Química', 'Biologia', 'História', 'Português', 'Inglês', 'Filosofia'] as $idx => $s)
                                <div class="subject-tag {{ $idx === 0 ? 'active' : '' }}" data-subject="{{ $s }}">{{ $s }}</div>
                            @endforeach
                        </div>
                        <div class="flex items-center gap-3 mt-5 pt-5" style="border-top:1px solid var(--ld);">
                            <div class="w-2 h-2 rounded-full flex-shrink-0" style="background:#ec4899;box-shadow:0 0 8px rgba(236,72,153,0.6);"></div>
                            <span style="font-size:0.72rem;color:var(--white);">Estudando: <strong id="current-subject" style="color:#ec4899;">Matemática</strong></span>
                        </div>
                    </div>

                    <!-- WEEK OVERVIEW -->
                    <div class="glass-card p-6">
                        <div style="font-family:var(--fh);font-size:0.55rem;letter-spacing:0.12em;text-transform:uppercase;color:#ec4899;margin-bottom:14px;">Progresso da semana</div>
                        <div class="flex items-end gap-2 h-16">
                            @php $days = [['S', 4, true, false], ['T', 3, true, false], ['Q', 5, true, false], ['Q', 2, true, false], ['S', 0, false, true], ['S', 0, false, false], ['D', 0, false, false]]; @endphp
                            @foreach($days as $d)
                                <div class="flex flex-col items-center gap-1 flex-1">
                                    <div style="width:100%;height:{{ max(10, $d[1] * 12) }}px;" class="week-bar {{ $d[1] > 0 ? ($d[3] ? 'today' : 'done') : '' }}"></div>
                                    <span style="font-size:0.5rem;font-family:var(--fh);color:{{ $d[3] ? '#ec4899' : 'var(--md)' }};">{{ $d[0] }}</span>
                                </div>
                            @endforeach
                        </div>
                        <div class="flex items-center justify-between mt-4 pt-4" style="border-top:1px solid var(--ld);">
                            <span style="font-size:0.65rem;color:var(--md);">Esta semana</span>
                            <span style="font-family:var(--fh);font-size:0.75rem;font-weight:900;color:var(--white);">14 <span style="color:#ec4899;">sessões</span></span>
                        </div>
                    </div>
                </div>

                <!-- ── ROW 3: TIPS ── -->
                <div class="glass-card p-6 anim-fade-up d4">
                    <div style="font-family:var(--fh);font-size:0.55rem;letter-spacing:0.12em;text-transform:uppercase;color:#ec4899;margin-bottom:14px;">Dica de estudo</div>
                    <div class="flex items-start gap-4">
                        <div class="w-10 h-10 rounded-[12px] flex items-center justify-center flex-shrink-0 text-lg"
                             style="background:rgba(236,72,153,0.08);border:1px solid rgba(236,72,153,0.15);">💡</div>
                        <div>
                            <p id="tip-text" style="font-size:0.78rem;line-height:1.7;color:var(--md);">
                                Durante o Pomodoro, evite verificar o celular. Coloque-o no modo silencioso e voltado para baixo. Cada interrupção leva cerca de 20 minutos para recuperar o foco total.
                            </p>
                        </div>
                    </div>
                </div>

                <!-- SUPPORT OVERLAY -->
                <div id="support-overlay" class="absolute top-0 right-0 h-full z-[100]" style="overflow:hidden;">
                    <div class="flex flex-col h-full" style="width:290px;background:#060810;border-left:1px solid var(--ld);">
                        <div class="flex items-center justify-between px-4 py-3" style="border-bottom:1px solid var(--ld);">
                            <span style="font-family:var(--fh);font-size:0.6rem;font-weight:700;letter-spacing:0.1em;color:var(--white);">BANCO DE QUESTÕES</span>
                            <div id="close-support" class="w-6 h-6 flex items-center justify-center cursor-pointer text-[#64748b] rounded-md transition-all hover:text-slate-200 hover:bg-white/5">
                                <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                                </svg>
                            </div>
                        </div>
                        <div class="overflow-y-auto flex-1 pb-5">
                            @php $bq = [
                                ['Exatas', 'pink', [['Matemática', '/math'], ['Física', '/fisica'], ['Química', '/quimica']]],
                                ['Linguagens', 'amber', [['Gramática', '/gramatica'], ['Literatura', '/literatura'], ['Inglês', '/ingles'], ['Espanhol', '/espanhol']]],
                                ['Humanas', 'indigo', [['História', '/historia'], ['Geografia', '/geografia'], ['Sociologia', '/sociologia'], ['Filosofia', '/filosofia']]],
                                ['Natureza', 'emerald', [['Biologia', '/biologia'], ['Ecologia', '/ecologia']]],
                            ]; @endphp
                            @foreach($bq as $area)
                                <p style="font-size:0.58rem;font-weight:700;letter-spacing:0.12em;text-transform:uppercase;color:#64748b;padding:12px 16px 4px;">{{ $area[0] }}</p>
                                @foreach($area[2] as $item)
                                    <a href="{{ $item[1] }}" class="flex items-center gap-3 px-4 h-11 cursor-pointer border-l-2 border-transparent text-[#64748b] text-[13px] font-medium transition-colors hover:bg-white/[0.04] hover:text-slate-200" style="text-decoration:none;">
                                        <div class="w-1.5 h-1.5 rounded-full flex-shrink-0" style="background:{{ $area[1] === 'pink' ? '#ec4899' : ($area[1] === 'amber' ? '#f59e0b' : ($area[1] === 'indigo' ? '#818cf8' : '#34d399')) }};"></div>
                                        {{ $item[0] }}
                                    </a>
                                @endforeach
                                <div style="height:1px;margin:6px 16px;background:var(--ld);"></div>
                            @endforeach
                        </div>
                    </div>
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
        });

        /* ── TUTORIAL ── */
        let currentStep = 1;
        const totalSteps = 3;
        const overlay = document.getElementById('tutorial-overlay');
        const nextBtn = document.getElementById('tut-next');
        const backBtn = document.getElementById('tut-back');
        const dots    = document.querySelectorAll('.step-dot');

        function goToStep(n) {
            document.querySelectorAll('.tut-step').forEach(s => s.classList.remove('active'));
            document.getElementById('step-' + n)?.classList.add('active');
            dots.forEach((d, i) => d.classList.toggle('active', i === n - 1));
            backBtn.classList.toggle('hidden', n === 1);
            if (n === totalSteps) { nextBtn.classList.add('hidden'); }
            else { nextBtn.classList.remove('hidden'); }
            currentStep = n;
        }

        nextBtn?.addEventListener('click', () => { if (currentStep < totalSteps) goToStep(currentStep + 1); });
        backBtn?.addEventListener('click', () => { if (currentStep > 1) goToStep(currentStep - 1); });

        document.getElementById('start-focus-btn')?.addEventListener('click', () => {
            overlay.classList.add('hide');
        });
        document.getElementById('tutorial-reopen')?.addEventListener('click', () => {
            goToStep(1);
            overlay.classList.remove('hide');
        });

        /* ── TIMER ── */
        const PHASES = [
            { name: 'FOCO',       label: 'Foco Total',   secs: 25 * 60, badge: 'FOCO',   next: 'pausa curta' },
            { name: 'PAUSA',      label: 'Pausa Curta',  secs: 5 * 60,  badge: 'PAUSA',  next: 'foco' },
            { name: 'PAUSA LONGA',label: 'Pausa Longa',  secs: 15 * 60, badge: 'PAUSA LONGA', next: 'foco' },
        ];

        let phaseIdx     = 0;
        let secondsLeft  = PHASES[0].secs;
        let running      = false;
        let interval     = null;
        let cycleCount   = 0;
        let sessionsToday= 0;
        let totalFocusMins = 0;
        let soundOn      = true;

        const timerEl  = document.getElementById('timer-digits');
        const phaseLabel = document.getElementById('phase-label');
        const phaseBadge = document.getElementById('phase-badge');
        const phaseNext  = phaseBadge?.nextElementSibling;
        const playBtn  = document.getElementById('play-btn');
        const playIcon = document.getElementById('play-icon');
        const playLbl  = document.getElementById('play-label');
        const resetBtn = document.getElementById('reset-btn');
        const skipBtn  = document.getElementById('skip-btn');
        const ringFill = document.getElementById('ring-fill');
        const timerWrap= document.getElementById('timer-wrap');
        const cycleLabel = document.getElementById('cycle-label');
        const statSessions = document.getElementById('stat-sessions');
        const statFocus    = document.getElementById('stat-focus');
        const sessionsBar  = document.getElementById('sessions-bar');

        const TIPS = [
            'Durante o Pomodoro, evite verificar o celular. Cada interrupção leva cerca de 20 minutos para recuperar o foco total.',
            'Anote tudo que vier à mente durante o foco em um papel ao lado — isso libera espaço mental sem interromper o timer.',
            'Mantenha uma garrafa de água na mesa. Hidratação adequada melhora em até 14% a capacidade de concentração.',
            'Estudos mostram que revisar o conteúdo nas primeiras 24h após aprender aumenta a retenção em 60%.',
            'O espaço físico importa: mesa organizada, luz natural e temperatura entre 18-22°C potencializam o foco.',
        ];
        let tipIdx = 0;
        const tipEl = document.getElementById('tip-text');

        function rotateTip() {
            if (!tipEl) return;
            tipIdx = (tipIdx + 1) % TIPS.length;
            tipEl.style.opacity = 0;
            setTimeout(() => { tipEl.textContent = TIPS[tipIdx]; tipEl.style.opacity = 1; }, 300);
        }
        tipEl && (tipEl.style.transition = 'opacity 0.3s');
        setInterval(rotateTip, 30000);

        function fmtTime(s) {
            return String(Math.floor(s / 60)).padStart(2, '0') + ':' + String(s % 60).padStart(2, '0');
        }

        function updateRing() {
            const total = PHASES[phaseIdx].secs;
            const pct   = secondsLeft / total;
            const circ  = 440;
            const offset = circ * (1 - pct);
            if (ringFill) ringFill.style.strokeDashoffset = offset;
        }

        function updateCycles() {
            for (let i = 1; i <= 4; i++) {
                const dot = document.getElementById('cycle-' + i);
                if (!dot) continue;
                if (i <= cycleCount) {
                    dot.style.background = 'linear-gradient(135deg,#ec4899,#9333ea)';
                    dot.style.border = 'none';
                    dot.style.boxShadow = '0 0 8px rgba(236,72,153,0.5)';
                } else {
                    dot.style.background = 'rgba(255,255,255,0.08)';
                    dot.style.border = '1px solid rgba(255,255,255,0.12)';
                    dot.style.boxShadow = '';
                }
            }
            if (cycleLabel) cycleLabel.textContent = cycleCount + '/4';
        }

        function setPhase(idx) {
            phaseIdx    = idx % 3;
            secondsLeft = PHASES[phaseIdx].secs;
            if (timerEl) timerEl.textContent = fmtTime(secondsLeft);
            if (phaseLabel) phaseLabel.textContent = PHASES[phaseIdx].name;
            if (phaseBadge) {
                phaseBadge.textContent = PHASES[phaseIdx].badge;
                phaseBadge.style.color = phaseIdx === 0 ? '#ec4899' : '#34d399';
                phaseBadge.style.background = phaseIdx === 0 ? 'rgba(236,72,153,0.12)' : 'rgba(52,211,153,0.12)';
                phaseBadge.style.borderColor = phaseIdx === 0 ? 'rgba(236,72,153,0.25)' : 'rgba(52,211,153,0.25)';
            }
            const nextDiv = document.querySelector('#phase-badge + div');
            if (nextDiv) nextDiv.textContent = 'Próximo: ' + PHASES[phaseIdx].next;
            updateRing();
            running = false;
            timerWrap?.classList.remove('timer-running');
            if (playIcon) playIcon.innerHTML = '<path d="M6 4l15 8-15 8V4z"/>';
            if (playLbl) playLbl.textContent = 'Iniciar';
        }

        function tick() {
            if (secondsLeft <= 0) {
                clearInterval(interval);
                running = false;
                timerWrap?.classList.remove('timer-running');
                if (playIcon) playIcon.innerHTML = '<path d="M6 4l15 8-15 8V4z"/>';
                if (playLbl) playLbl.textContent = 'Iniciar';

                // Phase complete
                if (phaseIdx === 0) { // focus done
                    sessionsToday++;
                    totalFocusMins += 25;
                    cycleCount = Math.min(cycleCount + 1, 4);
                    if (statSessions) statSessions.textContent = sessionsToday;
                    if (statFocus) statFocus.innerHTML = totalFocusMins + '<span style="font-size:0.8rem;">min</span>';
                    if (sessionsBar) sessionsBar.style.width = Math.min(sessionsToday / 4 * 100, 100) + '%';
                    updateCycles();
                    // Long break every 4 cycles
                    setPhase(cycleCount >= 4 ? 2 : 1);
                    if (cycleCount >= 4) cycleCount = 0;
                } else {
                    setPhase(0);
                }
                return;
            }
            secondsLeft--;
            if (timerEl) timerEl.textContent = fmtTime(secondsLeft);
            updateRing();
        }

        playBtn?.addEventListener('click', () => {
            if (!running) {
                running = true;
                interval = setInterval(tick, 1000);
                timerWrap?.classList.add('timer-running');
                if (phaseLabel) phaseLabel.textContent = PHASES[phaseIdx].name;
                if (playIcon) playIcon.innerHTML = '<path d="M6 10H4v4h2v-4zm8 0h-2v4h2v-4zm4 0h-2v4h2v-4z" fill="currentColor"/>';
                if (playLbl) playLbl.textContent = 'Pausar';
            } else {
                running = false;
                clearInterval(interval);
                timerWrap?.classList.remove('timer-running');
                if (playIcon) playIcon.innerHTML = '<path d="M6 4l15 8-15 8V4z"/>';
                if (playLbl) playLbl.textContent = 'Continuar';
            }
        });

        resetBtn?.addEventListener('click', () => {
            clearInterval(interval);
            running = false;
            setPhase(phaseIdx);
            timerWrap?.classList.remove('timer-running');
        });

        skipBtn?.addEventListener('click', () => {
            clearInterval(interval);
            running = false;
            setPhase(phaseIdx === 0 ? 1 : 0);
        });

        /* ── SOUND TOGGLE ── */
        const soundBtn  = document.getElementById('sound-btn');
        const soundIcon = document.getElementById('sound-icon');
        soundBtn?.addEventListener('click', () => {
            soundOn = !soundOn;
            if (soundIcon) {
                soundIcon.style.opacity = soundOn ? '1' : '0.3';
            }
        });

        /* ── SUBJECT TAGS ── */
        const subjectEl = document.getElementById('current-subject');
        document.querySelectorAll('.subject-tag').forEach(tag => {
            tag.addEventListener('click', () => {
                document.querySelectorAll('.subject-tag').forEach(t => t.classList.remove('active'));
                tag.classList.add('active');
                if (subjectEl) subjectEl.textContent = tag.dataset.subject;
            });
        });

        /* ── SUPPORT PANEL ── */
        const supportOverlay = document.getElementById('support-overlay');
        document.getElementById('support-btn')?.addEventListener('click', () => {
            supportOverlay?.classList.toggle('open');
        });
        document.getElementById('close-support')?.addEventListener('click', () => {
            supportOverlay?.classList.remove('open');
        });

        updateRing();
        updateCycles();
    })();
    </script>
</body>
</html>