<!DOCTYPE html>
<html lang="pt-BR" class="h-full">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Login | Studylab</title>

    <link rel="icon" href="{{ asset('favicons/icone.ico') }}">

    <script src="https://cdn.tailwindcss.com"></script>

    <style>
        @keyframes fadeUp {
            0% {
                opacity: 0;
                transform: translateY(30px);
            }

            100% {
                opacity: 1;
                transform: translateY(0);
            }
        }

        @keyframes float {

            0%,
            100% {
                transform: translateY(0)
            }

            50% {
                transform: translateY(-18px)
            }
        }


        @keyframes logoPop {
            0% {
                opacity: 0;
                transform: scale(.8);
            }

            100% {
                opacity: 1;
                transform: scale(1);
            }
        }

        .animate-fade {
            animation: fadeUp .8s ease forwards;
        }

        .animate-float {
            animation: float 6s ease-in-out infinite;
        }

        .animate-logo {
            animation: logoPop .8s ease forwards;
        }
    </style>

</head>

<body class="h-full overflow-y-hidden bg-white font-sans antialiased">

    <div class="flex h-full">


        <div class="hidden lg:flex lg:w-3/5 bg-gray-50 items-center justify-center p-16">

            <div class="max-w-xl text-center animate-fade">

                <h1 class="text-[60px] font-extrabold text-gray-900 leading-tight">
                    Domine seus<br>
                    <span class="text-[#FF0073]">estudos agora</span>
                </h1>

                <div class="mt-14 animate-float">
                    <img src="/images/login.png" class="w-[820px] mx-auto drop-shadow-2xl">
                </div>

            </div>

        </div>


        <div class="w-full lg:w-2/5 flex items-center justify-center p-10">

            <div class="w-[500px] max-w-md animate-fade">


                <div class="text-center mb-10">


                    <h2 class="text-2xl font-bold text-gray-800">
                        Entrar na conta
                    </h2>

                    <p class="text-sm text-gray-500">
                        Acesse sua plataforma Studylab
                    </p>

                </div>

                <form id="loginForm" class="space-y-6">

                    <div class="animate-fade">

                        <label class="text-sm font-semibold text-gray-700">
                            Email
                        </label>

                        <input type="email" required placeholder="seuemail@exemplo.com"
                            class="mt-2 w-full px-4 py-3 border border-gray-300 rounded-lg transition duration-200 focus:outline-none focus:ring-2 focus:ring-[#FF0073]/40 focus:border-[#FF0073] focus:scale-[1.02]">

                    </div>


                    <div class="animate-fade">

                        <label class="text-sm font-semibold text-gray-700">
                            Senha
                        </label>

                        <input type="password" required placeholder="••••••••"
                            class="mt-2 w-full px-4 py-3 border border-gray-300 rounded-lg transition duration-200 focus:outline-none focus:ring-2 focus:ring-[#FF0073]/40 focus:border-[#FF0073] focus:scale-[1.02]">

                    </div>


                    <div class="flex items-center justify-between text-sm animate-fade">

                        <label class="flex items-center gap-2 text-gray-600 cursor-pointer">
                            <input type="checkbox" class="accent-[#FF0073]">
                            Lembrar de mim
                        </label>

                        <a href="/forgot" class="text-[#FF0073] font-semibold hover:underline">
                            Esqueceu a senha?
                        </a>

                    </div>

                    <button type="submit"
                        class="w-full py-3 bg-[#FF0073] text-white font-semibold rounded-lg hover:bg-[#D1005E] transition transform hover:scale-[1.03] active:scale-[0.97] shadow-lg shadow-pink-200">

                        Entrar

                    </button>

                </form>


                <div class="my-7 flex items-center animate-fade">

                    <div class="flex-1 border-t"></div>

                    <span class="px-3 text-sm text-gray-400">
                        ou
                    </span>

                    <div class="flex-1 border-t"></div>

                </div>

                <div class="grid grid-cols-2 gap-4 animate-fade">

                    <button
                        class="flex items-center justify-center gap-2 border py-2 rounded-lg hover:bg-gray-50 transition hover:scale-[1.03]">

                        <img src="https://www.svgrepo.com/show/475656/google-color.svg" class="h-5">
                        Google

                    </button>

                    <button
                        class="flex items-center justify-center gap-2 border py-2 rounded-lg hover:bg-gray-50 transition hover:scale-[1.03]">

                        <img src="https://www.svgrepo.com/show/475647/facebook-color.svg" class="h-5">
                        Facebook

                    </button>

                </div>

                <p class="text-center text-sm text-gray-600 mt-6 animate-fade">

                    Novo por aqui?

                    <a href="/register" class="text-[#FF0073] font-semibold hover:underline">
                        Criar conta
                    </a>

                </p>


                <p class="text-center text-xs text-gray-400 mt-10 leading-relaxed animate-fade">

                    Protegido por reCAPTCHA.<br>
                    Sujeito aos Termos de Serviço e Política de Privacidade Studylab.

                </p>

            </div>

        </div>

    </div>

</body>

</html>