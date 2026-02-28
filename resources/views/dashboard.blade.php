@extends('layouts.app')

@section('content')
    <div class="space-y-8">



        <div class="flex justify-between items-center">

            <div>
                <h1 class="text-3xl font-bold text-gray-800 tracking-tight">
                    Dashboard
                </h1>
                <p class="text-sm text-pink-500 font-semibold mt-1">
                    {{ now()->format('H:i') }}
                </p>
            </div>

            <div class="flex items-center gap-3 bg-white px-5 py-2 rounded-xl shadow-sm border border-gray-100">
                <img class="h-4 opacity-60"
                    src="{{ asset('favicons/calendar_month_24dp_000000_FILL0_wght400_GRAD0_opsz24.png') }}">
                <span class="text-sm text-gray-600">
                    {{ now()->format('d/m/Y') }}
                </span>
            </div>

        </div>

        <div class="relative bg-white h-[260px] px-12 py-10 flex items-center rounded-3xl shadow-md overflow-visible">

            <div class="max-w-2xl z-10">
                <h1 class="text-4xl font-bold  text-pink-500 tracking-tight leading-tight">
                    Bem-vindo<br>
                    Sua dashboard está pronta!
                </h1>

                <p class="mt-4  text-gray-600 leading-relaxed">
                    Seu painel de status está disponível para você visualizar e gerenciar
                    sua vida estudantil de forma simples, organizada e eficiente.
                </p>
            </div>

            <img src="{{ asset('images/welcomeimage.png') }}"
                class="absolute -right-6 -bottom-6 w-[380px] drop-shadow-2xl pointer-events-none">

        </div>


        <div class="grid grid-cols-3 gap-6">

            <div
                class="bg-white rounded-2xl p-6 shadow-lg shadow-pink-100 border border-gray-100 hover:scale-[1.02] transition">

                <div class="flex justify-between items-start">
                    <div>
                        <p class="text-sm text-gray-500">Atividades pendentes</p>
                        <h2 class="text-3xl font-bold text-gray-800 mt-2">#</h2>
                    </div>

                    <div class="bg-pink-100 text-pink-600 p-3 rounded-xl">

                    </div>
                </div>

            </div>

            <div
                class="bg-white rounded-2xl p-6 shadow-lg shadow-pink-100 border border-gray-100 hover:scale-[1.02] transition">

                <div class="flex justify-between items-start">
                    <div>
                        <p class="text-sm text-gray-500">Atividades concluídas</p>
                        <h2 class="text-3xl font-bold text-gray-800 mt-2">#</h2>
                    </div>

                    <div class="bg-green-100 text-green-600 p-3 rounded-xl">

                    </div>
                </div>

            </div>

            <div
                class="bg-white rounded-2xl p-6 shadow-lg shadow-pink-100 border border-gray-100 hover:scale-[1.02] transition">

                <div class="flex justify-between items-start">
                    <div>
                        <p class="text-sm text-gray-500">Atividades atrasadas</p>
                        <h2 class="text-3xl font-bold text-gray-800 mt-2">#</h2>
                    </div>

                    <div class="bg-red-100 text-red-600 p-3 rounded-xl">

                    </div>
                </div>

            </div>

        </div>



        <div class="relative bg-gradient-to-r from-pink-500 to-pink-600 rounded-3xl p-10 text-white shadow-xl">

            <div class="flex items-center justify-between">

                <div class="max-w-lg">
                    <h3 class="text-2xl font-semibold">
                        Gráficos de desempenho
                    </h3>

                    <p class="text-pink-100 mt-2 text-sm">
                        Acompanhe sua evolução acadêmica e identifique pontos de melhoria.
                    </p>

                    <button
                        class="mt-6 bg-white text-pink-600 font-semibold px-6 py-2 rounded-xl hover:scale-105 transition">
                        Ver Relatórios
                    </button>
                </div>

            </div>

            <img src="{{ asset('images/graficosimage.png') }}"
                class="absolute right-8 bottom-0 w-[320px] opacity-95  pointer-events-none">

        </div>

    </div>



    <div class="grid mt-6 grid-cols-3 gap-6">

        <div class="col-span-2 bg-white rounded-2xl shadow-lg border border-gray-100 p-6">

            <h3 class="text-lg font-semibold text-gray-800 mb-4">
                Acesso Rápido
            </h3>

            <div class="grid grid-cols-2 gap-4">

                <a href="#" class="bg-gray-50 hover:bg-pink-50 transition rounded-xl p-4 flex items-center gap-3">
                    <img class="h-4 opacity-60" src="{{ asset('favicons/book_4_24dp_00000_FILL0_wght400_GRAD0_opsz24.png') }}">
                    <span>Matérias</span>
                </a>

                <a href="#" class="bg-gray-50 hover:bg-pink-50 transition rounded-xl p-4 flex items-center gap-3">
                    <img class="h-4 opacity-60" src="{{ asset('favicons/pace_24dp_00000_FILL0_wght400_GRAD0_opsz24.png') }}">
                    <span>Horários</span>
                </a>

                <a href="#" class="bg-gray-50 hover:bg-pink-50 transition rounded-xl p-4 flex items-center gap-3">
                    <img class="h-4 opacity-60" src="{{ asset('favicons/news_24dp_00000_FILL0_wght400_GRAD0_opsz24.png') }}">
                    <span>Notas</span>
                </a>

                <a href="#" class="bg-gray-50 hover:bg-pink-50 transition rounded-xl p-4 flex items-center gap-3">
                    <img class="h-4 opacity-60" src="{{ asset('favicons/area_chart_24dp_00000_FILL0_wght400_GRAD0_opsz24.png') }}">
                    <span>Progresso</span>
                </a>

            </div>

        </div>


        <div class="bg-white rounded-2xl shadow-lg border border-gray-100 p-6">

            <p class="text-sm text-gray-500">
                Média do Período
            </p>

            <h2 class="text-5xl font-bold text-pink-600 mt-3">
                #
            </h2>

            <div class="mt-6">
                <div class="w-full bg-gray-100 h-3 rounded-full">
                    <div class="bg-gradient-to-r from-pink-400 to-pink-600 h-3 rounded-full" style="width: 78%">
                    </div>
                </div>

                <p class="text-xs text-gray-400 mt-2">
                    78% de desempenho
                </p>
            </div>

        </div>

    </div>

    </div>
@endsection
