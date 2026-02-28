@extends('layouts.app')

@section('content')
    <div>

        <div class="text-center mb-10">
            <h1 class="text-3xl font-extrabold text-gray-800 mb-2">Escolha uma opção</h1>
            <p class="text-gray-400 font-semibold text-base">Selecione o que você deseja acessar</p>
            <div class="mt-3 h-0.5 w-16 bg-[#E91E63] mx-auto rounded-full opacity-60"></div>
        </div>


        <div class="grid grid-cols-1 md:grid-cols-3 gap-7  mx-auto w-full max-w-4xl">

            <div class="card-hover hover:scale-[1.02] transition bg-white h-[420px]  rounded-sm shadow-md flex flex-col items-center p-8 gap-4 border border-pink-100">
                <div class="bg-[#FCE4EC] rounded-2xl p-5 relative">
                    <svg class="w-14 h-14 text-[#E91E63]" fill="none" stroke="currentColor" stroke-width="1.5"
                        viewBox="0 0 24 24">
                        <rect x="5" y="2" width="14" height="20" rx="2" fill="#F8BBD0" stroke="#E91E63"
                            stroke-width="1.5" />
                        <path d="M9 7h6M9 11h4" stroke="#E91E63" stroke-width="1.5" stroke-linecap="round" />
                    </svg>
                    <div class="absolute -bottom-2 -right-2 bg-[#E91E63] rounded-full p-1.5 shadow-md">
                        <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" stroke-width="2.5"
                            viewBox="0 0 24 24">
                            <path d="M5 13l4 4L19 7" />
                        </svg>
                    </div>
                </div>
                <div class="text-center">
                    <h2 class="text-[30px] pt-8 font-extrabold text-[#E91E63]">Atividades</h2>
                <p class="text-gray-400 text-sm text-center pt-1 font-semibold leading-relaxed">Cadastre e gerencie suas tarefas e
                    exercícios para não se perder nos prazos!!</p>
                </div>
                <a
                    class="mt-[20px] hover:cursor-pointer w-full bg-[#E91E63] hover:bg-[#C2185B] text-white justify-center text-center align-center flex font-bold rounded-xl py-3 transition-colors shadow-md shadow-pink-200">
                    Selecionar
                </a>
            </div>

            <div class="card-hover hover:scale-[1.02] transition h-[420px]  bg-white rounded-sm shadow-md flex flex-col items-center p-8 gap-4 border border-purple-100">
                <div class="bg-[#EDE9FE] rounded-2xl p-5">
                    <svg class="w-14 h-14" fill="none" stroke="#7C3AED" stroke-width="1.5" viewBox="0 0 24 24">
                        <path
                            d="M2 6.5C2 5.12 3.12 4 4.5 4h15C20.88 4 22 5.12 22 6.5v11c0 1.38-1.12 2.5-2.5 2.5h-15C3.12 20 2 18.88 2 17.5v-11z"
                            fill="#EDE9FE" stroke="#7C3AED" />
                        <path d="M12 4v16M2 12h20" stroke="#7C3AED" stroke-width="1.2" stroke-dasharray="3 2" />
                    </svg>
                </div>
                <div class="text-center" >
                    <h2 class="text-[30px] pt-8 font-extrabold text-[#7C3AED]">Conteúdos</h2>
                    <p class="text-gray-400 text-sm pt-1  text-center font-semibold leading-relaxed">Acesse materiais de estudo para se preparar mehlor para as provas!!!</p>
                </div>
                <a
                    class="mt-[20px] hover:cursor-pointer w-full bg-[#7C3AED] hover:bg-[#6D28D9] text-white justify-center text-center align-center flex font-bold rounded-xl py-3 transition-colors shadow-md shadow-purple-200">
                    Selecionar
                </a>
            </div>

            <div class="card-hover hover:scale-[1.02] transition h-[420px] bg-white rounded-sm shadow-md flex flex-col items-center p-8 gap-4 border border-teal-100">
                <div class="bg-[#CCFBF1] rounded-2xl p-5">
                    <svg class="w-14 h-14" fill="none" stroke="#0D9488" stroke-width="1.5" viewBox="0 0 24 24">
                        <circle cx="12" cy="12" r="4" fill="#CCFBF1" stroke="#0D9488" stroke-width="1.5" />
                        <ellipse cx="12" cy="12" rx="10" ry="4" stroke="#0D9488"
                            stroke-width="1.5" />
                        <ellipse cx="12" cy="12" rx="10" ry="4" stroke="#0D9488"
                            stroke-width="1.5" transform="rotate(60 12 12)" />
                        <ellipse cx="12" cy="12" rx="10" ry="4" stroke="#0D9488"
                            stroke-width="1.5" transform="rotate(120 12 12)" />
                    </svg>
                </div>
                <div class="text-center">
                    <h2 class="text-[30px] pt-8 font-extrabold text-[#0D9488]">Disciplinas</h2>
                    <p class="text-gray-400 p-1 text-sm  text-center font-semibold leading-relaxed">Cadastre e veja suas matérias e cursos para uma mehlor organização!!!</p>
                </div>
                <a href="{{ route('subject.index') }}" class="mt-[20px] hover:cursor-pointer w-full bg-[#0D9488] hover:bg-[#0F766E] text-white justify-center text-center align-center flex font-bold rounded-xl py-3 transition-colors shadow-md shadow-teal-200">
                    Selecionar
                </a>
            </div>

        </div>
        </main>
    </div>



  
@endsection
