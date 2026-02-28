@extends('layouts.app')

@section('content')

<link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800;900&display=swap" rel="stylesheet">

<link rel="stylesheet" href="{{ asset('css/subject.css') }}">

<style>
  /* ── Select styling ── */
  .field-select {
    width: 100%;
    border: 1px solid #e2e8f0;
    border-radius: 8px;
    padding: 0.6rem 2.2rem 0.6rem 0.875rem;
    font-family: 'Inter', sans-serif;
    font-size: 0.875rem;
    font-weight: 400;
    color: #0f172a;
    background: #fff url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='12' height='12' viewBox='0 0 24 24' fill='none' stroke='%2394a3b8' stroke-width='2.5' stroke-linecap='round' stroke-linejoin='round'%3E%3Cpolyline points='6 9 12 15 18 9'/%3E%3C/svg%3E") no-repeat right 12px center;
    appearance: none;
    outline: none;
    transition: border-color 0.15s, box-shadow 0.15s;
    cursor: pointer;
  }
  .field-select:focus {
    border-color: #db2777;
    box-shadow: 0 0 0 3px rgba(219,39,119,0.08);
  }
  .field-select.is-error { border-color: #f43f5e; }

  .field-input {
    width: 100%;
    border: 1px solid #e2e8f0;
    border-radius: 8px;
    padding: 0.6rem 0.875rem;
    font-family: 'Inter', sans-serif;
    font-size: 0.875rem;
    font-weight: 400;
    color: #0f172a;
    background: #fff;
    outline: none;
    transition: border-color 0.15s, box-shadow 0.15s;
  }
  .field-input::placeholder { color: #94a3b8; }
  .field-input:focus {
    border-color: #db2777;
    box-shadow: 0 0 0 3px rgba(219,39,119,0.08);
  }
  .field-input.is-error,
  .field-select.is-error { border-color: #f43f5e; }

  .err-msg {
    display: none;
    font-size: 0.72rem;
    font-weight: 500;
    color: #f43f5e;
    margin-top: 4px;
  }
  .err-msg.show { display: block; }

  /* extra field reveal */
  .extra-field {
    display: none;
    margin-top: 8px;
  }
  .extra-field.show { display: block; }

  .toast {
    position: fixed;
    bottom: 1.5rem;
    right: 1.5rem;
    background: #fff;
    border: 1px solid #e2e8f0;
    border-left: 3px solid #db2777;
    border-radius: 10px;
    box-shadow: 0 4px 24px rgba(0,0,0,0.08);
    padding: 0.85rem 1.2rem;
    display: flex;
    align-items: center;
    gap: 10px;
    font-family: 'Inter', sans-serif;
    font-size: 0.85rem;
    font-weight: 600;
    z-index: 50;
  }
  .toast.hidden { display: none; }
</style>

<div class="min-h-screen relative h-full w-full overflow-hidden bg-[#fdf4f8]" style="font-family:'Inter',sans-serif;">

  <div class="absolute inset-0 pointer-events-none" style="background-image:radial-gradient(circle,#f9a8d4 1.5px,transparent 1.5px);background-size:32px 32px;opacity:.35;"></div>
  <div class="absolute -top-24 -right-24 w-96 h-96 rounded-full pointer-events-none" style="background:radial-gradient(circle at 40% 40%,#f9a8d4 0%,#fce7f3 60%,transparent 80%);opacity:.6;"></div>
  <div class="absolute -bottom-16 -left-16 w-64 h-64 rounded-full pointer-events-none" style="background:radial-gradient(circle at 60% 60%,#fbcfe8 0%,transparent 70%);opacity:.5;"></div>

  <div class="relative z-10 max-w-2xl mx-auto px-6 py-10">

    <div class="mb-8 fade-up">
      <a href="{{ route('subject.index') }}"
         class="inline-flex items-center gap-1.5 text-pink-500 hover:text-pink-700 text-sm font-600 mb-5 transition-colors">
        <svg width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor"
             stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round">
          <polyline points="15 18 9 12 15 6"/>
        </svg>
        Voltar para matérias
      </a>
      <p class="text-xs font-800 tracking-widest uppercase text-pink-400 mb-1">Nova matéria</p>
      <h1 class="text-4xl font-black text-gray-900 leading-tight">Cadastrar Matéria</h1>
      <p class="text-sm text-gray-400 font-600 mt-1">Preencha os campos abaixo</p>
    </div>

    <div class="bg-white/90 backdrop-blur-sm rounded-3xl shadow-xl shadow-pink-100 overflow-hidden border border-pink-100 fade-up">

      <div class="h-1.5 w-full" style="background:linear-gradient(90deg,#db2777 0%,#f472b6 50%,rgb(254,140,248) 100%);"></div>

      <form id="subjectForm" class="px-8 py-7 flex flex-col gap-5" novalidate>

        <div>
          <label class="block text-sm font-600 text-gray-700 mb-1.5">
            Matéria <span class="text-pink-500">*</span>
          </label>
          <select id="name" name="name" class="field-select">
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
          <div class="extra-field" id="extra-name">
            <input type="text" id="name_custom" placeholder="Digite o nome da matéria"
                   class="field-input mt-2">
          </div>
          <p class="err-msg" id="err-name">Selecione ou informe a matéria.</p>
        </div>

        <div>
          <label class="block text-sm font-600 text-gray-700 mb-1.5">
            Código <span class="text-pink-500">*</span>
          </label>
          <select id="abbreviation" name="abbreviation" class="field-select">
            <option value="">Selecione um código...</option>
            <optgroup label="── Ensino Médio ──">
              <option value="PORT">PORT — Português</option>
              <option value="LIT">LIT — Literatura</option>
              <option value="RED">RED — Redação</option>
              <option value="MAT">MAT — Matemática</option>
              <option value="FIS">FIS — Física</option>
              <option value="QUI">QUI — Química</option>
              <option value="BIO">BIO — Biologia</option>
              <option value="HIS">HIS — História</option>
              <option value="GEO">GEO — Geografia</option>
              <option value="FIL">FIL — Filosofia</option>
              <option value="SOC">SOC — Sociologia</option>
              <option value="ING">ING — Inglês</option>
              <option value="ESP">ESP — Espanhol</option>
              <option value="ART">ART — Arte</option>
              <option value="EDF">EDF — Educação Física</option>
              <option value="INF">INF — Informática</option>
            </optgroup>
            <optgroup label="── Ensino Superior ──">
              <option value="CAL1">CAL1 — Cálculo I</option>
              <option value="CAL2">CAL2 — Cálculo II</option>
              <option value="CAL3">CAL3 — Cálculo III</option>
              <option value="ALG">ALG — Álgebra Linear</option>
              <option value="FIS1">FIS1 — Física I</option>
              <option value="FIS2">FIS2 — Física II</option>
              <option value="QUIG">QUIG — Química Geral</option>
              <option value="BIOC">BIOC — Biologia Celular</option>
              <option value="PRG1">PRG1 — Programação I</option>
              <option value="PRG2">PRG2 — Programação II</option>
              <option value="ED">ED — Estrutura de Dados</option>
              <option value="BD">BD — Banco de Dados</option>
              <option value="RC">RC — Redes de Computadores</option>
              <option value="SO">SO — Sistemas Operacionais</option>
              <option value="ES">ES — Engenharia de Software</option>
              <option value="IA">IA — Inteligência Artificial</option>
              <option value="EST">EST — Estatística</option>
              <option value="PRB">PRB — Probabilidade</option>
              <option value="ADM">ADM — Administração</option>
              <option value="CONT">CONT — Contabilidade</option>
              <option value="DIR">DIR — Direito</option>
              <option value="ECO">ECO — Economia</option>
              <option value="MKT">MKT — Marketing</option>
            </optgroup>
            <option value="outro">Outro...</option>
          </select>
          <div class="extra-field" id="extra-abbreviation">
            <input type="text" id="abbreviation_custom" placeholder="Digite o código (ex: MAT201)"
                   class="field-input mt-2" style="text-transform:uppercase">
          </div>
          <p class="err-msg" id="err-abbreviation">Selecione ou informe o código.</p>
        </div>

        <div>
          <label class="block text-sm font-600 text-gray-700 mb-1.5">
            Professor <span class="text-pink-500">*</span>
          </label>
          <input type="text" id="teacher" name="teacher"
                 placeholder="Ex: Prof. João Silva"
                 class="field-input">
          <p class="err-msg" id="err-teacher">Informe o nome do professor.</p>
        </div>

        <div>
          <label class="block text-sm font-600 text-gray-700 mb-1.5">
            Semestre <span class="text-pink-500">*</span>
          </label>
          <select id="semester" name="semester" class="field-select">
            <option value="">Selecione o semestre...</option>
            <option value="1">1º Semestre</option>
            <option value="2">2º Semestre</option>
            <option value="3">3º Semestre</option>
            <option value="4">4º Semestre</option>
            <option value="5">5º Semestre</option>
            <option value="6">6º Semestre</option>
            <option value="7">7º Semestre</option>
            <option value="8">8º Semestre</option>
            <option value="9">9º Semestre</option>
            <option value="10">10º Semestre</option>
            <option value="outro">Outro...</option>
          </select>
          <div class="extra-field" id="extra-semester">
            <input type="number" id="semester_custom" placeholder="Digite o semestre (ex: 11)"
                   min="1" max="20" class="field-input mt-2">
          </div>
          <p class="err-msg" id="err-semester">Selecione ou informe o semestre.</p>
        </div>

        <hr class="border-gray-100">
        <div class="flex justify-end gap-2.5">
          <a href="{{ route('subject.index') }}"
             class="inline-flex items-center gap-1.5 border border-pink-200 hover:border-pink-300 text-pink-500 hover:text-pink-700 font-600 text-sm px-5 py-2.5 rounded-xl transition-colors">
            Cancelar
          </a>
          <button type="submit" id="submitBtn"
                  class="inline-flex items-center gap-1.5 bg-pink-600 hover:bg-pink-700 text-white font-800 text-sm px-6 py-2.5 rounded-xl shadow-lg shadow-pink-200 transition-all hover:-translate-y-0.5">
            <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                 stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round">
              <polyline points="20 6 9 17 4 12"/>
            </svg>
            <span id="btnLabel">Salvar matéria</span>
          </button>
        </div>

      </form>
    </div>

    <p class="text-center text-xs text-gray-300 font-600 mt-5">
      Campos com <span class="text-pink-400">*</span> são obrigatórios
    </p>

  </div>
</div>

<div class="toast hidden" id="toast">
  <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="#db2777"
       stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round">
    <polyline points="20 6 9 17 4 12"/>
  </svg>
  <div>
    <p class="text-gray-800 font-700 text-sm">Matéria cadastrada!</p>
    <p class="text-gray-400 text-xs">Redirecionando...</p>
  </div>
</div>

<script src="{{ asset('js/subject.js') }}"></script>

@endsection