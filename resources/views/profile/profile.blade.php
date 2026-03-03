@extends('layouts.app')

@section('content')

<div class="min-h-screen relative overflow-hidden bg-[#fdf4f8]">

  <div class="absolute inset-0 pointer-events-none" style="background-image:radial-gradient(circle,#f9a8d4 1.5px,transparent 1.5px);background-size:32px 32px;opacity:.35;"></div>
  <div class="absolute -top-24 -right-24 w-96 h-96 rounded-full pointer-events-none" style="background:radial-gradient(circle at 40% 40%,#f9a8d4 0%,#fce7f3 60%,transparent 80%);opacity:.6;"></div>
  <div class="absolute -bottom-16 -left-16 w-64 h-64 rounded-full pointer-events-none" style="background:radial-gradient(circle at 60% 60%,#fbcfe8 0%,transparent 70%);opacity:.5;"></div>

  <div class="relative z-10 max-w-4xl mx-auto px-6 py-10">

    <div class="mb-8">
      <p class="text-xs font-extrabold tracking-widest uppercase text-pink-400 mb-1">Minha conta</p>
      <h1 class="text-4xl font-black text-gray-900 leading-tight">Perfil</h1>
      <p class="text-sm text-gray-400 font-semibold mt-1">Gerencie suas informações e configurações</p>
    </div>

    <div class="mb-8">
      <div id="studentCard"
           class="relative w-full rounded-3xl overflow-hidden shadow-2xl shadow-pink-200 select-none"
           style="background: linear-gradient(135deg, #be185d 0%, #db2777 40%, #f472b6 100%); min-height: 220px;">

        <div class="absolute inset-0 opacity-10" style="background-image:repeating-linear-gradient(45deg,#ffffff 0,#ffffff 1px,transparent 0,transparent 50%);background-size:12px 12px;"></div>

        <div class="relative z-10 p-6 flex flex-col h-full" style="min-height:220px;">

          <div class="flex items-start justify-between mb-4">
            <div class="flex items-center gap-2">
              <div class="text-white">
                <svg width="48" height="28" viewBox="0 0 80 46" fill="none">
                  <circle cx="20" cy="23" r="20" fill="white" fill-opacity="0.9"/>
                  <circle cx="20" cy="23" r="12" fill="currentColor" opacity="0.7"/>
                  <rect x="44" y="3" width="36" height="40" rx="4" fill="white" fill-opacity="0.9"/>
                  <rect x="48" y="8" width="28" height="6" rx="2" fill="currentColor" opacity="0.6"/>
                  <rect x="48" y="18" width="20" height="4" rx="2" fill="currentColor" opacity="0.4"/>
                  <rect x="48" y="26" width="24" height="4" rx="2" fill="currentColor" opacity="0.4"/>
                </svg>
              </div>
              <div class="text-white">
                <p class="text-xl font-black leading-none" style="font-family:'Georgia',serif;">StudyLab</p>
                <p class="text-[9px] font-semibold opacity-80 tracking-wider uppercase">Carteira do Estudante</p>
              </div>
            </div>
            <div class="text-white font-black text-2xl" style="font-family:'Georgia',serif;">{{ date('Y') }}</div>
          </div>

          <div class="flex gap-5 flex-1">
            <div class="flex flex-col items-center gap-2">
              <div class="w-24 h-28 rounded-xl overflow-hidden border-2 border-white/60 shadow-lg bg-white/20 flex items-center justify-center" id="cardPhotoWrapper">
                <svg width="32" height="32" viewBox="0 0 24 24" fill="none" stroke="white" stroke-width="1.5">
                  <circle cx="12" cy="8" r="4"/><path d="M4 20c0-4 3.6-7 8-7s8 3 8 7"/>
                </svg>
              </div>
            </div>

            <div class="flex-1 flex flex-col justify-between">
              <div>
                <p class="text-white font-black text-lg leading-tight mb-2" id="cardName">SEU NOME</p>
                <div class="space-y-0.5 text-white/90 text-[11px]">
                  <p class="font-semibold">STUDYLAB ACADEMY</p>
                  <div class="mt-1.5 space-y-0.5">
                    <p><span class="font-black">EMAIL:</span> <span id="cardEmail" class="opacity-90">—</span></p>
                    <p><span class="font-black">MEMBRO DESDE:</span> <span id="cardSince">—</span></p>
                  </div>
                </div>
              </div>
              <div class="mt-2">
                <p class="text-white/60 text-[9px] uppercase tracking-widest">ID</p>
                <p class="text-white font-black text-sm tracking-widest" id="cardId">SL-000001</p>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">

      <div class="bg-white/90 backdrop-blur-sm rounded-3xl shadow-xl shadow-pink-100 overflow-hidden border border-pink-100">
        <div class="h-1.5 w-full" style="background:linear-gradient(90deg,#db2777 0%,#f472b6 50%,rgb(254,140,248) 100%);"></div>
        <div class="px-7 py-6">
          <div class="flex items-center gap-2.5 mb-4">
            <div class="w-9 h-9 rounded-xl bg-pink-50 flex items-center justify-center">
              <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="#db2777" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                <circle cx="12" cy="8" r="4"/><path d="M4 20c0-4 3.6-7 8-7s8 3 8 7"/>
              </svg>
            </div>
            <div>
              <p class="text-xs font-extrabold uppercase tracking-widest text-pink-400">Informações</p>
              <p class="font-bold text-gray-900 text-sm">Nome completo</p>
            </div>
          </div>
          <form id="nameForm" class="flex flex-col gap-3">
            <div>
              <input type="text" id="nameInput" placeholder="Seu nome completo" value=""
                     class="w-full border border-gray-200 rounded-xl px-4 py-2.5 text-sm text-gray-900 outline-none transition focus:border-pink-500 focus:ring-2 focus:ring-pink-100">
              <p class="hidden text-xs text-red-500 mt-1" id="err-name"></p>
            </div>
            <div class="flex justify-end">
              <button type="submit" class="flex items-center gap-1.5 bg-pink-600 hover:bg-pink-700 text-white font-extrabold text-xs px-5 py-2.5 rounded-xl shadow-md shadow-pink-200 transition-all hover:-translate-y-0.5">
                <svg width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><polyline points="20 6 9 17 4 12"/></svg>
                Salvar nome
              </button>
            </div>
          </form>
        </div>
      </div>

      <div class="bg-white/90 backdrop-blur-sm rounded-3xl shadow-xl shadow-pink-100 overflow-hidden border border-pink-100">
        <div class="h-1.5 w-full" style="background:linear-gradient(90deg,#db2777 0%,#f472b6 50%,rgb(254,140,248) 100%);"></div>
        <div class="px-7 py-6">
          <div class="flex items-center gap-2.5 mb-4">
            <div class="w-9 h-9 rounded-xl bg-pink-50 flex items-center justify-center">
              <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="#db2777" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                <rect x="2" y="4" width="20" height="16" rx="2"/><path d="m2 7 10 7 10-7"/>
              </svg>
            </div>
            <div>
              <p class="text-xs font-extrabold uppercase tracking-widest text-pink-400">Conta</p>
              <p class="font-bold text-gray-900 text-sm">Endereço de e-mail</p>
            </div>
          </div>
          <form id="emailForm" class="flex flex-col gap-3">
            <div>
              <input type="email" id="emailInput" placeholder="seu@email.com" value=""
                     class="w-full border border-gray-200 rounded-xl px-4 py-2.5 text-sm text-gray-900 outline-none transition focus:border-pink-500 focus:ring-2 focus:ring-pink-100">
              <p class="hidden text-xs text-red-500 mt-1" id="err-email"></p>
            </div>
            <div class="flex justify-end">
              <button type="submit" class="flex items-center gap-1.5 bg-pink-600 hover:bg-pink-700 text-white font-extrabold text-xs px-5 py-2.5 rounded-xl shadow-md shadow-pink-200 transition-all hover:-translate-y-0.5">
                <svg width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><polyline points="20 6 9 17 4 12"/></svg>
                Salvar e-mail
              </button>
            </div>
          </form>
        </div>
      </div>

      <div class="bg-white/90 backdrop-blur-sm rounded-3xl shadow-xl shadow-pink-100 overflow-hidden border border-pink-100">
        <div class="h-1.5 w-full" style="background:linear-gradient(90deg,#db2777 0%,#f472b6 50%,rgb(254,140,248) 100%);"></div>
        <div class="px-7 py-6">
          <div class="flex items-center gap-2.5 mb-4">
            <div class="w-9 h-9 rounded-xl bg-pink-50 flex items-center justify-center">
              <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="#db2777" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                <rect x="3" y="11" width="18" height="11" rx="2"/><path d="M7 11V7a5 5 0 0110 0v4"/>
              </svg>
            </div>
            <div>
              <p class="text-xs font-extrabold uppercase tracking-widest text-pink-400">Segurança</p>
              <p class="font-bold text-gray-900 text-sm">Alterar senha</p>
            </div>
          </div>
          <form id="passwordForm" class="flex flex-col gap-3">
            <input type="password" id="currentPassword" placeholder="Senha atual"
                   class="w-full border border-gray-200 rounded-xl px-4 py-2.5 text-sm text-gray-900 outline-none transition focus:border-pink-500 focus:ring-2 focus:ring-pink-100">
            <input type="password" id="newPassword" placeholder="Nova senha"
                   class="w-full border border-gray-200 rounded-xl px-4 py-2.5 text-sm text-gray-900 outline-none transition focus:border-pink-500 focus:ring-2 focus:ring-pink-100">
            <div>
              <input type="password" id="confirmPassword" placeholder="Confirmar nova senha"
                     class="w-full border border-gray-200 rounded-xl px-4 py-2.5 text-sm text-gray-900 outline-none transition focus:border-pink-500 focus:ring-2 focus:ring-pink-100">
              <p class="hidden text-xs text-red-500 mt-1" id="err-password"></p>
            </div>
            <div class="flex justify-end">
              <button type="submit" class="flex items-center gap-1.5 bg-pink-600 hover:bg-pink-700 text-white font-extrabold text-xs px-5 py-2.5 rounded-xl shadow-md shadow-pink-200 transition-all hover:-translate-y-0.5">
                <svg width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><polyline points="20 6 9 17 4 12"/></svg>
                Alterar senha
              </button>
            </div>
          </form>
        </div>
      </div>

      <div class="bg-white/90 backdrop-blur-sm rounded-3xl shadow-xl shadow-pink-100 overflow-hidden border border-pink-100">
        <div class="h-1.5 w-full" style="background:linear-gradient(90deg,#db2777 0%,#f472b6 50%,rgb(254,140,248) 100%);"></div>
        <div class="px-7 py-6">
          <div class="flex items-center gap-2.5 mb-4">
            <div class="w-9 h-9 rounded-xl bg-pink-50 flex items-center justify-center">
              <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="#db2777" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                <path d="M23 19a2 2 0 01-2 2H3a2 2 0 01-2-2V8a2 2 0 012-2h4l2-3h6l2 3h4a2 2 0 012 2z"/><circle cx="12" cy="13" r="4"/>
              </svg>
            </div>
            <div>
              <p class="text-xs font-extrabold uppercase tracking-widest text-pink-400">Aparência</p>
              <p class="font-bold text-gray-900 text-sm">Foto do perfil</p>
            </div>
          </div>
          <div class="flex items-center gap-4">
            <div class="w-16 h-16 rounded-2xl overflow-hidden border-2 border-pink-100 bg-pink-50 flex items-center justify-center flex-shrink-0" id="photoPreviewWrapper">
              <svg width="28" height="28" viewBox="0 0 24 24" fill="none" stroke="#f9a8d4" stroke-width="1.5"><circle cx="12" cy="8" r="4"/><path d="M4 20c0-4 3.6-7 8-7s8 3 8 7"/></svg>
            </div>
            <div class="flex-1">
              <label for="photoInput" class="flex items-center justify-center gap-2 w-full border-2 border-dashed border-pink-200 hover:border-pink-400 text-pink-500 hover:text-pink-700 font-semibold text-xs px-4 py-3 rounded-xl transition-colors cursor-pointer">
                <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                  <path d="M21 15v4a2 2 0 01-2 2H5a2 2 0 01-2-2v-4"/><polyline points="17 8 12 3 7 8"/><line x1="12" y1="3" x2="12" y2="15"/>
                </svg>
                Escolher foto
              </label>
              <input type="file" id="photoInput" accept="image/*" class="hidden">
              <p class="text-xs text-gray-400 mt-1.5 text-center">JPG, PNG — máx. 2MB</p>
            </div>
          </div>
          <div class="flex justify-end mt-4">
            <button id="savePhotoBtn" type="button" disabled
                    class="flex items-center gap-1.5 bg-pink-600 disabled:opacity-40 hover:bg-pink-700 text-white font-extrabold text-xs px-5 py-2.5 rounded-xl shadow-md shadow-pink-200 transition-all hover:-translate-y-0.5">
              <svg width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><polyline points="20 6 9 17 4 12"/></svg>
              Salvar foto
            </button>
          </div>
        </div>
      </div>

    </div>

    <div class="mt-6 grid grid-cols-1 md:grid-cols-2 gap-6">

      <div class="bg-white/90 backdrop-blur-sm rounded-3xl shadow-xl shadow-pink-100 overflow-hidden border border-pink-100">
        <div class="h-1.5 w-full" style="background:linear-gradient(90deg,#db2777 0%,#f472b6 50%,rgb(254,140,248) 100%);"></div>
        <div class="px-7 py-6 flex items-center justify-between">
          <div class="flex items-center gap-3">
            <div class="w-9 h-9 rounded-xl bg-gray-50 flex items-center justify-center">
              <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="#94a3b8" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                <path d="M9 21H5a2 2 0 01-2-2V5a2 2 0 012-2h4"/><polyline points="16 17 21 12 16 7"/><line x1="21" y1="12" x2="9" y2="12"/>
              </svg>
            </div>
            <div>
              <p class="font-bold text-gray-900 text-sm">Sair da conta</p>
              <p class="text-xs text-gray-400">Encerrar sessão atual</p>
            </div>
          </div>
          <button id="logoutBtn" type="button"
                  class="border border-gray-200 hover:border-gray-300 text-gray-600 hover:text-gray-800 font-bold text-xs px-5 py-2.5 rounded-xl transition-colors">
            Logout
          </button>
        </div>
      </div>

      <div class="bg-white/90 backdrop-blur-sm rounded-3xl shadow-xl shadow-red-100 overflow-hidden border border-red-100">
        <div class="h-1.5 w-full bg-red-400"></div>
        <div class="px-7 py-6 flex items-center justify-between">
          <div class="flex items-center gap-3">
            <div class="w-9 h-9 rounded-xl bg-red-50 flex items-center justify-center">
              <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="#ef4444" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                <polyline points="3 6 5 6 21 6"/><path d="M19 6l-1 14H6L5 6"/><path d="M10 11v6M14 11v6"/><path d="M9 6V4h6v2"/>
              </svg>
            </div>
            <div>
              <p class="font-bold text-red-600 text-sm">Excluir conta</p>
              <p class="text-xs text-gray-400">Ação permanente e irreversível</p>
            </div>
          </div>
          <button type="button" id="deleteAccountBtn"
                  class="border border-red-200 hover:border-red-400 text-red-500 hover:text-red-700 font-bold text-xs px-5 py-2.5 rounded-xl transition-colors">
            Excluir
          </button>
        </div>
      </div>

    </div>
  </div>
</div>

<div class="hidden fixed inset-0 bg-black/35 backdrop-blur-sm flex items-center justify-center z-50" id="deleteModal">
  <div class="bg-white rounded-2xl p-8 max-w-sm w-[90%] shadow-2xl">
    <div class="w-12 h-12 rounded-2xl bg-red-50 flex items-center justify-center mb-4">
      <svg width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="#ef4444" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
        <polyline points="3 6 5 6 21 6"/><path d="M19 6l-1 14H6L5 6"/><path d="M10 11v6M14 11v6"/><path d="M9 6V4h6v2"/>
      </svg>
    </div>
    <h3 class="text-lg font-bold text-gray-900 mb-1">Excluir conta</h3>
    <p class="text-sm text-gray-500 mb-4">Digite sua senha para confirmar. Essa ação é permanente.</p>
    <input type="password" id="deletePasswordInput" placeholder="Sua senha atual"
           class="w-full border border-gray-200 rounded-xl px-4 py-2.5 text-sm text-gray-900 outline-none transition focus:border-red-400 focus:ring-2 focus:ring-red-100 mb-4">
    <div class="flex gap-2.5 justify-end">
      <button id="cancelDelete" class="border border-gray-200 hover:border-gray-300 text-gray-600 font-semibold text-sm px-4 py-2 rounded-xl transition-colors">Cancelar</button>
      <button id="confirmDelete" class="bg-red-500 hover:bg-red-600 text-white font-bold text-sm px-5 py-2 rounded-xl transition-colors">Confirmar exclusão</button>
    </div>
  </div>
</div>

<div class="hidden fixed bottom-6 right-6 bg-white border border-gray-200 border-l-[3px] border-l-pink-600 rounded-xl shadow-xl px-5 py-3.5 flex items-center gap-3 z-50" id="toast">
  <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="#db2777" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><polyline points="20 6 9 17 4 12"/></svg>
  <div>
    <p class="text-gray-800 font-bold text-sm" id="toastMsg">Salvo com sucesso!</p>
    <p class="text-gray-400 text-xs">Carteira atualizada.</p>
  </div>
</div>

<script src="{{ asset('js/profile.js') }}"></script>
@endsection