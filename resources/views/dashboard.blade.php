
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>dashboard</title>
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

    <link rel="preload" as="image" href="{{ asset('image/logo-2.png') }}">


    <style>
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

    @keyframes blink {
        0%, 100% {
            opacity: 1;
        }
        50% {
            opacity: 0;
        }
        }

    </style>
</head>
<body class="bg-yellow-100 font-sans">

    @vite('resources/css/app.css')

    <header class="text-center mb-8 pt-8">
        <div class="flex items-center justify-center space-x-4 mt-4">
            <h1 class="text-2xl md:text-4xl font-bold text-red-600 relative">
                <span class="absolute inset-0 text-red-400 blur-sm transform translate-x-1 translate-y-1">DOUGÃO LANCHES</span>
                <span class="relative">DOUGÃO LANCHES</span>
            </h1>
            <img src="{{ asset('image/logo-2.png') }}" alt="Logo Dougão Lanches" class="h-16 w-auto rounded-full border">
        </div>


        <div class=" logout absolute top-0 left-0   px-4 mb-4 md:py-2 rounded-full hover:bg-amber-400 transition duration-300">
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
              {{-- rota do admin --}}
          <div class="absolute top-0 right-0 md:pt-4">
            @can('access')
                <button  class="text-1xl pt-2 md:text-3xl">
                    <a class="p-8" href="{{ route('panel.admin')}}"><i class="fas fa-solid fa-user-secret"></i></a>
                </button>
            @endcan
          </div>

    </header>

    <div class="container max-w-4xl mx-auto p-4 md:p-8">
        <div class="bg-white rounded-lg shadow-lg p-2">
            <div class="flex flex-col md:flex-row justify-between items-center">
                {{-- Lógica para mostrar se a lanchonete está fechada ou aberta --}}
                <div class="pt-2 ml-2  md:ml-8 pb-2">
                    @if ($toggle->is_open == 0 ?? '')
                        @php
                            $now = \Carbon\Carbon::now();
                            $isMonday = $now->dayOfWeek === 1;
                            $isBetweenClosingHours = $now->hour >= 19 && $now->hour < 24;
                        @endphp

                        @if ($isMonday)
                            <div class="bg-yellow-200 pr-8 pl-8 pb-2 pt-2 rounded">
                                <p class="sm:text-sm md:text-xl text-rose-400">
                                    <i class="fas fa-clock mr-2"></i>Fechada
                                </p>
                                <span class="text-sm">Abre terça-feira às 19:00h</span>
                            </div>
                        @elseif ($isBetweenClosingHours)
                            <div class="bg-yellow-200 rounded pr-8 pl-8 pb-2 pt-2">
                                <span class="text-rose-400 font-semibold">
                                    <i class="fas fa-clock mr-2"></i>Fechada
                                </span>
                                <p class="text-sm md:text-md">Já fechamos hoje.</p>
                            </div>
                        @else
                            <div class="bg-yellow-200 rounded pr-8 pl-8 pb-2 pt-2">
                                <span class="text-rose-400 font-semibold">
                                    <i class="fas fa-clock mr-2"></i>Fechada
                                </span>
                                <p class="sm:text-sm md:text-md">Abre hoje às 19:00h</p>
                            </div>
                        @endif
                    @else
                        <div class="border text-green-800 pr-8 pl-8 pb-2 pt-2 rounded bg-greend">
                            <span class="text-green font-semibold text-sm whitespace-nowrap">
                                <i class="fas fa-clock pr-2"></i>Aberto agora
                            </span>
                            <p class="text-sm text-gray-600">Aberto até 24:00h</p>
                        </div>
                    @endif
                </div>

                    {{-- <p class="text-3xl">😋</p> --}}
                    <div class="w-40 hidden md:block text-center">
                        <img src="{{ asset('image/lanche.webp')}}" alt=""  class="h-24 w-auto rounded-full bg-opacity-90 inline-block p-2">
                    </div>


                {{-- Div que mostra tempo de entrega --}}
                <div class=" md:mr-8 text-center">
                    <span class="text-blue font-semibold text-sm md:text-1xl whitespace-nowrap">
                        <i class="fas fa-motorcycle mr-2"></i>Tempo aproximado de entrega
                    </span>
                    <p class="text-sm text-gray-600">{{ $time->waitingtime ?? '' }} minutos</p>

                    @if($order && $order->created_at->isToday())
                        <p class="text-sm text-gray-600 mt-4">Pedido de número: <strong>{{ $order->id ?? '' }}</strong></p>
                        <p class="pb-2 sm:text-sm md:text-xl">
                            Status:
                            <span class="{{ $order->status == 'Recusado' ? 'text-red-600' : 'text-green' }} font-bold text-xl">
                                {{ $order->status ?? '' }}
                            </span>
                        </p>
                    @endif
                </div>
            </div>

            <div class="mt-4">
                <p class="text-sm text-gray-600 text-center">Horário de funcionamento de terça a domingo: 19:00h às 24:00h</p>
            </div>
        </div>
    </div>




    <main class="container mx-auto p-4">
           {{-- container dos lanches --}}

        <div class="container mx-auto p-4">
            <div class="border-b-2 border-gray-300 mb-4">
                <!-- Cabeçalho da seção com um botão de toggle -->
                <div class="flex justify-between items-center cursor-pointer" onclick="toggleSection('lanches-section')">
                    <h2 class="text-xl font-bold">LANCHES</h2>
                    <!-- Ícone de seta para abrir/fechar -->
                    <span id="lanches-arrow" class="transform transition-transform duration-300">▼</span>
                </div>
                <!-- Conteúdo que será ocultado/mostrado -->
                <div id="lanches-section" class="mt-4 hidden">
                    {{-- Conteúdo dos lanches aqui --}}
                    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                        @foreach ($product as $item)
                            <div class="bg-white rounded-lg shadow-lg overflow-hidden">
                                @if($item->photo)
                                    <div class="w-full img flex justify-center mt-2">
                                        <img src="{{ asset('storage/' .$item->photo) }}" alt="foto do lanche"
                                            class="w-28 h-28 rounded-md hover:scale-110 hover:-rotate-2 duration-300">
                                    </div>
                                @endif
                                <div class="p-2">
                                    <h3 class="text-lg font-semibold mb-2">{{ $item->name}}</h3>
                                    <p class="text-gray-600 mb-2">{{ $item->description}}</p>
                                     <h2 class="font-semibold mb-2 text-red-500 md:text-2xl">R$ @money( $item->price )</h2>
                                    <!-- Botão de adicionar ao carrinho ou outra ação -->
                                    <div class="">
                                        @if ($toggle->is_open ?? '' )

                                        <button class="btn btn-success ml-10 " data-bs-toggle="modal"
                                            data-bs-target="#firstModal{{$item->id}}">
                                              add ao carrinho
                                        </button>

                                       @else



                                       @endif
                                    </div>
                                </div>
                            </div>

                            {{-- modal para adicionar produtos ao carrinho --}}
                            <div class="modal fade" id="firstModal{{$item->id}}" tabindex="-1"
                                aria-labelledby="exampleModalLabel" aria-hidden="true">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                            <div class="modal-header,btn btn-warning">
                                                {{-- <h2 class="modal-title pt-4 ml-40" id="exampleModalLabel text-center">Adiciona este produto em seu carrinho</h2> --}}
                                                <button type="button" class="btn-close text-center" data-bs-dismiss="modal"   aria-label="Close">
                                                    X
                                                </button>
                                            </div>
                                            <div class="modal-body">
                                                <Form id="mainForm" action="{{ route('store.cart',$item->id)}}" method="post">
                                                    @csrf
                                                    <div class="text  pt-4 rounded">
                                                    <div class="grup-control">
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
                                                                                    <input type="checkbox" id="additional-{{ $item->id }}" name="additional_ids[]" value="{{ $item->id }}" class="form-checkbox h-5 w-5 text-blue-600">
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
                                                                                        >
                                                                                </div>
                                                                            </div>
                                                                        @endforeach
                                                                    </div>
                                                                <div class=" p-2 text-center">
                                                                <strong><h1>OBSERVAÇÃO</h1></strong>
                                                                <input type="text" autocomplete="off" class="  rounded " placeholder="Ex: sem tomate" name="observation" id="observation" value="{{$item->observation}}">
                                                                </div>
                                                                <div class="flex flex-col gap-2">

                                                                    <button type="submit" id="submitButton" class="bg-gradient-to-r from-green to-indigo-400 border-l-4 border-t-2 border-bluee pt-2 pb-2 mr-10 ml-10 rounded hover:bg-none hover:bg-green hover:text-white">
                                                                        <span id="buttonText">ADICIONAR</span>
                                                                        <span id="buttonSpinner" style="display: none;">
                                                                            <div class="spinner"></div>
                                                                        </span>
                                                                    </button>

                                                                {{-- <button class="btn btn-success text-with bg-success m-2" type="submit">ADICIONAR</button> --}}
                                                                <button type="button" class="btn btn-warning bg-warning m-2"data-bs-dismiss="modal">Cancelar</button>
                                                                </div>
                                                        </fieldset>
                                                    </div>
                                                    </div>
                                                </Form>
                                            </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>

        </div>
           {{-- container da bebidas --}}

        <div class="container mx-auto p-4">
            <div class="border-b-2 border-gray-300 mb-4">
                <!-- Cabeçalho da seção com um botão de toggle -->
                <div class="flex justify-between items-center cursor-pointer" onclick="toggleSection('beer-section')">
                    <h2 class="text-xl font-bold">BEBIDAS</h2>
                    <!-- Ícone de seta para abrir/fechar -->
                    <span id="beer-arrow" class="transform transition-transform duration-300">▼</span>
                </div>
                <!-- Conteúdo que será ocultado/mostrado -->
                <div id="beer-section" class="mt-4 hidden">
                    {{-- Conteúdo dos lanches aqui --}}
                    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                        @foreach ($productBeer as $item)
                        <div class="bg-white rounded-lg shadow-lg overflow-hidden">
                            @if($item->photo)
                            <div class="w-full img flex justify-center mt-4">
                                <img src="{{ asset('storage/' .$item->photo) }}" alt="foto do lanche"
                                     class="w-28 h-28 rounded-md hover:scale-110 hover:-rotate-2 duration-300">
                            </div>
                            @endif
                            <div class="p-2">
                                <h3 class="text-lg font-semibold mb-2">{{ $item->name}}</h3>
                                <p class="text-gray-600 mb-2">{{ $item->description}}</p>
                                <p class="font-semibold mb-2 text-red-500 md:text-2xl">R$ @money( $item->price )</p>

                                <div class="">
                                    @if ($toggle->is_open ?? '' )

                                    <button class="btn btn-success ml-10 " data-bs-toggle="modal"
                                        data-bs-target="#firstModal{{$item->id}}">
                                          add ao carrinho
                                    </button>

                                   @else



                                   @endif
                                </div>
                            </div>
                        </div>

                           {{-- modal para adicionar produtos ao carrinho --}}
                        <div class="modal fade" id="firstModal{{$item->id}}" tabindex="-1"
                            aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                        <div class="modal-header,btn btn-warning">
                                            {{-- <h2 class="modal-title pt-4 ml-40" id="exampleModalLabel text-center">Adiciona este produto em seu carrinho</h2> --}}
                                            <button type="button" class="btn-close text-center" data-bs-dismiss="modal"   aria-label="Close">
                                                X
                                            </button>
                                        </div>
                                        <div class="modal-body">
                                            <Form id="mainForm" action="{{ route('store.cart',$item->id)}}" method="post">
                                                @csrf
                                                <div class="text  pt-4 rounded">
                                                <div class="grup-control">
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

                                                            <div class="flex flex-col gap-2">

                                                                <button type="submit" id="submitButton" class="bg-gradient-to-r from-green to-indigo-400 border-l-4 border-t-2 border-bluee pt-2 pb-2 mr-10 ml-10 rounded hover:bg-none hover:bg-green hover:text-white">
                                                                    <span id="buttonText">ADICIONAR</span>
                                                                    <span id="buttonSpinner" style="display: none;">
                                                                        <div class="spinner"></div>
                                                                    </span>
                                                                </button>

                                                            {{-- <button class="btn btn-success text-with bg-success m-2" type="submit">ADICIONAR</button> --}}
                                                            <button type="button" class="btn btn-warning bg-warning m-2"data-bs-dismiss="modal">Cancelar</button>
                                                            </div>
                                                    </fieldset>
                                                </div>
                                                </div>
                                            </Form>
                                        </div>
                                </div>
                            </div>
                        </div>

                        @endforeach


                    </div>
                </div>
            </div>
            <!-- Você pode adicionar mais seções como "Bebidas", "Sobremesas" etc. da mesma forma -->
        </div>
          {{-- container dos combos --}}

        <div class="container mx-auto p-4">
            <div class="border-b-2 border-gray-300 mb-4">
                <!-- Cabeçalho da seção com um botão de toggle -->
                <div class="flex justify-between items-center cursor-pointer" onclick="toggleSection('combos-section')">
                    <h2 class="text-xl font-bold">  COMBOS</h2>
                    <!-- Ícone de seta para abrir/fechar -->
                    <span id="combos-arrow" class="transform transition-transform duration-300">▼</span>
                </div>
                <!-- Conteúdo que será ocultado/mostrado -->
                <div id="combos-section" class="mt-4 hidden">
                    {{-- Conteúdo dos lanches aqui --}}
                    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                        @foreach ($productCombo as $item)
                        <div class="bg-white rounded-lg shadow-lg overflow-hidden">
                            @if($item->photo)
                            <div class="w-full img flex justify-center mt-4">
                                <img src="{{ asset('storage/' .$item->photo) }}" alt="foto do lanche"
                                     class="w-28 h-28 rounded-md hover:scale-110 hover:-rotate-2 duration-300">
                            </div>
                            @endif
                            <div class="p-2">
                                <h3 class="text-lg font-semibold mb-2">{{ $item->name}}</h3>
                                <p class="text-gray-600 mb-2">{{ $item->description}}</p>
                                <p class="font-semibold mb-2 text-red-500 md:text-2xl">R$ @money( $item->price )</p>

                                <div class="">
                                    @if ($toggle->is_open ?? '' )

                                    <button class="btn btn-success ml-10 " data-bs-toggle="modal"
                                        data-bs-target="#firstModal{{$item->id}}">
                                          add ao carrinho
                                    </button>

                                   @else



                                   @endif
                                </div>
                            </div>
                        </div>

                           {{-- modal para adicionar produtos ao carrinho --}}
                        <div class="modal fade" id="firstModal{{$item->id}}" tabindex="-1"
                            aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                        <div class="modal-header,btn btn-warning">
                                            {{-- <h2 class="modal-title pt-4 ml-40" id="exampleModalLabel text-center">Adiciona este produto em seu carrinho</h2> --}}
                                            <button type="button" class="btn-close text-center" data-bs-dismiss="modal"   aria-label="Close">
                                                X
                                            </button>
                                        </div>
                                        <div class="modal-body">
                                            <Form id="mainForm" action="{{ route('store.cart',$item->id)}}" method="post">
                                                @csrf
                                                <div class="text  pt-4 rounded">
                                                <div class="grup-control">
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
                                                                                <input type="checkbox" id="additional-{{ $item->id }}" name="additional_ids[]" value="{{ $item->id }}" class="form-checkbox h-5 w-5 text-blue-600">
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
                                                                                    >
                                                                            </div>
                                                                        </div>
                                                                    @endforeach


                                                                </div>


                                                            <div class=" p-2 text-center">
                                                            <strong><h1>OBSERVAÇÃO</h1></strong>
                                                            <input type="text" autocomplete="off" class="  rounded " placeholder="Ex: sem tomate" name="observation" id="observation" value="{{$item->observation}}">
                                                            </div>
                                                            <div class="flex flex-col gap-2">

                                                                <button type="submit" id="submitButton" class="bg-gradient-to-r from-green to-indigo-400 border-l-4 border-t-2 border-bluee pt-2 pb-2 mr-10 ml-10 rounded hover:bg-none hover:bg-green hover:text-white">
                                                                    <span id="buttonText">ADICIONAR</span>
                                                                    <span id="buttonSpinner" style="display: none;">
                                                                        <div class="spinner"></div>
                                                                    </span>
                                                                </button>

                                                            {{-- <button class="btn btn-success text-with bg-success m-2" type="submit">ADICIONAR</button> --}}
                                                            <button type="button" class="btn btn-warning bg-warning m-2"data-bs-dismiss="modal">Cancelar</button>
                                                            </div>
                                                    </fieldset>
                                                </div>
                                                </div>
                                            </Form>
                                        </div>
                                </div>
                            </div>
                        </div>

                        @endforeach


                    </div>
                </div>
            </div>
            <!-- Você pode adicionar mais seções como "Bebidas", "Sobremesas" etc. da mesma forma -->
        </div>
        {{-- container de bomboneirer --}}

        <div class="container mx-auto p-4">
            <div class="border-b-2 border-gray-300 mb-4">
                <!-- Cabeçalho da seção com um botão de toggle -->
                <div class="flex justify-between items-center cursor-pointer" onclick="toggleSection('bomboniere-section')">
                    <h2 class="text-xl font-bold">BOMBONIERE</h2>
                    <!-- Ícone de seta para abrir/fechar -->
                    <span id="bomboniere-arrow" class="transform transition-transform duration-300">▼</span>
                </div>
                <!-- Conteúdo que será ocultado/mostrado -->
                <div id="bomboniere-section" class="mt-4 hidden">
                    {{-- Conteúdo dos lanches aqui --}}
                    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                        @foreach ($productBomboniere as $item)
                        <div class="bg-white rounded-lg shadow-lg overflow-hidden">
                            @if($item->photo)
                            <div class="w-full img flex justify-center mt-4">
                                <img src="{{ asset('storage/' .$item->photo) }}" alt="foto do lanche"
                                     class="w-28 h-28 rounded-md hover:scale-110 hover:-rotate-2 duration-300">
                            </div>
                            @endif
                            <div class="p-2">
                                <h3 class="text-lg font-semibold mb-2">{{ $item->name}}</h3>
                                <p class="text-gray-600 mb-2">{{ $item->description}}</p>
                                <h2 class="font-semibold mb-2 text-red-500 md:text-2xl">R$ @money( $item->price )</h2>

                                <div class="">
                                    @if ($toggle->is_open ?? '' )

                                    <button class="btn btn-success ml-10 " data-bs-toggle="modal"
                                        data-bs-target="#firstModal{{$item->id}}">
                                          add ao carrinho
                                    </button>

                                   @else



                                   @endif
                                </div>
                            </div>
                        </div>

                           {{-- modal para adicionar produtos ao carrinho --}}
                        <div class="modal fade" id="firstModal{{$item->id}}" tabindex="-1"
                            aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                        <div class="modal-header,btn btn-warning">
                                            {{-- <h2 class="modal-title pt-4 ml-40" id="exampleModalLabel text-center">Adiciona este produto em seu carrinho</h2> --}}
                                            <button type="button" class="btn-close text-center" data-bs-dismiss="modal"   aria-label="Close">
                                                X
                                            </button>
                                        </div>
                                        <div class="modal-body">
                                            <Form id="mainForm" action="{{ route('store.cart',$item->id)}}" method="post">
                                                @csrf
                                                <div class="text  pt-4 rounded">
                                                <div class="grup-control">
                                                    <fieldset class="text-center">

                                                            <div class="label text-center">
                                                                <img src="{{ asset('storage/' .$item->photo ?? '') }}" alt="foto do produto" class="img-fluid p-2 mx-auto d-block"><br>
                                                                <strong><h1>PRODUTO</h1></strong>
                                                                <input type="text" disabled class=" p-2  rounded "  name="product_id" id="product_id" value="{{ $item->name }}"/><br>
                                                            </div>
                                                       +
                                                            <div class=" mt-2 label2 text-center">
                                                            <strong><h1>QUANTIDADE</h1></strong>
                                                                <input type="number" min="1"  class=" p-2  rounded text-center " name="quanty" value="{{ $item->quanty }}"/><br>
                                                            </div>
                                                            <div class="label3 text-center p-2">
                                                                <strong><h1>PREÇO UNITARIO</h1></strong>
                                                                <input type="text"  disabled class=" rounded text-center " name="price" id="price" value="{{number_format($item->price,2,',','.')?? '' }}"/><br>
                                                            </div>


                                                            <div class="flex flex-col gap-2">

                                                                <button type="submit" id="submitButton" class="bg-gradient-to-r from-green to-indigo-400 border-l-4 border-t-2 border-bluee pt-2 pb-2 mr-10 ml-10 rounded hover:bg-none hover:bg-green hover:text-white">
                                                                    <span id="buttonText">ADICIONAR</span>
                                                                    <span id="buttonSpinner" style="display: none;">
                                                                        <div class="spinner"></div>
                                                                    </span>
                                                                </button>

                                                            {{-- <button class="btn btn-success text-with bg-success m-2" type="submit">ADICIONAR</button> --}}
                                                            <button type="button" class="btn btn-warning bg-warning m-2"data-bs-dismiss="modal">Cancelar</button>
                                                            </div>
                                                    </fieldset>
                                                </div>
                                                </div>
                                            </Form>
                                        </div>
                                </div>
                            </div>
                        </div>

                        @endforeach

                    </div>
                </div>
            </div>
            <!-- Você pode adicionar mais seções como "Bebidas", "Sobremesas" etc. da mesma forma -->
        </div>

    </main>



    {{-- <footer class="bg-red-600 text-white p-4 mt-6">
        <div class="container mx-auto flex justify-between items-center">
            <p>&copy; 2023 Dougão Lanches todos direitos reservados.</p>
            <div class="flex space-x-4">
                <a href="#" class="hover:text-yellow-400 transition duration-300">
                    <i class="fab fa-facebook-f"></i>
                </a>
                <a href="#" class="hover:text-yellow-400 transition duration-300">
                    <i class="fab fa-twitter"></i>
                </a>
                <a href="#" class="hover:text-yellow-400 transition duration-300">
                    <i class="fab fa-instagram"></i>
                </a>
            </div>
        </div>
    </footer> --}}
       {{-- carrinho --}}
    <div class="fixed bottom-4 right-4">
        <a href="{{ route('cart.show')}}">
            <button class="bg-red-600 text-white p-4 rounded-full shadow-lg hover:bg-red-500 transition duration-300">
                 <i class="fas fa-shopping-cart text-xl"></i>
                     @if($productCount)
                    <span class="absolute top-0 right-0 bg-yellow-400 text-red-600 rounded-full w-6 h-6 flex items-center justify-center text-xs ">{{ $productCount }}</span>
                    @endif
                    @if(!$productCount)
                  <i class="fa-solid fa-sad-tear text-xl"></i>
               @endif
            </button>
        <a>
    </div>
    @vite('resources/js/app.js')


    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.min.js"></script>


    <script>
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

    // mostrar div com os produtos

    function toggleSection(sectionId) {
    // Alternar visibilidade da seção
    const section = document.getElementById(sectionId);
    section.classList.toggle('hidden');

    // Alternar a seta de "▼" para "▲"
    const arrow = document.getElementById(sectionId.replace('-section', '-arrow'));
    if (section.classList.contains('hidden')) {
        arrow.textContent = '▼';
    } else {
        arrow.textContent = '▲';
    }
}

//     document.addEventListener('DOMContentLoaded', function() {
//     // Desabilitar todos os campos de quantidade inicialmente
//     document.querySelectorAll('input[type="number"]').forEach(function(quantityField) {
//         quantityField.disabled = true;
//     });

//     // Adiciona evento aos checkboxes para habilitar/desabilitar o campo de quantidade
//     document.querySelectorAll('input[type="checkbox"]').forEach(function(checkbox) {
//         checkbox.addEventListener('change', function() {
//             const additionalId = checkbox.id.split('-')[1]; // Pega o ID do adicional
//             const quantityField = document.getElementById(`quantity-${additionalId}`);

//             if (checkbox.checked) {
//                 quantityField.disabled = false; // Ativa o campo de quantidade se o checkbox estiver marcado
//             } else {
//                 quantityField.disabled = true; // Desativa o campo se o checkbox estiver desmarcado
//                 quantityField.value = 1; // Reseta o valor para 1 quando desmarcado
//             }
//         });
//     });
// });




    </script>
</body>
