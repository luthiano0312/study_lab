@extends('layouts.app')

@section('content')
    <div class="min-h-screen relative overflow-hidden bg-[#f4f7fd] dark:bg-[#121212] transition-colors duration-200">

        <div class="absolute inset-0 pointer-events-none"
            style="background-image:radial-gradient(circle,#a5b4fc 1.5px,transparent 1.5px);background-size:32px 32px;opacity:.25;">
        </div>
        <div class="absolute -top-24 -right-24 w-96 h-96 rounded-full pointer-events-none"
            style="background:radial-gradient(circle at 40% 40%,#818cf8 0%,#e0e7ff 60%,transparent 80%);opacity:.5;"></div>
        <div class="absolute -bottom-16 -left-16 w-64 h-64 rounded-full pointer-events-none"
            style="background:radial-gradient(circle at 60% 60%,#c7d2fe 0%,transparent 70%);opacity:.4;"></div>

        <div class="relative z-10 max-w-5xl mx-auto px-6 py-10">

            <div class="flex items-end justify-between mb-8">
                <div>
                    <p class="text-xs font-extrabold tracking-widest uppercase text-pink-400 mb-1">StudyLab</p>
                    <h1 class="text-4xl font-black text-gray-900 dark:text-gray-100 leading-tight">Trabalhos</h1>
                    <p class="text-sm text-gray-400 font-semibold mt-1">Gerencie seus trabalhos e prazos</p>
                </div>
                <a href="/works/create"
                    class="flex items-center gap-2 bg-pink-600 hover:bg-pink-700 text-white text-sm font-extrabold px-5 py-3 rounded-2xl shadow-lg shadow-pink-200 dark:shadow-pink-900/30 transition-all hover:-translate-y-0.5">
                    <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                        stroke-width="3" stroke-linecap="round" stroke-linejoin="round">
                        <line x1="12" y1="5" x2="12" y2="19" />
                        <line x1="5" y1="12" x2="19" y2="12" />
                    </svg>
                    Novo trabalho
                </a>
            </div>

            {{-- Stats Cards --}}
            <div class="flex flex-wrap gap-3 mb-6">
                <div class="bg-white/80 dark:bg-[#18181b]/80 backdrop-blur-sm rounded-2xl px-5 py-3 shadow-sm border border-pink-100 dark:border-gray-800 flex items-center gap-3">
                    <div class="w-9 h-9 rounded-xl bg-pink-100 dark:bg-pink-900/30 flex items-center justify-center">
                        <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="#818cf8" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"/><polyline points="14 2 14 8 20 8"/></svg>
                    </div>
                    <div>
                        <p class="text-xs text-gray-400 font-semibold">Total</p>
                        <p class="text-xl font-black text-gray-900 dark:text-gray-100" id="totalCount">—</p>
                    </div>
                </div>
                <div class="bg-white/80 dark:bg-[#18181b]/80 backdrop-blur-sm rounded-2xl px-5 py-3 shadow-sm border border-pink-100 dark:border-gray-800 flex items-center gap-3">
                    <div class="w-9 h-9 rounded-xl bg-yellow-100 dark:bg-yellow-900/30 flex items-center justify-center">
                        <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="#f59e0b" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><circle cx="12" cy="12" r="10"/><polyline points="12 6 12 12 16 14"/></svg>
                    </div>
                    <div>
                        <p class="text-xs text-gray-400 font-semibold">Pendentes</p>
                        <p class="text-xl font-black text-gray-900 dark:text-gray-100" id="pendingCount">—</p>
                    </div>
                </div>
                <div class="bg-white/80 dark:bg-[#18181b]/80 backdrop-blur-sm rounded-2xl px-5 py-3 shadow-sm border border-pink-100 dark:border-gray-800 flex items-center gap-3">
                    <div class="w-9 h-9 rounded-xl bg-blue-100 dark:bg-blue-900/30 flex items-center justify-center">
                        <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="#3b82f6" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><polyline points="23 4 23 10 17 10"/><path d="M20.49 15a9 9 0 1 1-.08-9.24"/></svg>
                    </div>
                    <div>
                        <p class="text-xs text-gray-400 font-semibold">Em andamento</p>
                        <p class="text-xl font-black text-gray-900 dark:text-gray-100" id="progressCount">—</p>
                    </div>
                </div>
                <div class="bg-white/80 dark:bg-[#18181b]/80 backdrop-blur-sm rounded-2xl px-5 py-3 shadow-sm border border-pink-100 dark:border-gray-800 flex items-center gap-3">
                    <div class="w-9 h-9 rounded-xl bg-green-100 dark:bg-green-900/30 flex items-center justify-center">
                        <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="#22c55e" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><polyline points="20 6 9 17 4 12"/></svg>
                    </div>
                    <div>
                        <p class="text-xs text-gray-400 font-semibold">Concluídos</p>
                        <p class="text-xl font-black text-gray-900 dark:text-gray-100" id="completedCount">—</p>
                    </div>
                </div>
            </div>

            {{-- Table --}}
            <div class="bg-white/90 dark:bg-[#18181b]/95 backdrop-blur-sm rounded-3xl shadow-xl shadow-pink-100 dark:shadow-none overflow-hidden border border-pink-100 dark:border-gray-800 transition-colors duration-200">
                <div class="h-1.5 w-full"
                    style="background:linear-gradient(90deg,#DB2777 0%,#DB2777 50%,#DB2777 100%);"></div>
                <table class="w-full border-collapse">
                    <thead>
                        <tr class="border-b border-gray-100 dark:border-gray-800">
                            <th class="px-6 py-4 text-left   text-xs font-extrabold uppercase tracking-wider text-gray-400">Tipo</th>
                            <th class="px-4 py-4 text-left   text-xs font-extrabold uppercase tracking-wider text-gray-400">Descrição</th>
                            <th class="px-4 py-4 text-center text-xs font-extrabold uppercase tracking-wider text-gray-400">Vencimento</th>
                            <th class="px-4 py-4 text-center text-xs font-extrabold uppercase tracking-wider text-gray-400">Status</th>
                            <th class="px-4 py-4 text-center text-xs font-extrabold uppercase tracking-wider text-gray-400">Ações</th>
                        </tr>
                    </thead>
                    <tbody id="examsTable">
                        @for ($i = 0; $i < 4; $i++)
                            <tr class="border-b border-gray-50 dark:border-gray-800/60">
                                <td class="px-6 py-4"><div class="skel dark:bg-gray-800" style="width:80px;"></div></td>
                                <td class="px-4 py-4"><div class="skel dark:bg-gray-800" style="width:60%;"></div></td>
                                <td class="px-4 py-4"><div class="skel dark:bg-gray-800" style="width:80px;margin:0 auto;"></div></td>
                                <td class="px-4 py-4"><div class="skel dark:bg-gray-800" style="width:90px;height:22px;border-radius:20px;margin:0 auto;"></div></td>
                                <td class="px-4 py-4"><div class="skel dark:bg-gray-800" style="width:110px;height:28px;border-radius:10px;margin:0 auto;"></div></td>
                            </tr>
                        @endfor
                    </tbody>
                </table>
                <div class="px-6 py-3 bg-pink-50/50 dark:bg-gray-800/50 border-t border-pink-100 dark:border-gray-800 flex items-center justify-between">
                    <p class="text-xs text-gray-400 font-semibold">StudyLab • Trabalhos</p>
                    <div class="flex gap-1">
                        <span class="w-2 h-2 rounded-full bg-pink-300 inline-block"></span>
                        <span class="w-2 h-2 rounded-full bg-pink-200 inline-block"></span>
                        <span class="w-2 h-2 rounded-full bg-pink-100 inline-block"></span>
                    </div>
                </div>
            </div>

        </div>
    </div>

    {{-- Delete Modal --}}
    <div class="hidden z-50 fixed inset-0 bg-black/35 backdrop-blur-sm items-center justify-center flex" id="deleteModal">
        <div class="bg-white dark:bg-[#18181b] rounded-2xl p-8 max-w-sm w-[90%] shadow-2xl border border-transparent dark:border-gray-800">
            <div class="w-12 h-12 rounded-2xl bg-red-50 dark:bg-red-900/20 flex items-center justify-center mb-4">
                <svg width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="#ef4444" stroke-width="2"
                    stroke-linecap="round" stroke-linejoin="round">
                    <polyline points="3 6 5 6 21 6"/>
                    <path d="M19 6l-1 14H6L5 6"/>
                    <path d="M10 11v6M14 11v6"/>
                    <path d="M9 6V4h6v2"/>
                </svg>
            </div>
            <h3 class="text-lg font-bold text-gray-900 dark:text-gray-100 mb-1">Excluir trabalho</h3>
            <p class="text-sm text-gray-500 dark:text-gray-400 mb-6">Tem certeza? Essa ação não pode ser desfeita.</p>
            <div class="flex gap-2.5 justify-end">
                <button id="cancelDelete"
                    class="border border-gray-200 dark:border-gray-700 hover:border-gray-300 dark:hover:border-gray-600 hover:bg-gray-50 dark:hover:bg-gray-800 text-gray-600 dark:text-gray-300 font-semibold text-sm px-4 py-2 rounded-xl transition-colors">Cancelar</button>
                <button id="confirmDelete"
                    class="bg-red-500 hover:bg-red-600 text-white font-bold text-sm px-5 py-2 rounded-xl transition-colors">Sim, excluir</button>
            </div>
        </div>
    </div>

    {{-- Toast --}}
    <div class="hidden fixed bottom-6 right-6 bg-white dark:bg-[#18181b] border border-gray-200 dark:border-gray-800 border-l-[3px] border-l-pink-600 rounded-xl shadow-xl px-5 py-3.5 flex items-center gap-3 z-50"
        id="toast">
        <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="#4338ca" stroke-width="2.5"
            stroke-linecap="round" stroke-linejoin="round">
            <polyline points="20 6 9 17 4 12"/>
        </svg>
        <div>
            <p class="text-gray-800 dark:text-gray-100 font-bold text-sm">Trabalho excluído!</p>
            <p class="text-gray-400 text-xs">Lista atualizada.</p>
        </div>
    </div>

    <style>
        .skel {
            height: 14px;
            border-radius: 6px;
            background: #DB2777;
            animation: shimmer 1.4s infinite;
            background: linear-gradient(90deg, #DB2777 25%, #e2e8f0 50%, #DB2777 75%);
            background-size: 200% 100%;
        }
        @keyframes shimmer {
            0% { background-position: 200% 0; }
            100% { background-position: -200% 0; }
        }
    </style>

    <script src="{{ asset('js/work.js') }}"></script>
@endsection