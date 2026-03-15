@extends('layouts.app')

@section('content')

<div class="min-h-screen relative overflow-hidden bg-[#fdf4f8] dark:bg-[#121212] transition-colors duration-200" style="font-family:'DM Sans',sans-serif;">
  <div class="absolute inset-0 pointer-events-none" style="background-image:radial-gradient(circle,#f9a8d4 1.5px,transparent 1.5px);background-size:32px 32px;opacity:.35;"></div>
  <div class="absolute -top-24 -right-24 w-96 h-96 rounded-full pointer-events-none" style="background:radial-gradient(circle at 40% 40%,#f9a8d4 0%,#fce7f3 60%,transparent 80%);opacity:.6;"></div>
  <div class="absolute -bottom-16 -left-16 w-64 h-64 rounded-full pointer-events-none" style="background:radial-gradient(circle at 60% 60%,#fbcfe8 0%,transparent 70%);opacity:.5;"></div>

  <div class="relative z-10 max-w-2xl mx-auto px-6 py-10">

    <div class="mb-8">
      <a href="{{ route('activity.index') }}"
         class="inline-flex items-center gap-1.5 text-pink-500 hover:text-pink-700 text-sm font-semibold mb-5 transition-colors">
        <svg width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round">
          <polyline points="15 18 9 12 15 6"/>
        </svg>
        Voltar para atividades
      </a>
      <p class="text-[10px] font-black tracking-widest uppercase text-pink-400 mb-1">Editar atividade</p>
      <h1 class="text-4xl font-black text-gray-900 dark:text-gray-100 leading-tight" style="font-family:'Syne',sans-serif;">Editar Atividade</h1>
      <p class="text-sm text-gray-400 font-semibold mt-1">Altere os campos abaixo</p>
    </div>

    <div class="bg-white/90 dark:bg-[#18181b]/95 backdrop-blur-sm rounded-3xl shadow-xl shadow-pink-100 dark:shadow-none overflow-hidden border border-pink-100 dark:border-gray-800 fade-up transition-colors duration-200" style="animation-delay:.1s">
      <div class="h-1.5 w-full" style="background:linear-gradient(90deg,#db2777 0%,#f472b6 50%,rgb(254,140,248) 100%);"></div>

      <form id="activityForm" class="px-8 py-7 flex flex-col gap-5" novalidate
            data-id="{{ $activity->id }}"
            data-description="{{ $activity->description }}"
            data-due_date="{{ \Carbon\Carbon::parse($activity->due_date)->format('Y-m-d') }}"
            data-status="{{ $activity->status }}">

        <div>
          <label class="block text-sm font-semibold text-gray-700 dark:text-gray-300 mb-1.5">
            Descrição da atividade <span class="text-pink-500">*</span>
          </label>
          <textarea id="description" name="description" rows="3" maxlength="500"
                    placeholder="Ex: Resolver lista de exercícios..."
                    class="w-full border border-gray-200 dark:border-gray-700 rounded-lg px-3.5 py-2.5 text-sm text-gray-900 dark:text-gray-100 bg-white dark:bg-[#18181b] outline-none transition focus:border-pink-500 dark:focus:border-pink-500 focus:ring-2 focus:ring-pink-100 dark:focus:ring-pink-900/30 placeholder:text-gray-400 resize-none">{{ $activity->description }}</textarea>
          <div class="flex justify-between items-center mt-1">
            <p class="hidden text-xs font-medium text-red-500" id="err-description">Informe a descrição.</p>
            <p class="text-xs text-gray-400 ml-auto" id="charCounter">0 / 500</p>
          </div>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
          <div>
            <label class="block text-sm font-semibold text-gray-700 dark:text-gray-300 mb-1.5">
              Data de entrega <span class="text-pink-500">*</span>
            </label>
            <select id="due_date_quick"
                    class="w-full border border-gray-200 dark:border-gray-700 rounded-lg px-3.5 py-2.5 text-sm text-gray-900 dark:text-gray-100 bg-white dark:bg-[#18181b] outline-none appearance-none transition focus:border-pink-500 dark:focus:border-pink-500 focus:ring-2 focus:ring-pink-100 dark:focus:ring-pink-900/30 mb-2"
                    style="background-image:url(\"data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='12' height='12' viewBox='0 0 24 24' fill='none' stroke='%2394a3b8' stroke-width='2.5' stroke-linecap='round' stroke-linejoin='round'%3E%3Cpolyline points='6 9 12 15 18 9'/%3E%3C/svg%3E\");background-repeat:no-repeat;background-position:right 12px center;padding-right:2.2rem;">
              <option value="">Atalho rápido...</option>
              <option value="hoje">Hoje</option>
              <option value="amanha">Amanhã</option>
              <option value="3dias">Em 3 dias</option>
              <option value="1semana">Em 1 semana</option>
              <option value="2semanas">Em 2 semanas</option>
              <option value="1mes">Em 1 mês</option>
              <option value="custom">Escolher data...</option>
            </select>
            <input type="date" id="due_date" name="due_date" value="{{ \Carbon\Carbon::parse($activity->due_date)->format('Y-m-d') }}"
                   class="w-full border border-gray-200 dark:border-gray-700 rounded-lg px-3.5 py-2.5 text-sm text-gray-900 dark:text-gray-100 bg-white dark:bg-[#18181b] outline-none transition focus:border-pink-500 dark:focus:border-pink-500 focus:ring-2 focus:ring-pink-100 dark:focus:ring-pink-900/30 font-sans scheme-light dark:scheme-dark">
            <p class="hidden text-xs font-medium text-red-500 mt-1" id="err-due_date">Informe a data de vencimento.</p>
          </div>

          <div>
            <label class="block text-sm font-semibold text-gray-700 dark:text-gray-300 mb-1.5">
              Status <span class="text-pink-500">*</span>
            </label>
            <select id="status" name="status"
                    class="w-full border border-gray-200 dark:border-gray-700 rounded-lg px-3.5 py-2.5 text-sm font-medium text-gray-900 dark:text-gray-100 bg-white dark:bg-[#18181b] outline-none appearance-none transition focus:border-pink-500 dark:focus:border-pink-500 focus:ring-2 focus:ring-pink-100 dark:focus:ring-pink-900/30 cursor-pointer"
                    style="background-image:url(\"data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='12' height='12' viewBox='0 0 24 24' fill='none' stroke='%2394a3b8' stroke-width='2.5' stroke-linecap='round' stroke-linejoin='round'%3E%3Cpolyline points='6 9 12 15 18 9'/%3E%3C/svg%3E\");background-repeat:no-repeat;background-position:right 12px center;padding-right:2.2rem;">
              <option value="">Selecione o status...</option>
              <option value="pending">⏳ Pendente</option>
              <option value="in_progress">🔄 Em andamento</option>
              <option value="completed">✅ Concluída</option>
            </select>
            <p class="hidden text-xs font-medium text-red-500 mt-1" id="err-status">Selecione o status.</p>
          </div>
        </div>

        <hr class="border-gray-100 dark:border-gray-800">

        <div class="flex items-center justify-between gap-2">
          <button type="button" id="deleteBtn"
                  class="inline-flex items-center gap-1.5 border border-red-200 dark:border-red-900/30 hover:bg-red-50 dark:hover:bg-red-900/20 text-red-500 font-bold text-sm px-4 py-2.5 rounded-xl transition-colors">
            <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
              <polyline points="3 6 5 6 21 6"/>
              <path d="M19 6l-1 14H6L5 6"/><path d="M10 11v6M14 11v6"/><path d="M9 6V4h6v2"/>
            </svg>
            Excluir atividade
          </button>
          <div class="flex gap-2">
            <a href="{{ route('activity.index') }}"
               class="inline-flex items-center gap-1.5 border border-pink-200 dark:border-gray-700 hover:border-pink-300 dark:hover:border-gray-600 text-pink-500 dark:text-gray-300 hover:text-pink-700 font-bold text-sm px-5 py-2.5 rounded-xl transition-colors">
              Cancelar
            </a>
            <button type="submit" id="submitBtn"
                    class="inline-flex items-center gap-1.5 bg-pink-600 hover:bg-pink-700 text-white font-extrabold text-sm px-6 py-2.5 rounded-xl shadow-lg shadow-pink-200 transition-all hover:-translate-y-0.5">
              <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round">
                <polyline points="20 6 9 17 4 12"/>
              </svg>
              <span id="btnLabel">Salvar alterações</span>
            </button>
          </div>
        </div>

      </form>
    </div>

    <p class="text-center text-xs text-gray-300 font-semibold mt-5">
      Campos com <span class="text-pink-400">*</span> são obrigatórios
    </p>

  </div>
</div>

<div id="deleteModal" class="hidden fixed inset-0 bg-black/30 backdrop-blur-sm z-50 items-center justify-center p-4">
  <div class="bg-white dark:bg-[#18181b] rounded-2xl shadow-2xl w-full max-w-sm overflow-hidden border border-transparent dark:border-gray-800">
    <div class="h-1 bg-linear-to-r from-red-500 to-rose-400"></div>
    <div class="p-8">
      <div class="w-12 h-12 rounded-2xl bg-red-50 flex items-center justify-center mb-4">
        <svg width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="#ef4444" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
          <polyline points="3 6 5 6 21 6"/>
          <path d="M19 6l-1 14H6L5 6"/><path d="M10 11v6M14 11v6"/><path d="M9 6V4h6v2"/>
        </svg>
      </div>
      <h3 class="text-lg font-bold text-gray-900 dark:text-gray-100 mb-1">Excluir atividade</h3>
      <p class="text-sm text-gray-500 dark:text-gray-400 mb-6">Tem certeza? Essa ação não pode ser desfeita.</p>
      <div class="flex gap-2 justify-end">
        <button id="cancelDelete" class="border border-gray-200 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-800 text-gray-600 dark:text-gray-300 font-bold text-sm px-5 py-2.5 rounded-xl transition-colors">Cancelar</button>
        <button id="confirmDelete" class="bg-red-500 hover:bg-red-600 text-white font-black text-sm px-5 py-2.5 rounded-xl transition-colors shadow-sm shadow-red-200 dark:shadow-none">Sim, excluir</button>
      </div>
    </div>
  </div>
</div>

<div id="toast"
    class="hidden fixed bottom-6 right-6 items-center gap-3 bg-white dark:bg-[#18181b] border border-gray-100 dark:border-gray-800 border-l-4 border-l-pink-500 rounded-xl shadow-lg px-5 py-3.5 z-50">
    <svg width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="#db2777" stroke-width="2.5"
        stroke-linecap="round" stroke-linejoin="round">
    <polyline points="20 6 9 17 4 12"/>
  </svg>
    <div>
        <p class="text-gray-800 dark:text-gray-100 font-bold text-sm">Atividade atualizada!</p>
        <p class="text-gray-400 text-xs">Redirecionando...</p>
    </div>
</div>

<script src="{{ asset('js/activity.js') }}"></script>

@endsection