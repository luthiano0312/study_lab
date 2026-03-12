@extends('layouts.app')

@section('content')
<div class="min-h-full" style="font-family:'DM Sans',sans-serif;">

    {{-- ══ TOP BAR ══ --}}
    <div class="flex items-center justify-between mb-7">
        <div>
            <p class="text-[10px] font-black tracking-[.2em] uppercase text-pink-400 mb-0.5">Painel de Controle</p>
            <h1 class="text-3xl font-black text-gray-900 leading-tight" style="font-family:'Syne',sans-serif;">
                Olá, <span id="greetName" class="text-transparent bg-clip-text"
                    style="background-image:linear-gradient(135deg,#db2777,#f472b6);">Estudante</span>
            </h1>
            <p class="text-xs text-gray-400 mt-0.5 font-medium flex items-center gap-1.5">
                <span id="clock" class="font-black text-pink-500 tabular-nums"></span>
                <span class="text-gray-200">·</span>
                {{ now()->translatedFormat('l, d \d\e F') }}
            </p>
        </div>

        {{-- Avatar + nome --}}
        <div class="flex items-center gap-3 bg-white border border-gray-100 rounded-2xl px-4 py-2.5 shadow-sm">
            <div class="w-8 h-8 rounded-xl overflow-hidden bg-pink-100 flex-shrink-0">
                <img id="userAvatar" src="" alt="" class="w-full h-full object-cover hidden">
                <div id="avatarFallback" class="w-full h-full flex items-center justify-center">
                    <svg class="w-4 h-4 text-pink-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <circle cx="12" cy="8" r="4" stroke-width="2"/>
                        <path d="M4 20c0-4 3.6-7 8-7s8 3 8 7" stroke-width="2" stroke-linecap="round"/>
                    </svg>
                </div>
            </div>
            <div class="leading-tight">
                <p class="text-[11px] text-gray-400 font-medium">Bem-vindo</p>
                <p id="userName" class="text-[13px] font-black text-gray-800">Estudante</p>
            </div>
        </div>
    </div>

    {{-- ══ STAT CARDS ══ --}}
    <div class="grid grid-cols-2 md:grid-cols-5 gap-3 mb-6">

        @php
        $stats = [
            ['id'=>'statPending',  'label'=>'Pendentes',  'icon'=>'⏳', 'ring'=>'ring-yellow-200',  'bg'=>'bg-yellow-50',  'dot'=>'bg-yellow-400'],
            ['id'=>'statDone',     'label'=>'Concluídas', 'icon'=>'✅', 'ring'=>'ring-green-200',   'bg'=>'bg-green-50',   'dot'=>'bg-green-400'],
            ['id'=>'statOverdue',  'label'=>'Atrasadas',  'icon'=>'🚨', 'ring'=>'ring-red-200',     'bg'=>'bg-red-50',     'dot'=>'bg-red-400'],
            ['id'=>'statSubjects', 'label'=>'Matérias',   'icon'=>'📚', 'ring'=>'ring-blue-200',    'bg'=>'bg-blue-50',    'dot'=>'bg-blue-400'],
            ['id'=>'statTotal',    'label'=>'Total',      'icon'=>'📋', 'ring'=>'ring-pink-200',    'bg'=>'bg-pink-50',    'dot'=>'bg-pink-400'],
        ];
        @endphp

        @foreach($stats as $s)
        <div class="bg-white rounded-2xl p-4 ring-1 {{ $s['ring'] }} shadow-sm
                    hover:-translate-y-1 hover:shadow-md transition-all duration-200 group cursor-default">
            <div class="flex items-center justify-between mb-3">
                <span class="text-xl">{{ $s['icon'] }}</span>
                <span class="w-2 h-2 rounded-full {{ $s['dot'] }} group-hover:scale-125 transition-transform"></span>
            </div>
            <p class="text-2xl font-black text-gray-900 tabular-nums leading-none mb-1"
               id="{{ $s['id'] }}" data-counter>—</p>
            <p class="text-[10px] font-bold text-gray-400 uppercase tracking-widest">{{ $s['label'] }}</p>
        </div>
        @endforeach

    </div>

    {{-- ══ HERO BANNER ══ --}}
    <div class="relative rounded-3xl mb-6 overflow-hidden"
         style="background:linear-gradient(135deg,#9d174d 0%,#db2777 35%,#ec4899 65%,#f9a8d4 100%); min-height:160px;">

        {{-- dot grid --}}
        <div class="absolute inset-0 pointer-events-none opacity-10"
             style="background-image:radial-gradient(circle,#fff 1px,transparent 1px);background-size:22px 22px;"></div>

        {{-- glow blobs --}}
        <div class="absolute -top-8 -right-8 w-56 h-56 rounded-full pointer-events-none opacity-20"
             style="background:radial-gradient(circle,#fff,transparent 70%);"></div>
        <div class="absolute -bottom-10 left-10 w-40 h-40 rounded-full pointer-events-none opacity-10"
             style="background:radial-gradient(circle,#fff,transparent 70%);"></div>

        <div class="relative z-10 px-8 py-7 flex items-center justify-between">
            <div class="text-white max-w-sm">
                <p class="text-pink-200 text-[10px] font-black uppercase tracking-[.2em] mb-2">StudyLab Academy</p>
                <h2 class="text-2xl font-black leading-tight mb-2" style="font-family:'Syne',sans-serif;">
                    Seu espaço de<br>aprendizado
                </h2>
                <p class="text-pink-100 text-xs leading-relaxed">
                    Gerencie matérias, atividades e provas num só lugar.
                </p>
            </div>

            {{-- mini progress --}}
            <div class="hidden md:flex flex-col items-end gap-2">
                <p class="text-pink-200 text-[10px] font-bold uppercase tracking-widest">Metas da semana</p>
                <div class="w-40 bg-pink-400/30 h-2 rounded-full overflow-hidden">
                    <div class="h-2 rounded-full bg-white/80" style="width:65%;"></div>
                </div>
                <p class="text-white text-xs font-black">65%</p>
            </div>

            <img src="{{ asset('images/welcomeimage.png') }}"
                 class="absolute -right-8 -bottom-12 w-[340px] drop-shadow-2xl pointer-events-none hidden lg:block opacity-90">
        </div>
    </div>

    {{-- ══ MAIN GRID ══ --}}
    <div class="grid grid-cols-1 lg:grid-cols-3 gap-5 mb-5">

        {{-- Atividades recentes --}}
        <div class="lg:col-span-2 bg-white rounded-3xl ring-1 ring-gray-100 shadow-sm overflow-hidden">
            <div class="h-0.5 w-full" style="background:linear-gradient(90deg,#db2777,#f472b6,#fda4af);"></div>
            <div class="px-6 py-4 flex items-center justify-between border-b border-gray-50">
                <div class="flex items-center gap-2">
                    <span class="w-1.5 h-5 rounded-full bg-gradient-to-b from-pink-500 to-pink-300"></span>
                    <h3 class="font-black text-gray-900 text-sm" style="font-family:'Syne',sans-serif;">Atividades recentes</h3>
                </div>
                <a href="/activities"
                   class="text-[11px] font-bold text-pink-500 hover:text-pink-700 flex items-center gap-1 transition-colors">
                    Ver todas <span>→</span>
                </a>
            </div>
            <div class="px-6 py-1 divide-y divide-gray-50" id="recentActivities">
                @for($i=0;$i<4;$i++)
                <div class="flex items-center justify-between py-3">
                    <div class="flex items-center gap-3">
                        <div class="w-2 h-2 rounded-full bg-gray-200 animate-pulse flex-shrink-0"></div>
                        <div>
                            <div class="h-3 w-40 bg-gray-100 rounded-lg animate-pulse mb-1.5"></div>
                            <div class="h-2 w-24 bg-gray-100 rounded-lg animate-pulse"></div>
                        </div>
                    </div>
                    <div class="h-5 w-16 bg-gray-100 rounded-full animate-pulse"></div>
                </div>
                @endfor
            </div>
            <div class="px-6 py-4 flex justify-center border-t border-gray-50">
                <a href="/activities/create"
                   class="flex items-center gap-1.5 text-[11px] font-bold text-pink-500 hover:text-white
                          border border-pink-200 hover:border-pink-500 hover:bg-pink-500
                          px-4 py-2 rounded-xl transition-all duration-200">
                    <svg class="w-3 h-3" fill="none" stroke="currentColor" stroke-width="3" viewBox="0 0 24 24">
                        <line x1="12" y1="5" x2="12" y2="19"/><line x1="5" y1="12" x2="19" y2="12"/>
                    </svg>
                    Nova atividade
                </a>
            </div>
        </div>

        {{-- Próximas provas --}}
        <div class="bg-white rounded-3xl ring-1 ring-gray-100 shadow-sm overflow-hidden">
            <div class="h-0.5 w-full" style="background:linear-gradient(90deg,#f472b6,#fda4af);"></div>
            <div class="px-6 py-4 flex items-center justify-between border-b border-gray-50">
                <div class="flex items-center gap-2">
                    <span class="w-1.5 h-5 rounded-full bg-gradient-to-b from-pink-400 to-pink-200"></span>
                    <h3 class="font-black text-gray-900 text-sm" style="font-family:'Syne',sans-serif;">Próximas provas</h3>
                </div>
                <a href="/exams"
                   class="text-[11px] font-bold text-pink-500 hover:text-pink-700 flex items-center gap-1 transition-colors">
                    Ver todas <span>→</span>
                </a>
            </div>
            <div class="px-6 py-1 divide-y divide-gray-50" id="upcomingExams">
                @for($i=0;$i<3;$i++)
                <div class="flex items-center justify-between py-3">
                    <div>
                        <div class="h-3 w-28 bg-gray-100 rounded-lg animate-pulse mb-1.5"></div>
                        <div class="h-2 w-20 bg-gray-100 rounded-lg animate-pulse"></div>
                    </div>
                    <div class="h-3 w-16 bg-gray-100 rounded-lg animate-pulse"></div>
                </div>
                @endfor
            </div>
            <div class="px-6 py-4 flex justify-center border-t border-gray-50">
                <a href="/exams/create"
                   class="flex items-center gap-1.5 text-[11px] font-bold text-pink-500 hover:text-white
                          border border-pink-200 hover:border-pink-500 hover:bg-pink-500
                          px-4 py-2 rounded-xl transition-all duration-200">
                    <svg class="w-3 h-3" fill="none" stroke="currentColor" stroke-width="3" viewBox="0 0 24 24">
                        <line x1="12" y1="5" x2="12" y2="19"/><line x1="5" y1="12" x2="19" y2="12"/>
                    </svg>
                    Cadastrar prova
                </a>
            </div>
        </div>

    </div>

    {{-- ══ BOTTOM GRID ══ --}}
    <div class="grid grid-cols-1 lg:grid-cols-3 gap-5">

        {{-- Matérias --}}
        <div class="bg-white rounded-3xl ring-1 ring-gray-100 shadow-sm overflow-hidden">
            <div class="h-0.5 w-full" style="background:linear-gradient(90deg,#db2777,#f472b6);"></div>
            <div class="px-6 py-4 flex items-center justify-between border-b border-gray-50">
                <div class="flex items-center gap-2">
                    <span class="w-1.5 h-5 rounded-full bg-gradient-to-b from-pink-600 to-pink-400"></span>
                    <h3 class="font-black text-gray-900 text-sm" style="font-family:'Syne',sans-serif;">Matérias</h3>
                </div>
                <a href="/subject"
                   class="text-[11px] font-bold text-pink-500 hover:text-pink-700 flex items-center gap-1 transition-colors">
                    Ver todas <span>→</span>
                </a>
            </div>
            <div class="px-6 py-1 divide-y divide-gray-50" id="subjectsList">
                @for($i=0;$i<4;$i++)
                <div class="flex items-center gap-3 py-2.5">
                    <div class="w-8 h-8 rounded-xl bg-gray-100 animate-pulse flex-shrink-0"></div>
                    <div>
                        <div class="h-3 w-32 bg-gray-100 rounded-lg animate-pulse mb-1.5"></div>
                        <div class="h-2 w-20 bg-gray-100 rounded-lg animate-pulse"></div>
                    </div>
                </div>
                @endfor
            </div>
            <div class="px-6 py-4 flex justify-center border-t border-gray-50">
                <a href="/subject/create"
                   class="flex items-center gap-1.5 text-[11px] font-bold text-pink-500 hover:text-white
                          border border-pink-200 hover:border-pink-500 hover:bg-pink-500
                          px-4 py-2 rounded-xl transition-all duration-200">
                    <svg class="w-3 h-3" fill="none" stroke="currentColor" stroke-width="3" viewBox="0 0 24 24">
                        <line x1="12" y1="5" x2="12" y2="19"/><line x1="5" y1="12" x2="19" y2="12"/>
                    </svg>
                    Nova matéria
                </a>
            </div>
        </div>

        {{-- Acesso rápido --}}
        <div class="bg-white rounded-3xl ring-1 ring-gray-100 shadow-sm overflow-hidden">
            <div class="h-0.5 w-full" style="background:linear-gradient(90deg,#fda4af,#db2777);"></div>
            <div class="px-6 py-4 border-b border-gray-50 flex items-center gap-2">
                <span class="w-1.5 h-5 rounded-full bg-gradient-to-b from-pink-300 to-pink-500"></span>
                <h3 class="font-black text-gray-900 text-sm" style="font-family:'Syne',sans-serif;">Acesso rápido</h3>
            </div>
            <div class="p-4 grid grid-cols-3 gap-2.5">
                @php
                $quick = [
                    ['href'=>'/activities', 'icon'=>'📋', 'label'=>'Atividades'],
                    ['href'=>'/exams',      'icon'=>'📝', 'label'=>'Provas'],
                    ['href'=>'/subject',    'icon'=>'📚', 'label'=>'Matérias'],
                    ['href'=>'/horary',     'icon'=>'🗓️', 'label'=>'Horários'],
                    ['href'=>'/notes',      'icon'=>'📒', 'label'=>'Notas'],
                    ['href'=>'/profile',    'icon'=>'👤', 'label'=>'Perfil'],
                ];
                @endphp
                @foreach($quick as $q)
                <a href="{{ $q['href'] }}"
                   class="flex flex-col items-center gap-1.5 rounded-2xl p-3
                          bg-gray-50 hover:bg-pink-50 border border-transparent
                          hover:border-pink-200 hover:-translate-y-0.5
                          transition-all duration-200 group">
                    <span class="text-xl group-hover:scale-110 transition-transform duration-200">{{ $q['icon'] }}</span>
                    <span class="text-[10px] font-bold text-gray-500 group-hover:text-pink-600">{{ $q['label'] }}</span>
                </a>
                @endforeach
            </div>
        </div>

        {{-- Quote card --}}
        <div class="rounded-3xl overflow-hidden text-white relative shadow-xl shadow-pink-200/50"
             style="background:linear-gradient(145deg,#9d174d 0%,#db2777 50%,#ec4899 100%);">
            <div class="absolute inset-0 pointer-events-none opacity-10"
                 style="background-image:radial-gradient(circle,#fff 1px,transparent 1px);background-size:20px 20px;"></div>
            <div class="absolute -top-6 -right-6 w-36 h-36 rounded-full pointer-events-none opacity-15"
                 style="background:radial-gradient(circle,#fff,transparent 70%);"></div>

            <div class="relative z-10 px-6 py-6 flex flex-col h-full">
                <p class="text-pink-200 text-[10px] font-black uppercase tracking-[.2em] mb-4">Você sabia?</p>

                <blockquote class="text-white font-bold text-base leading-snug mb-4 flex-1"
                            style="font-family:'Syne',sans-serif;">
                    "A educação é a arma mais poderosa que você pode usar para mudar o mundo."
                </blockquote>

                <p class="text-pink-300 text-xs font-semibold mb-6">— Nelson Mandela</p>

                <div class="border-t border-pink-400/30 pt-4">
                    <div class="flex items-center justify-between mb-2">
                        <p class="text-pink-100 text-[11px] font-bold">Metas da semana</p>
                        <p class="text-white text-[11px] font-black">65%</p>
                    </div>
                    <div class="w-full bg-pink-400/25 h-2 rounded-full overflow-hidden">
                        <div class="h-2 rounded-full"
                             style="width:65%;background:linear-gradient(90deg,#fda4af,#fff);transition:width 1.2s ease;">
                        </div>
                    </div>
                    <p class="text-pink-200/70 text-[10px] mt-1.5">Continue assim! 🔥</p>
                </div>
            </div>
        </div>

    </div>

</div>

<script src="{{ asset('js/dashboard.js') }}"></script>
@endsection