<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>StudyLab</title>

    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="bg-gray-100 font-sans antialiased">

    <div class="flex h-screen overflow-hidden">

        <aside class="w-64 bg-white shadow-md flex flex-col">

            <div class="p-6 border-b flex items-center gap-2">
                <img src="/images/logosemfundo.png" class="w-32">
            </div>

            <nav class="flex-1 p-4 space-y-2 text-sm">

                <a href="/dashboard" class="flex items-center gap-3 p-2 rounded-md hover:bg-gray-100">
                    <span></span> Dashboard
                </a>

                <p class="text-xs text-gray-400 mt-4">Estudos</p>

                <a href="#" class="flex items-center gap-3 p-2 rounded-md hover:bg-gray-100">
                     Matérias
                </a>

                <a href="#" class="flex items-center gap-3 p-2 rounded-md hover:bg-gray-100">
                     Horários
                </a>

                <a href="#" class="flex items-center gap-3 p-2 rounded-md hover:bg-gray-100">
                     Notas
                </a>

                <p class="text-xs text-gray-400 mt-4">Relatórios</p>

                <a href="#" class="flex items-center gap-3 p-2 rounded-md hover:bg-gray-100">
                     Boletim
                </a>

                <a href="#" class="flex items-center gap-3 p-2 rounded-md hover:bg-gray-100">
                     Progresso
                </a>

                <p class="text-xs text-gray-400 mt-4">Configurações</p>

                <a href="#" class="flex items-center gap-3 p-2 rounded-md hover:bg-gray-100">
                     Perfil
                </a>

            </nav>

        </aside>

        <div class="flex-1 flex flex-col overflow-hidden">

            <header class="bg-white shadow-sm px-6 py-4 flex items-center justify-between">

                <div>
                    <h1 class="text-lg font-semibold text-gray-800">
                        Dashboard
                    </h1>
                    <p class="text-xs text-gray-500">
                        {{ now()->format('l, d/m/Y - H:i') }}
                    </p>
                </div>

                <div class="flex items-center gap-4">

                    <button class="text-gray-500 hover:text-[#FF0073]">
                        Noti
                    </button>

                    <img src="https://wallpapers.com/images/hd/meme-profile-picture-2rhxt0ddudotto63.jpg" class="w-12 h-12 rounded-full ">

                </div>

            </header>

            <main class="flex-1 overflow-y-auto p-6">
                @yield('content')
            </main>

        </div>

    </div>

</body>

</html>
