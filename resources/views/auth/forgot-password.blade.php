<!DOCTYPE html>
<html lang="pt-BR" class="h-full">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Recuperar Senha | StudyLab</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        @keyframes fadeUp {
            from {
                opacity: 0;
                transform: translateY(20px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .fade-up {
            animation: fadeUp 0.6s cubic-bezier(0.16, 1, 0.3, 1) both;
        }

        body {
            font-family: 'Inter', sans-serif;
        }

        .font-syne {
            font-family: 'Syne', sans-serif;
        }

        /* Efeito de brilho no fundo */
        .glow {
            position: absolute;
            width: 400px;
            height: 400px;
            background: radial-gradient(circle, rgba(219, 39, 119, 0.15) 0%, rgba(0, 0, 0, 0) 70%);
            border-radius: 50%;
            z-index: 0;
            pointer-events: none;
        }
    </style>
</head>

<body class="h-full bg-[#0B0B0F] text-slate-200 flex items-center justify-center overflow-hidden">

    <div class="glow" style="top: -100px; right: -100px;"></div>
    <div class="glow" style="bottom: -100px; left: -100px;"></div>

    <main class="relative z-10 w-full max-w-md px-6">

        <div class="bg-[#0E0E13] border border-white/5 rounded-3xl p-8 lg:p-12 shadow-2xl shadow-black/50 fade-up">

            <div class="text-center mb-8">
                <h2 class="text-3xl font-syne font-bold text-white tracking-tight">Esqueceu a senha?</h2>
                <p class="text-slate-500 mt-3 text-sm leading-relaxed">
                    Sem problemas. Informe seu e-mail e enviaremos um link mágico para você voltar ao fluxo.
                </p>
            </div>

            <form id="forgotForm" class="space-y-6">
                <div>
                    <label class="block text-xs font-bold text-slate-400 uppercase tracking-widest mb-2">
                        E-mail cadastrado
                    </label>
                    <input id="email" type="email" placeholder="seu@email.com"
                        class="w-full bg-[#16161D] border border-white/5 rounded-xl px-4 py-4 text-sm focus:outline-none focus:border-pink-500 focus:ring-1 focus:ring-pink-500 transition-all placeholder:text-slate-600 text-white"
                        required>
                </div>

                <button type="submit"
                    class="w-full bg-pink-600 hover:bg-pink-500 text-white font-bold py-4 rounded-xl shadow-lg shadow-pink-600/20 transition-all transform hover:-translate-y-0.5 active:scale-95 flex items-center justify-center gap-2">
                    <span>Enviar link de redefinição</span>
                    <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5">
                        <path d="M14 5l7 7m0 0l-7 7m7-7H3" />
                    </svg>
                </button>
            </form>

            <p id="message"
                class="text-green-400 text-sm mt-6 text-center hidden bg-green-400/10 py-3 rounded-lg border border-green-400/20">
            </p>
            <p id="error"
                class="text-red-400 text-sm mt-6 text-center hidden bg-red-400/10 py-3 rounded-lg border border-red-400/20">
            </p>

            <div class="mt-10 text-center">
                <a href="/login"
                    class="inline-flex items-center gap-2 text-sm text-slate-500 hover:text-white transition-colors group">
                    <svg class="w-4 h-4 transform group-hover:-translate-x-1 transition-transform" fill="none"
                        viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                        <path d="M10 19l-7-7m0 0l7-7m-7 7h18" />
                    </svg>
                    Voltar para o login
                </a>
            </div>
        </div>

        <p class="text-center text-slate-600 text-[10px] mt-8 uppercase tracking-[0.2em]">
            StudyLab &copy; 2026 • Inteligência em Produtividade
        </p>
    </main>

</body>

</html>