<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <script src="https://kit.fontawesome.com/03e947ed86.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
    <title>centerCart</title>
    @vite('resources/css/app.css')

    <style>
        .yellow{
            background-color: yellow;
            color: red;
        }
    </style>

</head>
<body>
    <div class="container mx-auto pt-6 flex flex-col items-center">
        <!-- Exibição de erros -->
        @if ($errors->any())
            @foreach ($errors->any() as $error)
                <div class="w-full max-w-lg bg-red-100 text-red-800 p-4 rounded mb-4">
                    <p>{{ $error }}</p>
                </div>
            @endforeach
        @endif

        <!-- Mensagem de sessão -->
        @if(session('nfound'))
            <div class="w-full max-w-lg bg-yellow-100 text-yellow-800 p-4 rounded mb-4">
                {{ session('nfound') }}
            </div>
        @endif

        <!-- Título -->
        <h1 class="text-2xl md:text-3xl font-bold text-gray-800 mb-6">RESUMO DE TODOS OS PEDIDOS</h1>

        <!-- Formulário -->
        <form action="{{ route('summary.filter') }}" method="post" class="w-full max-w-lg bg-white p-6 shadow-lg rounded-lg mb-6">
            @csrf
            <div class="my-4">
                <label for="start_date" class="block text-lg font-medium">Data de início:</label>
                <input type="date" class="rounded w-full border-gray-300 p-2 mt-1" name="start_date" id="start_date">
            </div>
            <div class="my-4">
                <label for="end_date" class="block text-lg font-medium">Data de término:</label>
                <input type="date" class="rounded w-full border-gray-300 p-2 mt-1" name="end_date" id="end_date">
            </div>
            <button type="submit" class="w-full py-3 bg-emerald-500 text-white rounded-lg hover:bg-emerald-600 transition-all">Filtrar</button>
        </form>

        <!-- Botões para voltar e gráficos -->
        <div class="w-full max-w-lg flex flex-col items-center">
            <a href="{{ route('panel.admin')}}" class="w-full mb-4">
                <button class="w-full py-3 bg-emerald-500 text-white rounded-lg hover:bg-emerald-600 transition-all">
                    ← Voltar
                </button>
            </a>

            <a href="{{ route('summary.sales') }}" class="w-full mb-4">
                <button class="w-full py-3 bg-emerald-500 text-white rounded-lg hover:bg-emerald-600 transition-all">
                    Gráfico de Vendas do Mês
                </button>
            </a>

            <a href="{{ route('summary.product') }}" class="w-full">
                <button class="w-full py-3 bg-emerald-500 text-white rounded-lg hover:bg-emerald-600 transition-all">
                    Gráfico de Lanche Mais Vendido
                </button>
            </a>
        </div>

        <!-- Gráfico -->
        <div class="w-full max-w-lg mt-8">
            <canvas id="salesChart" width="800" height="400"></canvas>
        </div>
    </div>




</body>
</html>
