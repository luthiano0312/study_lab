<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>StudyLab · Questões</title>
    <link rel="icon" type="image/png" href="{{ asset('favicons/logo/focus-logo.ico') }}">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <link rel="stylesheet" href="{{ asset('css/banco-questoes.css') }}">

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

    <!-- TOPBAR -->
    <div id="topbar">

        {{-- ESQUERDA: título --}}
        <div style="display:flex;align-items:center;gap:10px;">
            <span
                style="font-family:var(--fh);font-weight:900;font-size:0.62rem;letter-spacing:0.12em;">CONTEÚDOS</span>
            <div
                style="padding:3px 12px;border-radius:100px;background:rgba(236,72,153,0.1);border:1px solid rgba(236,72,153,0.25);">
                <span
                    style="font-size:0.52rem;font-family:var(--fh);font-weight:700;color:#ec4899;letter-spacing:0.08em;">Biblioteca</span>
            </div>
        </div>

        {{-- CENTRO: search (geometricamente centralizado) --}}
        <div id="search-wrap">
            <svg width="14" height="14" fill="none" stroke="#64748b" stroke-width="2" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
            </svg>
            <input id="search-input" type="text" placeholder="Pesquisar conteúdos..." />
            <div id="search-clear" style="display:none;">
                <svg width="14" height="14" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
                </svg>
            </div>
        </div>

        {{-- DIREITA: contador --}}
        <div style="display:flex;justify-content:flex-end;align-items:center;">
            <div id="search-count" style="display:none;font-size:0.58rem;color:#64748b;font-family:var(--fb);">
                <span id="search-count-num">0</span> resultados
            </div>
        </div>

    </div>
    <div style="flex:1;display:flex;flex-direction:column;overflow:hidden;min-width:0;">


        <main class="flex-1 overflow-y-auto overflow-x-hidden p-8 bg-[#18181b] transition-colors duration-200">
            @yield('content')
        </main>

        <script src="{{ asset('js/banco-questoes.js') }}"></script>
</body>

</html>