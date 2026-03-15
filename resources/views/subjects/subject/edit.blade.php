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
        <div class="absolute top-16 left-10 float-a pointer-events-none opacity-65"><svg width="40" height="100"
                viewBox="0 0 40 100" fill="none">
                <rect x="6" y="6" width="28" height="72" rx="5" fill="#fbbf24" />
                <rect x="6" y="6" width="28" height="12" rx="5" fill="#d97706" />
                <polygon points="6,78 34,78 20,98" fill="#fde68a" />
                <polygon points="16,90 24,90 20,98" fill="#1a1a2e" />
                <rect x="6" y="6" width="4" height="72" fill="#f59e0b" opacity=".4" />
            </svg></div>
        <div class="absolute top-28 right-14 float-b pointer-events-none opacity-65"><svg width="70" height="60"
                viewBox="0 0 70 60" fill="none">
                <rect x="6" y="40" width="58" height="16" rx="4" fill="#db2777" />
                <rect x="6" y="40" width="8" height="16" rx="3" fill="#be185d" />
                <rect x="16" y="45" width="22" height="2.5" rx="2" fill="#fce7f3" opacity=".6" />
                <rect x="10" y="22" width="50" height="16" rx="4" fill="#fbbf24" />
                <rect x="10" y="22" width="8" height="16" rx="3" fill="#d97706" />
                <rect x="20" y="28" width="18" height="2.5" rx="2" fill="#fff" opacity=".5" />
                <rect x="4" y="4" width="62" height="16" rx="4" fill="#06b6d4" />
                <rect x="4" y="4" width="8" height="16" rx="3" fill="#0891b2" />
                <rect x="14" y="10" width="20" height="2.5" rx="2" fill="#fff" opacity=".5" />
            </svg></div>
        <div class="absolute top-44 left-1/3 float-c pointer-events-none" style="animation-delay:.7s"><svg width="20"
                height="20" viewBox="0 0 20 20" fill="none">
                <path d="M10 1L11.6 7.5L18 9L11.6 10.5L10 17L8.4 10.5L2 9L8.4 7.5Z" fill="#f472b6" opacity=".6" />
            </svg></div>
        <div class="absolute bottom-44 right-1/4 float-b pointer-events-none" style="animation-delay:.4s"><svg
                width="14" height="14" viewBox="0 0 14 14" fill="none">
                <path d="M7 0L8.2 5.2L13 7L8.2 8.8L7 14L5.8 8.8L1 7L5.8 5.2Z" fill="#db2777" opacity=".4" />
            </svg></div>

        <div class="relative z-10 max-w-2xl mx-auto px-6 py-10">
            <div class="mb-8 fade-up">
                <a href="{{ route('subject.index') }}"
                    class="inline-flex items-center gap-1.5 text-pink-500 hover:text-pink-700 text-sm font-semibold mb-5 transition-colors">
                    <svg width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                        stroke-width="2.5" stroke-linecap="round">
                        <polyline points="15 18 9 12 15 6" />
                    </svg>
                    Voltar para matérias
                </a>
                <p class="text-[10px] font-black tracking-widest uppercase text-pink-400 mb-1">Editar matéria</p>
                <h1 class="text-4xl font-black text-gray-900 dark:text-gray-100 leading-tight" style="font-family:'Syne',sans-serif;">Editar
                    Matéria</h1>
                <p class="text-sm text-gray-400 font-semibold mt-1">Atualize as informações abaixo</p>
            </div>

            <div class="bg-white/90 dark:bg-[#18181b]/95 backdrop-blur-sm rounded-3xl shadow-xl shadow-pink-100 dark:shadow-none overflow-hidden border border-pink-100 dark:border-gray-800 fade-up transition-colors duration-200"
                style="animation-delay:.1s">
                <div class="h-1.5 w-full" style="background:linear-gradient(90deg,#db2777 0%,#f472b6 50%,#fda4af 100%);">
                </div>
                <form id="subjectForm" class="px-8 py-7 flex flex-col gap-5" novalidate data-id="{{ $subject->id }}"
                    data-name="{{ $subject->name }}" data-abbreviation="{{ $subject->abbreviation }}"
                    data-teacher="{{ $subject->teacher }}" data-semester="{{ $subject->semester }}">

                    <div>
                        <label class="block text-sm font-bold text-gray-700 dark:text-gray-300 mb-1.5">Matéria <span
                                class="text-pink-500">*</span></label>
                        <select id="name" name="name"
                            class="w-full border border-gray-200 dark:border-gray-700 rounded-xl px-3 py-2.5 text-sm font-medium text-gray-800 dark:text-gray-100 bg-white dark:bg-[#18181b] focus:outline-none focus:border-pink-400 dark:focus:border-pink-500 focus:ring-2 focus:ring-pink-100 dark:focus:ring-pink-900/30 transition-colors cursor-pointer appearance-none"
                            style="background-image:url(\"data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='12' height='12' viewBox='0 0 24 24' fill='none' stroke='%2394a3b8' stroke-width='2.5' stroke-linecap='round' stroke-linejoin='round'%3E%3Cpolyline points='6 9 12 15 18 9'/%3E%3C/svg%3E\");background-repeat:no-repeat;background-position:right 12px center;padding-right:2.2rem;">
                            <option value="">Selecione uma matéria...</option>
                            <optgroup label="── Ensino Médio ──">
                                <option value="Português">Português</option>
                                <option value="Literatura">Literatura</option>
                                <option value="Redação">Redação</option>
                                <option value="Matemática">Matemática</option>
                                <option value="Física">Física</option>
                                <option value="Química">Química</option>
                                <option value="Biologia">Biologia</option>
                                <option value="História">História</option>
                                <option value="Geografia">Geografia</option>
                                <option value="Filosofia">Filosofia</option>
                                <option value="Sociologia">Sociologia</option>
                                <option value="Inglês">Inglês</option>
                                <option value="Espanhol">Espanhol</option>
                                <option value="Arte">Arte</option>
                                <option value="Educação Física">Educação Física</option>
                                <option value="Informática">Informática</option>
                            </optgroup>
                            <optgroup label="── Ensino Superior ──">
                                <option value="Cálculo I">Cálculo I</option>
                                <option value="Cálculo II">Cálculo II</option>
                                <option value="Cálculo III">Cálculo III</option>
                                <option value="Álgebra Linear">Álgebra Linear</option>
                                <option value="Física I">Física I</option>
                                <option value="Física II">Física II</option>
                                <option value="Química Geral">Química Geral</option>
                                <option value="Biologia Celular">Biologia Celular</option>
                                <option value="Programação I">Programação I</option>
                                <option value="Programação II">Programação II</option>
                                <option value="Estrutura de Dados">Estrutura de Dados</option>
                                <option value="Banco de Dados">Banco de Dados</option>
                                <option value="Redes de Computadores">Redes de Computadores</option>
                                <option value="Sistemas Operacionais">Sistemas Operacionais</option>
                                <option value="Engenharia de Software">Engenharia de Software</option>
                                <option value="Inteligência Artificial">Inteligência Artificial</option>
                                <option value="Estatística">Estatística</option>
                                <option value="Probabilidade">Probabilidade</option>
                                <option value="Português Instrumental">Português Instrumental</option>
                                <option value="Inglês Técnico">Inglês Técnico</option>
                                <option value="Administração">Administração</option>
                                <option value="Contabilidade">Contabilidade</option>
                                <option value="Direito">Direito</option>
                                <option value="Economia">Economia</option>
                                <option value="Marketing">Marketing</option>
                            </optgroup>
                            <option value="outro">Outro...</option>
                        </select>
                        <div id="extra-name" class="hidden mt-2">
                            <input type="text" id="name_custom" placeholder="Digite o nome da matéria"
                                class="w-full border border-gray-200 dark:border-gray-700 rounded-xl px-3 py-2.5 text-sm font-medium text-gray-800 dark:text-gray-100 bg-white dark:bg-[#18181b] focus:outline-none focus:border-pink-400 dark:focus:border-pink-500 focus:ring-2 focus:ring-pink-100 dark:focus:ring-pink-900/30 transition-colors placeholder:text-gray-400">
                        </div>
                        <p id="err-name" class="hidden text-[11px] font-semibold text-red-500 mt-1">Selecione ou informe
                            a matéria.</p>
                    </div>

                    <div>
                        <label class="block text-sm font-bold text-gray-700 dark:text-gray-300 mb-1.5">Código <span
                                class="text-pink-500">*</span></label>
                        <select id="abbreviation" name="abbreviation"
                            class="w-full border border-gray-200 dark:border-gray-700 rounded-xl px-3 py-2.5 text-sm font-medium text-gray-800 dark:text-gray-100 bg-white dark:bg-[#18181b] focus:outline-none focus:border-pink-400 dark:focus:border-pink-500 focus:ring-2 focus:ring-pink-100 dark:focus:ring-pink-900/30 transition-colors cursor-pointer appearance-none"
                            style="background-image:url(\"data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='12' height='12' viewBox='0 0 24 24' fill='none' stroke='%2394a3b8' stroke-width='2.5' stroke-linecap='round' stroke-linejoin='round'%3E%3Cpolyline points='6 9 12 15 18 9'/%3E%3C/svg%3E\");background-repeat:no-repeat;background-position:right 12px center;padding-right:2.2rem;">
                            <option value="">Selecione um código...</option>
                            <optgroup label="── Ensino Médio ──">
                                <option value="PORT">PORT</option>
                                <option value="LIT">LIT</option>
                                <option value="RED">RED</option>
                                <option value="MAT">MAT</option>
                                <option value="FIS">FIS</option>
                                <option value="QUI">QUI</option>
                                <option value="BIO">BIO</option>
                                <option value="HIS">HIS</option>
                                <option value="GEO">GEO</option>
                                <option value="FIL">FIL</option>
                                <option value="SOC">SOC</option>
                                <option value="ING">ING</option>
                                <option value="ESP">ESP</option>
                                <option value="ART">ART</option>
                                <option value="EDF">EDF</option>
                                <option value="INF">INF</option>
                            </optgroup>
                            <optgroup label="── Ensino Superior ──">
                                <option value="CAL1">CAL1</option>
                                <option value="CAL2">CAL2</option>
                                <option value="CAL3">CAL3</option>
                                <option value="ALG">ALG</option>
                                <option value="FIS1">FIS1</option>
                                <option value="FIS2">FIS2</option>
                                <option value="QUIG">QUIG</option>
                                <option value="BIOC">BIOC</option>
                                <option value="PRG1">PRG1</option>
                                <option value="PRG2">PRG2</option>
                                <option value="ED">ED</option>
                                <option value="BD">BD</option>
                                <option value="RC">RC</option>
                                <option value="SO">SO</option>
                                <option value="ES">ES</option>
                                <option value="IA">IA</option>
                                <option value="EST">EST</option>
                                <option value="PRB">PRB</option>
                                <option value="ADM">ADM</option>
                                <option value="CONT">CONT</option>
                                <option value="DIR">DIR</option>
                                <option value="ECO">ECO</option>
                                <option value="MKT">MKT</option>
                            </optgroup>
                            <option value="outro">Outro...</option>
                        </select>
                        <div id="extra-abbreviation" class="hidden mt-2">
                            <input type="text" id="abbreviation_custom" placeholder="Ex: MAT201"
                                class="w-full border border-gray-200 dark:border-gray-700 rounded-xl px-3 py-2.5 text-sm font-medium text-gray-800 dark:text-gray-100 bg-white dark:bg-[#18181b] uppercase focus:outline-none focus:border-pink-400 dark:focus:border-pink-500 focus:ring-2 focus:ring-pink-100 dark:focus:ring-pink-900/30 transition-colors placeholder:text-gray-400">
                        </div>
                        <p id="err-abbreviation" class="hidden text-[11px] font-semibold text-red-500 mt-1">Selecione ou
                            informe o código.</p>
                    </div>

                    <div>
                        <label class="block text-sm font-bold text-gray-700 dark:text-gray-300 mb-1.5">Professor <span
                                class="text-pink-500">*</span></label>
                        <input type="text" id="teacher" name="teacher" placeholder="Ex: Prof. João Silva"
                            class="w-full border border-gray-200 dark:border-gray-700 rounded-xl px-3 py-2.5 text-sm font-medium text-gray-800 dark:text-gray-100 bg-white dark:bg-[#18181b] focus:outline-none focus:border-pink-400 dark:focus:border-pink-500 focus:ring-2 focus:ring-pink-100 dark:focus:ring-pink-900/30 transition-colors placeholder:text-gray-400">
                        <p id="err-teacher" class="hidden text-[11px] font-semibold text-red-500 mt-1">Informe o nome do
                            professor.</p>
                    </div>

                    <div>
                        <label class="block text-sm font-bold text-gray-700 dark:text-gray-300 mb-1.5">Semestre <span
                                class="text-pink-500">*</span></label>
                        <select id="semester" name="semester"
                            class="w-full border border-gray-200 dark:border-gray-700 rounded-xl px-3 py-2.5 text-sm font-medium text-gray-800 dark:text-gray-100 bg-white dark:bg-[#18181b] focus:outline-none focus:border-pink-400 dark:focus:border-pink-500 focus:ring-2 focus:ring-pink-100 dark:focus:ring-pink-900/30 transition-colors cursor-pointer appearance-none"
                            style="background-image:url(\"data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='12' height='12' viewBox='0 0 24 24' fill='none' stroke='%2394a3b8' stroke-width='2.5' stroke-linecap='round' stroke-linejoin='round'%3E%3Cpolyline points='6 9 12 15 18 9'/%3E%3C/svg%3E\");background-repeat:no-repeat;background-position:right 12px center;padding-right:2.2rem;">
                            <option value="">Selecione o semestre...</option>
                            @for ($i = 1; $i <= 10; $i++)
                                <option value="{{ $i }}">{{ $i }}º Semestre</option>
                            @endfor
                            <option value="outro">Outro...</option>
                        </select>
                        <div id="extra-semester" class="hidden mt-2">
                            <input type="number" id="semester_custom" placeholder="Ex: 11" min="1"
                                max="20"
                                class="w-full border border-gray-200 dark:border-gray-700 rounded-xl px-3 py-2.5 text-sm font-medium text-gray-800 dark:text-gray-100 bg-white dark:bg-[#18181b] focus:outline-none focus:border-pink-400 dark:focus:border-pink-500 focus:ring-2 focus:ring-pink-100 dark:focus:ring-pink-900/30 transition-colors placeholder:text-gray-400">
                        </div>
                        <p id="err-semester" class="hidden text-[11px] font-semibold text-red-500 mt-1">Selecione ou
                            informe o semestre.</p>
                    </div>

                    <hr class="border-gray-100 dark:border-gray-800">

                    <div class="flex items-center justify-between">
                        <button type="button" id="deleteBtn"
                            class="inline-flex items-center gap-1.5 text-red-400 hover:text-red-600 border border-red-100 dark:border-red-900/30 hover:border-red-300 dark:hover:border-red-800 hover:bg-red-50 dark:hover:bg-red-900/20 font-bold text-sm px-4 py-2.5 rounded-xl transition-all">
                            <svg width="13" height="13" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                stroke-width="2" stroke-linecap="round">
                                <polyline points="3 6 5 6 21 6" />
                                <path d="M19 6l-1 14H6L5 6" />
                                <path d="M9 6V4h6v2" />
                            </svg>
                            Excluir matéria
                        </button>
                        <div class="flex gap-2.5">
                            <a href="{{ route('subject.index') }}"
                                class="inline-flex items-center gap-1.5 border border-pink-200 dark:border-gray-700 hover:border-pink-300 dark:hover:border-gray-600 text-pink-500 hover:text-pink-700 dark:text-gray-300 font-bold text-sm px-5 py-2.5 rounded-xl transition-colors">Cancelar</a>
                            <button type="submit" id="submitBtn"
                                class="inline-flex items-center gap-1.5 bg-pink-600 hover:bg-pink-700 text-white font-black text-sm px-6 py-2.5 rounded-xl shadow-lg shadow-pink-200 transition-all hover:-translate-y-0.5 disabled:opacity-60">
                                <svg width="13" height="13" viewBox="0 0 24 24" fill="none"
                                    stroke="currentColor" stroke-width="2.5" stroke-linecap="round">
                                    <polyline points="20 6 9 17 4 12" />
                                </svg>
                                <span id="btnLabel">Salvar alterações</span>
                            </button>
                        </div>
                    </div>

                </form>
            </div>
            <p class="text-center text-xs text-gray-300 font-semibold mt-5">Campos com <span
                    class="text-pink-400">*</span> são obrigatórios</p>
        </div>
    </div>

    <div id="deleteModal" class="hidden fixed inset-0 bg-black/30 backdrop-blur-sm z-50 items-center justify-center p-4">
        <div class="bg-white dark:bg-[#18181b] rounded-2xl shadow-2xl w-full max-w-sm overflow-hidden border border-transparent dark:border-gray-800">
            <div class="h-1 bg-linear-to-r from-red-500 to-rose-400"></div>
            <div class="p-6 text-center">
                <div class="w-14 h-14 rounded-2xl bg-red-50 dark:bg-red-500/10 flex items-center justify-center mx-auto mb-4">
                    <svg class="w-7 h-7 text-red-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <polyline points="3 6 5 6 21 6" stroke-width="2" stroke-linecap="round" />
                        <path d="M19 6l-1 14H6L5 6" stroke-width="2" stroke-linecap="round" />
                        <path d="M9 6V4h6v2" stroke-width="2" stroke-linecap="round" />
                    </svg>
                </div>
                <h3 class="text-base font-black text-gray-900 dark:text-white mb-1" style="font-family:'Syne',sans-serif;">Excluir
                    matéria?</h3>
                <p class="text-sm text-gray-400 dark:text-gray-500 mb-5">Esta ação não pode ser desfeita.</p>
                <div class="flex gap-2 justify-center">
                    <button id="cancelDelete"
                        class="border border-gray-200 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-800 text-gray-600 dark:text-gray-300 font-bold text-sm px-5 py-2.5 rounded-xl transition-colors">Cancelar</button>
                    <button id="confirmDelete"
                        class="bg-red-500 hover:bg-red-600 text-white font-black text-sm px-5 py-2.5 rounded-xl transition-colors shadow-sm shadow-red-200 dark:shadow-none">Sim,
                        excluir</button>
                </div>
            </div>
        </div>
    </div>

    <div id="toast"
        class="hidden fixed bottom-6 right-6 items-center gap-3 bg-white dark:bg-[#18181b] border border-gray-100 dark:border-gray-800 border-l-4 border-l-pink-500 rounded-xl shadow-lg px-5 py-3.5 z-50">
        <svg width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="#db2777" stroke-width="2.5"
            stroke-linecap="round">
            <polyline points="20 6 9 17 4 12" />
        </svg>
        <div>
            <p class="text-gray-800 dark:text-gray-100 font-bold text-sm">Matéria atualizada!</p>
            <p class="text-gray-400 text-xs">Redirecionando...</p>
        </div>
    </div>

    <script src="{{ asset('js/subject.js') }}"></script>
@endsection
