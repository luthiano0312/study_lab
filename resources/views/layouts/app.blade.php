<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>StudyLab</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="bg-gray-50 font-sans antialiased">

<div class="flex flex-col h-screen">

    <header class="bg-white h-20 px-8 flex items-center justify-between border-b border-pink-500 shadow-sm z-50">

        <div class="flex items-center gap-3">
            <a href="/dashboard"><img src="/images/logohorizontal.png" class="h-[100px]"></a>
        </div>

        <div class="flex items-center gap-6">

            <button class="relative w-10 h-10 rounded-xl hover:bg-gray-100 flex items-center justify-center transition">
                <img class="h-5 opacity-70"
                    src="{{ asset('favicons/notifications_24dp_00000_FILL0_wght400_GRAD0_opsz24.png') }}">

                <span class="absolute -top-1 -right-1 bg-pink-600 text-white text-[10px] w-4 h-4 rounded-full flex items-center justify-center">
                    #
                </span>
            </button>

            <div class="flex items-center gap-3 bg-gray-50 px-3 py-2 rounded-xl hover:bg-gray-100 transition cursor-pointer">
                <img src=""
                    class="w-9 h-9 rounded-full object-cover">

                <div class="text-sm">
                    <p class="font-medium text-gray-700">#</p>
                    <p class="text-xs text-gray-400">Estudante</p>
                </div>
            </div>

        </div>

    </header>


    <div class="flex flex-1 overflow-hidden">

        <aside class="w-64 bg-white border-r border-gray-100 flex flex-col">

            <nav class="flex-1 px-4 py-6 space-y-6 text-sm">

                <div>
                    <p class="text-xs font-semibold text-gray-400 uppercase tracking-wider mb-3">
                        Início
                    </p>

                    <a href="/dashboard"
                        class="flex items-center gap-3 px-4 py-2 rounded-xl bg-pink-50 text-pink-600 font-medium shadow-sm">
                        <img class="h-4 opacity-80"
                            src="{{ asset('favicons/vital_signs_24dp_00000_FILL0_wght400_GRAD0_opsz24.png') }}">
                        Dashboard
                    </a>
                </div>

                <div>
                    <p class="text-xs font-semibold text-gray-400 uppercase tracking-wider mb-3">
                        Estudos
                    </p>

                    <div class="space-y-1">
                        <a href="/subject" class="flex items-center gap-3 px-4 py-2 rounded-xl hover:bg-pink-50 hover:text-pink-600 transition">
                            <img class="h-4 opacity-60"
                                src="{{ asset('favicons/book_4_24dp_00000_FILL0_wght400_GRAD0_opsz24.png') }}">
                            Matérias
                        </a>

                        <a href="#" class="flex items-center gap-3 px-4 py-2 rounded-xl hover:bg-pink-50 hover:text-pink-600 transition">
                            <img class="h-4 opacity-60"
                                src="{{ asset('favicons/pace_24dp_00000_FILL0_wght400_GRAD0_opsz24.png') }}">
                            Horários
                        </a>

                        <a href="#" class="flex items-center gap-3 px-4 py-2 rounded-xl hover:bg-pink-50 hover:text-pink-600 transition">
                            <img class="h-4 opacity-60"
                                src="{{ asset('favicons/news_24dp_00000_FILL0_wght400_GRAD0_opsz24.png') }}">
                            Notas
                        </a>
                    </div>
                </div>

                <div>
                    <p class="text-xs font-semibold text-gray-400 uppercase tracking-wider mb-3">
                        Relatórios
                    </p>

                    <div class="space-y-1">
                        <a href="#" class="flex items-center gap-3 px-4 py-2 rounded-xl hover:bg-pink-50 hover:text-pink-600 transition">
                            <img class="h-4 opacity-60"
                                src="{{ asset('favicons/notes_24dp_00000_FILL0_wght400_GRAD0_opsz24.png') }}">
                            Boletim
                        </a>

                        <a href="#" class="flex items-center gap-3 px-4 py-2 rounded-xl hover:bg-pink-50 hover:text-pink-600 transition">
                            <img class="h-4 opacity-60"
                                src="{{ asset('favicons/area_chart_24dp_00000_FILL0_wght400_GRAD0_opsz24.png') }}">
                            Progresso
                        </a>
                    </div>
                </div>

                <div>
                    <p class="text-xs font-semibold text-gray-400 uppercase tracking-wider mb-3">
                        Configurações
                    </p>

                    <a href="#" class="flex items-center gap-3 px-4 py-2 rounded-xl hover:bg-pink-50 hover:text-pink-600 transition">
                        <img class="h-4 opacity-60"
                            src="{{ asset('favicons/account_child_invert_24dp_00000_FILL0_wght400_GRAD0_opsz24.png') }}">
                        Perfil
                    </a>
                </div>

            </nav>

        </aside>


        <main class="flex-1 overflow-y-auto p-8 bg-gray-50">
            @yield('content')
        </main>

    </div>

</div>

</body>
</html>