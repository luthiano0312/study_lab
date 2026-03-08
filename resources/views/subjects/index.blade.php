@extends('layouts.app')

@section('content')
<div class="min-h-screen bg-gradient-to-br from-[#fdf4f8] via-white to-[#fce7f3] relative overflow-hidden py-16 px-6">

    <div class="absolute inset-0 opacity-25 pointer-events-none"
         style="background-image: radial-gradient(circle,#f9a8d4 1.2px,transparent 1.2px);
                background-size: 28px 28px;">
    </div>

    <div class="relative z-10 max-w-5xl mx-auto">

        <div class="text-center mb-14">
            <h1 class="text-4xl font-black text-gray-800 mb-3">Escolha uma opção</h1>
            <p class="text-gray-500 font-semibold text-base">Selecione o que você deseja acessar</p>
            <div class="mt-4 h-1 w-20 bg-gradient-to-r from-pink-500 to-pink-400 mx-auto rounded-full"></div>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-3 gap-8">

            <div class="bg-white/80 backdrop-blur-xl rounded-2xl shadow-xl shadow-pink-200/40 border border-pink-100 p-8 flex flex-col items-center transition-all duration-300 hover:-translate-y-2 hover:shadow-2xl">

                <div class="bg-pink-100 rounded-2xl p-6 relative shadow-md">
                    <svg class="w-14 h-14 text-pink-600" fill="none" stroke="currentColor" stroke-width="1.5"
                        viewBox="0 0 24 24">
                        <rect x="5" y="2" width="14" height="20" rx="2" fill="#F8BBD0" stroke="#E91E63"
                            stroke-width="1.5" />
                        <path d="M9 7h6M9 11h4" stroke="#E91E63" stroke-width="1.5" stroke-linecap="round" />
                    </svg>
                    <div class="absolute -bottom-2 -right-2 bg-pink-600 rounded-full p-1.5 shadow-md">
                        <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" stroke-width="2.5"
                            viewBox="0 0 24 24">
                            <path d="M5 13l4 4L19 7" />
                        </svg>
                    </div>
                </div>

                <h2 class="text-3xl font-extrabold text-pink-600 mt-8">Atividades</h2>

                <p class="text-gray-500 text-sm text-center mt-2 font-semibold leading-relaxed">
                    Cadastre e gerencie suas tarefas e exercícios para não se perder nos prazos!
                </p>

                <a href="{{ route('activity.index') }}"
                   class="mt-8 w-full bg-gradient-to-r from-pink-600 to-pink-500 hover:from-pink-700 hover:to-pink-600 text-white text-center font-bold rounded-xl py-3 transition-all shadow-lg shadow-pink-300/40 hover:-translate-y-1">
                    Selecionar
                </a>
            </div>

            <div class="bg-white/80 backdrop-blur-xl rounded-2xl shadow-xl shadow-purple-200/40 border border-purple-100 p-8 flex flex-col items-center transition-all duration-300 hover:-translate-y-2 hover:shadow-2xl">

                <div class="bg-purple-100 rounded-2xl p-6 shadow-md">
                    <svg class="w-14 h-14" fill="none" stroke="#7C3AED" stroke-width="1.5" viewBox="0 0 24 24">
                        <path
                            d="M2 6.5C2 5.12 3.12 4 4.5 4h15C20.88 4 22 5.12 22 6.5v11c0 1.38-1.12 2.5-2.5 2.5h-15C3.12 20 2 18.88 2 17.5v-11z"
                            fill="#EDE9FE" stroke="#7C3AED" />
                        <path d="M12 4v16M2 12h20" stroke="#7C3AED" stroke-width="1.2" stroke-dasharray="3 2" />
                    </svg>
                </div>

                <h2 class="text-3xl font-extrabold text-purple-600 mt-8">Conteúdos</h2>

                <p class="text-gray-500 text-sm text-center mt-2 font-semibold leading-relaxed">
                    Acesse materiais de estudo para se preparar melhor para as provas!
                </p>

                <a class="mt-14 w-full bg-gradient-to-r from-purple-600 to-purple-500 hover:from-purple-700 hover:to-purple-600 text-white text-center font-bold rounded-xl py-3 transition-all shadow-lg shadow-purple-300/40 hover:-translate-y-1">
                    Selecionar
                </a>
            </div>

            <div class="bg-white/80 backdrop-blur-xl rounded-2xl shadow-xl shadow-teal-200/40 border border-teal-100 p-8 flex flex-col items-center transition-all duration-300 hover:-translate-y-2 hover:shadow-2xl">

                <div class="bg-teal-100 rounded-2xl p-6 shadow-md">
                    <svg class="w-14 h-14" fill="none" stroke="#0D9488" stroke-width="1.5" viewBox="0 0 24 24">
                        <circle cx="12" cy="12" r="4" fill="#CCFBF1" stroke="#0D9488" stroke-width="1.5" />
                        <ellipse cx="12" cy="12" rx="10" ry="4" stroke="#0D9488" stroke-width="1.5" />
                        <ellipse cx="12" cy="12" rx="10" ry="4" stroke="#0D9488" stroke-width="1.5" transform="rotate(60 12 12)" />
                        <ellipse cx="12" cy="12" rx="10" ry="4" stroke="#0D9488" stroke-width="1.5" transform="rotate(120 12 12)" />
                    </svg>
                </div>

                <h2 class="text-3xl font-extrabold text-teal-600 mt-8">Disciplinas</h2>

                <p class="text-gray-500 text-sm text-center mt-2 font-semibold leading-relaxed">
                    Cadastre e veja suas matérias e cursos para uma melhor organização!
                </p>

                <a href="{{ route('subject.index') }}"
                   class="mt-8 w-full bg-gradient-to-r from-teal-600 to-teal-500 hover:from-teal-700 hover:to-teal-600 text-white text-center font-bold rounded-xl py-3 transition-all shadow-lg shadow-teal-300/40 hover:-translate-y-1">
                    Selecionar
                </a>
            </div>

        </div>

    </div>

</div>
@endsection