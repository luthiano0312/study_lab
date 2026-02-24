<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <title>Recuperar Senha - Studylab</title>
    @vite('resources/css/app.css')
</head>

<body class="min-h-screen flex items-center justify-center bg-gray-100">

    <div class="w-full max-w-md bg-white shadow-lg rounded-2xl p-8">

        <div class="flex justify-center mb-6">
            <img src="/images/logosemfundo.png" class="w-40">
        </div>

        <h2 class="text-xl font-semibold text-gray-800 text-center mb-2">
            Esqueceu sua senha?
        </h2>

        <p class="text-sm text-gray-600 text-center mb-6">
            Sem problemas. Informe seu e-mail e enviaremos um link para redefinir sua senha.
        </p>

        <form id="forgotForm" class="space-y-6">

            <div>
                <label class="block text-sm font-medium text-gray-700">
                    Email
                </label>
                <input id="email" type="email"
                    class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-[#FF0073] focus:ring-[#FF0073]"
                    required>
            </div>

            <button type="submit"
                class="w-full bg-[#FF0073] text-white py-2.5 rounded-md font-semibold hover:bg-[#d10c65] transition">
                Enviar link de redefinição
            </button>

        </form>

        <p id="message" class="text-green-600 text-sm mt-4 text-center hidden"></p>
        <p id="error" class="text-red-500 text-sm mt-4 text-center hidden"></p>

        <div class="text-center mt-6">
            <a href="/login" class="text-sm text-[#FF0073] hover:underline">
                Voltar para login
            </a>
        </div>

    </div>



</body>

</html>
