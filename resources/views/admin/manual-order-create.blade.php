
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

    <link rel="preload" as="image" href="{{ asset('image/dellestlogo.png') }}">


    <style>

    .denied {
        color: rgb(243, 76, 76);
    }

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
<body class="bg-yellow-100 font-sans mb-28 md:mb-0">

    @vite('resources/css/app.css')

    <header class="text-center mb-8 pt-8">
        <div class="flex items-center justify-center space-x-4 mt-4">
            <h1 class="text-3xl md:text-4xl font-bold text-red-600 relative">
                <span class="absolute inset-0 text-red-400 blur-sm transform translate-x-1 translate-y-1">DOUGÃO LANCHES</span>
                <span class="relative">DOUGÃO LANCHES</span>
            </h1>
            <img src="{{ asset('/image/dellestlogo.png') }}" alt="Logo Dougão Lanches" class="h-20 w-auto rounded md:w-10 opacity-90 m-4">
        </div>
                <!-- Botão para abrir o modal -->
                @if ($productPromo->isNotEmpty() && $productPromo->contains('status', 0))
                    <div class="mt-4">
                        <button onclick="toggleModal()" class="bg-yellow-400 text-red-700 font-bold text-lg px-6 py-3 rounded-full shadow-lg hover:bg-yellow-500 transition duration-300">
                            🎉 Veja nossas Promoções! <span class="text-green-400">😋</span>
                        </button>
                    </div>
                @endif


            <!-- Modal (começa oculto) -->
            <div id="promoModal" class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center hidden">
                <div class="bg-white p-6 rounded-lg shadow-lg w-96 relative max-h-[90vh] ">
                    <h2 class="text-xl font-bold text-red-600 mb-4 text-center">Promoções Especiais! 🍔</h2>

                    <!-- Lista de Lanches -->
                    <div class="space-y-4 bg-white">

                        @foreach($productPromo as $item)

                            @if($item->photo)
                                <div class="w-full img flex justify-center mt-2">
                                    <img src="{{ asset('storage/' .$item->photo) }}" alt="foto do lanche"
                                        class="w-28 h-28 rounded-md hover:scale-110 hover:-rotate-2 duration-300">
                                </div>
                            @endif

                            <form id="mainForm" action="{{ route('store.cart', $item->id) }}" method="post">
                                @csrf
                                <div class="p-4 border rounded-lg shadow overflow-auto">
                                    <h3 class="text-lg font-semibold">{{ $item->name }}</h3>
                                    <input type="hidden" name="name" value="{{ $item->name }}">

                                    <h3>Quantidade:
                                        <input type="number" name="quanty" class="rounded border p-1 w-16" min="1" value="1">
                                    </h3>

                                    <p class="text-gray-600 text-sm">Descrição: {{ $item->description }}</p>
                                    <input type="hidden" name="description" value="{{ $item->description }}">

                                    <span class="text-red-500 font-bold">R$ @money($item->price)</span>
                                    <input type="hidden" name="price" value="{{ $item->price }}">
                                </div>
                                @if ($toggle->is_open ?? '' )

                                <button type="submit" class="w-full bg-indigo-600 text-white font-bold py-2 rounded-lg shadow-lg
                                    hover:bg-indigo-400 hover:scale-105 transition-all flex items-center justify-center gap-2">
                                    🛒 Adicionar ao Carrinho
                                </button>

                                @else

                                @endif



                            </form>
                        @endforeach
                    </div>

                    <!-- Botão para fechar -->
                    <button onclick="toggleModal(false)" class="mt-4 w-full bg-red-600 text-white font-bold py-2 rounded-lg hover:bg-red-700 transition">
                        Fechar ❌
                    </button>
                </div>
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


    </header>

    <div class="container max-w-4xl mx-auto p-4 md:p-8">
        <div class="bg-white p-4 rounded-lg shadow-md space-y-4">
            <h2 class="text-xl font-bold ">Dados do Cliente</h2>

              <!-- Nome (name) -->
              <div>
                <label for="name" class="block text-gray-700 font-semibold">Nome</label>
                <input type="text" name="name" id="client_name" placeholder=" Ex: Marcio"
                    class="w-full border rounded-lg p-2 shadow-sm focus:outline-none focus:ring-2 focus:ring-yellow-400">
            </div>

            <!-- Rua (Street) -->
            <div>
                <label for="street" class="block text-gray-700 font-semibold">Rua</label>
                <input type="text" name="street" id="street" placeholder="Ex: Rua das Flores"
                    class="w-full border rounded-lg p-2 shadow-sm focus:outline-none focus:ring-2 focus:ring-yellow-400">
            </div>

            <!-- Bairro (District) -->
            <div>
                <label for="district" class="block text-gray-700 font-semibold">Bairro</label>
                <input type="text" name="district" id="district" placeholder="Ex: Centro"
                    class="w-full border rounded-lg p-2 shadow-sm focus:outline-none focus:ring-2 focus:ring-yellow-400">
            </div>

            <!-- Número (Number) -->
            <div>
                <label for="number" class="block text-gray-700 font-semibold">Número</label>
                <input type="text" name="number" id="number" placeholder="Ex: 123"
                    class="w-full border rounded-lg p-2 shadow-sm focus:outline-none focus:ring-2 focus:ring-yellow-400">
            </div>

            <!-- referencia (reference) -->
            <div>
                <label for="reference" class="block text-gray-700 font-semibold">Referência</label>
                <input type="text" name="reference" id="reference" placeholder="Ex: enfrente a Praça do bairro"
                    class="w-full border rounded-lg p-2 shadow-sm focus:outline-none focus:ring-2 focus:ring-yellow-400">
            </div>

              <!-- Telefone -->
              <div>
                <label for="phone" class="block text-gray-700 font-semibold">Telefone</label>
                <input type="text" name="phone" id="phone" placeholder="Ex: (11) 91234-5678"
                    class="w-full border rounded-lg p-2 shadow-sm focus:outline-none focus:ring-2 focus:ring-yellow-400">
            </div>


            <!-- Tipo de Pedido -->
            <div>
                <label class="block text-gray-700 font-semibold mb-1">Tipo de Pedido</label>
                <div class="flex items-center gap-6">
                    <label class="flex items-center gap-2">
                        <input type="radio" name="order_type" value="retirar" class="form-radio " checked>
                        Retirar
                    </label>
                    <label class="flex items-center gap-2">
                        <input type="radio" name="order_type" value="entregar" class="form-radio ">
                        Entregar
                    </label>
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
                    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                        @foreach ($product as $item)
                            <div class="bg-white rounded-lg shadow-lg overflow-auto">

                            {{-- Número incremental do produto --}}
                            <div class="text-sm text-gray-500 ml-2 mt-4">
                                Produto Nº {{ $loop->iteration }}
                            </div>
                                @if($item->photo)
                                    <div class="w-full img flex justify-center mt-2">
                                        <img src="{{ asset('storage/' .$item->photo ?? '') }}" alt="foto do lanche"
                                            class="w-28 h-28 rounded-md hover:scale-110 hover:-rotate-2 duration-300">
                                    </div>
                                @endif
                                <div class="p-2 ">
                                    <h3 class="text-lg font-semibold mb-2">{{ $item->name }}</h3>

                                        <p class="text-gray-600 mb-1 mr-2 text-sm md:text-md line-clamp-3 max-h-20 overflow-hidden">{{ $item->description }}</p>

                                     <h2 class="font-semibold mb-2 text-red-500 md:text-2xl">R$ @money( $item->price )</h2>
                                    <!-- Botão de adicionar ao carrinho ou outra ação -->
                                    <div class="">
                                            <button class="w-full bg-indigo-600 text-white font-bold py-2 rounded-lg shadow-lg
                                            hover:bg-indigo-400 hover:scale-105 transition-all flex items-center justify-center gap-2 " data-bs-toggle="modal"
                                                data-bs-target="#firstModal{{$item->id}}">
                                                🛒 Adicionar ao Carrinho
                                            </button>
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
                                                <form class="product-form" action="{{ route('admin.manual-order.store', $item->id) }}" method="post">
                                                    @csrf
                                                    <div class="text pt-4 rounded">
                                                        <div class="grup-control">
                                                            <fieldset class="text-center">

                                                                <!-- Foto e Nome do Produto -->
                                                                <div class="label text-center">
                                                                    <img src="{{ asset('storage/' . ($item->photo ?? '')) }}" alt="foto do produto" class="img-fluid p-2 mx-auto d-block"><br>
                                                                    <strong><h1>PRODUTO</h1></strong>
                                                                    <input type="text" disabled class="p-2 rounded" value="{{ $item->name }}"/><br>
                                                                    <input type="hidden" name="product_id" value="{{ $item->id }}"> <!-- Valor real aqui -->
                                                                </div>

                                                                <!-- Descrição -->
                                                                <div class="mt-2 label2 text-center">
                                                                    <strong><h1>DESCRIÇÃO</h1></strong>
                                                                    <input type="text" disabled class="p-2 rounded" value="{{ $item->description }}"/><br>
                                                                </div>

                                                                <!-- Quantidade -->
                                                                <div class="mt-2 label2 text-center">
                                                                    <strong><h1>QUANTIDADE</h1></strong>
                                                                    <input type="number" min="1" class="p-2 rounded text-center" name="quanty" value="{{ $item->quanty }}"/><br>
                                                                </div>

                                                                <!-- Preço Unitário -->
                                                                <div class="label3 text-center p-2">
                                                                    <strong><h1>PREÇO UNITÁRIO</h1></strong>
                                                                    <input type="text" disabled class="rounded text-center" value="{{ number_format($item->price,2,',','.') }}"><br>
                                                                    <input type="hidden" name="unit_price" value="{{ $item->price }}">
                                                                </div>

                                                                <!-- Adicionais -->
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

                                                                <!-- Observação -->
                                                                <div class="p-2 text-center">
                                                                    <strong><h1>OBSERVAÇÃO</h1></strong>
                                                                    <input type="text" autocomplete="off" class="rounded" placeholder="Ex: sem tomate" name="observation" id="observation" value="{{ old('observation') }}">
                                                                </div>

                                                                <!-- Campos Ocultos (dados do cliente) -->
                                                                <input type="hidden" name="client_name" id="hidden_client_name">
                                                                <input type="hidden" name="phone" id="hidden_phone">
                                                                <input type="hidden" name="street" id="hidden_street">
                                                                <input type="hidden" name="district" id="hidden_district">
                                                                <input type="hidden" name="number" id="hidden_number">
                                                                <input type="hidden" name="reference" id="hidden_reference">
                                                                <input type="hidden" name="order_type" id="hidden_order_type">


                                                                <!-- Botões -->
                                                                <div class="flex flex-col gap-2 mt-4">
                                                                    <button type="submit"  class="bg-gradient-to-r from-green to-indigo-400 border-l-4 border-t-2 border-bluee pt-2 pb-2 mr-10 ml-10 rounded hover:bg-none hover:bg-green hover:text-white">
                                                                        <span id="buttonText">ADICIONAR</span>
                                                                        <span id="buttonSpinner" style="display: none;">
                                                                            <div class="spinner"></div>
                                                                        </span>
                                                                    </button>

                                                                    <button type="button" class="btn btn-warning bg-warning m-2" data-bs-dismiss="modal">Cancelar</button>
                                                                </div>

                                                            </fieldset>
                                                        </div>
                                                    </div>
                                                </form>
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

                           {{-- Número incremental do produto --}}
                           <div class="text-sm text-gray-500 ml-2 mt-4">
                             Produto Nº {{ $loop->iteration }}
                           </div>
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


                                    <button class="w-full bg-indigo-600 text-white font-bold py-2 rounded-lg shadow-lg
                                    hover:bg-indigo-400 hover:scale-105 transition-all flex items-center justify-center gap-2 " data-bs-toggle="modal"
                                        data-bs-target="#firstModal{{$item->id}}">
                                        🛒 Adicionar ao Carrinho
                                    </button>

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
                        {{-- Número incremental do produto --}}
                           <div class="text-sm text-gray-500 ml-2 mt-4">
                             Produto Nº {{ $loop->iteration }}
                           </div>
                        <div class="bg-white rounded-lg shadow-lg overflow-hidden">
                            @if($item->photo)
                            <div class="w-full img flex justify-center mt-4">
                                <img src="{{ asset('storage/' .$item->photo) }}" alt="foto do lanche"
                                     class="w-28 h-28 rounded-md hover:scale-110 hover:-rotate-2 duration-300">
                            </div>
                            @endif
                            <div class="p-2">
                                <h3 class="text-lg font-semibold mb-2">{{ $item->name}}</h3>
                                {{-- <p class="text-gray-600 mb-2">{{ $item->description}}</p> --}}
                                <p class="font-semibold mb-2 text-red-500 md:text-2xl">R$ @money( $item->price )</p>

                                <div class="">


                                    <button class="w-full bg-indigo-600 text-white font-bold py-2 rounded-lg shadow-lg
                                    hover:bg-indigo-400 hover:scale-105 transition-all flex items-center justify-center gap-2 " data-bs-toggle="modal"
                                        data-bs-target="#firstModal{{$item->id}}">
                                        🛒 Adicionar ao Carrinho
                                    </button>


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
                               {{-- Número incremental do produto --}}
                            <div class="text-sm text-gray-500 ml-2 mt-4">
                              Produto Nº {{ $loop->iteration }}
                            </div>
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
                                    
                                    <button class="w-full bg-indigo-600 text-white font-bold py-2 rounded-lg shadow-lg
                                    hover:bg-indigo-400 hover:scale-105 transition-all flex items-center justify-center gap-2 " data-bs-toggle="modal"
                                        data-bs-target="#firstModal{{$item->id}}">
                                        🛒 Adicionar ao Carrinho
                                    </button>

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

    <a href="{{ route('panel.admin') }}">
        <button class="bg-gradient-to-r from-green to-lime-300  font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline border-l-4 border-blue border-t-2 ">
            Voltar
        </button>
    </a>

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
       <div class="bottom-4 right-4" style="position: fixed; bottom: 1rem; right: 1rem; margin-bottom: 4px;">

        {{-- <a href="{{ route('cart.show') }}">
            <button style="background-color: #f63434; color: white; padding: 1rem; border-radius: 9999px; box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1); transition: background-color 0.3s;">
                <i class="fas fa-shopping-cart" style="font-size: 1.25rem;"></i>
                @if($productCount)
                    <span style="position: absolute; top: 0; right: 0; background-color: #facc15; color: #cb0c35; border-radius: 9999px; width: 1.5rem; height: 1.5rem; display: flex; align-items: center; justify-content: center; font-size: 0.75rem;">
                        {{ $productCount }}
                    </span>
                @endif
                @if(!$productCount)
                    <i class="fa-solid fa-sad-tear" style="font-size: 1.25rem;"></i>
                @endif
            </button>
        </a> --}}
    </div>


    @vite('resources/js/app.js')

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.min.js"></script>

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            // Exibe ou oculta campos de endereço
            const retirarRadio = document.querySelector('input[name="order_type"][value="retirar"]');
            const entregarRadio = document.querySelector('input[name="order_type"][value="entregar"]');

            const camposEndereco = [
                document.getElementById('street')?.closest('div'),
                document.getElementById('district')?.closest('div'),
                document.getElementById('number')?.closest('div'),
                document.getElementById('reference')?.closest('div'),
            ];

            function toggleEndereco(show) {
                camposEndereco.forEach(div => {
                    if (div) div.style.display = show ? 'block' : 'none';
                });
            }

            if (retirarRadio) retirarRadio.addEventListener('change', () => toggleEndereco(false));
            if (entregarRadio) entregarRadio.addEventListener('change', () => toggleEndereco(true));
            toggleEndereco(entregarRadio?.checked);

            // Envio de múltiplos formulários (um por produto)
            const forms = document.querySelectorAll('.product-form');
            forms.forEach(form => {
                form.addEventListener('submit', function () {
                    // Spinner
                    const submitButton = form.querySelector('button[type="submit"]');
                    const buttonText = form.querySelector('#buttonText');
                    const buttonSpinner = form.querySelector('#buttonSpinner');

                    if (submitButton) submitButton.disabled = true;
                    if (buttonText) buttonText.style.display = 'none';
                    if (buttonSpinner) buttonSpinner.style.display = 'block';

                    // Preencher campos hidden com os valores atuais
                    form.querySelector('#hidden_client_name').value = document.getElementById('client_name')?.value || '';
                    form.querySelector('#hidden_phone').value = document.getElementById('phone')?.value || '';
                    form.querySelector('#hidden_street').value = document.getElementById('street')?.value || '';
                    form.querySelector('#hidden_district').value = document.getElementById('district')?.value || '';
                    form.querySelector('#hidden_number').value = document.getElementById('number')?.value || '';
                    form.querySelector('#hidden_reference').value = document.getElementById('reference')?.value || '';
                    const tipo = document.querySelector('input[name="order_type"]:checked');
                    form.querySelector('#hidden_order_type').value = tipo ? tipo.value : '';
                });
            });
        });

        function toggleSection(sectionId) {
    const section = document.getElementById(sectionId);
    section.classList.toggle('hidden');

    const arrow = document.getElementById(sectionId.replace('-section', '-arrow'));
    arrow.textContent = section.classList.contains('hidden') ? '▼' : '▲';
}
        </script>


</body>

