<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>StudyLab · Escola Virtual</title>
    <link rel="icon" type="image/png" href="{{ asset('favicons/logo/focus-logo.ico') }}">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <link rel="stylesheet" href="{{ asset('css/focus.css') }}">
</head>

<body class="bg-[#121212] overflow-hidden font-sans antialiased" style="display:flex;height:100vh;">
    <aside id="sidebar">
        <div style="width:34px;height:34px;border-radius:10px;margin-bottom:16px;flex-shrink:0;"></div>
        <a href="/focus" class="si act"><svg width="17" height="17" fill="none" stroke="currentColor" stroke-width="1.8"
                viewBox="0 0 24 24" style="flex-shrink:0;">
                <path stroke-linecap="round" stroke-linejoin="round" d="M13 10V3L4 14h7v7l9-11h-7z" />
            </svg><span class="sl">Central</span></a>
        <a href="/whiteboard" class="si"><svg width="17" height="17" fill="none" stroke="currentColor"
                stroke-width="1.8" viewBox="0 0 24 24" style="flex-shrink:0;">
                <path stroke-linecap="round" stroke-linejoin="round"
                    d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z" />
            </svg><span class="sl">Lousa virtual</span></a>
        <a href="/notebook" class="si"><svg width="17" height="17" fill="none" stroke="currentColor" stroke-width="1.8"
                viewBox="0 0 24 24" style="flex-shrink:0;">
                <path stroke-linecap="round" stroke-linejoin="round"
                    d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253" />
            </svg><span class="sl">Caderno</span></a>
        <a href="/flashcards" class="si"><svg width="17" height="17" fill="none" stroke="currentColor"
                stroke-width="1.8" viewBox="0 0 24 24" style="flex-shrink:0;">
                <path stroke-linecap="round" stroke-linejoin="round"
                    d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2" />
            </svg><span class="sl">Flashcards</span></a>
        <a href="/dashboard" class="si"><svg width="17" height="17" fill="none" stroke="currentColor" stroke-width="1.8"
                viewBox="0 0 24 24" style="flex-shrink:0;">
                <path stroke-linecap="round" stroke-linejoin="round"
                    d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6" />
            </svg><span class="sl">Dashboard</span></a>
        <a href="/dashboard" class="si"><svg width="17" height="17" fill="none" stroke="currentColor" stroke-width="1.8"
                viewBox="0 0 24 24" style="flex-shrink:0;">
                <path stroke-linecap="round" stroke-linejoin="round"
                    d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1" />
            </svg><span class="sl">Sair</span></a>
        <div id="sb-toggle" class="si" style="margin-top:auto;">
            <svg id="sb-arrow" width="17" height="17" fill="none" stroke="currentColor" stroke-width="2"
                viewBox="0 0 24 24" style="flex-shrink:0;transition:transform 0.3s;">
                <path stroke-linecap="round" stroke-linejoin="round" d="M9 5l7 7-7 7" />
            </svg>
            <span class="sl">Recolher</span>
        </div>
    </aside>

    <div style="flex:1;display:flex;flex-direction:column;overflow:hidden;min-width:0;">

        <!-- TOPBAR -->
        <div
            style="height:54px;display:flex;align-items:center;justify-content:space-between;padding:0 28px;gap:16px;flex-shrink:0;border-bottom:1px solid var(--ld);background:#121212;backdrop-filter:blur(20px);">
            <div style="display:flex;align-items:center;gap:12px;">
                <span style="font-family:var(--fh);font-size:0.58rem;font-weight:900;letter-spacing:0.12em;">Escola
                    Virtual</span>
                <div
                    style="display:flex;align-items:center;gap:6px;padding:4px 11px;border-radius:100px;background:rgba(236,72,153,0.09);border:1px solid rgba(236,72,153,0.2);">
                    <div class="live-dot"
                        style="width:5px;height:5px;border-radius:50%;background:#ec4899;flex-shrink:0;"></div>
                    <span
                        style="font-family:var(--fh);font-size:0.42rem;font-weight:700;color:#ec4899;letter-spacing:0.1em;">SESSAO
                        ATIVA</span>
                </div>
                <div style="overflow:hidden;width:160px;">
                    <div class="mq-inner">
                        <span class="mq-item">Pomodoro <span style="color:rgba(147,51,234,0.25);">·</span></span>
                        <span class="mq-item">25min <span style="color:rgba(147,51,234,0.25);">·</span></span>
                        <span class="mq-item">Foco Total <span style="color:rgba(147,51,234,0.25);">·</span></span>
                        <span class="mq-item">Pausa <span style="color:rgba(147,51,234,0.25);">·</span></span>
                        <span class="mq-item">Deep Work <span style="color:rgba(147,51,234,0.25);">·</span></span>
                        <span class="mq-item">Ciclo <span style="color:rgba(147,51,234,0.25);">·</span></span>
                        <span class="mq-item">Pomodoro <span style="color:rgba(147,51,234,0.25);">·</span></span>
                        <span class="mq-item">25min <span style="color:rgba(147,51,234,0.25);">·</span></span>
                        <span class="mq-item">Foco Total <span style="color:rgba(147,51,234,0.25);">·</span></span>
                        <span class="mq-item">Pausa <span style="color:rgba(147,51,234,0.25);">·</span></span>
                        <span class="mq-item">Deep Work <span style="color:rgba(147,51,234,0.25);">·</span></span>
                        <span class="mq-item">Ciclo <span style="color:rgba(147,51,234,0.25);">·</span></span>
                    </div>
                </div>
            </div>
            <div style="display:flex;align-items:center;gap:8px;">
                <button id="reopen-tut" class="topbtn">
                    <svg width="13" height="13" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="M8.228 9c.549-1.165 2.03-2 3.772-2 2.21 0 4 1.343 4 3 0 1.4-1.278 2.575-3.006 2.907-.542.104-.994.54-.994 1.093m0 3h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                    </svg>
                    Tutorial
                </button>
                <button id="bq-btn" class="topbtn topbtn-acc">
                    <svg width="13" height="13" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="M18.364 5.636l-3.536 3.536m0 5.656l3.536 3.536M9.172 9.172L5.636 5.636m3.536 9.192L5.636 18.364M21 12a9 9 0 11-18 0 9 9 0 0118 0zm-5 0a4 4 0 11-8 0 4 4 0 018 0z" />
                    </svg>
                    Banco de Questoes
                </button>
            </div>
        </div>

        <main class="flex-1 overflow-y-auto overflow-x-hidden p-8 bg-[#18181b] transition-colors duration-200">
            @yield('content')
        </main>


        <script src="{{ asset('js/focus.js') }}"></script>
</body>

</html>