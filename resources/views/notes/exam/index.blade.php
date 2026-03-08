@extends('layouts.app')

@section('content')



<div class="min-h-screen relative h-full w-full overflow-hidden bg-[#fdf4f8]" style="font-family:'Inter',sans-serif;">

    <div class="absolute inset-0 pointer-events-none" style="background-image:radial-gradient(circle,#f9a8d4 1.5px,transparent 1.5px);background-size:32px 32px;opacity:.35;"></div>
    <div class="absolute -top-24 -right-24 w-96 h-96 rounded-full pointer-events-none" style="background:radial-gradient(circle at 40% 40%,#f9a8d4 0%,#fce7f3 60%,transparent 80%);opacity:.6;"></div>
    <div class="absolute -bottom-16 -left-16 w-64 h-64 rounded-full pointer-events-none" style="background:radial-gradient(circle at 60% 60%,#fbcfe8 0%,transparent 70%);opacity:.5;"></div>

    <div class="absolute top-16 left-10 float-a pointer-events-none opacity-70">
        <svg width="44" height="44" viewBox="0 0 44 44" fill="none">
            <rect x="4" y="4" width="36" height="36" rx="8" fill="#fce7f3" stroke="#f9a8d4" stroke-width="2"/>
            <path d="M14 22h16M22 14v16" stroke="#db2777" stroke-width="2.5" stroke-linecap="round"/>
        </svg>
    </div>
    <div class="absolute top-32 right-12 float-b pointer-events-none opacity-75">
        <svg width="80" height="56" viewBox="0 0 80 56" fill="none">
            <rect x="0" y="8" width="80" height="40" rx="8" fill="#db2777" opacity=".15"/>
            <rect x="8" y="16" width="44" height="6" rx="3" fill="#db2777" opacity=".4"/>
            <rect x="8" y="26" width="30" height="6" rx="3" fill="#db2777" opacity=".25"/>
            <rect x="8" y="36" width="20" height="4" rx="2" fill="#db2777" opacity=".2"/>
        </svg>
    </div>
    <div class="absolute bottom-28 right-20 float-c pointer-events-none opacity-60">
        <svg width="56" height="56" viewBox="0 0 56 56" fill="none">
            <circle cx="28" cy="28" r="24" stroke="#f9a8d4" stroke-width="3" stroke-dasharray="10 6"/>
        </svg>
    </div>
    <div class="absolute top-40 left-1/3 float-a pointer-events-none" style="animation-delay:.8s">
        <svg width="22" height="22" viewBox="0 0 22 22" fill="none">
            <path d="M11 2 L12.5 8.5 L19 11 L12.5 13.5 L11 20 L9.5 13.5 L3 11 L9.5 8.5 Z" fill="#f472b6" opacity=".7"/>
        </svg>
    </div>
    <div class="absolute bottom-40 left-40 spin-slow pointer-events-none opacity-20">
        <svg width="80" height="80" viewBox="0 0 80 80" fill="none">
            <circle cx="40" cy="40" r="35" stroke="#db2777" stroke-width="5" stroke-dasharray="12 7"/>
        </svg>
    </div>

    <div class="relative z-10 max-w-5xl mx-auto px-6 py-10">

        <div class="flex items-end justify-between mb-8 fade-up">
            <div>
                <p class="text-xs font-extrabold tracking-widest uppercase text-pink-400 mb-1">Provas & Avaliações</p>
                <h1 class="text-4xl font-black text-gray-900 leading-tight">Minhas Provas</h1>
                <p class="text-sm text-gray-400 font-semibold mt-1">Acompanhe e gerencie suas provas cadastradas</p>
            </div>
            <a href="{{ route('exam.create') }}"
                class="flex items-center gap-2 bg-pink-600 text-white text-sm font-extrabold px-5 py-3 rounded-2xl shadow-lg shadow-pink-200 transition-all hover:-translate-y-0.5 hover:shadow-xl hover:shadow-pink-300">
                <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="3" stroke-linecap="round" stroke-linejoin="round">
                    <line x1="12" y1="5" x2="12" y2="19"/><line x1="5" y1="12" x2="19" y2="12"/>
                </svg>
                Adicionar prova
            </a>
        </div>

        <div class="flex gap-3 mb-6 flex-wrap fade-up" style="animation-delay:.1s">
            <div class="bg-white/80 backdrop-blur-sm rounded-2xl px-5 py-3 shadow-sm border border-pink-100 flex items-center gap-3">
                <div class="w-9 h-9 rounded-xl bg-pink-100 flex items-center justify-center text-lg"></div>
                <div>
                    <p class="text-xs text-gray-400 font-semibold">Total de provas</p>
                    <p class="text-xl font-black text-gray-900" id="totalCount">—</p>
                </div>
            </div>
            <div class="bg-white/80 backdrop-blur-sm rounded-2xl px-5 py-3 shadow-sm border border-pink-100 flex items-center gap-3">
                <div class="w-9 h-9 rounded-xl bg-red-100 flex items-center justify-center text-lg"></div>
                <div>
                    <p class="text-xs text-gray-400 font-semibold">Dificeis</p>
                    <p class="text-xl font-black text-gray-900" id="pendingCount">—</p>
                </div>
            </div>
            <div class="bg-white/80 backdrop-blur-sm rounded-2xl px-5 py-3 shadow-sm border border-pink-100 flex items-center gap-3">
                <div class="w-9 h-9 rounded-xl bg-green-100 flex items-center justify-center text-lg"></div>
                <div>
                    <p class="text-xs text-gray-400 font-semibold">Faceis</p>
                    <p class="text-xl font-black text-gray-900" id="progressCount">—</p>
                </div>
            </div>
            <div class="bg-white/80 backdrop-blur-sm rounded-2xl px-5 py-3 shadow-sm border border-pink-100 flex items-center gap-3">
                <div class="w-9 h-9 rounded-xl bg-yellow-100 flex items-center justify-center text-lg"></div>
                <div>
                    <p class="text-xs text-gray-400 font-semibold">Medias</p>
                    <p class="text-xl font-black text-gray-900" id="completedCount">—</p>
                </div>
            </div>
        </div>

        <div class="bg-white/90 backdrop-blur-sm rounded-3xl shadow-xl shadow-pink-100 overflow-hidden border border-pink-100 fade-up" style="animation-delay:.2s">
            <div class="h-1.5 w-full" style="background:linear-gradient(90deg,#db2777 0%,#f472b6 50%,rgb(254,140,248) 100%);"></div>

            <table class="w-full border-collapse">
                <thead>
                    <tr class="border-b border-gray-100">
                        <th class="px-6 py-4 text-center text-xs font-extrabold uppercase tracking-wider text-gray-400">Tipo</th>
                        <th class="px-4 py-4 text-center text-xs font-extrabold uppercase tracking-wider text-gray-400">Descrição</th>
                        <th class="px-4 py-4 text-center text-xs font-extrabold uppercase tracking-wider text-gray-400">Data</th>
                        <th class="px-4 py-4 text-center text-xs font-extrabold uppercase tracking-wider text-gray-400">Status</th>
                        <th class="px-4 py-4 text-center text-xs font-extrabold uppercase tracking-wider text-gray-400">Ações</th>
                    </tr>
                </thead>
                <tbody id="examsTable">
                    @for ($i = 0; $i < 4; $i++)
                    <tr class="border-b border-gray-50">
                        <td class="px-6 py-4"><div class="skel" style="width:60%;"></div></td>
                        <td class="px-4 py-4"><div class="skel" style="width:75%;"></div></td>
                        <td class="px-4 py-4"><div class="skel" style="width:80px;"></div></td>
                        <td class="px-4 py-4"><div class="skel" style="width:90px;height:22px;border-radius:999px;"></div></td>
                        <td class="px-4 py-4"><div class="skel" style="width:100px;height:28px;border-radius:10px;margin:0 auto;"></div></td>
                    </tr>
                    @endfor
                </tbody>
            </table>

            <div class="px-6 py-3 bg-pink-50/50 border-t border-pink-100 flex items-center justify-between">
                <p class="text-xs text-gray-400 font-semibold">StudyLab • Provas</p>
                <div class="flex gap-1">
                    <span class="w-2 h-2 rounded-full bg-pink-300 inline-block"></span>
                    <span class="w-2 h-2 rounded-full bg-pink-200 inline-block"></span>
                    <span class="w-2 h-2 rounded-full bg-pink-100 inline-block"></span>
                </div>
            </div>
        </div>

    </div>
</div>

<div id="deleteModal" class="fixed inset-0 bg-black/35 backdrop-blur-sm items-center justify-center z-50" style="display:none;">
    <div class="bg-white rounded-2xl p-8 max-w-sm w-[90%] shadow-2xl">
        <div class="w-12 h-12 rounded-2xl bg-red-50 flex items-center justify-center mb-4">
            <svg width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="#ef4444" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                <polyline points="3 6 5 6 21 6"/>
                <path d="M19 6l-1 14H6L5 6"/>
                <path d="M10 11v6M14 11v6"/>
                <path d="M9 6V4h6v2"/>
            </svg>
        </div>
        <h3 class="text-lg font-bold text-gray-900 mb-1">Excluir prova</h3>
        <p class="text-sm text-gray-500 mb-6">Tem certeza? Essa ação não pode ser desfeita.</p>
        <div class="flex gap-2.5 justify-end">
            <button id="cancelDelete" class="border border-gray-200 hover:border-gray-300 text-gray-600 font-semibold text-sm px-4 py-2 rounded-xl transition-colors">Cancelar</button>
            <button id="confirmDelete" class="bg-red-500 hover:bg-red-600 text-white font-bold text-sm px-5 py-2 rounded-xl transition-colors">Sim, excluir</button>
        </div>
    </div>
</div>

<div id="toast" class="fixed bottom-6 right-6 items-center gap-3 bg-white border border-gray-100 border-l-4 border-l-pink-500 rounded-xl shadow-lg px-5 py-3.5 z-50" style="display:none;">
    <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="#db2777" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round">
        <polyline points="20 6 9 17 4 12"/>
    </svg>
    <div>
        <p class="text-gray-800 font-bold text-sm" id="toastMsg">Prova excluída!</p>
        <p class="text-gray-400 text-xs">Atualizado com sucesso.</p>
    </div>
</div>

<script src="{{ asset('js/exam.js') }}"></script>
@endsection