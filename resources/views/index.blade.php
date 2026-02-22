<!DOCTYPE html>
<html lang="pt-BR">
<head>
  <meta charset="UTF-8">
  <title>Studylab</title>
  <link rel="stylesheet" href="{{asset('css/home.css')}}">
  @vite('resources/css/app.css')
</head>

<body class="overflow-x-hidden m-0 font-family: 'Figtree', sans-serif">

<header class="fixed top-0 left-0 w-full bg-white h-20 shadow-[0_6px_15px_rgba(0,0,0,0.15)] z-50">
  <div class="flex justify-between items-center h-full px-32">
    <div>
      <img src="{{ asset('images/Logosemfundo.png') }}" class="w-20" alt="Logo">
    </div>
    <div class="flex items-center gap-6">
      <a <a href="/login" class="text-[#FF0073] px-4 py-1.5 rounded-md font-medium transition duration-500 ease-out hover:bg-[#FF0073] hover:text-white">
        Entrar
      </a>
      <a href="#" class="bg-[#FF0073] px-4 py-1.5 flex items-center justify-center font-medium text-white rounded-md transition duration-300 ease-in hover:bg-[#d10c65]">
        Criar conta
      </a>
    </div>
  </div>
</header>

<section class="reveal opacity-0 translate-y-10 transition-all duration-700 h-screen pt-20 flex items-center justify-center bg-white z-10">
  <div class="flex justify-between gap-[200px]">
    <div class="mt-[60px]">
      <h1 class="font-bold text-[95px] leading-none pl-[50px]">
        <b>Bem vindo a <br>
        <span class="text-[#FF0073]">Studylab</span></b>
      </h1>
      <h3 class="pt-[20px] text-[25px] font-light pl-[50px]">
        Conheça sua escola online, e comece a se organizar <br>
        da melhor forma
      </h3>
    </div>
    <div>
      <img class="w-[550px]" src="{{asset('images/session1image.png')}}" alt="">
    </div>
  </div>
</section>

<section class="h-screen flex items-center justify-center bg-[#f5f5f5] z-20">
  <div class="max-w-[1200px] w-full px-6">
    <div class="mb-14 text-center">
      <h2 class="text-[32px] font-bold text-black">
        O que temos para você
      </h2>
    </div>

    <div class="grid grid-cols-3 gap-10">

      <div class="reveal opacity-0 translate-y-10 transition-all duration-700 bg-white rounded-2xl p-6 shadow-[0_6px_15px_rgba(0,0,0,0.12)] hover:-translate-y-2">
        <div class="w-12 h-12 rounded-xl bg-pink-100 flex items-center justify-center mb-4">
          <div class="w-6 h-6 bg-pink-500 rounded-md"></div>
        </div>
        <h3 class="font-semibold text-[18px] mb-2">Dashboard</h3>
        <p class="text-sm text-gray-500">
          Acompanhe seu desempenho através de uma dashboard avaliativa
        </p>
      </div>

      <div class="reveal opacity-0 translate-y-10 transition-all duration-700 bg-white rounded-2xl p-6 shadow-[0_6px_15px_rgba(0,0,0,0.12)] hover:-translate-y-2">
        <div class="w-12 h-12 rounded-xl bg-green-100 flex items-center justify-center mb-4">
          <div class="w-6 h-6 bg-green-500 rounded-md"></div>
        </div>
        <h3 class="font-semibold text-[18px] mb-2">Matérias</h3>
        <p class="text-sm text-gray-500">
          Cadastro de suas disciplinas escolares
        </p>
      </div>

      <div class="reveal opacity-0 translate-y-10 transition-all duration-700 bg-white rounded-2xl p-6 shadow-[0_6px_15px_rgba(0,0,0,0.12)] hover:-translate-y-2">
        <div class="w-12 h-12 rounded-xl bg-yellow-100 flex items-center justify-center mb-4">
          <div class="w-6 h-6 bg-yellow-500 rounded-md"></div>
        </div>
        <h3 class="font-semibold text-[18px] mb-2">Horários</h3>
        <p class="text-sm text-gray-500">
          Cadastro de seus horários para nunca se perder
        </p>
      </div>

      <div class="reveal opacity-0 translate-y-10 transition-all duration-700 bg-white rounded-2xl p-6 shadow-[0_6px_15px_rgba(0,0,0,0.12)] hover:-translate-y-2">
        <div class="w-12 h-12 rounded-xl bg-blue-100 flex items-center justify-center mb-4">
          <div class="w-6 h-6 bg-blue-500 rounded-md"></div>
        </div>
        <h3 class="font-semibold text-[18px] mb-2">Notas</h3>
        <p class="text-sm text-gray-500">
          Registro de notas de cada período para todas as escolaridades
        </p>
      </div>

      <div class="reveal opacity-0 translate-y-10 transition-all duration-700 bg-white rounded-2xl p-6 shadow-[0_6px_15px_rgba(0,0,0,0.12)] hover:-translate-y-2">
        <div class="w-12 h-12 rounded-xl bg-orange-100 flex items-center justify-center mb-4">
          <div class="w-6 h-6 bg-orange-500 rounded-md"></div>
        </div>
        <h3 class="font-semibold text-[18px] mb-2">Boletim</h3>
        <p class="text-sm text-gray-500">
          Visualização de seu boletim e opção de download em PDF
        </p>
      </div>

      <div class="reveal opacity-0 translate-y-10 transition-all duration-700 bg-white rounded-2xl p-6 shadow-[0_6px_15px_rgba(0,0,0,0.12)] hover:-translate-y-2">
        <div class="w-12 h-12 rounded-xl bg-red-100 flex items-center justify-center mb-4">
          <div class="w-6 h-6 bg-red-500 rounded-md"></div>
        </div>
        <h3 class="font-semibold text-[18px] mb-2">Progresso</h3>
        <p class="text-sm text-gray-500">
          Gráficos e comparação entre bimestres para melhorar sua evolução
        </p>
      </div>

    </div>
  </div>
</section>

<section class="h-screen flex items-center justify-center bg-white z-30">
  <div class="reveal opacity-0 translate-y-10 transition-all duration-700">
    <img src="{{ asset('images/session3image.png') }}" class="h-[500px]" alt="">
  </div>
</section>

<section class="reveal opacity-0 translate-y-10 transition-all duration-700 h-screen flex items-center justify-center bg-[#f5f5f5] z-40">
  <div class="relative h-[420px] w-[1200px] bg-gradient-to-r from-[#F40D75] to-[#C7045C] rounded-[20px] px-20">
    <div class="absolute top-8 left-1/2 -translate-x-1/2 flex flex-col items-center text-center">
      <h1 class="font-bold text-[40px] text-white">
        Studylab
      </h1>
      <h3 class="text-white font-light text-[16px] mt-2 opacity-90">
        Tudo que você precisa para gerenciar sua vida escolar
      </h3>
    </div>

    <div class="absolute bottom-16 left-1/2 -translate-x-1/2 w-full mb-[30px] max-w-[900px]">
      <div class="grid grid-cols-3 text-white">
        <div class="flex flex-col items-center text-center">
          <h2 class="text-[60px] font-bold">100%</h2>
          <p class="text-sm font-light mt-2">Funcional</p>
        </div>
        <div class="flex flex-col items-center text-center">
          <h2 class="text-[60px] font-bold">100%</h2>
          <p class="text-sm font-light mt-2">Gratuito</p>
        </div>
        <div class="flex flex-col items-center text-center">
          <h2 class="text-[60px] font-bold">24/7</h2>
          <p class="text-sm font-light mt-2">Disponível</p>
        </div>
      </div>
    </div>
  </div>
</section>

<section class="h-screen flex flex-col justify-between bg-[#f2f2f2] z-50">
  <div class="flex-1 flex flex-col items-center justify-center text-center px-6">
    <h2 class="text-[40px] font-bold text-black">
      <b>Comece agora</b>
    </h2>
    <p class="mt-4 text-gray-600 font-light text-[16px]">
      Cadastre-se agora e comece a organizar seu futuro
    </p>
    <button class="mt-6 bg-[#F40D75] hover:bg-[#d10c65] text-white px-8 py-3 rounded-lg font-semibold transition duration-300">
      Criar conta
    </button>
  </div>

  <footer class="bg-[#2b2b2b] text-center py-6">
    <p class="text-gray-400 text-sm">
      Studylab 2025
    </p>
  </footer>
</section>
<script src="{{ asset('js/home.js ')}}"></script>
</body>
</html>