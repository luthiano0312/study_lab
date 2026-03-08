@extends('layouts.app')

@section('content')

    <div class="min-h-screen relative h-full w-full   bg-[#fdf4f8]" style="font-family:'Inter',sans-serif;">

        <div class="absolute inset-0 pointer-events-none"
            style="background-image:radial-gradient(circle,#f9a8d4 1.5px,transparent 1.5px);background-size:32px 32px;opacity:.35;">
        </div>
        <div class="absolute -top-24 -right-24 w-96 h-96 rounded-full pointer-events-none"
            style="background:radial-gradient(circle at 40% 40%,#f9a8d4 0%,#fce7f3 60%,transparent 80%);opacity:.6;"></div>
        <div class="absolute -bottom-16 -left-16 w-64 h-64 rounded-full pointer-events-none"
            style="background:radial-gradient(circle at 60% 60%,#fbcfe8 0%,transparent 70%);opacity:.5;"></div>

        <div class="absolute top-16 left-10 float-a pointer-events-none opacity-60">
            <svg width="40" height="40" viewBox="0 0 40 40" fill="none">
                <rect x="4" y="4" width="32" height="32" rx="7" fill="#fce7f3" stroke="#f9a8d4"
                    stroke-width="2" />
                <path d="M12 20h16M20 12v16" stroke="#db2777" stroke-width="2.5" stroke-linecap="round" />
            </svg>
        </div>
        <div class="absolute top-32 right-12 float-b pointer-events-none opacity-60">
            <svg width="56" height="56" viewBox="0 0 56 56" fill="none">
                <circle cx="28" cy="28" r="24" stroke="#f9a8d4" stroke-width="3" stroke-dasharray="10 6" />
            </svg>
        </div>
        <div class="absolute bottom-40 left-40 spin-slow pointer-events-none opacity-20">
            <svg width="80" height="80" viewBox="0 0 80 80" fill="none">
                <circle cx="40" cy="40" r="35" stroke="#db2777" stroke-width="5" stroke-dasharray="12 7" />
            </svg>
        </div>
        <div class="absolute top-40 left-1/3 float-a pointer-events-none" style="animation-delay:.8s">
            <svg width="22" height="22" viewBox="0 0 22 22" fill="none">
                <path d="M11 2 L12.5 8.5 L19 11 L12.5 13.5 L11 20 L9.5 13.5 L3 11 L9.5 8.5 Z" fill="#f472b6"
                    opacity=".7" />
            </svg>
        </div>

        <div class="relative z-10 max-w-2xl mx-auto px-6 py-10">

            <div class="mb-8 fade-up">
                <a href="{{ route('exam.index') }}"
                    class="inline-flex items-center gap-1.5 text-pink-500 hover:text-pink-700 text-sm font-semibold mb-5 transition-colors">
                    <svg width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                        stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round">
                        <polyline points="15 18 9 12 15 6" />
                    </svg>
                    Voltar para provas
                </a>
                <p class="text-xs font-extrabold tracking-widest uppercase text-pink-400 mb-1">Nova prova</p>
                <h1 class="text-4xl font-black text-gray-900 leading-tight">Cadastrar Prova</h1>
                <p class="text-sm text-gray-400 font-semibold mt-1">Preencha os campos abaixo</p>
            </div>

            <div class="bg-white/90 backdrop-blur-sm rounded-3xl shadow-xl shadow-pink-100 overflow-hidden border border-pink-100 fade-up"
                style="animation-delay:.1s">
                <div class="h-1.5 w-full"
                    style="background:linear-gradient(90deg,#db2777 0%,#f472b6 50%,rgb(254,140,248) 100%);"></div>

                <form id="examForm" class="px-8 py-7 flex flex-col gap-5" novalidate>

                    <div>
                        <label class="block text-sm font-semibold text-gray-700 mb-1.5">
                            Tipo de Prova <span class="text-pink-500">*</span>
                        </label>
                        <select id="type" name="type"
                            class="w-full border border-gray-200 rounded-lg px-3.5 py-2.5 text-sm text-gray-900 bg-white appearance-none outline-none transition focus:border-pink-500 focus:ring-2 focus:ring-pink-100 cursor-pointer"
                            style="background-image:url(\"data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='12' height='12' viewBox='0 0 24 24' fill='none' stroke='%2394a3b8' stroke-width='2.5' stroke-linecap='round' stroke-linejoin='round'%3E%3Cpolyline points='6 9 12 15 18 9'/%3E%3C/svg%3E\");background-repeat:no-repeat;background-position:right 12px center;padding-right:2.2rem;">
                            <option value="">Selecione o tipo...</option>
                            <option value="Prova">Prova</option>
                            <option value="Simulado">Simulado</option>
                            <option value="Prova Substitutiva">Prova Substitutiva</option>
                            <option value="Prova Final">Prova Final</option>
                            <option value="Avaliação Prática">Avaliação Prática</option>
                        </select>

                    </div>

                    <div>
                        <label class="block text-sm font-semibold text-gray-700 mb-1.5">
                            Descrição <span class="text-pink-500">*</span>
                        </label>
                        <textarea id="description" name="description" rows="3"
                            placeholder="Ex: Prova de Cálculo I — conteúdo de derivadas e integrais"
                            class="w-full border border-gray-200 rounded-lg px-3.5 py-2.5 text-sm text-gray-900 bg-white outline-none transition placeholder-gray-400 focus:border-pink-500 focus:ring-2 focus:ring-pink-100 resize-y"
                            style="font-family:'Inter',sans-serif;"></textarea>
                        <p id="err-description" class="hidden text-xs font-medium text-red-500 mt-1">Informe uma descrição.
                        </p>
                    </div>

                    <div>
                        <label class="block text-sm font-semibold text-gray-700 mb-1.5">
                            Data de Realização <span class="text-pink-500">*</span>
                        </label>
                        <input type="date" id="due_date" name="due_date"
                            class="w-full border border-gray-200 rounded-lg px-3.5 py-2.5 text-sm text-gray-900 bg-white outline-none transition focus:border-pink-500 focus:ring-2 focus:ring-pink-100">
                        <p id="err-due_date" class="hidden text-xs font-medium text-red-500 mt-1">Informe a data da prova.
                        </p>
                    </div>

                    <div>
                        <label class="block text-sm font-semibold text-gray-700 mb-1.5">
                            O que acha da prova <span class="text-pink-500">*</span>
                        </label>
                        <select id="status" name="status"
                            class="w-full border border-gray-200 rounded-lg px-3.5 py-2.5 text-sm text-gray-900 bg-white appearance-none outline-none transition focus:border-pink-500 focus:ring-2 focus:ring-pink-100 cursor-pointer"
                            style="background-image:url(\"data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='12' height='12' viewBox='0 0 24 24' fill='none' stroke='%2394a3b8' stroke-width='2.5' stroke-linecap='round' stroke-linejoin='round'%3E%3Cpolyline points='6 9 12 15 18 9'/%3E%3C/svg%3E\");background-repeat:no-repeat;background-position:right 12px center;padding-right:2.2rem;">
                            <option value="">Selecione o status...</option>
                            <option value="pending">❌ Dificil</option>
                            <option value="in_progress">✅ Facil</option>
                            <option value="completed">❗ Medio</option>
                        </select>
                        <p id="err-status" class="hidden text-xs font-medium text-red-500 mt-1">Selecione o status.</p>
                    </div>

                    <hr class="border-gray-100">

                    <div class="flex justify-end gap-2.5">
                        <a href="{{ route('exam.index') }}"
                            class="inline-flex items-center gap-1.5 border border-pink-200 hover:border-pink-300 text-pink-500 hover:text-pink-700 font-semibold text-sm px-5 py-2.5 rounded-xl transition-colors">
                            Cancelar
                        </a>
                        <button type="submit" id="submitBtn"
                            class="inline-flex items-center gap-1.5 bg-pink-600 hover:bg-pink-700 text-white font-extrabold text-sm px-6 py-2.5 rounded-xl shadow-lg shadow-pink-200 transition-all hover:-translate-y-0.5">
                            <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round">
                                <polyline points="20 6 9 17 4 12" />
                            </svg>
                            <span id="btnLabel">Salvar prova</span>
                        </button>
                    </div>

                </form>
            </div>

            <p class="text-center text-xs text-gray-300 font-semibold mt-5">
                Campos com <span class="text-pink-400">*</span> são obrigatórios
            </p>
        </div>
    </div>

    <div id="toast"
        class="fixed bottom-6 right-6 hidden items-center gap-3 bg-white border border-gray-100 border-l-4 border-l-pink-500 rounded-xl shadow-lg px-5 py-3.5 z-50"
        style="display:none;">
        <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="#db2777" stroke-width="2.5"
            stroke-linecap="round" stroke-linejoin="round">
            <polyline points="20 6 9 17 4 12" />
        </svg>
        <div>
            <p class="text-gray-800 font-bold text-sm">Prova cadastrada!</p>
            <p class="text-gray-400 text-xs">Redirecionando...</p>
        </div>
    </div>

    <script src="{{ asset('js/exam.js') }}"></script>
@endsection
