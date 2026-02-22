<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <title>Cadastro - Studylab</title>
    @vite('resources/css/app.css')
</head>

<body class="h-screen bg-[#f3f3f3] flex">

    <div class="w-1/2 flex items-center justify-center mb-4">

        <div class="w-[380px] mb-10">

            <div class="flex mx-auto justify-center items-center mb-2">
                <img src="/images/logosemfundo.png" class="w-[250px]">
            </div>

            <form id="registerForm" class="space-y-2 ">

                <div>
                    <label class="text-sm text-gray-600">Nome de Usuário:</label>
                    <input id="name" type="text"
                        class="w-full mt-2 border-b border-gray-300 p-2 bg-transparent focus:outline-none focus:border-[#FF0073]"
                        placeholder="Estudante123" required>
                </div>

                <div>
                    <label class="text-sm text-gray-600">E-mail:</label>
                    <input id="email" type="email"
                        class="w-full mt-2 border-b border-gray-300 p-2 bg-transparent focus:outline-none focus:border-[#FF0073]"
                        placeholder="estudante@gmail.com" required>
                </div>

                <div>
                    <label class="text-sm text-gray-600">Telefone:</label>
                    <input id="phone" type="text"
                        class="w-full mt-2 border-b border-gray-300 p-2 bg-transparent focus:outline-none focus:border-[#FF0073]"
                        placeholder="+55 88 99999999">
                </div>

                <div>
                    <label class="text-sm text-gray-600">Senha:</label>
                    <input id="password" type="password"
                        class="w-full mt-2 border-b border-gray-300 p-2 bg-transparent focus:outline-none focus:border-[#FF0073]"
                        placeholder="********" required>
                </div>

                <div>
                    <label class="text-sm text-gray-600">Confirmar Senha:</label>
                    <input id="password_confirmation" type="password"
                        class="w-full mt-2 border-b border-gray-300 p-2 bg-transparent focus:outline-none focus:border-[#FF0073]"
                        placeholder="********" required>
                </div>

                <button type="submit"
                    class="w-full bg-[#FF0073] text-white py-3 rounded-full shadow-md hover:scale-105 transition duration-300">
                    Cadastro
                </button>

            </form>

            <p class="text-xs text-center mt-2">
                Já tem uma conta?
                <a href="/login" class="text-[#FF0073] font-semibold hover:underline">
                    Login
                </a>
            </p>

            <p id="error" class="text-red-500 text-sm mt-4 text-center hidden"></p>

        </div>
    </div>

    <div class="w-1/2 flex flex-col mr-8 items-center justify-center relative">

        <h2 class="text-[50px] leading-none font-extrabold text-center text-black">
            Registre-se e comece <br>
            <span class="text-[#FF0073]">a se organizar</span>
        </h2>

        <img src="/images/register.png" class="w-[550px] mt-10">

    </div>

    <script src="{{ asset('js/register.js') }}"></script>

</body>

</html>
