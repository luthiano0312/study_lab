@extends('layouts.app')

@section('content')
    <div class="space-y-10">

        <div class="flex justify-between items-center">

            <div>
                <h1 class="text-3xl font-bold text-gray-800 tracking-tight">
                    Dashboard
                </h1>

                <span class="text-sm text-pink-500 font-semibold mt-1" id="clock"></span>

                <script>
                    const clock = document.getElementById('clock');
                    setInterval(() => {
                        clock.textContent = new Date().toLocaleTimeString('pt-BR', {
                            hour: '2-digit',
                            minute: '2-digit'
                        });
                    }, 1000);
                </script>

            </div>

            <div class="flex items-center gap-3 bg-white px-5 py-2 rounded-xl shadow-sm border border-pink-100">

                <img class="h-4 opacity-70"
                    src="{{ asset('favicons/calendar_month_24dp_000000_FILL0_wght400_GRAD0_opsz24.png') }}">

                <span class="text-sm text-gray-700">
                    {{ now()->format('d/m/Y') }}
                </span>

            </div>

        </div>



        <div
            class="relative bg-gradient-to-br from-white to-pink-50 border border-pink-100 h-[260px] px-12 py-10 flex items-center rounded-3xl shadow-lg shadow-pink-100 overflow-visible">

            <div class="max-w-2xl z-10">

                <h1 class="text-6xl font-bold text-pink-500 tracking-tight leading-tight">
                    Bem-vindo
                </h1>

                <p class="mt-4 text-gray-600 leading-relaxed">
                    Seu painel de estudos está pronto para acompanhar desempenho,
                    organizar matérias e acompanhar sua evolução acadêmica.
                </p>

            </div>

            <img src="{{ asset('images/welcomeimage.png') }}"
                class="absolute -right-8 -bottom-10 w-[420px]  pointer-events-none">

        </div>



        <div class="grid grid-cols-4 gap-6">

            <div
                class="bg-gradient-to-br from-white  rounded-2xl p-6 border border-pink-100 shadow-lg shadow-pink-100 hover:-translate-y-1 hover:shadow-pink-200 transition">

                <p class="text-sm text-gray-500">Atividades pendentes</p>
                <h2 class="text-3xl font-bold text-gray-800 mt-2">#</h2>

            </div>

            <div
                class="bg-gradient-to-br from-white rounded-2xl p-6 border border-green-100 shadow-lg hover:-translate-y-1 hover:shadow-green-200 transition">

                <p class="text-sm text-gray-500">Atividades concluídas</p>
                <h2 class="text-3xl font-bold text-gray-800 mt-2">#</h2>

            </div>

            <div
                class="bg-gradient-to-br from-white  rounded-2xl p-6 border border-red-100 shadow-lg hover:-translate-y-1 hover:shadow-red-200 transition">

                <p class="text-sm text-gray-500">Atividades atrasadas</p>
                <h2 class="text-3xl font-bold text-gray-800 mt-2">#</h2>

            </div>

            <div
                class="bg-gradient-to-br from-white  rounded-2xl p-6 border border-pink-200 shadow-lg shadow-pink-100 hover:-translate-y-1 hover:shadow-pink-300 transition">

                <p class="text-sm text-gray-500">Total de Atividades</p>
                <h2 class="text-3xl font-bold text-gray-800 mt-2">#</h2>

            </div>

        </div>



        <div class="grid grid-cols-3 gap-6">

            <div
                class="col-span-2 bg-gradient-to-br from-white to-pink-50 rounded-2xl shadow-lg shadow-pink-100 border border-pink-100 p-6">

                <h3 class="text-lg font-semibold text-gray-800 mb-6">
                    Acesso rápido
                </h3>

                <div class="grid grid-cols-2 gap-4">

                    <a href="/subject"
                        class="flex items-center gap-3 bg-white hover:bg-pink-50 border border-pink-100 rounded-xl p-4 transition hover:-translate-y-1 hover:shadow-md">

                        <img class="h-4 opacity-70"
                            src="{{ asset('favicons/book_4_24dp_00000_FILL0_wght400_GRAD0_opsz24.png') }}">

                        <span class="text-gray-700 font-medium">Matérias</span>

                    </a>

                    <a href="/horary"
                        class="flex items-center gap-3 bg-white hover:bg-pink-50 border border-pink-100 rounded-xl p-4 transition hover:-translate-y-1 hover:shadow-md">

                        <img class="h-4 opacity-70"
                            src="{{ asset('favicons/pace_24dp_00000_FILL0_wght400_GRAD0_opsz24.png') }}">

                        <span class="text-gray-700 font-medium">Horários</span>

                    </a>

                    <a href="/notes"
                        class="flex items-center gap-3 bg-white hover:bg-pink-50 border border-pink-100 rounded-xl p-4 transition hover:-translate-y-1 hover:shadow-md">

                        <img class="h-4 opacity-70"
                            src="{{ asset('favicons/news_24dp_00000_FILL0_wght400_GRAD0_opsz24.png') }}">

                        <span class="text-gray-700 font-medium">Notas</span>

                    </a>

                    <a href="#"
                        class="flex items-center gap-3 bg-white hover:bg-pink-50 border border-pink-100 rounded-xl p-4 transition hover:-translate-y-1 hover:shadow-md">

                        <img class="h-4 opacity-70"
                            src="{{ asset('favicons/area_chart_24dp_00000_FILL0_wght400_GRAD0_opsz24.png') }}">

                        <span class="text-gray-700 font-medium">Progresso</span>

                    </a>

                </div>

            </div>



            <div class="bg-gradient-to-br from-pink-500 to-pink-600 rounded-2xl shadow-xl shadow-pink-300 p-6 text-white">

                <p class="text-pink-100 text-sm">
                    Meta semanal
                </p>

                <h2 class="text-4xl font-bold mt-3">
                    78%
                </h2>

                <div class="mt-6">

                    <div class="w-full bg-pink-300/30 h-3 rounded-full overflow-hidden">

                        <div class="bg-white h-3 rounded-full" style="width:78%">
                        </div>

                    </div>

                    <p class="text-xs text-pink-100 mt-2">
                        9 de 12 horas estudadas
                    </p>

                </div>

            </div>

        </div>



        <div class="grid grid-cols-3 gap-6">

            <div
                class="col-span-2 bg-gradient-to-br from-white to-pink-50 rounded-2xl shadow-lg shadow-pink-100 border border-pink-100 p-6">

                <h3 class="text-lg font-semibold text-gray-800 mb-6">
                    Atividade recente
                </h3>

                <div class="space-y-4">

                    <div class="flex justify-between">

                        <span class="text-gray-600">Matemática - Exercícios</span>
                        <span class="text-green-500 text-sm font-medium">Concluído</span>

                    </div>

                    <div class="flex justify-between">

                        <span class="text-gray-600">História - Resumo</span>
                        <span class="text-yellow-500 text-sm font-medium">Em progresso</span>

                    </div>

                    <div class="flex justify-between">

                        <span class="text-gray-600">Física - Lista 4</span>
                        <span class="text-red-500 text-sm font-medium">Atrasado</span>

                    </div>

                </div>

            </div>



            <div
                class="relative bg-gradient-to-r from-pink-500 to-pink-600 rounded-2xl p-8 text-white shadow-xl shadow-pink-300 overflow-visible">

                <h3 class="text-xl font-semibold">
                    Desempenho acadêmico
                </h3>

                <p class="text-pink-100 text-sm mt-2">
                    Veja relatórios completos e acompanhe sua evolução.
                </p>

                <button
                    class="mt-5 bg-white text-pink-600 font-semibold px-5 py-2 rounded-xl hover:scale-105 hover:shadow-lg transition">
                    Ver relatórios
                </button>

                <img src="{{ asset('images/graficosimage.png') }}"
                    class="absolute -right-10 -bottom-10 w-[260px] drop-shadow-[0_30px_50px_rgba(236,72,153,0.45)] pointer-events-none">

            </div>

        </div>

    </div>
@endsection
