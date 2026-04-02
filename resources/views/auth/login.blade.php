<!DOCTYPE html>
<html lang="pt-BR" class="h-full">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login | StudyLab</title>
    <link rel="icon" href="{{ asset('favicons/icone.ico') }}">
    @vite('resources/css/app.css')
    <link rel="stylesheet" href="{{ asset('css/login.css') }}">
</head>

<body class="h-full overflow-hidden bg-[#0B0B0F] text-slate-200" style="font-family:'DM Sans',sans-serif;">

    <svg class="fixed inset-0 w-full h-full pointer-events-none z-0 opacity-25" preserveAspectRatio="xMidYMid slice">
        <path class="draw1" d="M-50 580 Q200 490 450 548 Q700 606 940 498 Q1180 390 1500 475" stroke="#db2777"
            stroke-width="1.5" fill="none" stroke-linecap="round" />
        <path class="draw2" d="M-50 310 Q160 248 380 290 Q600 332 820 244 Q1040 156 1500 232"
            stroke="rgba(219,39,119,.5)" stroke-width="1" fill="none" stroke-linecap="round" />
    </svg>


    <div class="fixed pulse-dot pointer-events-none"
        style="top:17%;left:20%;animation:blobFloat 4.5s ease-in-out infinite .4s;">
        <svg width="24" height="24" viewBox="0 0 24 24" fill="none">
            <path d="M12 2L14 8.5L21 12L14 15.5L12 22L10 15.5L3 12L10 8.5Z" fill="#f472b6" opacity=".65" />
        </svg>
    </div>
    <div class="fixed pulse-dot pointer-events-none"
        style="bottom:32%;right:20%;animation:blobFloat 6s ease-in-out infinite 1.2s;">
        <svg width="16" height="16" viewBox="0 0 16 16" fill="none">
            <path d="M8 1L9.6 6.2L15 8L9.6 9.8L8 15L6.4 9.8L1 8L6.4 6.2Z" fill="#db2777" opacity=".55" />
        </svg>
    </div>
    <div class="fixed pulse-dot pointer-events-none"
        style="top:58%;left:12%;animation:blobFloat 5s ease-in-out infinite .7s;">
        <svg width="12" height="12" viewBox="0 0 12 12" fill="none">
            <path d="M6 1L7 4.5L10.5 6L7 7.5L6 11L5 7.5L1.5 6L5 4.5Z" fill="#fbbf24" opacity=".7" />
        </svg>
    </div>
    <div class="fixed pulse-dot pointer-events-none bg-[#f9a8d4] w-2.5 h-2.5 rounded-full" style="top:26%;left:10%;">
    </div>
    <div class="fixed pulse-dot pointer-events-none bg-yellow-300 w-2 h-2 rounded-full opacity-70"
        style="top:70%;left:33%;animation-delay:.8s;"></div>
    <div class="fixed pulse-dot pointer-events-none bg-violet-400 w-2 h-2 rounded-full opacity-60"
        style="top:20%;right:25%;animation-delay:1.4s;"></div>


    <div id="particles" class="fixed inset-0 pointer-events-none overflow-hidden z-0"></div>


    <main class="relative z-10 h-full flex">

        <div class="hidden lg:flex flex-1 flex-col items-center justify-center relative overflow-hidden">

            <div class="max-w-xl w-full px-12">

                <div
                    class="inline-flex items-center gap-2 px-4 py-2 rounded-full bg-pink-500/10 border border-pink-500/20 text-pink-500 text-xs font-bold tracking-widest uppercase mb-2 fade-up">
                    <span class="w-2 h-2 rounded-full bg-pink-500 animate-pulse"></span>
                    Plataforma de estudos
                </div>

                <h1 class="font-display text-6xl font-extrabold text-white leading-none mb-2 fade-up"
                    style="animation-delay:.1s">
                    Futuro da sua<br>
                    <span class="grad-text">organização.</span>
                </h1>

                <p class="text-slate-400 text-base leading-relaxed mb-10 fade-up" style="animation-delay:.2s">
                    Organize provas, atividades e conteúdos em um só lugar com dashboards em tempo real.
                </p>

                <div class="relative mt-12 fade-up" style="animation-delay: 0.3s">
                    <div
                        class="bg-[#16161D] border border-white/10 rounded-2xl shadow-2xl p-6 transform -rotate-2 hover:rotate-0 transition-transform duration-700 floating">
                        <div class="flex items-center gap-2 mb-6 border-b border-white/5 pb-4">
                            <div class="flex gap-1.5">
                                <div class="w-3 h-3 rounded-full bg-red-500/20 border border-red-500/40"></div>
                                <div class="w-3 h-3 rounded-full bg-yellow-500/20 border border-yellow-500/40"></div>
                                <div class="w-3 h-3 rounded-full bg-green-500/20 border border-green-500/40"></div>
                            </div>
                            <div class="h-4 w-32 bg-white/5 rounded mx-auto"></div>
                        </div>

                        <div class="grid grid-cols-2 gap-4">
                            <div
                                class="h-24 bg-gradient-to-br from-pink-500/20 to-transparent rounded-xl border border-pink-500/20 p-4">
                                <div class="w-8 h-2 bg-pink-500/40 rounded mb-2"></div>
                                <div class="w-12 h-6 bg-white rounded"></div>
                            </div>
                            <div class="h-24 bg-white/5 rounded-xl border border-white/10 p-4">
                                <div class="w-8 h-2 bg-white/20 rounded mb-2"></div>
                                <div class="w-12 h-6 bg-white/60 rounded"></div>
                            </div>
                        </div>

                        <div class="mt-4 h-32 bg-white/5 rounded-xl border border-white/10 p-4 flex flex-col gap-3">
                            <div class="h-2 w-full bg-white/10 rounded"></div>
                            <div class="h-2 w-2/3 bg-white/10 rounded"></div>
                            <div class="h-2 w-1/2 bg-white/10 rounded"></div>
                        </div>
                    </div>

                    <div class="absolute -right-8 -bottom-10 w-40 bg-[#1A1A24] border border-white/10 rounded-3xl shadow-3xl p-4 hidden xl:block transform rotate-6 animate-bounce"
                        style="animation-duration: 6s;">
                        <div class="w-10 h-1 bg-white/10 rounded-full mx-auto mb-4"></div>
                        <div class="space-y-3">
                            <div class="h-10 w-full bg-pink-500/20 rounded-lg"></div>
                            <div class="h-10 w-full bg-white/5 rounded-lg"></div>
                        </div>
                    </div>
                </div>



            </div>
        </div>

        <!-- LADO DIREITO — formulário -->
        <div
            class="w-full lg:w-[500px] shrink-0 bg-[#0E0E13] border-l border-white/5 flex items-center justify-center px-8 lg:px-14 relative z-20">

            <!-- barra gradiente -->
            <div
                class="absolute top-0 left-0 w-[2px] h-full bg-gradient-to-b from-pink-600 via-pink-400 to-transparent">
            </div>

            <div class="w-full max-w-sm">

                <div class="mb-6 fade-up text-center" style="animation-delay:.08s">
                    <h2 class="text-3xl font-display font-bold text-white tracking-tight">Bem-vindo de volta</h2>
                    <p class="text-slate-500 mt-2 text-sm">Insira seus dados para acessar sua conta.</p>
                </div>

                <div id="errorBox"
                    class="hidden mb-5 flex items-center gap-2.5 rounded-xl px-4 py-3 bg-red-500/10 border border-red-500/20">
                    <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="#ef4444" stroke-width="2.5"
                        stroke-linecap="round">
                        <circle cx="12" cy="12" r="10" />
                        <line x1="12" y1="8" x2="12" y2="12" />
                        <line x1="12" y1="16" x2="12.01" y2="16" />
                    </svg>
                    <p id="errorMessage" class="text-red-400 text-xs font-semibold"></p>
                </div>

                <form id="loginForm" class="space-y-5 fade-up" style="animation-delay:.1s" novalidate>

                    <div>
                        <label
                            class="block text-xs font-bold text-slate-400 uppercase tracking-widest mb-2">E-mail</label>
                        <input id="email" type="email" placeholder="nome@exemplo.com" autocomplete="email"
                            class="w-full bg-[#16161D] border border-white/5 rounded-xl px-4 py-3 text-sm text-white placeholder:text-slate-600 focus:outline-none focus:border-pink-500 focus:ring-1 focus:ring-pink-500/30 transition-all">
                    </div>

                    <div>
                        <div class="flex justify-between mb-2">
                            <label class="text-xs font-bold text-slate-400 uppercase tracking-widest">Senha</label>
                            <a href="/forgot"
                                class="text-xs font-bold text-pink-500 hover:text-pink-400 transition-colors">Esqueceu?</a>
                        </div>
                        <div class="relative">
                            <input id="password" type="password" placeholder="••••••••" autocomplete="current-password"
                                class="w-full bg-[#16161D] border border-white/5 rounded-xl px-4 py-3 text-sm text-white placeholder:text-slate-600 focus:outline-none focus:border-pink-500 focus:ring-1 focus:ring-pink-500/30 transition-all pr-11">
                            <button type="button" id="togglePwd"
                                class="absolute right-3.5 top-1/2 -translate-y-1/2 text-slate-600 hover:text-pink-500 transition-colors">
                                <svg id="eyeOff" width="15" height="15" viewBox="0 0 24 24" fill="none"
                                    stroke="currentColor" stroke-width="2" stroke-linecap="round">
                                    <path
                                        d="M17.94 17.94A10.07 10.07 0 0112 20c-7 0-11-8-11-8a18.45 18.45 0 015.06-5.94M9.9 4.24A9.12 9.12 0 0112 4c7 0 11 8 11 8a18.5 18.5 0 01-2.16 3.19m-6.72-1.07a3 3 0 11-4.24-4.24" />
                                    <line x1="1" y1="1" x2="23" y2="23" />
                                </svg>
                                <svg id="eyeOn" width="15" height="15" viewBox="0 0 24 24" fill="none"
                                    stroke="currentColor" stroke-width="2" stroke-linecap="round" class="hidden">
                                    <path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z" />
                                    <circle cx="12" cy="12" r="3" />
                                </svg>
                            </button>
                        </div>
                    </div>

                    <label class="flex items-center gap-3 cursor-pointer group">
                        <input type="checkbox" id="remember" class="hidden peer">
                        <div
                            class="relative w-8 h-4 bg-slate-800 peer-checked:bg-pink-600 rounded-full border border-white/10 transition-colors duration-200">
                            <div
                                class="absolute top-0.5 left-0.5 w-3 h-3 bg-white rounded-full shadow-sm transition-transform duration-200 peer-checked:translate-x-4">
                            </div>
                        </div>
                        <span class="text-sm text-slate-500 group-hover:text-slate-300 transition-colors">Manter
                            conectado</span>
                    </label>

                    <button type="submit" id="submitBtn"
                        class="glow-btn w-full bg-pink-600 hover:bg-pink-500 text-white font-bold py-4 rounded-xl transition-all hover:-translate-y-0.5 active:scale-95 flex items-center justify-center gap-2 disabled:opacity-50">
                        <span id="btnLabel">Entrar na plataforma</span>
                        <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5">
                            <path d="M14 5l7 7m0 0l-7 7m7-7H3" stroke-linecap="round" stroke-linejoin="round" />
                        </svg>
                    </button>

                </form>

                <div class="mt-7 pt-7 border-t border-white/5 space-y-3 fade-up" style="animation-delay:.2s">
                    <a href="/auth/google/redirect"
                        class="w-full bg-[#16161D] hover:bg-[#1C1C26] border border-white/5 text-white font-medium py-3 rounded-xl transition-all hover:-translate-y-0.5 flex items-center justify-center gap-3 text-sm">
                        <img src="https://www.svgrepo.com/show/475656/google-color.svg" class="w-5 h-5" alt="Google">
                        Entrar com Google
                    </a>
                </div>

                <p class="mt-7 text-center text-sm text-slate-500 fade-up" style="animation-delay:.3s">
                    Não tem conta?
                    <a href="/register" class="text-white font-bold hover:text-pink-500 transition-colors">Crie agora
                        gratuitamente</a>
                </p>

            </div>
        </div>
    </main>

    <script src="{{ asset('js/login.js') }}"></script>
    <script>
        (function () {
            const tog = document.getElementById('togglePwd'), pw = document.getElementById('password');
            const off = document.getElementById('eyeOff'), on = document.getElementById('eyeOn');
            if (!tog || !pw) return;
            tog.addEventListener('click', () => { const s = pw.type === 'password'; pw.type = s ? 'text' : 'password'; off.classList.toggle('hidden', s); on.classList.toggle('hidden', !s); });
        })();

        (function () {
            const pc = document.getElementById('particles');
            for (let i = 0; i < 24; i++) {
                const p = document.createElement('div');
                p.className = 'particle';
                const sz = 1.5 + Math.random() * 3;
                p.style.width = sz + 'px';
                p.style.height = sz + 'px';
                p.style.left = Math.random() * 100 + '%';
                p.style.bottom = '-12px';
                p.style.opacity = .15 + Math.random() * .45;
                p.style.animationDuration = (8 + Math.random() * 14) + 's';
                p.style.animationDelay = Math.random() * 14 + 's';
                pc.appendChild(p);
            }
        })();

        (function () {
            const m = document.querySelector('.scanline');
            if (!m || window.innerWidth < 1024) return;
            document.addEventListener('mousemove', e => {
                const cx = window.innerWidth / 2, cy = window.innerHeight / 2;
                const dx = (e.clientX - cx) / cx, dy = (e.clientY - cy) / cy;
                m.style.transform = `perspective(900px) rotateY(${dx * 3}deg) rotateX(${-dy * 2.5}deg) rotate(-1deg)`;
            });
            document.addEventListener('mouseleave', () => { m.style.transform = 'rotate(-1deg)'; });
            m.style.transition = 'transform .15s ease';
        })();
    </script>
</body>

</html>