<link rel="stylesheet" href="{{ asset('css/active-bar.css') }}">

<div class="flex justify-end">
    <div class="relative inline-block">

        {{-- Botão dos 9 pontos --}}
        <button id="activeBar" class="group relative flex h-10 w-10 items-center justify-center rounded-full transition-all duration-150
                       hover:bg-white/10 active:bg-white/15">
            <div class="grid grid-cols-3 gap-[3.5px] opacity-60 group-hover:opacity-100 transition-opacity">
                @for($i = 0; $i < 9; $i++)
                    <div class="h-[6px] w-[6px] rounded-full bg-gray-400"></div>
                @endfor
            </div>
        </button>

        {{-- Painel --}}
        <div id="appsGrid">
            <div class="apps-inner-grid">

                {{-- Grupos --}}
                <button class="app-tile">
                    <div class="icon-wrap">
                        <svg width="28" height="28" viewBox="0 0 24 24" fill="none" stroke="#4A90D9" stroke-width="1.8"
                            stroke-linecap="round" stroke-linejoin="round">
                            <path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2" />
                            <circle cx="9" cy="7" r="4" />
                            <path d="M23 21v-2a4 4 0 0 0-3-3.87" />
                            <path d="M16 3.13a4 4 0 0 1 0 7.75" />
                        </svg>
                    </div>
                    <span>Grupos</span>
                </button>

                {{-- Drive --}}
                <button class="app-tile">
                    <div class="icon-wrap">
                        <svg width="28" height="28" viewBox="0 0 24 24" fill="none" stroke="#34A853" stroke-width="1.8"
                            stroke-linecap="round" stroke-linejoin="round">
                            <path
                                d="M4 20h16a2 2 0 0 0 2-2V8a2 2 0 0 0-2-2h-7.93a2 2 0 0 1-1.66-.9l-.82-1.2A2 2 0 0 0 7.93 3H4a2 2 0 0 0-2 2v13c0 1.1.9 2 2 2Z" />
                        </svg>
                    </div>
                    <span>Drive</span>
                </button>

                {{-- Niklor --}}
                <button class="app-tile">
                    <div class="icon-wrap">
                        <svg width="28" height="28" viewBox="0 0 24 24" fill="none" stroke="#EA4335" stroke-width="1.6"
                            stroke-linecap="round" stroke-linejoin="round">
                            <path d="M7 10 C6.5 13 7 15 8 16.5 C9.5 18 14.5 18 16 16.5 C17 15 17.5 13 17 10" />
                            <circle cx="9.5" cy="11" r="1.1" fill="#EA4335" stroke="none" />
                            <circle cx="14.5" cy="11" r="1.1" fill="#EA4335" stroke="none" />
                        </svg>
                    </div>
                    <span>Niklor</span>
                </button>

                {{-- Docs --}}
                <button class="app-tile">
                    <div class="icon-wrap">
                        <svg width="28" height="28" viewBox="0 0 24 24" fill="none" stroke="#4A90D9" stroke-width="1.8"
                            stroke-linecap="round" stroke-linejoin="round">
                            <path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z" />
                            <polyline points="14 2 14 8 20 8" />
                            <line x1="16" y1="13" x2="8" y2="13" />
                            <line x1="16" y1="17" x2="8" y2="17" />
                            <polyline points="10 9 9 9 8 9" />
                        </svg>
                    </div>
                    <span>Docs</span>
                </button>

                {{-- Timer --}}
                <button class="app-tile">
                    <div class="icon-wrap">
                        <svg width="28" height="28" viewBox="0 0 24 24" fill="none" stroke="#FBBC04" stroke-width="1.8"
                            stroke-linecap="round" stroke-linejoin="round">
                            <circle cx="12" cy="12" r="10" />
                            <polyline points="12 6 12 12 16 14" />
                        </svg>
                    </div>
                    <span>Timer</span>
                </button>

                {{-- Ajustes --}}
                <button class="app-tile">
                    <div class="icon-wrap">
                        <svg width="28" height="28" viewBox="0 0 24 24" fill="none" stroke="rgba(255,255,255,0.5)"
                            stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round">
                            <circle cx="12" cy="12" r="3" />
                            <path
                                d="M19.4 15a1.65 1.65 0 0 0 .33 1.82l.06.06a2 2 0 0 1 0 2.83 2 2 0 0 1-2.83 0l-.06-.06a1.65 1.65 0 0 0-1.82-.33 1.65 1.65 0 0 0-1 1.51V21a2 2 0 0 1-2 2 2 2 0 0 1-2-2v-.09A1.65 1.65 0 0 0 9 19.4a1.65 1.65 0 0 0-1.82.33l-.06.06a2 2 0 0 1-2.83 0 2 2 0 0 1 0-2.83l.06-.06A1.65 1.65 0 0 0 4.68 15a1.65 1.65 0 0 0-1.51-1H3a2 2 0 0 1-2-2 2 2 0 0 1 2-2h.09A1.65 1.65 0 0 0 4.6 9a1.65 1.65 0 0 0-.33-1.82l-.06-.06a2 2 0 0 1 0-2.83 2 2 0 0 1 2.83 0l.06.06A1.65 1.65 0 0 0 9 4.68a1.65 1.65 0 0 0 1-1.51V3a2 2 0 0 1 2-2 2 2 0 0 1 2 2v.09a1.65 1.65 0 0 0 1 1.51 1.65 1.65 0 0 0 1.82-.33l.06-.06a2 2 0 0 1 2.83 0 2 2 0 0 1 0 2.83l-.06.06A1.65 1.65 0 0 0 19.4 9a1.65 1.65 0 0 0 1.51 1H21a2 2 0 0 1 2 2 2 2 0 0 1-2 2h-.09a1.65 1.65 0 0 0-1.51 1z" />
                        </svg>
                    </div>
                    <span>Ajustes</span>
                </button>

            </div>

            <div class="apps-sep"></div>

            {{-- Link "Ver todos" --}}
            <button class="apps-store-row">
                <svg width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="rgba(255,255,255,0.4)"
                    stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round">
                    <rect x="3" y="3" width="7" height="7" rx="1" />
                    <rect x="14" y="3" width="7" height="7" rx="1" />
                    <rect x="3" y="14" width="7" height="7" rx="1" />
                    <rect x="14" y="14" width="7" height="7" rx="1" />
                </svg>
                <span>Ver todos os apps</span>
            </button>
        </div>

    </div>
</div>

<script src="{{ asset('js/active-bar.js') }}"></script>