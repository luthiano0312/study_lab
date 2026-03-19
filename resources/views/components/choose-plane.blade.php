<style>
    @keyframes fadeInUp {
        from {
            opacity: 0;
            transform: translateY(20px);
        }

        to {
            opacity: 1;
            transform: translateY(0);
        }
    }

    .animate-card {
        opacity: 0;
        animation: fadeInUp 0.5s ease-out forwards;
    }

    .delay-1 {
        animation-delay: 0.1s;
    }

    .delay-2 {
        animation-delay: 0.2s;
    }

    .delay-3 {
        animation-delay: 0.3s;
    }
</style>

<div class="w-full flex items-stretch justify-center gap-4 mt-10 font-sans p-4">

    <div
        class="animate-card delay-1 w-72 rounded-2xl bg-[#0f0f11] border border-zinc-800 p-6 flex flex-col transition-all duration-300 hover:-translate-y-2 hover:border-zinc-700 cursor-default group">
        <h3 class="text-lg font-bold text-white group-hover:text-pink-500 transition-colors">Gratuito</h3>
        <p class="text-xs text-zinc-500 mt-0.5">Perfeito para começar</p>

        <div class="mt-5 flex items-baseline gap-1">
            <span class="text-3xl font-black text-white tracking-tighter">R$ 0</span>
            <span class="text-[10px] text-zinc-500 font-medium">para sempre</span>
        </div>

        <ul class="mt-6 space-y-3 flex-grow">
            <li class="flex items-center gap-2 text-[13px] text-zinc-400">
                <span class="text-pink-500 text-[10px]">✔</span> Até 3 matérias
            </li>
            <li class="flex items-center gap-2 text-[13px] text-zinc-400">
                <span class="text-pink-500 text-[10px]">✔</span> 5h de estudo/semana
            </li>
            <li class="flex items-center gap-2 text-[13px] text-zinc-400">
                <span class="text-pink-500 text-[10px]">✔</span> Flashcards básicos
            </li>
            <li class="flex items-center gap-2 text-[13px] text-zinc-400">
                <span class="text-pink-500 text-[10px]">✔</span> Dashboard simples
            </li>
        </ul>

        <button
            class="mt-8 w-full py-2.5 rounded-xl border border-pink-500/20 bg-pink-500/5 text-pink-500 font-bold text-xs hover:bg-pink-500 hover:text-white transition-all duration-300">
            Criar conta grátis
        </button>
    </div>

    <div
        class="animate-card delay-2 relative w-72 rounded-2xl bg-pink-600 p-7 flex flex-col shadow-[0_15px_40px_rgba(236,72,153,0.25)] transition-all duration-300 hover:-translate-y-3 hover:scale-[1.02] cursor-default">
        <div
            class="absolute -top-3 left-1/2 -translate-x-1/2 bg-[#0f0f11] border border-pink-400/30 px-3 py-1 rounded-full flex items-center gap-1.5 shadow-lg animate-pulse whitespace-nowrap">
            <span class="text-[10px] text-yellow-400">★</span>
            <span class="text-[9px] uppercase font-black text-white tracking-widest">Mais Popular</span>
        </div>

        <h3 class="text-lg font-bold text-white">Pro</h3>
        <p class="text-xs text-pink-100/80 mt-0.5">Para quem leva a sério</p>

        <div class="mt-5 flex items-baseline gap-1">
            <span class="text-4xl font-black text-white tracking-tighter">R$ 29</span>
            <span class="text-[10px] text-pink-100 font-bold">/mês</span>
        </div>

        <ul class="mt-6 space-y-3 flex-grow">
            <li class="flex items-center gap-2 text-[13px] text-white font-medium">
                <span class="bg-white/20 rounded-full p-0.5 text-[8px]">✔</span> Matérias ilimitadas
            </li>
            <li class="flex items-center gap-2 text-[13px] text-white font-medium">
                <span class="bg-white/20 rounded-full p-0.5 text-[8px]">✔</span> Horas ilimitadas
            </li>
            <li class="flex items-center gap-2 text-[13px] text-white font-medium">
                <span class="bg-white/20 rounded-full p-0.5 text-[8px]">✔</span> IA personalizada
            </li>
            <li class="flex items-center gap-2 text-[13px] text-white font-medium">
                <span class="bg-white/20 rounded-full p-0.5 text-[8px]">✔</span> Grupos de estudo
            </li>
            <li class="flex items-center gap-2 text-[13px] text-white font-medium">
                <span class="bg-white/20 rounded-full p-0.5 text-[8px]">✔</span> Análise avançada
            </li>
        </ul>

        <button
            class="mt-8 w-full py-3 rounded-xl bg-white text-pink-600 font-black text-xs shadow-md hover:bg-pink-50 transition-all duration-300 active:scale-95">
            Começar agora
        </button>
    </div>

    <div
        class="animate-card delay-3 w-72 rounded-2xl bg-[#0f0f11] border border-zinc-800 p-6 flex flex-col transition-all duration-300 hover:-translate-y-2 hover:border-zinc-700 cursor-default group">
        <h3 class="text-lg font-bold text-white group-hover:text-pink-500 transition-colors">Equipe</h3>
        <p class="text-xs text-zinc-500 mt-0.5">Para grupos e escolas</p>

        <div class="mt-5 flex items-baseline gap-1">
            <span class="text-3xl font-black text-white tracking-tighter">R$ 79</span>
            <span class="text-[10px] text-zinc-500 font-medium">/mês</span>
        </div>

        <ul class="mt-6 space-y-3 flex-grow">
            <li class="flex items-center gap-2 text-[13px] text-zinc-400">
                <span class="text-pink-500 text-[10px]">✔</span> Tudo do Pro
            </li>
            <li class="flex items-center gap-2 text-[13px] text-zinc-400">
                <span class="text-pink-500 text-[10px]">✔</span> Até 10 membros
            </li>
            <li class="flex items-center gap-2 text-[13px] text-zinc-400">
                <span class="text-pink-500 text-[10px]">✔</span> Dashboard do grupo
            </li>
            <li class="flex items-center gap-2 text-[13px] text-zinc-400">
                <span class="text-pink-500 text-[10px]">✔</span> Suporte prioritário
            </li>
        </ul>

        <button
            class="mt-8 w-full py-2.5 rounded-xl border border-zinc-800 bg-transparent text-zinc-400 font-bold text-xs hover:bg-zinc-800 hover:text-white transition-all duration-300">
            Falar com vendas
        </button>
    </div>

</div>