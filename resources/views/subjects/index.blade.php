@extends('layouts.app')

@section('content')

<div class="min-h-screen flex items-center justify-center bg-gradient-to-br from-[#fdf4f8] via-white to-[#fce7f3] px-6 py-20 relative overflow-hidden">

    <div class="absolute inset-0 opacity-20"
        style="background-image: radial-gradient(circle,#f472b6 1.2px,transparent 1.2px);
        background-size:28px 28px;">
    </div>

    <div class="relative z-10 w-full max-w-6xl">

        <div class="text-center mb-16">
            <h1 class="text-4xl md:text-5xl font-black text-gray-800 mb-4">
                Escolha uma opção
            </h1>

            <p class="text-gray-500 font-medium">
                Selecione o que você deseja acessar
            </p>

            <div class="mt-6 h-1 w-24 mx-auto bg-gradient-to-r from-pink-500 to-pink-400 rounded-full"></div>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-3 gap-10">

            <a href="{{ route('activity.index') }}" class="group relative">

                <div class="absolute -inset-0.5 bg-gradient-to-r from-pink-500 to-pink-400 rounded-2xl blur opacity-0 group-hover:opacity-60 transition duration-500"></div>

                <div class="relative bg-white/80 backdrop-blur-xl border border-pink-100 rounded-2xl p-10 flex flex-col items-center text-center shadow-lg transition-all duration-500 group-hover:-translate-y-3 group-hover:scale-[1.03]">

                    <div class="bg-pink-100 p-6 rounded-2xl mb-6 transition group-hover:scale-110">

                        <svg class="w-14 h-14 text-pink-600" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M8 6h13M8 12h13M8 18h13M3 6h.01M3 12h.01M3 18h.01"/>
                        </svg>

                    </div>

                    <h2 class="text-3xl font-extrabold text-pink-600 mb-3">
                        Atividades
                    </h2>

                    <p class="text-gray-500 text-sm mb-8 max-w-xs">
                        Cadastre e gerencie suas tarefas e exercícios
                        para não perder nenhum prazo.
                    </p>
                </div>

            </a>

            <a href="#" class="group relative">

                <div class="absolute -inset-0.5 bg-gradient-to-r from-purple-500 to-purple-400 rounded-2xl blur opacity-0 group-hover:opacity-60 transition duration-500"></div>

                <div class="relative bg-white/80 backdrop-blur-xl border border-purple-100 rounded-2xl p-10 flex flex-col items-center text-center shadow-lg transition-all duration-500 group-hover:-translate-y-3 group-hover:scale-[1.03]">

                    <div class="bg-purple-100 p-6 rounded-2xl mb-6 transition group-hover:scale-110">

                        <svg class="w-14 h-14 text-purple-600" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M3 16l5-5 4 4 8-8"/>
                            <path stroke-linecap="round" stroke-linejoin="round" d="M14 7h6v6"/>
                        </svg>

                    </div>

                    <h2 class="text-3xl font-extrabold text-purple-600 mb-3">
                        Conteúdos
                    </h2>

                    <p class="text-gray-500 text-sm mb-8 max-w-xs">
                        Acesse materiais de estudo para se preparar
                        melhor para as provas.
                    </p>


                </div>

            </a>

            <a href="{{ route('subject.index') }}" class="group relative">

                <div class="absolute -inset-0.5 bg-gradient-to-r from-teal-500 to-teal-400 rounded-2xl blur opacity-0 group-hover:opacity-60 transition duration-500"></div>

                <div class="relative bg-white/80 backdrop-blur-xl border border-teal-100 rounded-2xl p-10 flex flex-col items-center text-center shadow-lg transition-all duration-500 group-hover:-translate-y-3 group-hover:scale-[1.03]">

                    <div class="bg-teal-100 p-6 rounded-2xl mb-6 transition group-hover:scale-110">

                        <svg class="w-14 h-14 text-teal-600" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M12 6v12M6 12h12"/>
                            <circle cx="12" cy="12" r="9"/>
                        </svg>

                    </div>

                    <h2 class="text-3xl font-extrabold text-teal-600 mb-3">
                        Disciplinas
                    </h2>

                    <p class="text-gray-500 text-sm mb-8 max-w-xs">
                        Cadastre e visualize suas matérias e cursos
                        para uma organização melhor.
                    </p>

                    

                </div>

            </a>

        </div>

    </div>

</div>

@endsection