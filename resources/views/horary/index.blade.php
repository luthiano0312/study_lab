@extends('layouts.app')

@section('content')

<div class="min-h-screen flex items-center justify-center bg-gradient-to-br from-[#fdf4f8] via-white to-[#fce7f3] px-6 py-20 relative overflow-hidden">

    <div class="absolute inset-0 opacity-20"
        style="background-image: radial-gradient(circle,#f472b6 1.2px,transparent 1.2px);
        background-size:28px 28px;">
    </div>

    <div class="relative z-10 w-full max-w-5xl">

        <div class="text-center mb-16">
            <h1 class="text-4xl md:text-5xl font-black text-gray-800 mb-4">
                Escolha uma opção
            </h1>

            <p class="text-gray-500 font-medium">
                Selecione como deseja registrar seus horários
            </p>

            <div class="mt-6 h-1 w-24 mx-auto bg-gradient-to-r from-pink-500 to-pink-400 rounded-full"></div>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-10">

            <a href="{{ route('activity.index') }}" class="group relative">

                <div class="absolute -inset-0.5 bg-gradient-to-r from-pink-500 to-pink-400 rounded-2xl blur opacity-0 group-hover:opacity-60 transition duration-500"></div>

                <div class="relative bg-white/80 backdrop-blur-xl border border-pink-100 rounded-2xl p-10 flex flex-col items-center text-center shadow-lg transition-all duration-500 group-hover:-translate-y-3 group-hover:scale-[1.02]">

                    <div class="bg-pink-100 p-6 rounded-2xl mb-6 transition group-hover:scale-110">

                        <svg class="w-14 h-14 text-pink-600" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M9 12h6m-6 4h6M7 4h10a2 2 0 012 2v12a2 2 0 01-2 2H7a2 2 0 01-2-2V6a2 2 0 012-2z"/>
                        </svg>

                    </div>

                    <h2 class="text-3xl font-extrabold text-pink-600 mb-3">
                        Manualmente
                    </h2>

                    <p class="text-gray-500 text-sm mb-8 max-w-xs">
                        Cadastre e gerencie seus horários manualmente, utilizando suas matérias cadastradas.
                    </p>

                </div>
            </a>

            <a href="#" class="group relative">

                <div class="absolute -inset-0.5 bg-gradient-to-r from-purple-500 to-purple-400 rounded-2xl blur opacity-0 group-hover:opacity-60 transition duration-500"></div>

                <div class="relative bg-white/80 backdrop-blur-xl border border-purple-100 rounded-2xl p-10 flex flex-col items-center text-center shadow-lg transition-all duration-500 group-hover:-translate-y-3 group-hover:scale-[1.02]">

                    <div class="bg-purple-100 p-6 rounded-2xl mb-6 transition group-hover:scale-110">

                        <svg class="w-14 h-14 text-purple-600" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M3 16l4-4a3 3 0 014.243 0L15 15l2-2a3 3 0 014.243 0L21 14"/>
                            <path stroke-linecap="round" stroke-linejoin="round" d="M14 7h.01M3 20h18a1 1 0 001-1V5a1 1 0 00-1-1H3a1 1 0 00-1 1v14a1 1 0 001 1z"/>
                        </svg>

                    </div>

                    <h2 class="text-3xl font-extrabold text-purple-600 mb-3">
                        Upload de foto
                    </h2>

                    <p class="text-gray-500 text-sm mb-8 max-w-xs">
                        Tire uma foto da atividade e deixe o sistema
                        organizar automaticamente para você.
                    </p>
                </div>
            </a>

        </div>

    </div>

</div>

@endsection