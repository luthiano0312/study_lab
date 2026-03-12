@php
$slides = [
    [
        'icon'  => '🎯',
        'title' => 'Mantenha o foco',
        'desc'  => 'Revise suas atividades pendentes e priorize o que importa hoje.',
        'href'  => '/activities',
        'cta'   => 'Ver atividades',
        'bg'    => 'from-pink-500 to-rose-400',
    ],
    [
        'icon'  => '📅',
        'title' => 'Provas chegando',
        'desc'  => 'Confira o calendário de provas e planeje seus estudos com antecedência.',
        'href'  => '/exams',
        'cta'   => 'Ver provas',
        'bg'    => 'from-fuchsia-500 to-pink-500',
    ],
    [
        'icon'  => '📚',
        'title' => 'Organize as matérias',
        'desc'  => 'Mantenha suas matérias atualizadas para não perder nenhum prazo.',
        'href'  => '/subject',
        'cta'   => 'Ver matérias',
        'bg'    => 'from-pink-600 to-fuchsia-500',
    ],
    [
        'icon'  => '✏️',
        'title' => 'Nova atividade',
        'desc'  => 'Registre tarefas rapidamente antes de esquecer.',
        'href'  => '/activities/create',
        'cta'   => 'Criar agora',
        'bg'    => 'from-rose-500 to-pink-400',
    ],
];
@endphp

<div class="relative" x-data="{ active: 0, total: {{ count($slides) }} }" x-init="setInterval(() => active = (active + 1) % total, 4000)">

    <div class="overflow-hidden rounded-2xl">
        <div class="flex transition-transform duration-500 ease-in-out"
             :style="`transform: translateX(-${active * 100}%)`">

            @foreach($slides as $slide)
            <div class="w-full flex-shrink-0">
                <div class="bg-gradient-to-r {{ $slide['bg'] }} rounded-2xl px-6 py-5 flex items-center justify-between gap-4 relative overflow-hidden">
                    <div class="absolute inset-0 opacity-10 pointer-events-none"
                         style="background-image:radial-gradient(circle,#fff 1px,transparent 1px);background-size:16px 16px;"></div>
                    <div class="relative z-10 flex items-center gap-4">
                        <span class="text-4xl">{{ $slide['icon'] }}</span>
                        <div>
                            <p class="text-white font-black text-base leading-tight"
                               style="font-family:'Syne',sans-serif;">{{ $slide['title'] }}</p>
                            <p class="text-white/70 text-xs mt-0.5 max-w-sm">{{ $slide['desc'] }}</p>
                        </div>
                    </div>
                    <a href="{{ $slide['href'] }}"
                       class="relative z-10 flex-shrink-0 bg-white/20 hover:bg-white/30 border border-white/30
                              text-white text-[11px] font-black uppercase tracking-wide
                              px-4 py-2 rounded-xl transition-all duration-200 whitespace-nowrap">
                        {{ $slide['cta'] }} →
                    </a>
                </div>
            </div>
            @endforeach

        </div>
    </div>

    <div class="flex items-center justify-center gap-1.5 mt-2.5">
        @foreach($slides as $i => $slide)
        <button @click="active = {{ $i }}"
                :class="active === {{ $i }} ? 'bg-pink-500 w-4' : 'bg-pink-200 w-1.5'"
                class="h-1.5 rounded-full transition-all duration-300">
        </button>
        @endforeach
    </div>

</div>