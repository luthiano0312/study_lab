@extends('layouts.app')

@section('content')


<div class="min-h-screen relative overflow-hidden bg-[#fdf4f8]">

  <div class="absolute inset-0 pointer-events-none" style="background-image:radial-gradient(circle,#f9a8d4 1.5px,transparent 1.5px);background-size:32px 32px;opacity:.35;"></div>
  <div class="absolute -top-24 -right-24 w-96 h-96 rounded-full pointer-events-none" style="background:radial-gradient(circle at 40% 40%,#f9a8d4 0%,#fce7f3 60%,transparent 80%);opacity:.6;"></div>
  <div class="absolute -bottom-16 -left-16 w-64 h-64 rounded-full pointer-events-none" style="background:radial-gradient(circle at 60% 60%,#fbcfe8 0%,transparent 70%);opacity:.5;"></div>

  <div class="relative z-10 max-w-5xl mx-auto px-6 py-10">

    <div class="flex items-end justify-between mb-8">
      <div>
        <p class="text-xs font-extrabold tracking-widest uppercase text-pink-400 mb-1">Painel acadêmico</p>
        <h1 class="text-4xl font-black text-gray-900 leading-tight">Atividades</h1>
        <p class="text-sm text-gray-400 font-semibold mt-1">Gerencie suas atividades e prazos</p>
      </div>
      <a href="{{ route('activity.create') }}"
         class="flex items-center gap-2 bg-pink-600 hover:bg-pink-700 text-white text-sm font-extrabold px-5 py-3 rounded-2xl shadow-lg shadow-pink-200 transition-all hover:-translate-y-0.5">
        <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="3" stroke-linecap="round" stroke-linejoin="round">
          <line x1="12" y1="5" x2="12" y2="19"/><line x1="5" y1="12" x2="19" y2="12"/>
        </svg>
        Nova atividade
      </a>
    </div>

    <div class="flex flex-wrap gap-3 mb-6">
      <div class="bg-white/80 backdrop-blur-sm rounded-2xl px-5 py-3 shadow-sm border border-pink-100 flex items-center gap-3">
        <div class="w-9 h-9 rounded-xl bg-pink-100 flex items-center justify-center text-lg">📋</div>
        <div>
          <p class="text-xs text-gray-400 font-semibold">Total</p>
          <p class="text-xl font-black text-gray-900" id="totalCount">—</p>
        </div>
      </div>
      <div class="bg-white/80 backdrop-blur-sm rounded-2xl px-5 py-3 shadow-sm border border-pink-100 flex items-center gap-3">
        <div class="w-9 h-9 rounded-xl bg-yellow-100 flex items-center justify-center text-lg">⏳</div>
        <div>
          <p class="text-xs text-gray-400 font-semibold">Pendentes</p>
          <p class="text-xl font-black text-gray-900" id="pendingCount">—</p>
        </div>
      </div>
      <div class="bg-white/80 backdrop-blur-sm rounded-2xl px-5 py-3 shadow-sm border border-pink-100 flex items-center gap-3">
        <div class="w-9 h-9 rounded-xl bg-blue-100 flex items-center justify-center text-lg">🔄</div>
        <div>
          <p class="text-xs text-gray-400 font-semibold">Em andamento</p>
          <p class="text-xl font-black text-gray-900" id="progressCount">—</p>
        </div>
      </div>
      <div class="bg-white/80 backdrop-blur-sm rounded-2xl px-5 py-3 shadow-sm border border-pink-100 flex items-center gap-3">
        <div class="w-9 h-9 rounded-xl bg-green-100 flex items-center justify-center text-lg">✅</div>
        <div>
          <p class="text-xs text-gray-400 font-semibold">Concluídas</p>
          <p class="text-xl font-black text-gray-900" id="completedCount">—</p>
        </div>
      </div>
    </div>

    <div class="bg-white/90 backdrop-blur-sm rounded-3xl shadow-xl shadow-pink-100 overflow-hidden border border-pink-100">
      <div class="h-1.5 w-full" style="background:linear-gradient(90deg,#db2777 0%,#f472b6 50%,rgb(254,140,248) 100%);"></div>
      <table class="w-full border-collapse">
        <thead>
          <tr class="border-b border-gray-200">
            <th class="px-6 py-4 text-left   text-xs font-extrabold uppercase tracking-wider text-gray-400">Descrição</th>
            <th class="px-4 py-4 text-center text-xs font-extrabold uppercase tracking-wider text-gray-400">Vencimento</th>
            <th class="px-4 py-4 text-center text-xs font-extrabold uppercase tracking-wider text-gray-400">Status</th>
            <th class="px-4 py-4 text-center text-xs font-extrabold uppercase tracking-wider text-gray-400">Ações</th>
          </tr>
        </thead>
        <tbody id="activitiesTable">
          @for ($i = 0; $i < 4; $i++)
          <tr class="border-b border-gray-50">
            <td class="px-6 py-4"><div class="skel" style="width:70%;"></div></td>
            <td class="px-4 py-4"><div class="skel" style="width:80px;margin:0 auto;"></div></td>
            <td class="px-4 py-4"><div class="skel" style="width:90px;height:22px;border-radius:20px;margin:0 auto;"></div></td>
            <td class="px-4 py-4"><div class="skel" style="width:110px;height:28px;border-radius:10px;margin:0 auto;"></div></td>
          </tr>
          @endfor
        </tbody>
      </table>
      <div class="px-6 py-3 bg-pink-50/50 border-t border-pink-100 flex items-center justify-between">
        <p class="text-xs text-gray-400 font-semibold">StudyLab • Atividades</p>
        <div class="flex gap-1">
          <span class="w-2 h-2 rounded-full bg-pink-300 inline-block"></span>
          <span class="w-2 h-2 rounded-full bg-pink-200 inline-block"></span>
          <span class="w-2 h-2 rounded-full bg-pink-100 inline-block"></span>
        </div>
      </div>
    </div>

  </div>
</div>

<div class="hidden fixed inset-0 bg-black/35 backdrop-blur-sm flex items-center justify-center z-50" id="deleteModal">
  <div class="bg-white rounded-2xl p-8 max-w-sm w-[90%] shadow-2xl">
    <div class="w-12 h-12 rounded-2xl bg-red-50 flex items-center justify-center mb-4">
      <svg width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="#ef4444" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
        <polyline points="3 6 5 6 21 6"/>
        <path d="M19 6l-1 14H6L5 6"/><path d="M10 11v6M14 11v6"/><path d="M9 6V4h6v2"/>
      </svg>
    </div>
    <h3 class="text-lg font-bold text-gray-900 mb-1">Excluir atividade</h3>
    <p class="text-sm text-gray-500 mb-6">Tem certeza? Essa ação não pode ser desfeita.</p>
    <div class="flex gap-2.5 justify-end">
      <button id="cancelDelete" class="border border-gray-200 hover:border-gray-300 text-gray-600 font-semibold text-sm px-4 py-2 rounded-xl transition-colors">Cancelar</button>
      <button id="confirmDelete" class="bg-red-500 hover:bg-red-600 text-white font-bold text-sm px-5 py-2 rounded-xl transition-colors">Sim, excluir</button>
    </div>
  </div>
</div>

<div class="hidden fixed bottom-6 right-6 bg-white border border-gray-200 border-l-[3px] border-l-pink-600 rounded-xl shadow-xl px-5 py-3.5 flex items-center gap-3 z-50" id="toast">
  <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="#db2777" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round">
    <polyline points="20 6 9 17 4 12"/>
  </svg>
  <div>
    <p class="text-gray-800 font-bold text-sm">Atividade excluída!</p>
    <p class="text-gray-400 text-xs">Lista atualizada.</p>
  </div>
</div>

<script>
  const deleteIcon = "{{ asset('favicons/delete_24dp_000000_FILL0_wght400_GRAD0_opsz24.png') }}";
  const editIcon   = "{{ asset('favicons/edit_24dp_000000_FILL0_wght400_GRAD0_opsz24.png') }}";
</script>
<script src="{{ asset('js/activity.js') }}"></script>

@endsection