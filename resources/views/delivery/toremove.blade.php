<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <script src="https://kit.fontawesome.com/03e947ed86.js" crossorigin="anonymous"></script>
    <script src="{{asset('js/index-cart.js')}}"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">

    <title>centerCart</title>

    @vite('resources/css/app.css')
    <style>

    </style>
</head>

<body class="bg-yellow-100">
    @vite('resources/css/app.css')
    <div class="container max-auto">

        <div class="flex justify-between items-center pt-4">
            <div class="">
                <a href="{{ route('cart.show')}}" class="flex items-center space-x-2 text-blue-500">
                    <i class="fa-solid fa-cart-flatbed-suitcase fa-beat"></i>
                    <p class="">Minhas Compras</p>
                </a>
            </div>

            <div class=" text-center">
                <h1 class="text-1xl md:text-2xl font-bold">{{Auth::user()->name}}</h1>
                @if($points[0]->points_earned ?? '' > 0)
                    <p class="text-green font-bold">
                        Você tem {{ $points[0]->points_earned ?? ''}} pts
                    </p>
                @else
                    <h3 class="text-gray-600 text-center">Você ainda não possui pontos, mas continue comprando. Cada compra gera pontos!</h3>
                @endif
            </div>
        </div>


        <div class="mt-4">
            <p class=" text-start">
                Aqui, o valor do seu pedido vira pontos e com eles você pode resgatar esses blindes:
            </p>
        </div>

            @if (session('delivery'))
               <div class="text-red text-center p-4">
                    <p>
                        {{session('delivery')}}
                    </p>
               </div>
            @endif

            @if ( session('remuve'))

                <div class="">
                    <p class="text-green text-2xl">
                        {{session('remuve')}}
                    </p>
                </div>

            @endif

            @if (session('brind'))
                <div class="blind rounded text-white p-2">
                    <p>{{session('brind')}}</p>
                </div>

            @endif

            @if ( session('denied'))
                <div class="text-center p-4 bg-yellow-200 rounded">
                    <p class="text-red-800 text-xl md:text-2xl">
                        {{ session('denied')}}
                    </p>
                </div>
            @endif

            @if(session('emptyCart'))
              <div class="bg-yellow-400 p-2 w-auto rounded">
                <p class=" font-semibold">
                    {{session('emptyCart')}}
                </p>
              </div>

            @endif


        <div class="products-section">
            <div class="row mt-4">
                <!-- Brinde 1 -->
             @foreach ($point as $item)

                <div class="col-md-4">
                    <div class="card">
                        <img src="{{ asset('storage/'.$item->image) }}" class="product img" alt="Imagem do Doce">
                        <div class="card-body">
                            <p class="card-text">{{$item->name }}</p>
                            <p class="card-text">Resgate por {{$item->points}}  pontos</p>
                            <button class="text-sm bg-blue-500 p-2 rounded border "  data-bs-toggle="modal"
                            data-bs-target="#firstModal{{$item->id}}">RESGATAR</button>
                        </div>
                    </div>
                    <div class="modal fade" id="firstModal{{$item->id}}" tabindex="-1"
                        aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header,btn btn-warning">
                                    {{-- <h2 class="modal-title pt-4 ml-40" id="exampleModalLabel text-center">Adiciona este produto em seu carrinho</h2> --}}
                                    <button type="button" class="btn-close " data-bs-dismiss="modal"   aria-label="Close">
                                    X
                                    </button>
                                </div>
                                <div class="modal-body">
                                    <div class="p-4 relative">
                                        <form action="{{ route('blindcart.store',$item->id )}}" method="POST">
                                            @csrf
                                            <div class="pb-4 w-full text-start">

                                            </div>
                                            <div class="card">
                                                <img src="{{ asset('storage/' .$item->image) }}" class="product img" alt="Imagem do Doce">
                                                <div class="card-body">
                                                    <p class="card-text">{{$item->name }}</p>
                                                    <input type="hidden" name="name" value="{{$item->name}}">
                                                    <p class="card-text">Resgate por {{$item->points}}  pontos</p>
                                                    <input type="hidden" name="points" value="{{$item->points}}">

                                                </div>
                                                    <div class="">
                                                        <button class='text-sm bg-blue-500 p-2 rounded border' type="submit">RESGATAR</button>
                                                    </div>
                                            </div>


                                        </form>

                                </div>

                                </div>
                                </div>
                            </div>
                    </div>
                </div>

             @endforeach

        </div>
    </div>
    @vite('resources/js/app.js')
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.min.js" integrity="sha384-cuYeSxntonz0PPNlHhBs68uyIAVpIIOZZ5JqeqvYYIcEL727kskC66kF92t6Xl2V" crossorigin="anonymous"></script>
</body>

</html>
