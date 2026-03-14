@extends('layouts.app')

@section('content')
    <div class="min-h-screen relative overflow-hidden bg-[#fdf4f8]" style="font-family:'DM Sans',sans-serif;">
        <div class="absolute inset-0 pointer-events-none"
            style="background-image:radial-gradient(circle,#f9a8d4 1.5px,transparent 1.5px);background-size:32px 32px;opacity:.35;">
        </div>
        <div class="absolute -top-24 -right-24 w-96 h-96 rounded-full pointer-events-none"
            style="background:radial-gradient(circle at 40% 40%,#f9a8d4 0%,#fce7f3 60%,transparent 80%);opacity:.6;"></div>
        <div class="absolute -bottom-16 -left-16 w-64 h-64 rounded-full pointer-events-none"
            style="background:radial-gradient(circle at 60% 60%,#fbcfe8 0%,transparent 70%);opacity:.5;"></div>
        <div class="absolute top-16 left-10 float-a pointer-events-none opacity-60"><svg width="32" height="32"
                viewBox="0 0 32 32" fill="none">
                <rect x="3" y="3" width="26" height="26" rx="5" fill="#fce7f3" stroke="#f9a8d4"
                    stroke-width="1.5" />
                <path d="M8 12h16M8 17h10M8 22h7" stroke="#db2777" stroke-width="2" stroke-linecap="round" />
            </svg></div>
        <div class="absolute top-32 right-12 float-b pointer-events-none opacity-70"><svg width="52" height="44"
                viewBox="0 0 52 44" fill="none">
                <rect x="0" y="6" width="52" height="18" rx="5" fill="#db2777" opacity=".85" />
                <rect x="0" y="6" width="8" height="18" rx="4" fill="#be185d" />
                <rect x="11" y="11" width="20" height="3" rx="2" fill="#fce7f3" opacity=".6" />
                <rect x="4" y="28" width="48" height="14" rx="5" fill="#fbbf24" opacity=".8" />
                <rect x="4" y="28" width="8" height="14" rx="4" fill="#d97706" />
                <rect x="15" y="33" width="16" height="2.5" rx="2" fill="#fff" opacity=".5" />
            </svg></div>
        <div class="absolute top-44 left-1/3 float-c pointer-events-none" style="animation-delay:.6s"><svg width="18"
                height="18" viewBox="0 0 18 18" fill="none">
                <path d="M9 1L10.6 6.8L16 9L10.6 11.2L9 17L7.4 11.2L2 9L7.4 6.8Z" fill="#f472b6" opacity=".55" />
            </svg></div>
        <div class="absolute bottom-48 left-1/4 float-b pointer-events-none" style="animation-delay:1.2s"><svg
                width="20" height="20" viewBox="0 0 20 20" fill="none">
                <path d="M10 1L11.5 7.5L18 9L11.5 10.5L10 17L8.5 10.5L2 9L8.5 7.5Z" fill="#db2777" opacity=".5" />
            </svg></div>
        <div class="absolute bottom-40 left-40 spin-slow pointer-events-none opacity-20"><svg width="90" height="90"
                viewBox="0 0 90 90" fill="none">
                <circle cx="45" cy="45" r="40" stroke="#db2777" stroke-width="6" stroke-dasharray="14 8" />
            </svg></div>
        <div class="absolute top-20 right-1/3 w-5 h-5 rounded-full bg-pink-300 opacity-40 float-a pointer-events-none"
            style="animation-delay:.6s"></div>
        <div class="absolute top-80 left-20 w-8 h-8 rounded-full bg-yellow-300 opacity-35 float-b pointer-events-none">
        </div>
        <div class="absolute bottom-36 right-1/4 w-6 h-6 rounded-full bg-pink-400 opacity-30 float-c pointer-events-none">
        </div>

        <div class="relative z-10 max-w-5xl mx-auto px-6 py-10">
            <div class="flex flex-wrap items-end justify-between gap-4 mb-8 fade-up">
                <div>
                    <p class="text-[10px] font-black tracking-widest uppercase text-pink-400 mb-1">📝 Painel acadêmico</p>
                    <h1 class="text-4xl font-black text-gray-900 leading-tight" style="font-family:'Syne',sans-serif;">Meus
                        Conteúdos</h1>
                    <p class="text-sm text-gray-400 font-semibold mt-1">Organize os conteúdos das suas matérias</p>
                </div>
                <a href="{{ route('content.create') }}"
                    class="flex items-center gap-2 bg-pink-600 hover:bg-pink-700 text-white text-sm font-black px-5 py-3 rounded-2xl shadow-lg shadow-pink-200 transition-all hover:-translate-y-0.5">
                    <svg width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                        stroke-width="3" stroke-linecap="round">
                        <line x1="12" y1="5" x2="12" y2="19" />
                        <line x1="5" y1="12" x2="19" y2="12" />
                    </svg>
                    Adicionar conteúdo
                </a>
            </div>

            <div class="flex flex-wrap gap-3 mb-6 fade-up" style="animation-delay:.1s">
                <div
                    class="bg-white/80 backdrop-blur-sm rounded-2xl px-5 py-3 shadow-sm border border-pink-100 flex items-center gap-3">
                    <div class="w-9 h-9 rounded-xl bg-pink-100 flex items-center justify-center shrink-0">
                        <svg class="w-5 h-5 text-pink-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path d="M14 2H6a2 2 0 00-2 2v16a2 2 0 002 2h12a2 2 0 002-2V8z" stroke-width="2" />
                            <polyline points="14 2 14 8 20 8" stroke-width="2" />
                        </svg>
                    </div>
                    <div>
                        <p class="text-[10px] text-gray-400 font-bold uppercase tracking-wider">Total de conteúdos</p>
                        <p class="text-xl font-black text-gray-900 leading-none" id="totalCount"
                            style="font-family:'Syne',sans-serif;">—</p>
                    </div>
                </div>
                <div
                    class="bg-white/80 backdrop-blur-sm rounded-2xl px-5 py-3 shadow-sm border border-pink-100 flex items-center gap-3">
                    <div class="w-9 h-9 rounded-xl bg-purple-100 flex items-center justify-center shrink-0">
                        <svg class="w-5 h-5 text-purple-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path d="M4 19.5A2.5 2.5 0 016.5 17H20" stroke-width="2" stroke-linecap="round" />
                            <path d="M6.5 2H20v20H6.5A2.5 2.5 0 014 19.5v-15A2.5 2.5 0 016.5 2z" stroke-width="2" />
                        </svg>
                    </div>
                    <div>
                        <p class="text-[10px] text-gray-400 font-bold uppercase tracking-wider">Matérias</p>
                        <p class="text-xl font-black text-gray-900 leading-none" id="subjectCount"
                            style="font-family:'Syne',sans-serif;">—</p>
                    </div>
                </div>
            </div>

            <div class="bg-white/90 backdrop-blur-sm rounded-3xl shadow-xl shadow-pink-100 overflow-hidden border border-pink-100 fade-up"
                style="animation-delay:.2s">
                <div class="h-1.5 w-full" style="background:linear-gradient(90deg,#db2777 0%,#f472b6 50%,#fda4af 100%);">
                </div>
                <table class="w-full border-collapse">
                    <thead>
                        <tr class="border-b border-gray-100">
                            <th
                                class="px-6 py-4 text-center text-[11px] font-black uppercase tracking-wider text-gray-400">
                                Nome</th>
                            <th
                                class="px-4 py-4 text-center text-[11px] font-black uppercase tracking-wider text-gray-400">
                                Matéria</th>
                            <th
                                class="px-4 py-4 text-center text-[11px] font-black uppercase tracking-wider text-gray-400">
                                Professor</th>
                            <th
                                class="px-4 py-4 text-center text-[11px] font-black uppercase tracking-wider text-gray-400">
                                Semestre</th>
                            <th
                                class="px-4 py-4 text-center text-[11px] font-black uppercase tracking-wider text-gray-400">
                                Ações</th>
                        </tr>
                    </thead>
                    <tbody id="contentsTable">
                        @for ($i = 0; $i < 4; $i++)
                            <tr class="border-b border-gray-50">
                                <td class="px-6 py-4">
                                    <div class="skel" style="width:65%;"></div>
                                </td>
                                <td class="px-4 py-4">
                                    <div class="skel" style="width:80px;height:22px;border-radius:20px;"></div>
                                </td>
                                <td class="px-4 py-4">
                                    <div class="flex items-center gap-3">
                                        <div class="w-8 h-8 rounded-full bg-pink-100 shrink-0"></div>
                                        <div class="skel" style="width:55%;height:14px;"></div>
                                    </div>
                                </td>
                                <td class="px-4 py-4">
                                    <div class="skel" style="width:70px;height:22px;border-radius:20px;"></div>
                                </td>
                                <td class="px-4 py-4">
                                    <div class="skel" style="width:100px;height:28px;border-radius:10px;margin:0 auto;">
                                    </div>
                                </td>
                            </tr>
                        @endfor
                    </tbody>
                </table>
                <div class="px-6 py-3 bg-pink-50/50 border-t border-pink-100 flex items-center justify-between">
                    <p class="text-[10px] text-gray-400 font-semibold">StudyLab • Conteúdos</p>
                    <div class="flex gap-1">
                        <span class="w-2 h-2 rounded-full bg-pink-300 inline-block"></span>
                        <span class="w-2 h-2 rounded-full bg-pink-200 inline-block"></span>
                        <span class="w-2 h-2 rounded-full bg-pink-100 inline-block"></span>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div id="deleteModal" class="fixed inset-0 bg-black/30 backdrop-blur-sm z-50 flex items-center justify-center p-4"
        style="display:none;">
        <div class="bg-white rounded-2xl shadow-2xl w-full max-w-sm overflow-hidden">
            <div class="h-1 bg-gradient-to-r from-red-500 to-rose-400"></div>
            <div class="p-6 text-center">
                <div class="w-14 h-14 rounded-2xl bg-red-50 flex items-center justify-center mx-auto mb-4">
                    <svg class="w-7 h-7 text-red-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <polyline points="3 6 5 6 21 6" stroke-width="2" stroke-linecap="round" />
                        <path d="M19 6l-1 14H6L5 6" stroke-width="2" stroke-linecap="round" />
                        <path d="M9 6V4h6v2" stroke-width="2" stroke-linecap="round" />
                    </svg>
                </div>
                <h3 class="text-base font-black text-gray-900 mb-1" style="font-family:'Syne',sans-serif;">Excluir
                    conteúdo?</h3>
                <p class="text-sm text-gray-400 mb-5">Esta ação não pode ser desfeita.</p>
                <div class="flex gap-2 justify-center">
                    <button id="cancelDelete"
                        class="border border-gray-200 hover:bg-gray-50 text-gray-600 font-bold text-sm px-5 py-2.5 rounded-xl transition-colors">Cancelar</button>
                    <button id="confirmDelete"
                        class="bg-red-500 hover:bg-red-600 text-white font-black text-sm px-5 py-2.5 rounded-xl transition-colors shadow-sm shadow-red-200">Sim,
                        excluir</button>
                </div>
            </div>
        </div>
    </div>

    <div id="toast"
        class="fixed bottom-6 right-6 flex items-center gap-3 bg-white border border-gray-100 border-l-4 border-l-pink-500 rounded-xl shadow-lg px-5 py-3.5 z-50"
        style="display:none;">
        <svg width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="#db2777" stroke-width="2.5"
            stroke-linecap="round">
            <path d="M20 6L9 17l-5-5" />
        </svg>
        <p class="text-gray-800 font-bold text-sm" id="toastMsg">Pronto!</p>
    </div>

    <script src="{{ asset('js/content.js') }}"></script>
@endsection
