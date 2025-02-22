<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Chela+One&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
    <title>status.navegation</title>

    <style>
   body {
            background-color: #0D1117;
            /* font-family: 'Chela One', cursive; */
        }

    </style>
</head>
<body>
    @vite('resources/css/app.css')

    <div class="bg-gradient-to-r from-gray-800 to-gray-900 py-3 shadow-lg rounded-md">
        <div class="container mx-auto px-4">
            <ul class="grid grid-cols-2 sm:grid-cols-2 lg:grid-cols-4 gap-4">
                <li>
                    <a href="{{ route('order.show') }}" class="flex items-center px-4 py-3 bg-gray-700 hover:bg-indigo-600 hover:text-white transition-transform transform hover:scale-105 rounded-lg text-sm sm:text-base">
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 12h.01M12 12h.01M16 12h.01M9 16h6m2 2H7a2 2 0 01-2-2V7a2 2 0 012-2h10a2 2 0 012 2v9a2 2 0 01-2 2z" />
                        </svg>
                        Pedidos
                    </a>
                </li>
                <li>
                    <a href="{{ route('status.aceito') }}" class="flex items-center px-4 py-3 bg-gray-700 hover:bg-indigo-600 hover:text-white transition-transform transform hover:scale-105 rounded-lg text-sm sm:text-base">
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                        </svg>
                        Aceito
                    </a>
                </li>
                <li>
                    <a href="{{ route('status.fordelivery') }}" class="flex items-center px-4 py-3 bg-gray-700 hover:bg-indigo-600 hover:text-white transition-transform transform hover:scale-105 rounded-lg text-sm sm:text-base">
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 17v-1a4 4 0 118 0v1m-4 4h.01M12 12v.01" />
                        </svg>
                        Saindo para Entrega
                    </a>
                </li>
                <li>
                    <a href="{{ route('status.delivered') }}" class="flex items-center px-4 py-3 bg-gray-700 hover:bg-indigo-600 hover:text-white transition-transform transform hover:scale-105 rounded-lg text-sm sm:text-base">
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 10h3M21 10h-3m-4-4l-4 4-4-4" />
                        </svg>
                        Entregue
                    </a>
                </li>
                  <li>
                    <a href="{{ route('status.impresso') }}" class="flex items-center px-4 py-3 bg-gray-700 hover:bg-indigo-600 hover:text-white transition-transform transform hover:scale-105 rounded-lg text-sm sm:text-base">
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 10h3M21 10h-3m-4-4l-4 4-4-4" />
                        </svg>
                        Impresso
                    </a>
                </li
              
              <li>
                <a href="{{ route('status.ready') }}" class="flex items-center px-4 py-3 bg-gray-700 hover:bg-indigo-600 hover:text-white transition-transform transform hover:scale-105 rounded-lg text-sm sm:text-base">
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 10h3M21 10h-3m-4-4l-4 4-4-4" />
                    </svg>
                    Pronto
                </a>
            </li>
            
            </ul>
        </div>
    </div>


    @vite('resources/js/app.js')
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.min.js" integrity="sha384-cuYeSxntonz0PPNlHhBs68uyIAVpIIOZZ5JqeqvYYIcEL727kskC66kF92t6Xl2V" crossorigin="anonymous"></script>
</body>
</html>
