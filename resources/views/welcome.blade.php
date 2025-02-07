<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Dougão Lanches</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,600&display=swap" rel="stylesheet" />
        <link  rel="stylesheet"  href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css"/>
        <script src="https://kit.fontawesome.com/03e947ed86.js" crossorigin="anonymous"></script>
        <style>
        .baner {
            text-align: center;
            font-family: 'Chela One', cursive;
            color: #facc15;
            width: 100%;
            font-size: 40px;
        }
        .icons {
            width: 300px;
        }
        .header-text {
            color: #dc2626;
            text-shadow: 2px 2px #facc15;
        }
        </style>

        @vite('resources/css/app.css')

    </head>
    <body class="antialiased bg-yellow-100">
        <div class="relative sm:flex sm:justify-center sm:items-center min-h-screen">
            @if (Route::has('login'))
                <div class="sm:fixed sm:top-0 sm:right-0 p-6 text-right">
                    @auth
                        <a href="{{ url('/dashboard') }}" class="font-semibold text-gray-600 hover:text-gray-900 dark:text-gray-400 dark:hover:text-white focus:outline focus:outline-2 focus:rounded-sm focus:outline-red-500">Dashboard</a>
                    @else
                        <a href="{{ route('login') }}" class="font-semibold hover:text-gray-900 focus:outline focus:outline-2 focus:rounded-sm focus:outline-red-500">Entrar</a>
                        @if (Route::has('register'))
                            <a href="{{ route('register') }}" class="ml-4 font-semibold dark:hover:text-white focus:outline focus:outline-2 focus:rounded-sm focus:outline-red-500">Registrar-se</a>
                        @endif
                    @endauth
                </div>
            @endif

            <!-- Imagem e texto de apresentação -->
            <section class="mt-0 items-center text-center">
                <div class="lg:w-full flex space-x-4">
                    <div class="baner pt-2 font-bold">
                        <div class="animate__animated animate__bounce">
                            <h1 class="text-5xl font-bold header-text">DOUGÃO LANCHES</h1>
                        </div>
                    </div>
                </div>

                <div class="container mx-auto md:flex-row items-center px-6 py-8">
                    <h1 class="text-3xl text-red-600 text-center font-bold mb-4">Bem-vindo(a) ao Dougão Lanches</h1>
                    <p class="mb-6 text-gray-700 text-lg leading-relaxed text-justify">
                        No Dougão Lanches, você encontra o melhor lanche da cidade, preparado com ingredientes frescos e de alta qualidade.
                        Faça seu pedido facilmente pelo nosso delivery, sem complicação! Aceitamos diversas formas de pagamento, como dinheiro,
                        cartão,pix na maquininha, que podem ser feitos diretamente ao entregador. Nosso horário de funcionamento é de terça a domingo,
                        das 19h às 24h. Venha nos visitar pessoalmente na Rua Batista Luzardo, 1005, São Lourenço, MG, e aproveite o melhor da nossa Lanchonete.
                        Não se esqueça de nos seguir nas redes sociais para ficar por dentro de todas as novidades!
                    </p>
                </div>

                <!-- Rodapé -->
                <footer class="bg-orange-400 py-6">
                    <div class="container mx-auto flex justify-center">
                        <nav class="text-center">
                            <ul class="flex space-x-6">
                                <li>
                                    <a href="https://www.facebook.com/douglasodin199/?locale=pt_BR" target="_blank" class="md:text-white hover:text-gray-200 text-blue">
                                        <i class="fa-brands fa-square-facebook fa-2xl"></i>
                                    </a>
                                </li>
                                <li>
                                    <a href="#" class="md:text-white hover:text-gray-200 text-blue">
                                        <i class="fa-brands fa-instagram fa-2xl"></i>
                                    </a>
                                </li>
                                <li>
                                    <a href="https://api.whatsapp.com/send?phone=553599810371" target="_blank" class="md:text-white hover:text-gray-200 text-blue">
                                        <i class="fa-brands fa-whatsapp fa-2xl"></i>
                                    </a>
                                </li>
                            </ul>
                        </nav>
                    </div>
                </footer>
            </section>
        </div>

        @vite('resources/js/app.js')
    </body>
</html>
