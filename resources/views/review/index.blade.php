<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <script src="https://kit.fontawesome.com/03e947ed86.js" crossorigin="anonymous"></script>
    <script src="{{ asset('js/index-cart.js') }}"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
    @vite('resources/css/app.css')
</head>
<body>

       @php
       $ratingsdescriptions = array(
        5 =>  'Execelente',
        4 =>  'Muito bom',
        3 =>  'Bom',
        2 =>  'Regular',
        1 =>  'Rim'
       );

       @endphp

    <div class="container max-auto mt-4 ">
          <h1 class="text-center  font-bold text-sm">Avaliações e Comentários dos Clientes</h1>
        <h4 class="text-center pb-4 font-semibold ">Avaliações</h4>
           <div class="bg-white ">
                    <!-- Exibe as avaliações -->
                @foreach ($reviews as $review)
                    <div class="review mb-3 border-l-2 bg-slate-50 rounded m-2 p-2">
                        <strong>Avaliação: </strong>{{ $ratingsdescriptions[$review->rating] }} {{$review->rating}} /5<br>
                        <strong>Comentário: </strong>{{ $review->comment }}<br>
                        <em>Enviado por: {{ $review->user->name }} em {{ $review->created_at->format('d/m/Y') }}</em>
                    </div>
                    <hr>
                 @endforeach

           </div>


        <!-- Links de paginação -->
        <div class="d-flex justify-content-center">
            {{ $reviews->links() }}
        </div>
        <a href="{{ route('client.show') }}">
            <button class="bg-gradient-to-r from-yellow-400 to-bluee border-l-4 border-blue hover:bg-gradient-to-l hover:from-blue-600 hover:to-yellow-400  font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline" type="submit">
                Voltar
            </button>
        </a>
    </div>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.min.js" integrity="sha384-cuYeSxntonz0PPNlHhBs68uyIAVpIIOZZ5JqeqvYYIcEL727kskC66kF92t6Xl2V" crossorigin="anonymous"></script>
    @vite('resources/js/app.js')
</body>
</html>
