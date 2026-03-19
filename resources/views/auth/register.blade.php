<!DOCTYPE html>
<html lang="pt-BR" class="h-full">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Criar Conta | StudyLab</title>
    <link rel="icon" href="{{ asset('favicons/icone.ico') }}">
    @vite('resources/css/app.css')
</head>

<body class="h-full bg-[#0B0B0F] text-slate-200 overflow-hidden font-body antialiased">

    <div class="animate-float fixed pointer-events-none -top-24 -left-32 w-[440px] h-[440px] rounded-[30%_70%_70%_30%/30%_30%_70%_70%] blur-[70px] opacity-10 bg-pink-600"
        style="animation-duration:9s;"></div>
    <div class="animate-float-delayed fixed pointer-events-none opacity-[.08] top-1/3 right-2 w-72 h-72 rounded-[30%_70%_70%_30%/30%_30%_70%_70%] blur-[80px] bg-violet-600"
        style="animation-duration:11s;"></div>

    <svg class="fixed inset-0 w-full h-full pointer-events-none z-0 opacity-25" preserveAspectRatio="xMidYMid slice">
        <path stroke-dasharray="800" stroke-dashoffset="800" stroke="#db2777" stroke-width="1.5" fill="none"
            stroke-linecap="round" d="M-50 580 Q200 490 450 548 Q700 606 940 498 Q1180 390 1500 475">
            <animate attributeName="stroke-dashoffset" from="800" to="0" dur="4s" begin="1s" fill="freeze" />
        </path>
        <path stroke-dasharray="800" stroke-dashoffset="800" stroke="rgba(219,39,119,.5)" stroke-width="1" fill="none"
            stroke-linecap="round" d="M-50 310 Q160 248 380 290 Q600 332 820 244 Q1040 156 1500 232">
            <animate attributeName="stroke-dashoffset" from="800" to="0" dur="4s" begin="2s" fill="freeze" />
        </path>
    </svg>


    <div class="animate-float fixed pointer-events-none opacity-60" style="top:15%;left:7%;animation-delay:.4s;">
        <svg width="22" height="22" viewBox="0 0 22 22" fill="none">
            <path d="M11 2L13 7.8L19 11L13 14.2L11 20L9 14.2L3 11L9 7.8Z" fill="#f472b6" opacity=".65" />
        </svg>
    </div>
    <div class="animate-float fixed pointer-events-none opacity-50" style="bottom:30%;right:5%;animation-delay:1.2s;">
        <svg width="14" height="14" viewBox="0 0 14 14" fill="none">
            <path d="M7 1L8.4 5.4L13 7L8.4 8.6L7 13L5.6 8.6L1 7L5.6 5.4Z" fill="#db2777" opacity=".55" />
        </svg>
    </div>
    <div class="animate-float fixed pointer-events-none opacity-50" style="top:60%;left:4%;animation-delay:.7s;">
        <svg width="11" height="11" viewBox="0 0 11 11" fill="none">
            <path d="M5.5 1L6.5 4.2L10 5.5L6.5 6.8L5.5 10L4.5 6.8L1 5.5L4.5 4.2Z" fill="#fbbf24" opacity=".7" />
        </svg>
    </div>


    <div class="animate-pulse fixed pointer-events-none w-2.5 h-2.5 rounded-full bg-[#f9a8d4]" style="top:25%;left:5%;">
    </div>
    <div class="animate-pulse fixed pointer-events-none w-2 h-2 rounded-full bg-yellow-300 opacity-70"
        style="top:70%;left:13%;animation-delay:.8s;"></div>
    <div class="animate-pulse fixed pointer-events-none w-2 h-2 rounded-full bg-violet-400 opacity-60"
        style="top:18%;right:7%;animation-delay:1.4s;"></div>


    <div id="particles" class="fixed inset-0 pointer-events-none overflow-hidden z-0"></div>

    <main class="relative z-10 h-full flex">


        <div class="hidden lg:flex flex-1 flex-col items-center justify-center relative overflow-hidden">
            <div class="absolute w-[500px] h-[500px] bg-pink-600/10 rounded-full blur-[120px] -z-10"></div>

            <div class="max-w-xl w-full px-12 text-center">

                <div
                    class="inline-flex items-center gap-2 px-4 py-2 rounded-full bg-pink-500/10 border border-pink-500/20 text-pink-500 text-xs font-bold tracking-widest uppercase mb-8 animate-fade-up">
                    <span class="w-2 h-2 rounded-full bg-pink-500 animate-pulse"></span>
                    Entre na evolução
                </div>

                <h1 class="font-display text-6xl font-extrabold text-white leading-tight mb-6 animate-fade-up"
                    style="animation-delay:.1s;">
                    Comece sua<br>
                    <span class="bg-gradient-to-r from-pink-500 to-violet-500 bg-clip-text text-transparent">jornada
                        hoje.</span>
                </h1>

                <p class="text-slate-400 text-lg mb-12 animate-fade-up" style="animation-delay:.2s;">
                    Junte-se a milhares de estudantes que já estão organizando seus estudos com o StudyLab.
                </p>

                <div class="relative animate-fade-up" style="animation-delay:.3s;">
                    <div class="animate-float bg-[#16161D] border border-white/10 rounded-2xl shadow-2xl p-6 transform rotate-2 hover:rotate-0 transition-transform duration-700"
                        style="box-shadow:0 0 60px rgba(219,39,119,.07),0 32px 64px rgba(0,0,0,.55);">
                        <div class="flex items-center gap-3 mb-4">
                            <div class="w-10 h-10 rounded-full bg-gradient-to-tr from-pink-500 to-violet-500 shrink-0">
                            </div>
                            <div class="space-y-2 text-left flex-1">
                                <div class="h-2 w-24 bg-white/20 rounded"></div>
                                <div class="h-2 w-16 bg-white/10 rounded"></div>
                            </div>
                        </div>
                        <div class="space-y-3 mb-4">
                            <div class="h-2 w-full bg-white/5 rounded"></div>
                            <div class="h-2 w-full bg-white/5 rounded"></div>
                            <div class="h-2 w-3/4 bg-white/5 rounded"></div>
                        </div>
                        <div class="grid grid-cols-3 gap-2.5">
                            @foreach([['#db2777', 'bg-pink-500/20 border-pink-500/20'], ['bg-white/5 border-white/10', 'bg-white/5 border-white/10'], ['bg-white/5 border-white/10', 'bg-white/5 border-white/10']] as $c)
                                <div
                                    class="h-14 rounded-xl border p-2.5 {{ $loop->first ? 'bg-pink-500/20 border-pink-500/20' : 'bg-white/5 border-white/10' }}">
                                    <div
                                        class="h-1.5 w-8 rounded mb-1.5 {{ $loop->first ? 'bg-pink-500/40' : 'bg-white/20' }}">
                                    </div>
                                    <div class="h-4 w-10 rounded {{ $loop->first ? 'bg-white' : 'bg-white/60' }}"></div>
                                </div>
                            @endforeach
                        </div>
                        <div
                            class="absolute -bottom-8 left-1/2 -translate-x-1/2 w-44 h-20 rounded-full pointer-events-none bg-pink-600/25 blur-3xl">
                        </div>
                    </div>
                </div>

            </div>
        </div>

        <div
            class="w-full lg:w-[550px] shrink-0 bg-[#0E0E13] border-l border-white/5 flex items-center justify-center px-8 lg:px-16 relative z-20 overflow-y-auto">

            <div class="absolute top-0 left-0 w-0.5 h-full bg-gradient-to-b from-pink-600 via-pink-400 to-transparent">
            </div>

            <div class="w-full max-w-sm py-12">

                <div class="mb-7 text-center animate-fade-up" style="animation-delay:.05s;">
                    <h2 class="text-3xl font-display font-bold text-white tracking-tight">Criar sua conta</h2>
                    <p class="text-slate-500 mt-2 text-sm">Preencha os campos para começar sua experiência.</p>
                </div>

                <form id="registerForm" class="space-y-4 animate-fade-up" style="animation-delay:.1s;" novalidate>

                    <div>
                        <label class="block text-xs font-bold text-slate-400 uppercase tracking-widest mb-2">Nome
                            Completo</label>
                        <input id="name" type="text" placeholder="Seu nome completo" autocomplete="name"
                            class="input-field w-full bg-[#16161D] border border-white/5 rounded-xl px-4 py-3 text-sm text-white placeholder:text-slate-600 outline-none focus:border-pink-500 focus:ring-1 focus:ring-pink-500/30 transition-all">
                        <p id="error-name" class="error-text hidden mt-1 text-xs text-pink-500"></p>
                    </div>

                    <div>
                        <label
                            class="block text-xs font-bold text-slate-400 uppercase tracking-widest mb-2">E-mail</label>
                        <input id="email" type="email" placeholder="nome@exemplo.com" autocomplete="email"
                            class="input-field w-full bg-[#16161D] border border-white/5 rounded-xl px-4 py-3 text-sm text-white placeholder:text-slate-600 outline-none focus:border-pink-500 focus:ring-1 focus:ring-pink-500/30 transition-all">
                        <p id="error-email" class="error-text hidden mt-1 text-xs text-pink-500"></p>
                    </div>

                    <div>
                        <label
                            class="block text-xs font-bold text-slate-400 uppercase tracking-widest mb-2">Senha</label>
                        <div class="relative">
                            <input id="passwordInput" type="password" placeholder="Crie uma senha forte"
                                autocomplete="new-password"
                                class="input-field w-full bg-[#16161D] border border-white/5 rounded-xl px-4 py-3 pr-11 text-sm text-white placeholder:text-slate-600 outline-none focus:border-pink-500 focus:ring-1 focus:ring-pink-500/30 transition-all">
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
                        <p id="error-password" class="error-text hidden mt-1 text-xs text-pink-500"></p>

                        <div class="mt-3 grid grid-cols-1 sm:grid-cols-2 gap-2">
                            <div id="req-length"
                                class="flex items-center gap-2 text-[10px] text-slate-500 transition-colors">
                                <div class="w-1.5 h-1.5 rounded-full bg-current shrink-0"></div>Mínimo 8 caracteres
                            </div>
                            <div id="req-upper"
                                class="flex items-center gap-2 text-[10px] text-slate-500 transition-colors">
                                <div class="w-1.5 h-1.5 rounded-full bg-current shrink-0"></div>Uma letra maiúscula
                            </div>
                            <div id="req-lower"
                                class="flex items-center gap-2 text-[10px] text-slate-500 transition-colors">
                                <div class="w-1.5 h-1.5 rounded-full bg-current shrink-0"></div>Uma letra minúscula
                            </div>
                            <div id="req-number"
                                class="flex items-center gap-2 text-[10px] text-slate-500 transition-colors">
                                <div class="w-1.5 h-1.5 rounded-full bg-current shrink-0"></div>Números (0-9)
                            </div>
                            <div id="req-special"
                                class="flex items-center gap-2 text-[10px] text-slate-500 transition-colors">
                                <div class="w-1.5 h-1.5 rounded-full bg-current shrink-0"></div>Caractere especial (@,
                                #, $)
                            </div>
                        </div>
                    </div>

                    <label class="flex items-start gap-3 cursor-pointer group pt-1">
                        <input type="checkbox" class="hidden peer">
                        <div
                            class="mt-0.5 w-5 h-5 border-2 border-white/10 rounded-md peer-checked:bg-pink-600 peer-checked:border-pink-600 transition-all flex items-center justify-center shrink-0">
                            <svg class="w-3 h-3 text-white scale-0 peer-checked:scale-100 transition-transform"
                                fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="4">
                                <path d="M5 13l4 4L19 7" stroke-linecap="round" stroke-linejoin="round" />
                            </svg>
                        </div>
                        <span
                            class="text-xs text-slate-500 leading-relaxed group-hover:text-slate-300 transition-colors">
                            Eu li e aceito os <a href="#" class="text-pink-500 hover:underline">Termos de Uso</a> e a <a
                                href="#" class="text-pink-500 hover:underline">Política de Privacidade</a>.
                        </span>
                    </label>

                    <button type="submit" id="submitBtn"
                        class="animate-pulse-pink w-full bg-pink-600 hover:bg-pink-500 text-white font-bold py-4 rounded-xl transition-all hover:-translate-y-0.5 active:scale-95 flex items-center justify-center gap-2 mt-2 font-display disabled:opacity-50">
                        <span id="btnLabel">Criar minha conta</span>
                        <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5">
                            <path d="M14 5l7 7m0 0l-7 7m7-7H3" stroke-linecap="round" stroke-linejoin="round" />
                        </svg>
                    </button>

                </form>

                <div class="mt-8 pt-8 border-t border-white/5 animate-fade-up" style="animation-delay:.2s;">
                    <button
                        class="w-full bg-[#16161D] hover:bg-[#1C1C26] border border-white/5 text-white font-medium py-3 rounded-xl transition-all hover:-translate-y-0.5 flex items-center justify-center gap-3 text-sm">
                        <img src="https://www.svgrepo.com/show/475656/google-color.svg" class="w-5 h-5" alt="Google">
                        Cadastrar com Google
                    </button>
                </div>

                <p class="mt-8 text-center text-sm text-slate-500 animate-fade-up" style="animation-delay:.3s;">
                    Já possui uma conta?
                    <a href="/login" class="text-white font-bold hover:text-pink-500 transition-colors ml-0.5">Fazer
                        login</a>
                </p>

            </div>
        </div>
    </main>

    <script src="{{ asset('js/register.js') }}"></script>
    <script>
        (function () {
            const tog = document.getElementById('togglePwd'), pw = document.getElementById('passwordInput');
            const off = document.getElementById('eyeOff'), on = document.getElementById('eyeOn');
            if (!tog || !pw) return;
            tog.addEventListener('click', () => {
                const s = pw.type === 'password';
                pw.type = s ? 'text' : 'password';
                off.classList.toggle('hidden', s);
                on.classList.toggle('hidden', !s);
            });
        })();

        (function () {
            const pc = document.getElementById('particles');
            const style = document.createElement('style');
            style.textContent = '@keyframes ptUp{0%{transform:translateY(0);opacity:0}10%{opacity:1}90%{opacity:1}100%{transform:translateY(-100vh);opacity:0}}.pt{position:absolute;border-radius:50%;background:#db2777;animation:ptUp linear infinite}';
            document.head.appendChild(style);
            for (let i = 0; i < 24; i++) {
                const p = document.createElement('div');
                p.className = 'pt';
                const sz = 1.5 + Math.random() * 3;
                p.style.cssText = `width:${sz}px;height:${sz}px;left:${Math.random() * 100}%;bottom:-12px;opacity:${.15 + Math.random() * .45};animation-duration:${8 + Math.random() * 14}s;animation-delay:${Math.random() * 14}s`;
                pc.appendChild(p);
            }
        })();
    </script>
</body>

</html>