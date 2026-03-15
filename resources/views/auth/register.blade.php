<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <title>Cadastro - Studylab</title>
    <link rel="icon" href="{{ asset('favicons/icone.ico') }}">
    <script src="https://unpkg.com/imask"></script>
    @vite('resources/css/app.css')
</head>
<body class="h-screen bg-white flex">

    <div class="w-1/2 flex items-center justify-center">

        <div class="w-[320px]">

            <div class="flex justify-center mb-4">
                <img src="/images/logosemfundo.png" class="w-[150px]">
            </div>

            <form id="registerForm" class="space-y-3">

                <div class="space-y-1">
                    <label class="text-xs text-gray-500">Nome de Usuário</label>
                    <input id="name" type="text" class="input-field text-sm"
                        placeholder="Estudante123" required>
                    <p class="error-text hidden" id="error-name"></p>
                </div>


                <div class="space-y-1">
                    <label class="text-xs text-gray-500">E-mail</label>
                    <input id="email" type="email" class="input-field text-sm"
                        placeholder="estudante@gmail.com" required>
                    <p class="error-text hidden" id="error-email"></p>
                </div>

                <div class="space-y-1">
                    <label class="text-xs text-gray-500">Telefone</label>
                    <input id="phone" type="text" class="input-field text-sm"
                        placeholder="(88) 99999-9999">
                    <p class="error-text hidden" id="error-phone"></p>
                </div>

                <div class="space-y-1">
                    <label class="text-xs text-gray-500">Senha</label>
                    <input id="password" type="password" class="input-field text-sm"
                        placeholder="********" required>
                    <p class="error-text hidden" id="error-password"></p>
                </div>

                <div class="space-y-1">
                    <label class="text-xs text-gray-500">Confirmar Senha</label>
                    <input id="password_confirmation" type="password"
                        class="input-field text-sm"
                        placeholder="********" required>
                    <p class="error-text hidden"
                        id="error-password_confirmation"></p>
                </div>

                <button type="submit"
                    class="w-full mt-3 bg-[#FF0073] text-white py-2.5 text-sm rounded-full 
                           hover:scale-[1.02] transition duration-300">
                    Cadastro
                </button>

            </form>

            <p class="text-[11px] text-center mt-3">
                Já tem uma conta?
                <a href="/login"
                    class="text-[#FF0073] font-semibold hover:underline">
                    Login
                </a>
            </p>

        </div>
    </div>

    <div class="w-1/2 flex flex-col items-center justify-center">

        <h2 class="text-[42px] leading-tight font-extrabold text-center text-black">
            Registre-se e comece <br>
            <span class="text-[#FF0073]">a se organizar</span>
        </h2>

        <img src="/images/register.png" class="w-[480px] mt-8">

    </div>
    <script src="{{ asset('js/register.js') }}"></script>
</body>

</html>
