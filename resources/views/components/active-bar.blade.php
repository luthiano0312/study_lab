<link rel="stylesheet" href="{{ asset('css/active-bar.css') }}">

<div class="relative inline-block">
    <div class="relative inline-block">
        <button id="activeBar"
            class="cursor-pointer group relative flex h-10 w-10 flex-col items-center justify-center gap-2 rounded-2xl backdrop-blur-md transition-all duration-300 bg-white dark:bg-slate-900/50 hover:bg-pink-50 dark:hover:bg-white/20 hover:shadow-xl hover:shadow-pink-500/10 active:scale-95 overflow-hidden border border-slate-200 dark:border-white/20">
            <div
                class="grid grid-cols-3 gap-1 transition-transform duration-300 group-hover:rotate-12 group-hover:scale-110">
                <div class="h-1 w-1 rounded-full bg-pink-500 dark:bg-slate-500 transition-colors duration-300"></div>
                <div class="h-1 w-1 rounded-full bg-pink-500 dark:bg-slate-500 transition-colors duration-300"></div>
                <div class="h-1 w-1 rounded-full bg-pink-500 dark:bg-slate-500 transition-colors duration-300"></div>
                <div class="h-1 w-1 rounded-full bg-pink-500 dark:bg-slate-500 transition-colors duration-300"></div>
                <div class="h-1 w-1 rounded-full bg-pink-500 dark:bg-slate-500 transition-colors duration-300"></div>
                <div class="h-1 w-1 rounded-full bg-pink-500 dark:bg-slate-500 transition-colors duration-300"></div>
                <div class="h-1 w-1 rounded-full bg-pink-500 dark:bg-slate-500 transition-colors duration-300"></div>
                <div class="h-1 w-1 rounded-full bg-pink-500 dark:bg-slate-500 transition-colors duration-300"></div>
                <div class="h-1 w-1 rounded-full bg-pink-500 dark:bg-slate-500 transition-colors duration-300"></div>
            </div>
            <div class="absolute bottom-0 h-1 w-0 bg-pink-500 transition-all duration-300 group-hover:w-full"></div>
        </button>

        <div id="appsGrid" class="hidden absolute left-0 mt-4 z-50 origin-top-left menu-animation">
            <div
                class="flex flex-col gap-2 p-3 bg-white dark:bg-slate-900/90 backdrop-blur-xl rounded-[2rem] border border-slate-200 dark:border-white/20 shadow-2xl">
                <div class="flex flex-row gap-2">
                    <div class="relative group/item">
                        <button
                            class="w-16 h-16 flex items-center justify-center bg-slate-50 dark:bg-slate-800 rounded-tl-[1.8rem] rounded-tr-md rounded-bl-md rounded-br-md shadow-sm hover:bg-pink-500 transition-all duration-300 hover:scale-105 group/btn border border-slate-100 dark:border-transparent">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                                fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                stroke-linejoin="round"
                                class="text-pink-500 dark:text-indigo-500 group-hover/btn:text-white transition-colors">
                                <path d="M16 21v-2a4 4 0 0 0-4-4H6a4 4 0 0 0-4 4v2" />
                                <circle cx="9" cy="7" r="4" />
                                <path d="M22 21v-2a4 4 0 0 0-3-3.87" />
                                <path d="M16 3.13a4 4 0 0 1 0 7.75" />
                            </svg>
                        </button>
                        <span
                            class="absolute -bottom-8 left-1/2 -translate-x-1/2 scale-0 group-hover/item:scale-100 transition-all bg-slate-800 text-white text-[10px] px-2 py-1 rounded-md whitespace-nowrap z-10">Grupo
                            de estudos</span>
                    </div>
                    <div class="relative group/item">
                        <button
                            class="w-16 h-16 flex items-center justify-center bg-slate-50 dark:bg-slate-800 rounded-tr-[1.8rem] rounded-tl-md rounded-bl-md rounded-br-md shadow-sm hover:bg-pink-500 transition-all duration-300 hover:scale-105 group/btn border border-slate-100 dark:border-transparent">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                                fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                stroke-linejoin="round"
                                class="text-pink-500 dark:text-amber-500 group-hover/btn:text-white transition-colors">
                                <path
                                    d="M4 20h16a2 2 0 0 0 2-2V8a2 2 0 0 0-2-2h-7.93a2 2 0 0 1-1.66-.9l-.82-1.2A2 2 0 0 0 7.93 3H4a2 2 0 0 0-2 2v13c0 1.1.9 2 2 2Z" />
                            </svg>
                        </button>
                        <span
                            class="absolute -bottom-8 left-1/2 -translate-x-1/2 scale-0 group-hover/item:scale-100 transition-all bg-slate-800 text-white text-[10px] px-2 py-1 rounded-md whitespace-nowrap z-10">Armazém</span>
                    </div>
                </div>
                <div class="flex flex-row gap-2">
                    <div class="relative group/item">
                        <button
                            class="w-16 h-16 flex items-center justify-center bg-slate-50 dark:bg-slate-800 rounded-bl-[1.8rem] rounded-tl-md rounded-tr-md rounded-br-md shadow-sm hover:bg-pink-500 transition-all duration-300 hover:scale-105 group/btn border border-slate-100 dark:border-transparent">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                                fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round"
                                stroke-linejoin="round"
                                class="text-pink-500 dark:text-emerald-500 group-hover/btn:text-white transition-colors">

                                <path d="M8 7 C7 4 8 2 10 2" />
                                <path d="M10 2 C11 1 12 1 12 2" />
                                <path d="M12 2 C13 0.5 14.5 1 14 3" />
                                <path d="M14 3 C15 1.5 16.5 2 16 4" />
                                <path d="M16 4 C17.5 3 18 5 17 6" />
                                <path d="M7 10 C6 8 6.5 6.5 8 6 C10 5 14 5 16 6 C17.5 6.5 18 8 17 10" />
                                <path d="M7 10 C6.5 13 7 15 8 16.5 C9.5 18 14.5 18 16 16.5 C17 15 17.5 13 17 10" />
                                <path d="M7 11 C5.5 10.5 5 12 5.5 13 C6 14 7 13.5 7 13" />
                                <path d="M17 11 C18.5 10.5 19 12 18.5 13 C18 14 17 13.5 17 13" />
                                <rect x="7.5" y="9.5" width="4" height="3" rx="1.5" />
                                <rect x="12.5" y="9.5" width="4" height="3" rx="1.5" />
                                <path d="M11.5 11 L12.5 11" />
                                <circle cx="9.5" cy="11" r="1" />
                                <circle cx="14.5" cy="11" r="1" />
                                <path d="M10 15.5 C11 16.5 13 16.5 14 15.5" />
                                <path d="M11 17 C11.5 18 12.5 18 13 17" />
                            </svg>
                        </button>
                        <span
                            class="absolute -bottom-8 left-1/2 -translate-x-1/2 scale-0 group-hover/item:scale-100 transition-all bg-slate-800 text-white text-[10px] px-2 py-1 rounded-md whitespace-nowrap z-10">Prof.Niklor</span>
                    </div>
                    <div class="relative group/item">
                        <button
                            class="w-16 h-16 flex items-center justify-center bg-slate-50 dark:bg-slate-800 rounded-br-[1.8rem] rounded-tl-md rounded-tr-md rounded-bl-md shadow-sm hover:bg-pink-500 transition-all duration-300 hover:scale-105 group/btn border border-slate-100 dark:border-transparent">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                                fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                stroke-linejoin="round"
                                class="text-pink-500 dark:text-rose-500 group-hover/btn:text-white transition-colors">
                                <circle cx="12" cy="12" r="10" />
                                <polyline points="12 6 12 12 16 14" />
                            </svg>
                        </button>
                        <span
                            class="absolute -bottom-8 left-1/2 -translate-x-1/2 scale-0 group-hover/item:scale-100 transition-all bg-slate-800 text-white text-[10px] px-2 py-1 rounded-md whitespace-nowrap z-10">Pomodoro</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<script src="{{ asset('js/active-bar.js') }}"></script>