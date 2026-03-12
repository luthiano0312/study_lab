<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>StudyLab</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="bg-gray-50 overflow-x-hidden font-sans antialiased">

    <div class="flex flex-col h-screen">

        <header class="bg-white h-16 px-8 flex items-center justify-between border-b border-pink-100 shadow-sm z-50">

            <div class="flex items-center gap-3">
                <a href="/dashboard"><img src="/images/logohorizontal.png" class="h-[90px]"></a>
            </div>

            <div class="flex items-center gap-4">

                <button class="relative w-9 h-9 rounded-xl hover:bg-gray-100 flex items-center justify-center transition">
                    <img class="h-5 opacity-50" src="{{ asset('favicons/notifications_24dp_00000_FILL0_wght400_GRAD0_opsz24.png') }}">
                    <span class="absolute -top-0.5 -right-0.5 bg-pink-500 text-white text-[9px] w-3.5 h-3.5 rounded-full flex items-center justify-center font-bold">3</span>
                </button>

                <a href="/profile" class="flex items-center gap-2.5 bg-gray-50 hover:bg-pink-50 px-3 py-1.5 rounded-xl transition cursor-pointer border border-transparent hover:border-pink-100">
                    <img id="userAvatar" src="{{ asset('images/default-avatar.png') }}" class="w-8 h-8 rounded-full object-cover ring-2 ring-pink-100">
                    <div class="text-sm">
                        <p class="font-semibold text-gray-700 leading-tight" id="userName">Estudante</p>
                        <p class="text-xs text-gray-400 leading-tight">StudyLab</p>
                    </div>
                </a>

            </div>

        </header>

        <div class="flex flex-1 overflow-hidden">

            <aside class="w-60 bg-white border-r border-gray-100 flex flex-col shadow-sm">

                <nav class="flex-1 px-3 py-5 space-y-5 text-sm overflow-y-auto">

                    <div>
                        <p class="text-[10px] font-bold text-gray-300 uppercase tracking-widest mb-2 px-2">Início</p>
                        <a href="/dashboard"
                            class="flex items-center gap-3 px-3 py-2.5 rounded-xl font-semibold transition-all
                            {{ request()->is('dashboard') ? 'bg-pink-50 text-pink-600 shadow-sm' : 'text-gray-600 hover:bg-pink-50 hover:text-pink-600' }}">
                            <img class="h-4 opacity-70" src="{{ asset('favicons/vital_signs_24dp_00000_FILL0_wght400_GRAD0_opsz24.png') }}">
                            Dashboard
                        </a>
                    </div>

                    <div>
                        <p class="text-[10px] font-bold text-gray-300 uppercase tracking-widest mb-2 px-2">Estudos</p>
                        <div class="space-y-0.5">
                            <a href="/subject"
                                class="flex items-center gap-3 px-3 py-2.5 rounded-xl font-semibold transition-all
                                {{ request()->is('subject*') ? 'bg-pink-50 text-pink-600 shadow-sm' : 'text-gray-600 hover:bg-pink-50 hover:text-pink-600' }}">
                                <img class="h-4 opacity-60" src="{{ asset('favicons/book_4_24dp_00000_FILL0_wght400_GRAD0_opsz24.png') }}">
                                Matérias
                            </a>
                    
                            <a href="/horary"
                                class="flex items-center gap-3 px-3 py-2.5 rounded-xl font-semibold transition-all
                                {{ request()->is('horary*') ? 'bg-pink-50 text-pink-600 shadow-sm' : 'text-gray-600 hover:bg-pink-50 hover:text-pink-600' }}">
                                <img class="h-4 opacity-60" src="{{ asset('favicons/pace_24dp_00000_FILL0_wght400_GRAD0_opsz24.png') }}">
                                Horários
                            </a>
                            <a href="/notes"
                                class="flex items-center gap-3 px-3 py-2.5 rounded-xl font-semibold transition-all
                                {{ request()->is('notes*') ? 'bg-pink-50 text-pink-600 shadow-sm' : 'text-gray-600 hover:bg-pink-50 hover:text-pink-600' }}">
                                <img class="h-4 opacity-60" src="{{ asset('favicons/news_24dp_00000_FILL0_wght400_GRAD0_opsz24.png') }}">
                                Notas
                            </a>
                        </div>
                    </div>

                    <div>
                        <p class="text-[10px] font-bold text-gray-300 uppercase tracking-widest mb-2 px-2">Relatórios</p>
                        <div class="space-y-0.5">
                            <a href="#"
                                class="flex items-center gap-3 px-3 py-2.5 rounded-xl font-semibold transition-all text-gray-600 hover:bg-pink-50 hover:text-pink-600">
                                <img class="h-4 opacity-60" src="{{ asset('favicons/notes_24dp_00000_FILL0_wght400_GRAD0_opsz24.png') }}">
                                Boletim
                            </a>
                            <a href="#"
                                class="flex items-center gap-3 px-3 py-2.5 rounded-xl font-semibold transition-all text-gray-600 hover:bg-pink-50 hover:text-pink-600">
                                <img class="h-4 opacity-60" src="{{ asset('favicons/area_chart_24dp_00000_FILL0_wght400_GRAD0_opsz24.png') }}">
                                Progresso
                            </a>
                        </div>
                    </div>

                    <div>
                        <p class="text-[10px] font-bold text-gray-300 uppercase tracking-widest mb-2 px-2">Conta</p>
                        <a href="/profile"
                            class="flex items-center gap-3 px-3 py-2.5 rounded-xl font-semibold transition-all
                            {{ request()->is('profile*') ? 'bg-pink-50 text-pink-600 shadow-sm' : 'text-gray-600 hover:bg-pink-50 hover:text-pink-600' }}">
                            <img class="h-4 opacity-60" src="{{ asset('favicons/account_child_invert_24dp_00000_FILL0_wght400_GRAD0_opsz24.png') }}">
                            Perfil
                        </a>
                    </div>

                </nav>

            </aside>

            <main class="flex-1 overflow-y-auto overflow-x-hidden p-8 bg-gray-50">
                @yield('content')
            </main>

        </div>

    </div>
    <script src="{{ asset('js/dashboard.js') }}"></script>
</body>

</html>