@extends('layouts.app')

@section('content')


<div class="min-h-screen relative h-full w-full overflow-hidden bg-[#fdf4f8]">


  <div class="absolute inset-0 pointer-events-none" style="
    background-image: radial-gradient(circle, #f9a8d4 1.5px, transparent 1.5px);
    background-size: 32px 32px;
    opacity: 0.35;
  "></div>


  <div class="absolute -top-24 -right-24 w-96 h-96 rounded-full pointer-events-none"
       style="background: radial-gradient(circle at 40% 40%, #f9a8d4 0%, #fce7f3 60%, transparent 80%); opacity:.6;"></div>


  <div class="absolute -bottom-16 -left-16 w-64 h-64 rounded-full pointer-events-none"
       style="background: radial-gradient(circle at 60% 60%, #fbcfe8 0%, transparent 70%); opacity:.5;"></div>


  <div class="absolute top-16 left-10 float-a pointer-events-none opacity-70">
    <svg width="48" height="120" viewBox="0 0 48 120" fill="none" xmlns="http://www.w3.org/2000/svg">
      <rect x="10" y="10" width="28" height="85" rx="5" fill="#fbbf24"/>
      <rect x="10" y="10" width="28" height="12" rx="5" fill="#d97706"/>
      <polygon points="10,95 38,95 24,118" fill="#fde68a"/>
      <polygon points="20,108 28,108 24,118" fill="#1a1a2e"/>
      <rect x="10" y="10" width="4" height="85" fill="#f59e0b" opacity=".4"/>
    </svg>
  </div>


  <div class="absolute top-32 right-12 float-b pointer-events-none opacity-75">
    <svg width="90" height="90" viewBox="0 0 90 90" fill="none" xmlns="http://www.w3.org/2000/svg">

      <rect x="8" y="52" width="74" height="22" rx="4" fill="#db2777"/>
      <rect x="8" y="52" width="10" height="22" rx="3" fill="#be185d"/>
      <rect x="20" y="57" width="30" height="3" rx="2" fill="#fce7f3" opacity=".6"/>
      <rect x="20" y="63" width="20" height="3" rx="2" fill="#fce7f3" opacity=".4"/>

      <rect x="14" y="32" width="62" height="22" rx="4" fill="#fbbf24"/>
      <rect x="14" y="32" width="10" height="22" rx="3" fill="#d97706"/>
      <rect x="26" y="37" width="25" height="3" rx="2" fill="#fff" opacity=".5"/>
      <rect x="26" y="43" width="18" height="3" rx="2" fill="#fff" opacity=".35"/>

      <rect x="5" y="12" width="80" height="22" rx="4" fill="#06b6d4"/>
      <rect x="5" y="12" width="10" height="22" rx="3" fill="#0891b2"/>
      <rect x="18" y="17" width="28" height="3" rx="2" fill="#fff" opacity=".5"/>
      <rect x="18" y="23" width="20" height="3" rx="2" fill="#fff" opacity=".35"/>
    </svg>
  </div>


  <div class="absolute bottom-28 right-20 float-c pointer-events-none opacity-60">
    <svg width="160" height="36" viewBox="0 0 160 36" fill="none">
      <rect x="0" y="6" width="160" height="24" rx="5" fill="#a78bfa"/>
      <rect x="0" y="6" width="160" height="4" rx="3" fill="#7c3aed" opacity=".4"/>
      <line x1="20"  y1="6"  x2="20"  y2="16" stroke="white" stroke-width="1.5" opacity=".8"/>
      <line x1="40"  y1="6"  x2="40"  y2="20" stroke="white" stroke-width="1.5" opacity=".8"/>
      <line x1="60"  y1="6"  x2="60"  y2="16" stroke="white" stroke-width="1.5" opacity=".8"/>
      <line x1="80"  y1="6"  x2="80"  y2="20" stroke="white" stroke-width="1.5" opacity=".8"/>
      <line x1="100" y1="6"  x2="100" y2="16" stroke="white" stroke-width="1.5" opacity=".8"/>
      <line x1="120" y1="6"  x2="120" y2="20" stroke="white" stroke-width="1.5" opacity=".8"/>
      <line x1="140" y1="6"  x2="140" y2="16" stroke="white" stroke-width="1.5" opacity=".8"/>
    </svg>
  </div>


  <div class="absolute top-40 left-1/3 float-a pointer-events-none" style="animation-delay:.8s">
    <svg width="28" height="28" viewBox="0 0 28 28" fill="none">
      <path d="M14 2 L15.8 10.2 L24 12 L15.8 13.8 L14 22 L12.2 13.8 L4 12 L12.2 10.2 Z" fill="#f472b6" opacity=".7"/>
    </svg>
  </div>
  <div class="absolute bottom-48 left-1/4 float-b pointer-events-none" style="animation-delay:1.2s">
    <svg width="20" height="20" viewBox="0 0 20 20" fill="none">
      <path d="M10 1 L11.5 7.5 L18 9 L11.5 10.5 L10 17 L8.5 10.5 L2 9 L8.5 7.5 Z" fill="#db2777" opacity=".5"/>
    </svg>
  </div>
  <div class="absolute top-72 right-1/3 float-c pointer-events-none" style="animation-delay:.3s">
    <svg width="16" height="16" viewBox="0 0 16 16" fill="none">
      <path d="M8 0 L9 6 L15 8 L9 10 L8 16 L7 10 L1 8 L7 6 Z" fill="#fbbf24" opacity=".65"/>
    </svg>
  </div>

  <div class="absolute bottom-40 left-40 spin-slow pointer-events-none opacity-20">
    <svg width="90" height="90" viewBox="0 0 90 90" fill="none">
      <circle cx="45" cy="45" r="40" stroke="#db2777" stroke-width="6" stroke-dasharray="14 8"/>
    </svg>
  </div>

  <div class="absolute bottom-20 left-1/3 float-b pointer-events-none opacity-65" style="animation-delay:.5s">
    <svg width="64" height="28" viewBox="0 0 64 28" fill="none">
      <rect x="0" y="4" width="64" height="20" rx="5" fill="#f87171"/>
      <rect x="0" y="4" width="26" height="20" rx="5" fill="#fca5a5"/>
      <rect x="26" y="4" width="2" height="20" fill="#ef4444"/>
    </svg>
  </div>

  <div class="absolute top-20 right-1/3 w-5 h-5 rounded-full bg-pink-300 opacity-40 float-a pointer-events-none" style="animation-delay:.6s"></div>
  <div class="absolute top-80 left-20 w-8 h-8 rounded-full bg-yellow-300 opacity-35 float-b pointer-events-none"></div>
  <div class="absolute bottom-36 right-1/4 w-6 h-6 rounded-full bg-pink-400 opacity-30 float-c pointer-events-none"></div>


  <div class="relative z-10 max-w-5xl mx-auto px-6 py-10">

    <div class="flex items-end justify-between mb-8 fade-up">
      <div>
        <p class="text-xs font-800 tracking-widest uppercase text-pink-400 mb-1">
          📖 Painel acadêmico
        </p>
        <h1 class="text-4xl font-black text-gray-900 leading-tight">
          Minhas Matérias
        </h1>
        <p class="text-sm text-gray-400 font-600 mt-1">Gerencie suas matérias cadastradas com facilidade</p>
      </div>

      <a href="{{ route('subject.create') }}"
         class="flex items-center gap-2 bg-pink-600 text-white text-sm font-800 px-5 py-3 rounded-2xl shadow-lg shadow-pink-200 transition-all hover:-translate-y-0.5 hover:shadow-xl hover:shadow-pink-300">
        <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor"
             stroke-width="3" stroke-linecap="round" stroke-linejoin="round">
          <line x1="12" y1="5" x2="12" y2="19"/><line x1="5" y1="12" x2="19" y2="12"/>
        </svg>
        Adicionar matéria
      </a>
    </div>

    <div class="flex gap-3 mb-6 fade-up" style="animation-delay:.1s">
      <div class="bg-white/80 backdrop-blur-sm rounded-2xl px-5 py-3 shadow-sm border border-pink-100 flex items-center gap-3">
        <div class="w-9 h-9 rounded-xl bg-pink-100 flex items-center justify-center text-lg">
          <img class="opacity-35" src="{{ asset('favicons/book_4_24dp_00000_FILL0_wght400_GRAD0_opsz24.png')}}">
        </div>

        <div>
          <p class="text-xs text-gray-400 font-600">Total de matérias</p>
          <p class="text-xl font-900 text-gray-900" id="totalCount">—</p>
        </div>
      </div>
      <div class="bg-white/80 backdrop-blur-sm rounded-2xl px-5 py-3 shadow-sm border border-pink-100 flex items-center gap-3">
        <div class="w-9 h-9 rounded-xl bg-purple-100 flex items-center justify-center text-lg">
          <img class="opacity-35" src="{{ asset('favicons/person_apron_24dp_000000_FILL0_wght400_GRAD0_opsz24.png')}}">
        </div>
        <div>
          <p class="text-xs text-gray-400 font-600">Professores</p>
          <p class="text-xl font-900 text-gray-900" id="profCount">—</p>
        </div>
      </div>
    </div>

    <div class="bg-white/90 backdrop-blur-sm rounded-3xl shadow-xl shadow-pink-100 overflow-hidden border border-pink-100 fade-up" style="animation-delay:.2s">

      <div class="h-1.5 w-full" style="background: linear-gradient(90deg, #db2777 0%, #f472b6 50%, rgb(254, 140, 248) 100%);">

      </div>

      <table class="w-full border-collapse">
        <thead>
          <tr class="border-b  border-gray-200">
            <th class="px-6 py-4 text-center text-xs font-800 uppercase tracking-wider text-gray-400">
              Nome
            </th>
            <th class="px-4 py-4 text-center text-xs font-800 uppercase tracking-wider text-gray-400">
              Código
            </th>
            <th class="px-4 py-4 text-center text-xs font-800 uppercase tracking-wider text-gray-400">
              Professor
            </th>
            <th class="px-4 py-4 text-center text-xs font-800 uppercase tracking-wider text-gray-400">
              Semestre
            </th>
            <th class="px-4 py-4 text-center text-xs font-800 uppercase tracking-wider text-gray-400">
              Ações
            </th>
          </tr>
        </thead>
        <tbody id="subjectsTable">
          @for ($i = 0; $i < 4; $i++)
          <tr class="">
            <td class="px-6 py-4"><div class="skel" style="width:65%;"></div></td>
            <td class="px-4 py-4"><div class="skel" style="width:52px;"></div></td>
            <td class="px-4 py-4">
              <div class="flex items-center gap-3">
                <div class="w-8 h-8 rounded-full bg-pink-100" style="flex-shrink:0"></div>
                <div class="skel" style="width:55%; height:14px;"></div>
              </div>
            </td>
            <td class="px-4 py-4"><div class="skel" style="width:80px; height:22px; border-radius:20px;"></div></td>
            <td class="px-4 py-4"><div class="skel" style="width:100px; height:28px; border-radius:10px; margin:0 auto;"></div></td>
          </tr>
          @endfor
        </tbody>
      </table>

      <div class="px-6 py-3 bg-pink-50/50 border-t border-pink-100 flex items-center justify-between">
        <p class="text-xs text-gray-400 font-600">StudyLab • Matérias</p>
        <div class="flex gap-1">
          <span class="w-2 h-2 rounded-full bg-pink-300 inline-block"></span>
          <span class="w-2 h-2 rounded-full bg-pink-200 inline-block"></span>
          <span class="w-2 h-2 rounded-full bg-pink-100 inline-block"></span>
        </div>
      </div>

    </div>
  </div>
</div>

<script>
    const deleteIcon = "{{ asset('favicons/delete_24dp_000000_FILL0_wght400_GRAD0_opsz24.png') }}";
    const editIcon   = "{{ asset('favicons/edit_24dp_000000_FILL0_wght400_GRAD0_opsz24.png') }}";
</script>
<script src="{{ asset('js/subject.js') }}"></script>

@endsection