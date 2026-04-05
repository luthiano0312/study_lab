@extends('layouts.app')

@section('content')
  <link rel="stylesheet" href="{{ asset('css/profile.css') }}">
  <div class="profile-page min-h-screen relative overflow-hidden">

    <div class="absolute inset-0 z-0 pointer-events-none overflow-hidden">
      <div class="profile-glow-top absolute top-0 left-0 w-full h-full"></div>
      <div class="profile-glow-bot absolute bottom-0 right-0 w-full h-full"></div>
      <div class="profile-glow-mid absolute inset-0 w-full h-full"></div>

      <div class="blob-drift blob-light-1 absolute -top-24 -left-24 w-[420px] h-[420px]" style="animation-delay:0s;">
      </div>
      <div class="blob-drift blob-light-2 absolute top-1/3 -right-20 w-[300px] h-[300px]"
        style="animation-delay:2s;animation-duration:10s;"></div>
      <div class="blob-drift blob-light-3 absolute -bottom-16 left-1/3 w-[260px] h-[260px]"
        style="animation-delay:1s;animation-duration:9s;"></div>

      <svg class="absolute inset-0 w-full h-full opacity-[.2]" preserveAspectRatio="xMidYMid slice">
        <path stroke-dasharray="900" stroke-dashoffset="900" stroke="#db2777" stroke-width="1.5" fill="none"
          stroke-linecap="round" d="M-60 650 Q180 550 420 610 Q660 670 900 560 Q1140 450 1500 530">
          <animate attributeName="stroke-dashoffset" from="900" to="0" dur="4s" begin="0.5s" fill="freeze" />
        </path>
        <path stroke-dasharray="900" stroke-dashoffset="900" stroke="rgba(219,39,119,.5)" stroke-width="1" fill="none"
          stroke-linecap="round" d="M-60 380 Q140 310 340 350 Q540 390 760 300 Q980 210 1500 280">
          <animate attributeName="stroke-dashoffset" from="900" to="0" dur="4s" begin="1.5s" fill="freeze" />
        </path>
      </svg>

      <div class="spin-cw absolute opacity-[.06]" style="top:4%;right:16%;">
        <svg width="120" height="120" viewBox="0 0 120 120" fill="none">
          <circle cx="60" cy="60" r="52" stroke="#db2777" stroke-width="5" stroke-dasharray="16 9" />
        </svg>
      </div>
      <div class="spin-ccw absolute opacity-[.05]" style="bottom:8%;left:18%;">
        <svg width="88" height="88" viewBox="0 0 88 88" fill="none">
          <circle cx="44" cy="44" r="38" stroke="#f472b6" stroke-width="4" stroke-dasharray="11 7" />
        </svg>
      </div>

      <div class="dot-drift absolute opacity-55" style="top:16%;left:7%;animation-delay:.4s;">
        <svg width="22" height="22" viewBox="0 0 22 22" fill="none">
          <path d="M11 2L13 7.8L19 11L13 14.2L11 20L9 14.2L3 11L9 7.8Z" fill="#f472b6" opacity=".65" />
        </svg>
      </div>
      <div class="dot-drift absolute opacity-45" style="bottom:28%;right:6%;animation-delay:1.2s;">
        <svg width="14" height="14" viewBox="0 0 14 14" fill="none">
          <path d="M7 1L8.4 5.4L13 7L8.4 8.6L7 13L5.6 8.6L1 7L5.6 5.4Z" fill="#db2777" opacity=".55" />
        </svg>
      </div>
      <div class="dot-drift absolute opacity-50" style="top:60%;left:4%;animation-delay:.8s;">
        <svg width="11" height="11" viewBox="0 0 11 11" fill="none">
          <path d="M5.5 1L6.5 4.2L10 5.5L6.5 6.8L5.5 10L4.5 6.8L1 5.5L4.5 4.2Z" fill="#fbbf24" opacity=".7" />
        </svg>
      </div>

      <div class="animate-pulse absolute w-2.5 h-2.5 rounded-full bg-pink-300 opacity-60" style="top:24%;left:5%;"></div>
      <div class="animate-pulse absolute w-2 h-2 rounded-full bg-violet-300 opacity-50"
        style="top:70%;left:32%;animation-delay:.8s;"></div>
      <div class="animate-pulse absolute w-2 h-2 rounded-full bg-pink-400 opacity-45"
        style="top:18%;right:8%;animation-delay:1.5s;"></div>
      <div class="animate-pulse absolute w-1.5 h-1.5 rounded-full bg-yellow-300 opacity-55"
        style="bottom:20%;left:26%;animation-delay:.3s;"></div>
    </div>

    <div class="relative z-10 max-w-6xl mx-auto px-6 py-12">

      {{-- header --}}
      <header class="mb-12 flex justify-between items-end">
        <div>
          <div class="flex items-center gap-2 mb-2">
            <span class="w-2 h-2 rounded-full bg-pink-500 animate-pulse"></span>
            <span class="text-[10px] font-black uppercase tracking-[0.3em] text-pink-500/80">Central do Aluno</span>
          </div>
          <h1 class="text-4xl font-black tracking-tight" style="color:inherit">Meu Perfil</h1>
        </div>
        <div class="hidden md:block">
          <div class="px-4 py-2 rounded-xl profile-card-bg border backdrop-blur-md">
            <span class="profile-label text-xs font-bold uppercase tracking-widest">Nível: </span>
            <span class="text-pink-500 font-black">--</span>
          </div>
        </div>
      </header>

      <div class="grid grid-cols-1 lg:grid-cols-12 gap-12 items-start">

        {{-- COLUNA ESQUERDA: CARTEIRA --}}
        <div class="lg:col-span-5 flex flex-col items-center">
          <div class="relative perspective-1000 w-full flex justify-center mb-8">
            <div class="absolute inset-0 pointer-events-none">
              <div class="animate-particle absolute top-10 left-10 w-2 h-2 bg-pink-500 rounded-full blur-[1px]"
                style="--duration:5s"></div>
              <div class="animate-particle absolute bottom-20 right-10 w-3 h-3 bg-violet-500 rounded-full blur-[2px]"
                style="--duration:7s;animation-delay:1s"></div>
            </div>

            <div id="studentCard"
              class="transition-all hover:rotate-x-6 hover:rotate-y-[-6deg] duration-700 ease-out group relative z-10 w-[320px] sm:w-[350px] h-[480px] rounded-[3rem] p-[2px] shadow-2xl shadow-black/30 cursor-pointer"
              style="background:linear-gradient(135deg,#be185d,#db2777,#f472b6);">

              <div id="cardInner"
                class="relative h-full w-full rounded-[2.9rem] overflow-hidden flex flex-col items-center p-8 border border-white/5"
                style="background:rgba(13,13,20,.95);">

                <div class="w-full flex justify-between items-center mb-6">
                  <span id="cardLabel" class="text-[9px] tracking-[0.3em] font-black text-pink-500 uppercase">StudyLab
                    ID</span>
                  <div class="w-2 h-2 rounded-full bg-green-500 shadow-[0_0_8px_#22c55e]"></div>
                </div>

                <div class="relative mb-6">
                  <div id="photoBorder"
                    class="w-32 h-32 rounded-full border-2 border-pink-500/30 p-1.5 group-hover:scale-105 transition-transform duration-500 overflow-hidden">
                    <div id="cardPhotoWrapper" class="w-full h-full rounded-full bg-slate-900 overflow-hidden">
                      @if(Auth::check() && Auth::user()->avatar)
                        <img src="{{ Auth::user()->avatar }}"
                          style="width:100%;height:100%;object-fit:cover;display:block;">
                      @else
                        <div class="w-full h-full flex items-center justify-center">
                          <svg class="w-16 h-16 text-slate-600 translate-y-3" fill="currentColor" viewBox="0 0 24 24">
                            <path
                              d="M12 12c2.21 0 4-1.79 4-4s-1.79-4-4-4-4 1.79-4 4 1.79 4 4 4zm0 2c-2.67 0-8 1.34-8 4v2h16v-2c0-2.66-5.33-4-8-4z" />
                          </svg>
                        </div>
                      @endif
                    </div>
                  </div>
                </div>

                <div class="text-center">
                  <h2 id="cardName" class="text-2xl font-bold text-white tracking-tight uppercase">
                    {{ Auth::check() ? Auth::user()->name : 'Visitante' }}
                  </h2>
                  <p id="cardId" class="text-pink-500 text-xs font-bold tracking-widest mt-1">
                    ID: SL-{{ Auth::check() ? str_pad(Auth::user()->id, 6, '0', STR_PAD_LEFT) : '000000' }}
                  </p>
                </div>

                <div class="grid grid-cols-2 gap-4 w-full mt-8 py-4 border-y border-white/5">
                  <div class="text-center">
                    <p class="text-[8px] text-slate-500 uppercase font-black tracking-widest">Ano</p>
                    <p id="cardSince" class="text-white text-xs font-bold">{{ date('Y') }}</p>
                  </div>
                  <div class="text-center border-l border-white/5">
                    <p class="text-[8px] text-slate-500 uppercase font-black tracking-widest">Status</p>
                    <p class="text-green-400 text-xs font-bold italic">ATIVO</p>
                  </div>
                </div>

                <div class="mt-auto flex flex-col items-center gap-2">
                  <div class="w-12 h-1 bg-white/10 rounded-full overflow-hidden">
                    <div id="cardProgress" class="w-1/2 h-full bg-pink-500"></div>
                  </div>
                  <span class="text-[7px] text-slate-600 tracking-[0.5em] font-bold uppercase">SECURE ENCRYPTED ID</span>
                </div>
              </div>
            </div>
          </div>

          {{-- personalizar --}}
          <div class="w-full max-w-[400px] space-y-4">
            <p class="text-[10px] font-black uppercase tracking-widest text-center profile-muted">Personalizar Estilo</p>
            <div id="colorPicker" class="profile-picker grid grid-cols-6 gap-2 p-3 rounded-2xl border"></div>

            <div class="flex items-center justify-between profile-card-bg border p-4 rounded-2xl backdrop-blur-md">
              <label for="photoInput"
                class="text-sm font-bold profile-label cursor-pointer hover:text-pink-500 transition-colors">
                Alterar Foto
              </label>
              <input type="file" id="photoInput" class="hidden" accept="image/*">
              <button id="savePhotoBtn"
                class="hidden disabled:opacity-40 bg-pink-600 hover:bg-pink-500 cursor-pointer text-white text-[10px] font-black px-4 py-2 rounded-xl uppercase transition-colors"
                disabled>Salvar</button>
            </div>
          </div>
        </div>

        {{-- COLUNA DIREITA --}}
        <div class="lg:col-span-7 space-y-8">
          <div class="profile-section border rounded-[2.5rem] overflow-hidden backdrop-blur-xl">
            <div class="profile-section-header px-8 py-6 border-b">
              <h2 class="font-bold" style="color:inherit">Configurações de Conta</h2>
            </div>

            <div class="p-8 space-y-8">
              <div class="grid grid-cols-1 md:grid-cols-2 gap-8">

                {{-- nome --}}
                <form id="nameForm" class="space-y-3">
                  <label class="text-[10px] font-black uppercase tracking-widest profile-label block">Nome
                    Completo</label>
                  <div class="relative">
                    <input type="text" id="nameInput" value="{{ Auth::check() ? Auth::user()->name : '' }}"
                      class="input-glass profile-input w-full border rounded-2xl px-5 py-3.5 text-sm focus:outline-none transition-all">
                  </div>
                  <button type="submit"
                    class="w-full flex items-center justify-center gap-2 bg-pink-600 hover:bg-pink-500 cursor-pointer text-white font-black py-2.5 rounded-2xl text-[11px] uppercase tracking-wider transition-all shadow-lg shadow-pink-600/20 hover:-translate-y-0.5 active:translate-y-0">
                    <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                      <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M5 13l4 4L19 7" />
                    </svg>
                    Atualizar Nome
                  </button>
                  <p id="err-name" class="hidden text-[11px] text-red-500 font-semibold"></p>
                </form>

                {{-- email --}}
                <form id="emailForm" class="space-y-3">
                  <label class="text-[10px] font-black uppercase tracking-widest profile-label block">E-mail</label>
                  <div class="relative">
                    <input type="email" id="emailInput" value="{{ Auth::check() ? Auth::user()->email : '' }}"
                      class="input-glass profile-input w-full border rounded-2xl px-5 py-3.5 text-sm focus:outline-none transition-all">
                  </div>
                  <button type="submit"
                    class="w-full flex items-center justify-center gap-2 bg-pink-600 hover:bg-pink-500 cursor-pointer text-white font-black py-2.5 rounded-2xl text-[11px] uppercase tracking-wider transition-all shadow-lg shadow-pink-600/20 hover:-translate-y-0.5 active:translate-y-0">
                    <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                      <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M5 13l4 4L19 7" />
                    </svg>
                    Atualizar E-mail
                  </button>
                  <p id="err-email" class="hidden text-[11px] text-red-500 font-semibold"></p>
                </form>

              </div>

              {{-- senha --}}
              <div class="pt-8 border-t profile-section-header">
                <label class="text-[10px] font-black uppercase tracking-widest profile-label mb-5 block">Alterar
                  Senha</label>
                <form id="passwordForm" class="grid grid-cols-1 md:grid-cols-3 gap-4">
                  <input type="password" id="currentPassword" placeholder="Senha Atual"
                    class="input-glass profile-input border rounded-2xl px-5 py-3.5 text-sm focus:outline-none">
                  <input type="password" id="newPassword" placeholder="Nova Senha"
                    class="input-glass profile-input border rounded-2xl px-5 py-3.5 text-sm focus:outline-none">
                  <button type="submit"
                    class="bg-pink-600 hover:bg-pink-500 cursor-pointer text-white font-black py-3.5 rounded-2xl text-[11px] uppercase tracking-tighter transition-all shadow-lg shadow-pink-600/20">
                    Atualizar
                  </button>
                </form>
                <p id="err-password" class="hidden mt-2 text-[11px] text-red-500 font-semibold"></p>
              </div>
            </div>
          </div>

          {{-- rodapé --}}
          <div class="flex flex-wrap items-center justify-between gap-6 px-4">
            <div class="flex items-center gap-8">

              {{-- toggle tema --}}
              <button id="toggleThemeBtn" class="flex items-center gap-3 group cursor-pointer">
                <div class="w-10 h-5 bg-pink-600/20 border border-pink-500/30 rounded-full relative transition-colors">
                  <div id="themeKnob"
                    class="absolute top-1 left-1 w-2.5 h-2.5 bg-pink-500 rounded-full shadow-[0_0_8px_rgba(236,72,153,1)] transition-transform duration-300"
                    style="transform:translateX(20px)">
                  </div>
                </div>
                <span id="themeLabel"
                  class="text-xs font-bold profile-muted group-hover:text-pink-500 transition-colors uppercase">
                  Modo Dark
                </span>
              </button>

              <button id="logoutBtn"
                class="text-xs font-bold cursor-pointer profile-muted hover:text-red-500 transition-colors uppercase tracking-widest">
                Desconectar
              </button>
            </div>

            <button id="deleteAccountBtn"
              class="text-[9px] font-black cursor-pointer uppercase tracking-[0.2em] profile-muted hover:text-red-600 transition-all border-b border-transparent hover:border-red-600">
              Excluir Conta Permanentemente
            </button>
          </div>
        </div>
      </div>
    </div>
  </div>

  {{-- modal exclusão --}}
  <div id="deleteModal"
    class="hidden fixed inset-0 bg-black/50 backdrop-blur-sm z-50 flex items-center justify-center p-4">
    <div class="profile-section border rounded-2xl p-6 w-full max-w-sm shadow-2xl">
      <h3 class="font-bold text-red-500 mb-2">Excluir conta?</h3>
      <p class="profile-muted text-sm mb-4">Esta ação é irreversível. Confirme sua senha.</p>
      <input type="password" id="deletePasswordInput" placeholder="Sua senha"
        class="profile-input border w-full rounded-xl px-4 py-3 text-sm focus:outline-none mb-4 transition-all">
      <div class="flex gap-3">
        <button id="cancelDelete"
          class="flex-1 profile-card-bg border rounded-xl py-2.5 text-sm font-bold profile-label hover:border-pink-500 transition-colors cursor-pointer">Cancelar</button>
        <button id="confirmDelete"
          class="flex-1 bg-red-600 hover:bg-red-500 text-white rounded-xl py-2.5 text-sm font-bold transition-colors cursor-pointer">Excluir</button>
      </div>
    </div>
  </div>

  {{-- toast --}}
  <div id="toast"
    class="hidden fixed bottom-6 right-6 z-50 flex items-center gap-3 px-5 py-3.5 rounded-xl shadow-xl border profile-section backdrop-blur-md">
    <svg class="w-4 h-4 text-pink-500 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2.5">
      <polyline points="20 6 9 17 4 12" stroke-linecap="round" />
    </svg>
    <div>
      <p id="toastMsg" class="text-sm font-bold" style="color:inherit">Pronto!</p>
      <p data-toast-sub class="text-xs profile-muted"></p>
    </div>
  </div>

  <script src="{{ asset('js/profile.js') }}"></script>
@endsection