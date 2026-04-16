<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>StudyLab</title>
    <link  rel="icon" href="{{ asset('favicons/icone.ico') }}">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <script>
        if (localStorage.getItem('theme') === 'dark') {
            document.documentElement.classList.add('dark');
        } else {
            document.documentElement.classList.remove('dark');
        }
    </script>
</head>

<body
    class="bg-gray-50 dark:bg-[#121212] dark:text-gray-100 overflow-x-hidden font-sans antialiased transition-colors duration-200">

    <div class="flex flex-col h-screen">

        <header
            class="bg-white dark:bg-[#18181b] h-16 px-8 flex items-center justify-between border-b border-pink-100 dark:border-gray-800 shadow-sm z-50 transition-colors duration-200">
            <div class="flex items-center">
                <a href="/dashboard" class="relative h-[90px] w-[260px] flex items-center justify-center">
                    <img src="/images/logohorizontal.png" class="absolute h-[90px] object-contain dark:hidden">
                    <img src="/images/logo-dark-mode.png" class="absolute h-[90px] object-contain hidden dark:block">
                </a>
            </div>



            <div class="flex items-center gap-4">
                <div>
                    <x-bt-focus-mode />
                </div>
                <div>
                    <x-planes-bt />
                </div>
                <div>
                    <x-active-bar />
                </div>
                <button
                    class="relative w-9 h-9 rounded-xl hover:bg-gray-100 dark:hover:bg-gray-800 flex items-center justify-center transition">
                    <img class="h-5 opacity-50 dark:opacity-100 transition-all dark:filter-[invert(43%)_sepia(94%)_saturate(2250%)_hue-rotate(306deg)_brightness(96%)_contrast(97%)]"
                        src="{{ asset('favicons/notifications_24dp_00000_FILL0_wght400_GRAD0_opsz24.png') }}">
                    <span
                        class="absolute -top-0.5 -right-0.5 bg-pink-500 text-white text-[9px] w-3.5 h-3.5 rounded-full flex items-center justify-center font-bold">3</span>
                </button>
                <a href="/profile"
                    class="flex items-center gap-2.5 bg-gray-50 dark:bg-[#27272a] hover:bg-pink-50 dark:hover:bg-pink-950/40 px-3 py-1.5 rounded-xl transition cursor-pointer border border-gray-300 hover:border-pink-300 dark:border-gray-700 dark:hover:border-pink-800">
                    <div class="relative w-8 h-8 flex-shrink-0">
                        <img id="headerAvatar" src="" alt=""
                            class="w-8 h-8 rounded-full object-cover ring-2 ring-pink-200 dark:ring-pink-800 hidden">
                        <div id="headerAvatarFallback"
                            class="w-8 h-8 rounded-full ring-2 ring-pink-200 dark:ring-pink-800 bg-gradient-to-br from-pink-400 to-pink-600 flex items-center justify-center text-white">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                            </svg>
                        </div>
                    </div>
                    <div class="text-sm">
                        <p class="font-semibold text-gray-700 dark:text-gray-100 leading-tight" id="headerUserName">
                            Estudante</p>
                        <p class="text-xs text-gray-400 dark:text-gray-500 leading-tight">StudyLab</p>
                    </div>
                </a>
                <script>
                    (function() {
                        const cached = localStorage.getItem('user_cache');
                        if (cached) {
                            try {
                                const user = JSON.parse(cached);
                                if (user.name) document.getElementById('headerUserName').textContent = user.name;
                                if (user.avatarUrl) {
                                    const img = document.getElementById('headerAvatar');
                                    const fb  = document.getElementById('headerAvatarFallback');
                                    img.src = user.avatarUrl;
                                    img.classList.remove('hidden');
                                    fb.style.display = 'none';
                                }
                            } catch(e) {}
                        }
                    })();
                </script>

            </div>
        </header>

        <div class="flex flex-1 overflow-hidden">

            <aside id="sidebar" class="flex flex-col bg-white dark:bg-[#18181b] border-r border-gray-100 dark:border-gray-800 shadow-sm
                       transition-all duration-300 ease-in-out
                       w-16 hover:w-56 overflow-visible group/sidebar z-40">

                <nav class="flex-1 px-2 py-4 flex flex-col gap-1">

                    <p
                        class="text-[9px] font-bold text-gray-300 uppercase tracking-widest px-3 mb-1
                               opacity-0 group-hover/sidebar:opacity-100 transition-opacity duration-200 whitespace-nowrap">
                        Início
                    </p>

                    <x-sb-item href="/dashboard" :active="request()->is('dashboard')" label="Dashboard"
                        icon="vital_signs_24dp_00000_FILL0_wght400_GRAD0_opsz24.png" />

                    <p
                        class="text-[9px] font-bold text-gray-300 uppercase tracking-widest px-3 mt-3 mb-1
                               opacity-0 group-hover/sidebar:opacity-100 transition-opacity duration-200 whitespace-nowrap">
                        Estudos
                    </p>

                    <x-sb-item href="/subjects" :active="request()->is('subjects*')" label="Matérias"
                        icon="book_4_24dp_00000_FILL0_wght400_GRAD0_opsz24.png" :submenu="[
        [
            'label' => 'Ver matérias',
            'href' => '/subjects',
            'icon' => 'book_4_24dp_00000_FILL0_wght400_GRAD0_opsz24.png',
        ],
        [
            'label' => 'Ver conteúdos',
            'href' => '/contents',
            'icon' => 'full_coverage_24dp_000000_FILL0_wght400_GRAD0_opsz24.png',
        ],
        [
            'label' => 'Ver atividades',
            'href' => '/activities',
            'icon' => 'notes_24dp_00000_FILL0_wght400_GRAD0_opsz24.png',
        ],
    ]" />

                    <x-sb-item href="/horary" :active="request()->is('horary*')" label="Horários"
                        icon="pace_24dp_00000_FILL0_wght400_GRAD0_opsz24.png" :submenu="[
        [
            'label' => 'Upload de foto',
            'href' => '#',
            'icon' => 'pace_24dp_00000_FILL0_wght400_GRAD0_opsz24.png',
        ],
    ]" />

                    <x-sb-item href="/exams" :active="request()->is('exams*')" label="Exames"
                        icon="news_24dp_00000_FILL0_wght400_GRAD0_opsz24.png" :submenu="[
        [
            'label' => 'Ver Provas',
            'href' => '/exams',
            'icon' => 'dual_screen_24dp_000000_FILL0_wght400_GRAD0_opsz24.png',
        ],
        [
            'label' => 'Ver Trabalhos',
            'href' => '#',
            'icon' => 'book_24dp_000000_FILL0_wght400_GRAD0_opsz24.png',
        ],
    ]" />

                    <p
                        class="text-[9px] font-bold text-gray-300 uppercase tracking-widest px-3 mt-3 mb-1
                               opacity-0 group-hover/sidebar:opacity-100 transition-opacity duration-200 whitespace-nowrap">
                        Relatórios
                    </p>

                    <x-sb-item href="#" :active="false" label="Boletim"
                        icon="notes_24dp_00000_FILL0_wght400_GRAD0_opsz24.png" />
                    <x-sb-item href="#" :active="false" label="Progresso"
                        icon="area_chart_24dp_00000_FILL0_wght400_GRAD0_opsz24.png" />

                    <p
                        class="text-[9px] font-bold text-gray-300 uppercase tracking-widest px-3 mt-3 mb-1
                               opacity-0 group-hover/sidebar:opacity-100 transition-opacity duration-200 whitespace-nowrap">
                        Conta
                    </p>

                    <x-sb-item href="/profile" :active="request()->is('profile*')" label="Perfil"
                        icon="account_child_invert_24dp_00000_FILL0_wght400_GRAD0_opsz24.png" :submenu="[
        [
            'label' => 'Meu perfil',
            'href' => '/profile',
            'icon' => 'account_child_invert_24dp_00000_FILL0_wght400_GRAD0_opsz24.png',
        ],
        ['label' => 'Sair', 'href' => '/logout', 'icon' => ''],
    ]" />

                </nav>
            </aside>

            <main
                class="flex-1 overflow-y-auto overflow-x-hidden p-8 bg-gray-50 dark:bg-[#121212] transition-colors duration-200">
                @yield('content')
            </main>

        </div>
    </div>

    <script src="{{ asset('js/header.js') }}"></script>
    <script src="{{ asset('js/dashboard.js') }}"></script>
</body>

</html>