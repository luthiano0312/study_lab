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
        <div class="absolute top-32 right-12 float-b pointer-events-none opacity-65"><svg width="52" height="44"
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
        <div class="absolute top-72 right-1/3 float-c pointer-events-none" style="animation-delay:.3s"><svg width="16"
                height="16" viewBox="0 0 16 16" fill="none">
                <path d="M8 0L9 6L15 8L9 10L8 16L7 10L1 8L7 6Z" fill="#fbbf24" opacity=".65" />
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
                    <p class="text-[10px] font-black tracking-widest uppercase text-pink-400 mb-1">Provas & Avaliações</p>
                    <h1 class="font-black text-gray-900 leading-tight text-4xl" style="font-family:'Syne',sans-serif;">
                        Calendário de Provas</h1>
                    <p class="text-sm text-gray-400 font-semibold mt-1">Visualize, adicione e edite suas provas semana a
                        semana</p>
                </div>
            </div>

            <div class="flex flex-wrap gap-3 mb-6 fade-up" style="animation-delay:.1s">
                <div
                    class="bg-white/80 backdrop-blur-sm rounded-2xl px-4 py-3 shadow-sm border border-pink-100 flex items-center gap-3">
                    <div class="w-8 h-8 rounded-xl bg-pink-100 flex items-center justify-center shrink-0">
                        <svg class="w-4 h-4 text-pink-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <rect x="3" y="4" width="18" height="18" rx="2" stroke-width="2" />
                            <path d="M16 2v4M8 2v4M3 10h18" stroke-width="2" stroke-linecap="round" />
                        </svg>
                    </div>
                    <div>
                        <p class="text-[10px] font-bold text-gray-400 uppercase tracking-wider">Total</p>
                        <p class="text-lg font-black text-gray-900 leading-none" id="statTotal"
                            style="font-family:'Syne',sans-serif;">—</p>
                    </div>
                </div>
                <div
                    class="bg-white/80 backdrop-blur-sm rounded-2xl px-4 py-3 shadow-sm border border-pink-100 flex items-center gap-3">
                    <div class="w-8 h-8 rounded-xl bg-orange-100 flex items-center justify-center shrink-0">
                        <svg class="w-4 h-4 text-orange-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <circle cx="12" cy="12" r="10" stroke-width="2" />
                            <path d="M12 6v6l4 2" stroke-width="2" stroke-linecap="round" />
                        </svg>
                    </div>
                    <div>
                        <p class="text-[10px] font-bold text-gray-400 uppercase tracking-wider">Pendentes</p>
                        <p class="text-lg font-black text-gray-900 leading-none" id="statPending"
                            style="font-family:'Syne',sans-serif;">—</p>
                    </div>
                </div>
                <div
                    class="bg-white/80 backdrop-blur-sm rounded-2xl px-4 py-3 shadow-sm border border-pink-100 flex items-center gap-3">
                    <div class="w-8 h-8 rounded-xl bg-blue-100 flex items-center justify-center shrink-0">
                        <svg class="w-4 h-4 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path d="M13 2L3 14h9l-1 8 10-12h-9l1-8z" stroke-width="2" stroke-linecap="round"
                                stroke-linejoin="round" />
                        </svg>
                    </div>
                    <div>
                        <p class="text-[10px] font-bold text-gray-400 uppercase tracking-wider">Andamento</p>
                        <p class="text-lg font-black text-gray-900 leading-none" id="statProgress"
                            style="font-family:'Syne',sans-serif;">—</p>
                    </div>
                </div>
                <div
                    class="bg-white/80 backdrop-blur-sm rounded-2xl px-4 py-3 shadow-sm border border-pink-100 flex items-center gap-3">
                    <div class="w-8 h-8 rounded-xl bg-green-100 flex items-center justify-center shrink-0">
                        <svg class="w-4 h-4 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path d="M20 6L9 17l-5-5" stroke-width="2.5" stroke-linecap="round"
                                stroke-linejoin="round" />
                        </svg>
                    </div>
                    <div>
                        <p class="text-[10px] font-bold text-gray-400 uppercase tracking-wider">Concluídas</p>
                        <p class="text-lg font-black text-gray-900 leading-none" id="statDone"
                            style="font-family:'Syne',sans-serif;">—</p>
                    </div>
                </div>
            </div>

            <div class="bg-white/90 backdrop-blur-sm rounded-3xl shadow-xl shadow-pink-100 overflow-hidden border border-pink-100 fade-up"
                style="animation-delay:.2s">
                <div class="h-1.5 w-full" style="background:linear-gradient(90deg,#db2777 0%,#f472b6 50%,#fda4af 100%);">
                </div>

                <div class="px-6 pt-5 pb-3 flex items-center justify-between border-b border-pink-50">
                    <div class="flex items-center gap-3">
                        <button id="prevWeek"
                            class="w-9 h-9 rounded-xl bg-pink-50 hover:bg-pink-100 flex items-center justify-center text-pink-600 transition-colors cursor-pointer">
                            <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                stroke-width="3" stroke-linecap="round">
                                <path d="M15 18l-6-6 6-6" />
                            </svg>
                        </button>
                        <span id="weekLabel" class="text-sm font-black text-gray-800"
                            style="font-family:'Syne',sans-serif;"></span>
                        <button id="nextWeek"
                            class="w-9 h-9 rounded-xl bg-pink-50 hover:bg-pink-100 flex items-center justify-center text-pink-600 transition-colors cursor-pointer">
                            <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                stroke-width="3" stroke-linecap="round">
                                <path d="M9 18l6-6-6-6" />
                            </svg>
                        </button>
                    </div>
                    <button id="todayBtn"
                        class="text-[11px] font-black uppercase tracking-wider text-pink-600 bg-pink-50 hover:bg-pink-100 px-4 py-1.5 rounded-xl transition-colors cursor-pointer">Hoje</button>
                </div>

                <div class="overflow-x-auto">
                    <table class="w-full border-collapse" style="table-layout:fixed;">
                        <thead>
                            <tr id="calHead"></tr>
                        </thead>
                        <tbody>
                            <tr id="calBody"></tr>
                        </tbody>
                    </table>
                </div>

                <div class="px-6 py-3 bg-pink-50/50 border-t border-pink-100 flex items-center justify-between">
                    <p class="text-[10px] font-bold text-gray-400 uppercase tracking-wider">StudyLab • Calendário de Provas
                    </p>
                    <span class="text-[10px] font-semibold text-gray-400">Clique em + para adicionar</span>
                </div>
            </div>

        </div>
    </div>

    <div id="examModal" class="fixed inset-0 bg-black/30 backdrop-blur-sm z-50 flex items-center justify-center p-4"
        style="display:none;">
        <div class="bg-white rounded-2xl shadow-2xl w-full max-w-md overflow-hidden">
            <div class="h-1 bg-gradient-to-r from-pink-600 to-pink-400"></div>
            <div class="p-6">

                <div class="flex items-center justify-between mb-5">
                    <h2 id="modalTitle" class="text-base font-black text-gray-900"
                        style="font-family:'Syne',sans-serif;">Nova prova</h2>
                    <button id="modalClose"
                        class="w-8 h-8 rounded-xl bg-gray-100 hover:bg-gray-200 flex items-center justify-center text-gray-500 transition-colors cursor-pointer">
                        <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                            stroke-width="3" stroke-linecap="round">
                            <path d="M18 6L6 18M6 6l12 12" />
                        </svg>
                    </button>
                </div>

                <div class="mb-4 bg-pink-50 rounded-xl px-4 py-2.5 flex items-center gap-2.5">
                    <svg class="w-4 h-4 text-pink-500 shrink-0" fill="none" stroke="currentColor"
                        viewBox="0 0 24 24">
                        <rect x="3" y="4" width="18" height="18" rx="2" stroke-width="2" />
                        <path d="M16 2v4M8 2v4M3 10h18" stroke-width="2" stroke-linecap="round" />
                    </svg>
                    <span id="modalDateLabel" class="text-sm font-black text-pink-700"
                        style="font-family:'Syne',sans-serif;"></span>
                    <input type="hidden" id="modalDate">
                    <input type="hidden" id="modalExamId">
                </div>

                <div class="mb-4">
                    <label class="block text-[11px] font-black uppercase tracking-widest text-gray-500 mb-1.5">Tipo de
                        prova</label>
                    <select id="modalType"
                        class="w-full border border-gray-200 rounded-xl px-3 py-2.5 text-sm font-semibold text-gray-800 bg-gray-50 focus:outline-none focus:border-pink-400 focus:bg-white transition-colors appearance-none"
                        style="background-image:url(\"data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='12' height='12' viewBox='0 0 24 24' fill='none' stroke='%2394a3b8' stroke-width='2.5' stroke-linecap='round' stroke-linejoin='round'%3E%3Cpolyline points='6 9 12 15 18 9'/%3E%3C/svg%3E\");background-repeat:no-repeat;background-position:right 12px center;padding-right:2.2rem;">
                        <optgroup label="Avaliações">
                            <option value="Prova">Prova</option>
                            <option value="Prova Final">Prova Final</option>
                            <option value="Simulado">Simulado</option>
                            <option value="Recuperação">Recuperação</option>
                        </optgroup>
                    </select>
                    <p id="errType" class="hidden text-[11px] text-red-500 mt-1">Selecione o tipo.</p>
                </div>

                <div class="mb-4 hidden" id="typeCustomWrap">
                    <label class="block text-[11px] font-black uppercase tracking-widest text-gray-500 mb-1.5">Tipo
                        personalizado</label>
                    <input id="typeCustom" type="text"
                        class="w-full border border-gray-200 rounded-xl px-3 py-2.5 text-sm font-semibold text-gray-800 bg-gray-50 focus:outline-none focus:border-pink-400 focus:bg-white transition-colors"
                        placeholder="Ex: EXAT, Simulado Humanas...">
                </div>

                <div class="mb-4">
                    <label
                        class="block text-[11px] font-black uppercase tracking-widest text-gray-500 mb-1.5">Matéria</label>
                    <select id="modalDesc"
                        class="w-full border border-gray-200 rounded-xl px-3 py-2.5 text-sm font-semibold text-gray-800 bg-gray-50 focus:outline-none focus:border-pink-400 focus:bg-white transition-colors appearance-none"
                        style="background-image:url(\"data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='12' height='12' viewBox='0 0 24 24' fill='none' stroke='%2394a3b8' stroke-width='2.5' stroke-linecap='round' stroke-linejoin='round'%3E%3Cpolyline points='6 9 12 15 18 9'/%3E%3C/svg%3E\");background-repeat:no-repeat;background-position:right 12px center;padding-right:2.2rem;">
                        <option value="" disabled selected>Selecione uma matéria...</option>
                        <option value="__outro__">Digitar manualmente...</option>
                    </select>
                    <input id="descCustom" type="text"
                        class="hidden w-full mt-2 border border-gray-200 rounded-xl px-3 py-2.5 text-sm font-semibold text-gray-800 bg-gray-50 focus:outline-none focus:border-pink-400 focus:bg-white transition-colors"
                        placeholder="Ex: Cálculo I, Linguagens...">
                    <p id="errDesc" class="hidden text-[11px] text-red-500 mt-1">Selecione ou informe a matéria.</p>
                </div>

                <div class="mb-4">
                    <label class="block text-[11px] font-black uppercase tracking-widest text-gray-500 mb-1.5">Horário
                        <span class="text-gray-400 font-semibold normal-case">(opcional)</span></label>
                    <input id="modalTime" type="text"
                        class="w-full border border-gray-200 rounded-xl px-3 py-2.5 text-sm font-semibold text-gray-800 bg-gray-50 focus:outline-none focus:border-pink-400 focus:bg-white transition-colors"
                        placeholder="Ex: 08:00 - 10:00" maxlength="13">
                </div>

                <div class="mb-5">
                    <label class="block text-[11px] font-black uppercase tracking-widest text-gray-500 mb-2">Status</label>
                    <div class="flex gap-2">
                        <label id="lblPending"
                            class="flex-1 flex items-center justify-center gap-1 py-2 rounded-xl border-2 cursor-pointer text-[11px] font-black uppercase tracking-wider transition-all border-orange-200 bg-orange-50 text-orange-700">
                            <input type="radio" name="modalStatus" value="pending" class="sr-only" checked>
                            ⏳ Pendente
                        </label>
                        <label id="lblProgress"
                            class="flex-1 flex items-center justify-center gap-1 py-2 rounded-xl border-2 cursor-pointer text-[11px] font-black uppercase tracking-wider transition-all border-gray-200 bg-gray-50 text-gray-400">
                            <input type="radio" name="modalStatus" value="in_progress" class="sr-only">
                            🔄 Andamento
                        </label>
                        <label id="lblDone"
                            class="flex-1 flex items-center justify-center gap-1 py-2 rounded-xl border-2 cursor-pointer text-[11px] font-black uppercase tracking-wider transition-all border-gray-200 bg-gray-50 text-gray-400">
                            <input type="radio" name="modalStatus" value="completed" class="sr-only">
                            ✅ Concluída
                        </label>
                    </div>
                </div>

                <div class="flex items-center gap-2">
                    <button id="modalDelete"
                        class="hidden items-center gap-1.5 text-red-500 border border-red-200 hover:bg-red-50 text-[11px] font-black px-4 py-2.5 rounded-xl transition-all cursor-pointer">
                        <svg width="13" height="13" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                            stroke-width="2.5" stroke-linecap="round">
                            <polyline points="3 6 5 6 21 6" />
                            <path d="M19 6l-1 14H6L5 6" />
                            <path d="M9 6V4h6v2" />
                        </svg>
                        Excluir
                    </button>
                    <div class="flex-1"></div>
                    <button id="modalCancel"
                        class="text-gray-500 border border-gray-200 hover:border-gray-300 hover:bg-gray-50 text-[11px] font-black px-4 py-2.5 rounded-xl transition-colors cursor-pointer">Cancelar</button>
                    <button id="modalSave"
                        class="flex items-center gap-1.5 bg-pink-600 hover:bg-pink-700 disabled:opacity-60 text-white text-[11px] font-black px-5 py-2.5 rounded-xl transition-all shadow-sm cursor-pointer">
                        <svg width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                            stroke-width="3" stroke-linecap="round">
                            <path d="M20 6L9 17l-5-5" />
                        </svg>
                        <span id="modalSaveLabel">Salvar prova</span>
                    </button>
                </div>

            </div>
        </div>
    </div>

    <div id="toast"
        class="fixed bottom-6 right-6 flex items-center gap-3 bg-white border border-gray-100 border-l-4 border-l-pink-500 rounded-xl shadow-lg px-5 py-3.5 z-50"
        style="display:none;">
        <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="#db2777" stroke-width="2.5"
            stroke-linecap="round">
            <path d="M20 6L9 17l-5-5" />
        </svg>
        <p class="text-gray-800 font-bold text-sm" id="toastMsg">Pronto!</p>
    </div>

    <script src="{{ asset('js/exam.js') }}"></script>
@endsection
