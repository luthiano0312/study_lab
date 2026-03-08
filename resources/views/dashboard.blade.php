@extends('layouts.app')

@section('content')
    <div class="min-h-full" style="font-family:'DM Sans',sans-serif;">

        {{-- Top bar --}}
        <div class="flex items-start justify-between mb-8">
            <div>
                <p class="text-xs font-bold tracking-widest uppercase text-pink-400 mb-1">Painel de Controle</p>
                <h1 class="text-4xl font-black text-gray-900 leading-tight" style="font-family:'Syne',sans-serif;">
                    Olá, <span id="greetName" class="text-pink-500">Estudante</span> 👋
                </h1>
                <p class="text-sm text-gray-400 mt-1 font-medium">
                    <span id="clock" class="text-pink-500 font-bold"></span>
                    &nbsp;·&nbsp; {{ now()->translatedFormat('l, d \d\e F') }}
                </p>
            </div>
        </div>

        <div class="relative rounded-3xl  mb-8 shadow-xl shadow-pink-100"
            style="background:linear-gradient(135deg,#db2777 0%,#f472b6 50%,#fda4af 100%); min-height:180px;">

            <div class="absolute inset-0 pointer-events-none"
                style="background-image:radial-gradient(circle,rgba(255,255,255,.12) 1.5px,transparent 1.5px);background-size:28px 28px;">
            </div>

            <div class="absolute -top-10 -right-10 w-64 h-64 rounded-full pointer-events-none"
                style="background:radial-gradient(circle,rgba(255,255,255,.15),transparent 70%);"></div>
            <div class="absolute -bottom-8 -left-8 w-48 h-48 rounded-full pointer-events-none"
                style="background:radial-gradient(circle,rgba(255,255,255,.1),transparent 70%);"></div>

            <div class=" z-10 px-10 py-8 flex items-center justify-between">

                <div class="text-white">
                    <p class="text-pink-100 text-sm font-semibold mb-1">StudyLab</p>

                    <h2 class="text-3xl font-black leading-tight" ">
                        Seu espaço de<br>aprendizado
                    </h2>

                    <p class="text-pink-100 text-sm mt-3 max-w-sm">
                        Gerencie matérias, atividades e provas num só lugar.
                    </p>
                </div>

                <img src="{{ asset('images/welcomeimage.png') }}"
                    class="absolute -right-10 -bottom-14 w-[400px] drop-shadow-[0_40px_80px_rgba(0,0,0,0.35)] pointer-events-none hidden md:block">

            </div>
        </div>

        <div class="grid grid-cols-2 md:grid-cols-5 gap-4 mb-8">

            <div
                class="bg-white rounded-2xl p-5 border border-pink-100 shadow-sm hover:-translate-y-0.5 transition-transform">
                <div class="flex items-center gap-3 mb-3">
                    <div class="w-9 h-9 rounded-xl bg-yellow-100 flex items-center justify-center text-lg"></div>
                    <p class="text-xs font-semibold text-gray-400 uppercase tracking-wide">Pendentes</p>
                </div>
                <p class="text-3xl font-black text-gray-900" id="statPending" data-counter>—</p>
            </div>

            <div
                class="bg-white rounded-2xl p-5 border border-green-100 shadow-sm hover:-translate-y-0.5 transition-transform">
                <div class="flex items-center gap-3 mb-3">
                    <div class="w-9 h-9 rounded-xl bg-green-100 flex items-center justify-center text-lg"></div>
                    <p class="text-xs font-semibold text-gray-400 uppercase tracking-wide">Concluídas</p>
                </div>
                <p class="text-3xl font-black text-gray-900" id="statDone" data-counter>—</p>
            </div>

            <div
                class="bg-white rounded-2xl p-5 border border-red-100 shadow-sm hover:-translate-y-0.5 transition-transform">
                <div class="flex items-center gap-3 mb-3">
                    <div class="w-9 h-9 rounded-xl bg-red-100 flex items-center justify-center text-lg"></div>
                    <p class="text-xs font-semibold text-gray-400 uppercase tracking-wide">Atrasadas</p>
                </div>
                <p class="text-3xl font-black text-gray-900" id="statOverdue" data-counter>—</p>
            </div>

            <div
                class="bg-white rounded-2xl p-5 border border-blue-100 shadow-sm hover:-translate-y-0.5 transition-transform">
                <div class="flex items-center gap-3 mb-3">
                    <div class="w-9 h-9 rounded-xl bg-blue-100 flex items-center justify-center text-lg"></div>
                    <p class="text-xs font-semibold text-gray-400 uppercase tracking-wide">Matérias</p>
                </div>
                <p class="text-3xl font-black text-gray-900" id="statSubjects" data-counter>—</p>
            </div>

            <div
                class="bg-white rounded-2xl p-5 border border-pink-100 shadow-sm hover:-translate-y-0.5 transition-transform">
                <div class="flex items-center gap-3 mb-3">
                    <div class="w-9 h-9 rounded-xl bg-pink-100 flex items-center justify-center text-lg"></div>
                    <p class="text-xs font-semibold text-gray-400 uppercase tracking-wide">Total</p>
                </div>
                <p class="text-3xl font-black text-gray-900" id="statTotal" data-counter>—</p>
            </div>

        </div>

        <div class="grid grid-cols-1 lg:grid-cols-3 gap-6 mb-6">

            <div class="lg:col-span-2 bg-white rounded-3xl border border-pink-100 shadow-sm overflow-hidden">
                <div class="h-1" style="background:linear-gradient(90deg,#db2777,#f472b6,#fda4af);"></div>
                <div class="px-6 py-5 flex items-center justify-between border-b border-gray-50">
                    <h3 class="font-black text-gray-900" style="font-family:'Syne',sans-serif;">Atividades recentes</h3>
                    <a href="/activities" class="text-xs font-bold text-pink-500 hover:text-pink-700 transition">Ver todas
                        →</a>
                </div>
                <div class="px-6 py-2" id="recentActivities">
                    @for ($i = 0; $i < 4; $i++)
                        <div class="flex items-center justify-between py-3 border-b border-gray-50 last:border-0">
                            <div class="flex items-center gap-3">
                                <div class="w-2 h-2 rounded-full bg-gray-200 animate-pulse"></div>
                                <div>
                                    <div class="h-3 w-40 bg-gray-100 rounded animate-pulse mb-1.5"></div>
                                    <div class="h-2 w-24 bg-gray-100 rounded animate-pulse"></div>
                                </div>
                            </div>
                            <div class="h-5 w-16 bg-gray-100 rounded-full animate-pulse"></div>
                        </div>
                    @endfor
                </div>
                <div class="px-6 pb-5 pt-3 flex justify-center">
                    <a href="/activities/create"
                        class="flex items-center gap-2 text-xs font-bold text-pink-500 hover:text-pink-700 border border-pink-200 hover:border-pink-400 px-4 py-2 rounded-xl transition">
                        <svg width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                            stroke-width="3" stroke-linecap="round" stroke-linejoin="round">
                            <line x1="12" y1="5" x2="12" y2="19" />
                            <line x1="5" y1="12" x2="19" y2="12" />
                        </svg>
                        Nova atividade
                    </a>
                </div>
            </div>

            <div class="bg-white rounded-3xl border border-pink-100 shadow-sm overflow-hidden">
                <div class="h-1" style="background:linear-gradient(90deg,#f472b6,#fda4af);"></div>
                <div class="px-6 py-5 flex items-center justify-between border-b border-gray-50">
                    <h3 class="font-black text-gray-900" style="font-family:'Syne',sans-serif;">Próximas provas</h3>
                    <a href="/exams" class="text-xs font-bold text-pink-500 hover:text-pink-700 transition">Ver todas
                        →</a>
                </div>
                <div class="px-6 py-2" id="upcomingExams">
                    @for ($i = 0; $i < 3; $i++)
                        <div class="flex items-center justify-between py-3 border-b border-gray-50 last:border-0">
                            <div>
                                <div class="h-3 w-28 bg-gray-100 rounded animate-pulse mb-1.5"></div>
                                <div class="h-2 w-20 bg-gray-100 rounded animate-pulse"></div>
                            </div>
                            <div class="h-3 w-16 bg-gray-100 rounded animate-pulse"></div>
                        </div>
                    @endfor
                </div>
                <div class="px-6 pb-5 pt-3 flex justify-center">
                    <a href="/exams/create"
                        class="flex items-center gap-2 text-xs font-bold text-pink-500 hover:text-pink-700 border border-pink-200 hover:border-pink-400 px-4 py-2 rounded-xl transition">
                        <svg width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                            stroke-width="3" stroke-linecap="round" stroke-linejoin="round">
                            <line x1="12" y1="5" x2="12" y2="19" />
                            <line x1="5" y1="12" x2="19" y2="12" />
                        </svg>
                        Cadastrar prova
                    </a>
                </div>
            </div>

        </div>

        <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">

            <div class="bg-white rounded-3xl border border-pink-100 shadow-sm overflow-hidden">
                <div class="h-1" style="background:linear-gradient(90deg,#db2777,#f472b6);"></div>
                <div class="px-6 py-5 flex items-center justify-between border-b border-gray-50">
                    <h3 class="font-black text-gray-900" style="font-family:'Syne',sans-serif;">Matérias</h3>
                    <a href="/subject" class="text-xs font-bold text-pink-500 hover:text-pink-700 transition">Ver todas
                        →</a>
                </div>
                <div class="px-6 py-2" id="subjectsList">
                    @for ($i = 0; $i < 4; $i++)
                        <div class="flex items-center gap-3 py-2.5 border-b border-gray-50 last:border-0">
                            <div class="w-8 h-8 rounded-lg bg-gray-100 animate-pulse flex-shrink-0"></div>
                            <div>
                                <div class="h-3 w-32 bg-gray-100 rounded animate-pulse mb-1.5"></div>
                                <div class="h-2 w-20 bg-gray-100 rounded animate-pulse"></div>
                            </div>
                        </div>
                    @endfor
                </div>
                <div class="px-6 pb-5 pt-3 flex justify-center">
                    <a href="/subject/create"
                        class="flex items-center gap-2 text-xs font-bold text-pink-500 hover:text-pink-700 border border-pink-200 hover:border-pink-400 px-4 py-2 rounded-xl transition">
                        <svg width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                            stroke-width="3" stroke-linecap="round" stroke-linejoin="round">
                            <line x1="12" y1="5" x2="12" y2="19" />
                            <line x1="5" y1="12" x2="19" y2="12" />
                        </svg>
                        Nova matéria
                    </a>
                </div>
            </div>

            <div class="bg-white rounded-3xl border border-pink-100 shadow-sm overflow-hidden">
                <div class="h-1" style="background:linear-gradient(90deg,#fda4af,#db2777);"></div>
                <div class="px-6 py-5 border-b border-gray-50">
                    <h3 class="font-black text-gray-900" style="font-family:'Syne',sans-serif;">Acesso rápido</h3>
                </div>
                <div class="p-4 grid grid-cols-2 gap-3">

                    <a href="/activities"
                        class="flex flex-col items-center gap-2 bg-pink-50 hover:bg-pink-100 border border-pink-100 rounded-2xl p-4 transition hover:-translate-y-0.5">
                        <span class="text-2xl">📋</span>
                        <span class="text-xs font-bold text-gray-700">Atividades</span>
                    </a>

                    <a href="/exams"
                        class="flex flex-col items-center gap-2 bg-pink-50 hover:bg-pink-100 border border-pink-100 rounded-2xl p-4 transition hover:-translate-y-0.5">
                        <span class="text-2xl">📝</span>
                        <span class="text-xs font-bold text-gray-700">Provas</span>
                    </a>

                    <a href="/subject"
                        class="flex flex-col items-center gap-2 bg-pink-50 hover:bg-pink-100 border border-pink-100 rounded-2xl p-4 transition hover:-translate-y-0.5">
                        <span class="text-2xl">📚</span>
                        <span class="text-xs font-bold text-gray-700">Matérias</span>
                    </a>

                    <a href="/horary"
                        class="flex flex-col items-center gap-2 bg-pink-50 hover:bg-pink-100 border border-pink-100 rounded-2xl p-4 transition hover:-translate-y-0.5">
                        <span class="text-2xl">🗓️</span>
                        <span class="text-xs font-bold text-gray-700">Horários</span>
                    </a>

                    <a href="/notes"
                        class="flex flex-col items-center gap-2 bg-pink-50 hover:bg-pink-100 border border-pink-100 rounded-2xl p-4 transition hover:-translate-y-0.5">
                        <span class="text-2xl">📒</span>
                        <span class="text-xs font-bold text-gray-700">Notas</span>
                    </a>

                    <a href="/profile"
                        class="flex flex-col items-center gap-2 bg-pink-50 hover:bg-pink-100 border border-pink-100 rounded-2xl p-4 transition hover:-translate-y-0.5">
                        <span class="text-2xl">👤</span>
                        <span class="text-xs font-bold text-gray-700">Perfil</span>
                    </a>

                </div>
            </div>

            <div class="rounded-3xl shadow-xl shadow-pink-200 overflow-hidden text-white relative"
                style="background:linear-gradient(135deg,#db2777 0%,#be185d 100%);">
                <div class="absolute inset-0 pointer-events-none"
                    style="background-image:radial-gradient(circle,rgba(255,255,255,.1) 1.5px,transparent 1.5px);background-size:24px 24px;">
                </div>
                <div class="absolute top-0 right-0 w-40 h-40 pointer-events-none"
                    style="background:radial-gradient(circle at 70% 30%,rgba(255,255,255,.18),transparent 70%);"></div>

                <div class="relative z-10 px-6 py-6">
                    <p class="text-pink-200 text-xs font-bold uppercase tracking-widest mb-4">Você sabia?</p>

                    <blockquote class="text-white font-bold text-lg leading-snug mb-6"
                        style="font-family:'Syne',sans-serif;">
                        "A educação é a arma mais poderosa que você pode usar para mudar o mundo."
                    </blockquote>

                    <p class="text-pink-200 text-xs">— Nelson Mandela</p>

                    <div class="mt-8 pt-6 border-t border-pink-400/40">
                        <p class="text-pink-100 text-xs font-semibold mb-2">Continue assim!</p>
                        <div class="w-full bg-pink-400/30 h-2.5 rounded-full overflow-hidden">
                            <div class="h-2.5 rounded-full bg-white" style="width:65%; transition:width 1s ease;"></div>
                        </div>
                        <p class="text-pink-200 text-xs mt-1.5">65% das metas da semana</p>
                    </div>
                </div>

                <img src="{{ asset('images/graficosimage.png') }}"
                    class="absolute -right-6 -bottom-6 w-40 opacity-20 pointer-events-none">
            </div>

        </div>

    </div>

    <script src="{{ asset('js/dashboard.js') }}"></script>
@endsection
