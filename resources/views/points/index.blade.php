<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <script src="https://kit.fontawesome.com/03e947ed86.js" crossorigin="anonymous"></script>
    <script src="{{asset('js/index-cart.js')}}"></script>
    <title>CenterCart</title>

    @vite('resources/css/app.css')
</head>

<body class="bg-yellow-100">
    <div class="container mx-auto p-6 bg-white rounded-lg shadow-lg mt-10">

        <div class="flex justify-center items-center  mb-6">
            <a href="{{ route('cart.show')}}" class="text-center">
                <i class="fa-solid fa-cart-flatbed-suitcase fa-beat  md:fa-beat "></i>
                <p class=" font-bold">Minhas Compras</p>
            </a>
        </div>

        <div class="text-center">
            <h2 class="text-2xl font-bold ">Bem-vindo ao seu Cartão Fidelidade</h2>
            <h1 class="text-4xl font-bold  mt-2">{{ Auth::user()->name }}</h1>

            @if($points[0]->points_earned ?? '' > 0)
                <p class="text-xl text-green font-bold mt-2">
                    Você tem {{ $points[0]->points_earned ?? ''}} pts
                </p>
            @else
                <p class="text-lg text-red-600 mt-4">
                    Você ainda não possui pontos, mas não fique triste! Suas compras acumulam pontos. Continue comprando.
                </p>
            @endif
        </div>

        <div class="mt-6 text-center">
            <p class="text-xl">Escolha a forma que seja mais conveniente para resgatar seu brinde</p>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mt-8">
            <!-- Opção 1: Resgatar na Lanchonete -->
            <div class="bg-yellow-100 p-6 rounded-lg shadow hover:shadow-lg transition-shadow">
                <a href="{{ route('delivery.index') }}" class="block text-center">
                    <h5 class="text-lg font-bold mb-2">Resgatar na Lanchonete</h5>
                    <p class="text-left">Clique aqui para resgatar seu brinde retirando na lanchonete.</p>
                </a>
            </div>

            <!-- Opção 2: Resgatar com Pedido -->
            <div class="bg-yellow-100 p-6 rounded-lg shadow hover:shadow-lg transition-shadow">
                <a href="{{ route('delivery.show') }}" class="block text-center">
                    <h5 class="text-lg font-bold mb-2">Resgatar com Pedido</h5>
                    <p class="text-left">Clique aqui para resgatar seu brinde junto com um pedido.</p>
                </a>
            </div>

            <!-- Regras: Retirar na Lanchonete -->
            <div class="bg-yellow-100 p-6 rounded-lg shadow hover:shadow-lg transition-shadow">
                <h3 class="text-lg font-bold mb-2">Regras para Retirar o Brinde na Lanchonete</h3>
                <p class="text-left">
                    Para resgatar seu brinde na lanchonete, clique no botão acima e selecione seu brinde com base nos pontos acumulados.
                    O responsável verificará sua solicitação no sistema e autorizará a retirada do brinde.
                </p>
            </div>

            <!-- Regras: Pedir o Brinde com Pedido -->
            <div class="bg-yellow-100 p-6 rounded-lg shadow hover:shadow-lg transition-shadow">
                <h3 class="text-lg font-bold mb-2">Regras para Pedir o Brinde com um Pedido</h3>
                <p class="text-left">
                    Para resgatar seu brinde junto com um pedido, selecione o brinde com base nos pontos acumulados. O brinde será
                    entregue junto com o pedido, respeitando as regras de valor mínimo para entrega.
                </p>
            </div>
        </div>
    </div>

    @vite('resources/js/app.js')
</body>

</html>
