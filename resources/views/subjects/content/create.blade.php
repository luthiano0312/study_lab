@extends('layouts.app')

@section('content')
    <div class="min-h-screen relative overflow-hidden bg-[#fdf4f8] dark:bg-[#121212] transition-colors duration-200" style="font-family:'DM Sans',sans-serif;">
        <div class="absolute inset-0 pointer-events-none"
            style="background-image:radial-gradient(circle,#f9a8d4 1.5px,transparent 1.5px);background-size:32px 32px;opacity:.35;">
        </div>
        <div class="absolute -top-24 -right-24 w-96 h-96 rounded-full pointer-events-none"
            style="background:radial-gradient(circle at 40% 40%,#f9a8d4 0%,#fce7f3 60%,transparent 80%);opacity:.6;"></div>
        <div class="absolute -bottom-16 -left-16 w-64 h-64 rounded-full pointer-events-none"
            style="background:radial-gradient(circle at 60% 60%,#fbcfe8 0%,transparent 70%);opacity:.5;"></div>
        <div class="absolute top-20 right-16 float-b pointer-events-none opacity-70"><svg width="52" height="44"
                viewBox="0 0 52 44" fill="none">
                <rect x="0" y="6" width="52" height="18" rx="5" fill="#db2777" opacity=".85" />
                <rect x="0" y="6" width="8" height="18" rx="4" fill="#be185d" />
                <rect x="11" y="11" width="20" height="3" rx="2" fill="#fce7f3" opacity=".6" />
                <rect x="4" y="28" width="48" height="14" rx="5" fill="#fbbf24" opacity=".8" />
                <rect x="4" y="28" width="8" height="14" rx="4" fill="#d97706" />
                <rect x="15" y="33" width="16" height="2.5" rx="2" fill="#fff" opacity=".5" />
            </svg></div>
        <div class="absolute top-14 left-12 float-a pointer-events-none opacity-60"><svg width="32" height="32"
                viewBox="0 0 32 32" fill="none">
                <rect x="3" y="3" width="26" height="26" rx="5" fill="#fce7f3" stroke="#f9a8d4"
                    stroke-width="1.5" />
                <path d="M8 12h16M8 17h10M8 22h7" stroke="#db2777" stroke-width="2" stroke-linecap="round" />
            </svg></div>
        <div class="absolute top-40 left-1/3 float-c pointer-events-none" style="animation-delay:.8s"><svg width="20"
                height="20" viewBox="0 0 20 20" fill="none">
                <path d="M10 1L11.8 7.5L18 9L11.8 10.5L10 17L8.2 10.5L2 9L8.2 7.5Z" fill="#f472b6" opacity=".6" />
            </svg></div>
        <div class="absolute bottom-44 right-1/4 float-b pointer-events-none" style="animation-delay:.4s"><svg
                width="14" height="14" viewBox="0 0 14 14" fill="none">
                <path d="M7 0L8.2 5.2L13 7L8.2 8.8L7 14L5.8 8.8L1 7L5.8 5.2Z" fill="#db2777" opacity=".4" />
            </svg></div>

        <div class="relative z-10 max-w-2xl mx-auto px-6 py-10">
            <div class="mb-8 fade-up">
                <a href="{{ route('content.index') }}"
                    class="inline-flex items-center gap-1.5 text-pink-500 hover:text-pink-700 text-sm font-semibold mb-5 transition-colors">
                    <svg width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                        stroke-width="2.5" stroke-linecap="round">
                        <polyline points="15 18 9 12 15 6" />
                    </svg>
                    Voltar para conteúdos
                </a>
                <p class="text-[10px] font-black tracking-widest uppercase text-pink-400 mb-1">Novo conteúdo</p>
                <h1 class="text-4xl font-black text-gray-900 dark:text-gray-100 leading-tight" style="font-family:'Syne',sans-serif;">Cadastrar
                    Conteúdo</h1>
                <p class="text-sm text-gray-400 font-semibold mt-1">Preencha os campos abaixo</p>
            </div>

            <div class="bg-white/90 dark:bg-[#18181b]/95 backdrop-blur-sm rounded-3xl shadow-xl shadow-pink-100 dark:shadow-none overflow-hidden border border-pink-100 dark:border-gray-800 fade-up transition-colors duration-200"
                style="animation-delay:.1s">
                <div class="h-1.5 w-full" style="background:linear-gradient(90deg,#db2777 0%,#f472b6 50%,#fda4af 100%);">
                </div>
                <form id="contentForm" class="px-8 py-7 flex flex-col gap-5" novalidate>

                    <div>
                        <label class="block text-sm font-semibold text-gray-700 dark:text-gray-300 mb-1.5">Nome do conteúdo <span
                                class="text-pink-500">*</span></label>
                        <input type="text" id="name" name="name"
                            placeholder="Ex: Derivadas e integrais, Orações subordinadas..."
                            class="w-full border border-gray-200 dark:border-gray-700 rounded-lg px-3.5 py-2.5 text-sm text-gray-900 dark:text-gray-100 bg-white dark:bg-[#18181b] outline-none transition focus:border-pink-500 dark:focus:border-pink-500 focus:ring-2 focus:ring-pink-100 dark:focus:ring-pink-900/30 placeholder:text-gray-400">
                        <p class="hidden text-xs font-medium text-red-500 mt-1" id="err-name">Informe o nome do conteúdo.
                        </p>
                    </div>

                    <div>
                        <label class="block text-sm font-semibold text-gray-700 dark:text-gray-300 mb-1.5">Matéria <span
                                class="text-pink-500">*</span></label>
                        <select id="subject_id" name="subject_id"
                            class="w-full border border-gray-200 dark:border-gray-700 rounded-lg px-3.5 py-2.5 text-sm text-gray-900 dark:text-gray-100 bg-white dark:bg-[#18181b] outline-none appearance-none transition focus:border-pink-500 dark:focus:border-pink-500 focus:ring-2 focus:ring-pink-100 dark:focus:ring-pink-900/30 mb-2"
                            style="background-image:url(\"data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='12' height='12' viewBox='0 0 24 24' fill='none' stroke='%2394a3b8' stroke-width='2.5' stroke-linecap='round' stroke-linejoin='round'%3E%3Cpolyline points='6 9 12 15 18 9'/%3E%3C/svg%3E\");background-repeat:no-repeat;background-position:right 12px center;padding-right:2.2rem;">
                            <option value="">Carregando matérias...</option>
                        </select>
                        <input type="text" id="subject_custom" placeholder="Digite o nome da matéria manualmente"
                            class="hidden w-full border border-gray-200 dark:border-gray-700 rounded-lg px-3.5 py-2.5 text-sm text-gray-900 dark:text-gray-100 bg-white dark:bg-[#18181b] outline-none transition focus:border-pink-500 dark:focus:border-pink-500 focus:ring-2 focus:ring-pink-100 dark:focus:ring-pink-900/30 placeholder:text-gray-400">
                        <p class="hidden text-xs font-medium text-red-500 mt-1" id="err-subject_id">Selecione ou informe a
                            matéria.</p>
                    </div>

                    <div>
                        <label class="block text-sm font-semibold text-gray-700 dark:text-gray-300 mb-1.5">Professor <span
                                class="text-pink-500">*</span></label>
                        <input type="text" id="teacher" name="teacher" placeholder="Ex: Prof. João Silva"
                            class="w-full border border-gray-200 dark:border-gray-700 rounded-lg px-3.5 py-2.5 text-sm text-gray-900 dark:text-gray-100 bg-white dark:bg-[#18181b] outline-none transition focus:border-pink-500 dark:focus:border-pink-500 focus:ring-2 focus:ring-pink-100 dark:focus:ring-pink-900/30 placeholder:text-gray-400">
                        <p class="hidden text-xs font-medium text-red-500 mt-1" id="err-teacher">Informe o nome do
                            professor.</p>
                    </div>

                    <div>
                        <label class="block text-sm font-semibold text-gray-700 dark:text-gray-300 mb-1.5">Semestre <span
                                class="text-pink-500">*</span></label>
                        <select id="semester" name="semester"
                            class="w-full border border-gray-200 dark:border-gray-700 rounded-lg px-3.5 py-2.5 text-sm text-gray-900 dark:text-gray-100 bg-white dark:bg-[#18181b] outline-none appearance-none transition focus:border-pink-500 dark:focus:border-pink-500 focus:ring-2 focus:ring-pink-100 dark:focus:ring-pink-900/30"
                            style="background-image:url(\"data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='12' height='12' viewBox='0 0 24 24' fill='none' stroke='%2394a3b8' stroke-width='2.5' stroke-linecap='round' stroke-linejoin='round'%3E%3Cpolyline points='6 9 12 15 18 9'/%3E%3C/svg%3E\");background-repeat:no-repeat;background-position:right 12px center;padding-right:2.2rem;">
                            <option value="">Selecione o semestre...</option>
                            @for ($i = 1; $i <= 10; $i++)
                                <option value="{{ $i }}">{{ $i }}º Semestre</option>
                            @endfor
                            <option value="outro">Outro...</option>
                        </select>
                        <input type="number" id="semester_custom" placeholder="Ex: 11" min="1" max="20"
                            class="hidden mt-2 w-full border border-gray-200 dark:border-gray-700 rounded-lg px-3.5 py-2.5 text-sm text-gray-900 dark:text-gray-100 bg-white dark:bg-[#18181b] outline-none transition focus:border-pink-500 dark:focus:border-pink-500 focus:ring-2 focus:ring-pink-100 dark:focus:ring-pink-900/30 placeholder:text-gray-400">
                        <p class="hidden text-xs font-medium text-red-500 mt-1" id="err-semester">Selecione ou informe o
                            semestre.</p>
                    </div>

                    <hr class="border-gray-100 dark:border-gray-800">

                    <div class="flex justify-end gap-2.5">
                        <a href="{{ route('content.index') }}"
                            class="inline-flex items-center border border-pink-200 dark:border-gray-700 hover:border-pink-300 dark:hover:border-gray-600 text-pink-500 dark:text-gray-300 hover:text-pink-700 font-semibold text-sm px-5 py-2.5 rounded-xl transition-colors">Cancelar</a>
                        <button type="submit" id="submitBtn"
                            class="inline-flex items-center gap-1.5 bg-pink-600 hover:bg-pink-700 text-white font-black text-sm px-6 py-2.5 rounded-xl shadow-lg shadow-pink-200 transition-all hover:-translate-y-0.5 disabled:opacity-60">
                            <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                stroke-width="2.5" stroke-linecap="round">
                                <polyline points="20 6 9 17 4 12" />
                            </svg>
                            <span id="btnLabel">Salvar conteúdo</span>
                        </button>
                    </div>

                </form>
            </div>
            <p class="text-center text-xs text-gray-300 font-semibold mt-5">Campos com <span
                    class="text-pink-400">*</span> são obrigatórios</p>
        </div>
    </div>

    <div id="toast"
        class="hidden z-50 fixed bottom-6 right-6 items-center gap-3 bg-white dark:bg-[#18181b] border border-gray-100 dark:border-gray-800 border-l-4 border-l-pink-500 rounded-xl shadow-lg px-5 py-3.5">
        <svg width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="#db2777" stroke-width="2.5"
            stroke-linecap="round">
            <polyline points="20 6 9 17 4 12" />
        </svg>
        <div>
            <p class="text-gray-800 dark:text-gray-100 font-bold text-sm">Conteúdo cadastrado!</p>
            <p class="text-gray-400 text-xs">Redirecionando...</p>
        </div>
    </div>

    <script src="{{ asset('js/content.js') }}"></script>
@endsection
