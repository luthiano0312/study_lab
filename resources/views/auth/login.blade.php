<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <title>Login - Studylab</title>
    @vite('resources/css/app.css')
</head>

<body class="h-screen bg-[#f3f3f3] flex">

    <div class="w-1/2 flex items-center justify-center">

        <div class="w-[380px] mb-8">

            <div class="flex mx-auto justify-center items-center mb-6">
                <img src="/images/logosemfundo.png" class="w-64">
            </div>
            <p id="error" class="text-red-500 text-sm mt-4 text-center hidden"></p>
            <form id="loginForm" class="space-y-6">

                <div>
                    <label class="text-sm text-gray-600">Email:</label>
                    <input id="email" type="email"
                        class="w-full mt-2 border-b border-gray-300 p-2 bg-transparent focus:outline-none focus:border-[#FF0073]"
                        placeholder="Seu e-mail cadastrado" required>
                </div>

                <div>
                    <label class="text-sm text-gray-600">Senha:</label>
                    <input id="password" type="password"
                        class="w-full mt-2 border-b border-gray-300 p-2 bg-transparent focus:outline-none focus:border-[#FF0073]"
                        placeholder="Sua senha cadastrada" required>
                </div>

                <div class="flex items-center justify-between text-xs text-gray-500">
                    <div class="flex items-center gap-2">
                        <input type="checkbox" class="accent-[#FF0073]">
                        <span>Mantenha-me logado</span>
                    </div>
                    <a href="/forgot" class="text-[#FF0073] hover:underline">Esqueceu sua senha?</a>
                </div>

                <button type="submit"
                    class="w-full bg-[#FF0073] text-white py-3 rounded-full shadow-md hover:scale-105 transition duration-300">
                    Login
                </button>

            </form>

            <p class="text-xs text-center mt-6">
                Ainda não tem conta?
                <a href="/register" class="text-[#FF0073] font-semibold hover:underline">
                    Cadastrar
                </a>
            </p>

            

        </div>
    </div>

    <div class="w-1/2 flex flex-col mr-8 items-center justify-center relative">

        <h2 class="text-[80px] leading-none font-extrabold text-center  text-black">
            Entre e <br> <span  class="text-[#FF0073] ">aproveite</span>
        </h2>
        

        <img src="/images/login.png" class="w-[670px] mt-10">

    </div>

    <script src="{{ asset('js/login.js') }}"></script>

</body>

</html>
