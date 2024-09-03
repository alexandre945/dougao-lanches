

    <!DOCTYPE html>
    <html lang="pt-br">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
        <script src="https://kit.fontawesome.com/03e947ed86.js" crossorigin="anonymous"></script>
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" crossorigin="anonymous" referrerpolicy="no-referrer" />
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Chela+One&display=swap" rel="stylesheet">
                 {{-- select --}}
        <link rel="stylesheet" href="../css/bootstrap-multselect.css" type="text/css"/>

        <style>
          /* .container {
            font-family: 'Chela One', cursive;
            font-family: 'Roboto', sans-serif;
          }

          .add {
            background-color: chartreuse;
            color: green;
          }
          .icon {
            font-size: 30px;
          color: red;
          margin-left: 15px;
          margin-top: 3px;
          }
          .success{

            padding: 4px;
            color: green;
            font-size: 18px;
            font-family: 'Courier New', Courier, monospace;
          }
          .cart{
            float:right;
            margin-top: 10px;
            padding-right: 10px;
          }
          .color{
            background-color: rgba(55, 122, 53, 0.726);
          }
         .button{
          margin-left: 120px;
         }
         .cartadd {
          box-shadow: 0 0 10px rgba(226, 231, 227, 0.5);
          transition: 0,5ms,ease-out;
         }
         .cartadd:hover {
          background-color:white;
          color: brown;
         }
         .wider {
          widows: 700px;
         }
         .img {
            width: 40px;
         }
         .green{
            color: green;
            /* background-color: cornsilk; */


         .red {
            color: red;
            border-radius: 6px;
         }
         .greend {
            color: rgb(28, 108, 28);
         } */
         .spinner {
        border: 4px solid rgba(0,0,0,0.1);
        border-left: 4px solid #1c8ad3;
        border-radius: 50%;
        width: 30px;
        height: 30px;
        animation: spin 1s linear infinite;
    }

    @keyframes spin {
        0% { transform: rotate(0deg); }
        100% { transform: rotate(360deg); }
        }
        #buttonSpinner {
        margin-left: 5px; /* Opcional, para um pequeno espaçamento entre o texto e o spinner */
        }

        .clock {
            animation:blink 4s linear infinite;
        }

    @keyframes blink {
        0%, 100% {
            opacity: 1;
        }
        50% {
            opacity: 0;
        }
        }

        </style>
        <title>CreateProduct</title>
    </head>

    <body>
        @vite('resources/css/app.css')

            <div class=" pb-4 bg-slate-100">

                    <div class="flex justify-between">
                          <div class="pt-2 ml-2  pb-2" @if ($toggle->is_open == 0 ?? '') inertex @endif>
                                @if ($toggle->is_open == 0 ?? '')
                                @php
                                    // Verificar se o dia da semana é segunda-feira (considerando o formato padrão do Carbon)
                                    $isMonday = \Carbon\Carbon::now()->dayOfWeek === 1;
                                @endphp

                                @if ($isMonday)
                                    <p class="sm:text-sm md:text-md text-black" >A lanchonete está fechada. Abre terça-feira às 19:00hs.</p>
                                @else
                                    <div class="bg-yellow-200 red pl-2 pr-2">
                                        <p class="md:text-xl sm:text-sm">Lanchonete fechada</p>
                                        <p class="sm:text-sm md:text-md">Abre hoje às 19:00hs</p>
                                    </div>
                                @endif
                                @else
                                        <div class=" border text-green-800 p-2 rounded">
                                            <p class="text-green text-sm">Lanchonete aberta</p>
                                        </div>
                                @endif
                          </div>
                             @include('layouts.adminButton')
                          <div class="logaut ">
                            <x-dropdown width="48">
                                <x-slot name="trigger">
                                    <button class="  button inline-flex px-3 py-2 mt-2  text-sm leading-4 font-medium rounded-md text-yellow hover:text-gray-700 focus:outline-none transition ease-in-out duration-150">
                                        <div>{{ Auth::user()->name }}</div>

                                        <div class="ml-1">
                                            <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                                                <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
                                            </svg>
                                        </div>
                                    </button>
                                </x-slot>

                                <x-slot name="content">
                                    {{-- <x-dropdown-link :href="route('profile.edit')">
                                        {{ __('Profile') }}
                                    </x-dropdown-link> --}}

                                    <!-- Authentication -->
                                    <form method="POST" action="{{ route('logout') }}">
                                        @csrf

                                        <x-dropdown-link :href="route('logout')"
                                                onclick="event.preventDefault();
                                                            this.closest('form').submit();">
                                            {{ __('Sair') }}
                                        </x-dropdown-link>
                                    </form>
                                </x-slot>
                            </x-dropdown>
                          </div>
                    </div>



                    <div class="cart ml-auto">
                        <div class="flex justify-end items-center space-x-2">
                            <div>

                                <a href="{{ route('cart.show')}}">
                                    <i class="fa-solid fa-cart-flatbed-suitcase fa-beat text-blue"></i>
                                    <p class="text-blue">minhas compras</p>
                                </a>
                            </div>
                            <div class="text-3xl font-normal pr-4">
                                @if($productCount)
                                    <span class="text-xl text-blue">{{$productCount}}</span>
                                @endif
                                @if(!$productCount)
                                    <i class="fa-solid fa-sad-tear text-3xl text-slate-500"></i>
                                @endif
                            </div>
                        </div>
                        <div class="text-2xl font-normal pl-4">
                            <div class="pb-2">
                                @if($order && $order->created_at->isToday())
                                    <p class="text-sm">Status do seu pedido de número: <span class="text-lg">{{$order->id ?? ''}}</span></p>
                                    <p class="greend pb-2 text-xl sm:text-sm md-text-xl">{{$order->status ?? ''}}</p>
                                @endif
                            </div>
                        </div>
                    </div>


                  <div class=" ">

                    {{-- @include('layouts.baner') --}}
                    <div class="text-xl pt-6 md:text-center ">
                         <div class=" ">

                             <p class="ml-2 text-sm md:text-xl sm:text-start text-center">Horario de funcionamento: de Terça a Domingo
                                das 19:00 hs as 24:00 hs
                             </p>
                         </div>

                         <div class="pt-2 ml-2">

                            <p class="sm:text-start text-sm clock fa-solid fa-clock ">tempo de espera aproximado: {{ $time->waitingtime ?? ''}} min</p>
                            <i class=""></i>
                         </div>
                    </div>

                  </div>
            </div>

            <div class=" orange bg-slate-50  w-full">
              <div class=" pr-4">
                @include('layouts.menu')
              </div>

                @if(session('access'))
                    <div class="bg-amber-300">
                        <p class="text-green">
                        {{ session('access')}}
                        </p>
                    </div>
                @endif

                @if(session('success'))
                    <div class=" success text-center  bg-white ">
                        <p class="text-green p-2">{{ session('success')}}</p>
                    </div>
                @endif


                <div class="mb-5 mt-4 text-center" id="menu">
                    <main class="grid grid-cols-1 md:grid-cols-2 gap-7 md:gap-10 lg:px-8 mx-auto max-w-7xl px-2 mb-15 ">
                       <!-- PRODUTO-ITEM  -->
                       @foreach ($product as $item)
                       <div class=" flex gap-4 ml-4">
                            @if($item->photo)
                              <div class="w-40 img">
                                <img src="{{ asset('storage/' .$item->photo) }}" alt="foto do lanche"
                                class="w-28 h-28 rounded-md hover:scale-110 hover:-rotate-2 duration-300">
                              </div>
                            @endif
                            <div class="">
                                <p class="font-bold text-start">{{$item->name}}</p>

                                <details class="flex gap-2">
                                  <p class="text-sm text-start  md:text-lg bg-slate-400 p-2">{{$item->description}}</p>
                                  <summary class="text-sm text-start">
                                      Ingredientes
                                  </summary>
                                </details>

                                <div class="flex gap-10">
                                    <div class="">
                                        <p class="font-bold md:text-2xl whitespace-nowrap text-green">R$ @money( $item->price )</p>
                                    </div>

                                  <div class="ml-8">
                                      @if ($toggle->is_open ?? '' )

                                        <button class="btn btn-success ml-10 border cartadd " data-bs-toggle="modal"
                                            data-bs-target="#firstModal{{$item->id}}">
                                            <i class="fa-sharp fa-solid fa-cart-plus text-white"></i>
                                        </button>

                                      @else

                                        @include('layouts.button')

                                      @endif
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
                                                        <Form id="mainForm" action="{{ route('store.cart',$item->id)}}" method="post">
                                                            @csrf
                                                            <div class="text  pt-4 rounded">
                                                            <form class="grup-control">
                                                                <fieldset class="text-center">

                                                                        <div class="label text-center">
                                                                            <img src="{{ asset('storage/' .$item->photo ?? '') }}" alt="foto do produto" class="img-fluid p-2 mx-auto d-block"><br>
                                                                            <strong><h1>PRODUTO</h1></strong>
                                                                            <input type="text" disabled class=" p-2  rounded "  name="product_id" id="product_id" value="{{ $item->name }}"/><br>
                                                                        </div>
                                                                        <div class=" mt-2 label2 text-center">
                                                                            <strong><h1>DESCRIÇÃO</h1></strong>
                                                                            <input type="text" disabled class=" p-2 rounded " id="description" value="{{ $item->description }}"/><br>
                                                                        </div>
                                                                        <div class=" mt-2 label2 text-center">
                                                                        <strong><h1>QUANTIDADE</h1></strong>
                                                                            <input type="number" min="1"  class=" p-2  rounded text-center " name="quanty" value="{{ $item->quanty }}"/><br>
                                                                        </div>
                                                                        <div class="label3 text-center p-2">
                                                                            <strong><h1>PREÇO UNITARIO</h1></strong>
                                                                            <input type="text"  disabled class=" rounded text-center " name="price" id="price" value="{{number_format($item->price,2,',','.')?? '' }}"/><br>
                                                                        </div>
                                                                            <div class="text-center p-2">
                                                                                <strong><label for="additional">ADICIONAIS</label></strong>
                                                                                <h3>Selecione quantos tipos de adicionais desejar e quantidade que desejar</h3>
                                                                            </div>

                                                                            <div id="additional-container" class="text-left rounded multiselect-container space-y-4">
                                                                                @foreach($additional as $item)
                                                                                    <div class="flex items-center justify-between space-x-2 container">
                                                                                        <div class="flex items-center space-x-2">
                                                                                            <input type="checkbox" id="additional-{{ $item->id }}" name="additional_ids[]" value="{{ $item->id }}" class="form-checkbox h-5 w-5 text-blue-600" onchange="toggleQuantityField({{ $item->id }})">
                                                                                            <label for="additional-{{ $item->id }}" class="text-lg">
                                                                                                {{ $item->name }}
                                                                                            </label>
                                                                                        </div>
                                                                                        <div class="flex items-center">
                                                                                            <span class="text-green font-bold mr-4">R$ @money($item->price)</span>
                                                                                            <input
                                                                                            type="number"
                                                                                            id="quantity-{{ $item->id }}"
                                                                                            name="additional_quantities[{{ $item->id }}]"
                                                                                            min="1"
                                                                                            value="1"
                                                                                            class="w-16 p-2 border border-gray-400 bg-white rounded-lg text-center mt-1 shadow-sm focus:ring-2 focus:ring-blue-500 focus:border-blue-500"
                                                                                            inputmode="numeric"
                                                                                            pattern="[0-9]*">

                                                                                        </div>
                                                                                    </div>
                                                                                @endforeach
                                                                            </div>


                                                                        <div class=" p-2 text-center">
                                                                        <strong><h1>OBSERVAÇÃO</h1></strong>
                                                                        <input type="text" autocomplete="off" class="  rounded " placeholder="Ex: sem tomate" name="observation" id="observation" value="{{$item->observation}}">
                                                                        </div>
                                                                        <div class="flex flex-col gap-2">

                                                                            <button type="submit" id="submitButton" class="bg-slate-300 pt-2 pb-2 mr-10 ml-10 rounded">
                                                                                <span id="buttonText">ADICIONAR</span>
                                                                                <span id="buttonSpinner" style="display: none;">
                                                                                    <div class="spinner"></div>
                                                                                </span>
                                                                            </button>

                                                                        {{-- <button class="btn btn-success text-with bg-success m-2" type="submit">ADICIONAR</button> --}}
                                                                        <button type="button" class="btn btn-warning bg-warning m-2"data-bs-dismiss="modal">Cancelar</button>
                                                                        </div>
                                                                </fieldset>
                                                            </form>
                                                            </div>
                                                        </Form>
                                                    </div>
                                            </div>
                                        </div>
                                    </div>

                                </div>
                            </div>
                      </div>

                       @endforeach

                    </main>

                 </div>

                  <div class="">
                      {{   $product->links() }}
                  </div>
            </div>
         @vite('resources/js/app.js')


         <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
         <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.min.js" integrity="sha384-cuYeSxntonz0PPNlHhBs68uyIAVpIIOZZ5JqeqvYYIcEL727kskC66kF92t6Xl2V" crossorigin="anonymous"></script>
        <script>

// $(document).ready(function() {
//     $('#mainForm').on('submit', function(event) {

//         // Desabilitar o botão para evitar cliques duplos
//         $('#submitButton').prop('disabled', true);

//         // Mostrar o spinner e ocultar o texto do botão
//         $('#buttonText').hide();
//         $('#buttonSpinner').show();

//     });
// });

document.addEventListener('DOMContentLoaded', function() {
    // Seleciona o formulário pelo ID 'mainForm'
    var form = document.getElementById('mainForm');

    // Adiciona um "event listener" para o evento de envio do formulário
    form.addEventListener('submit', function(event) {

        // Desabilita o botão de envio para evitar cliques duplos
        var submitButton = document.getElementById('submitButton');
        submitButton.disabled = true;

        // Oculta o texto do botão
        var buttonText = document.getElementById('buttonText');
        buttonText.style.display = 'none';

        // Mostra o spinner
        var buttonSpinner = document.getElementById('buttonSpinner');
        buttonSpinner.style.display = 'block';
    });
});
/*function toggleQuantityField(additionalId) {
    const checkbox = document.getElementById(`additional-${additionalId}`);
    const quantityField = document.getElementById(`quantity-${additionalId}`);

    if (checkbox.checked) {
        quantityField.disabled = false;
    } else {
        quantityField.disabled = true;
        quantityField.value = 1; // Reset value to 1 when unchecked
    }
}*/



        </script>
    </body>
  </html>






