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
    <style>
       .additional{
        border: solid 2px rgb(66, 110, 190);
       }
       .color{
        color: rgba(22, 88, 129, 0.708);
       }
       .spinner {
        border: 4px solid rgba(0,0,0,0.1);
        border-left: 4px solid #3498db;
        border-radius: 50%;
        width: 30px;
        height: 30px;
        animation: spin 1s linear infinite;
    }

    @keyframes spin {
        0% { transform: rotate(0deg); }
        100% { transform: rotate(360deg); }
    }


    </style>


    @vite('resources/css/app.css')
</head>
<body>
        <div class="  text-center md: p-2 relative bg-yellow-100">
                    <div class="container max-auto relative">
                        <div class="bg-white rounded-lg shadow-lg p-6 mb-8">

                             <div class="text-center mt-2absolute">
                                  <p class="text-sm md:text-2xl text-gray-700">Bem vindo a sua Sacola de Compras   {{ auth()->user()->name }}</p>
                             </div>

                         </div>
                         <div class="bg-white rounded-lg shadow-lg p-6 mb-8 pb-2">
                             <h3 class="pb-2 text-sm text-start  md:text-center">Com Dougão Lanches o valor de seus pedidos viram pontos
                                verifique se você possui pontos aqui no seu cartão fideledade.
                            </h3>
                            <a href="{{route('index.point')}}"  class="text-xs md:text-sm pt-2">
                                CARTÃO FIDELIDADE
                              <i class="fa-solid fa-id-card fa-2xl color " ></i>
                            </a>
                         </div>
                    </div>

                        {{-- <audio controls autoplay>
                            <source src="{{asset('sounds/new_order.mp3')}}" type="audio/mp3">
                            Your browser does not support the audio element.
                        </audio> --}}
                                            {{-- @dd(session('new_order')) --}}
                                @if (session('new_order'))
                                    <script>
                                        // Reproduzir som de notificação

                                        var audio = new Audio('{{ asset('sounds/audio.mp3') }}');
                                            audio.play();

                                    </script>
                                @endif

                          

                            @if (session('successmessage'))

                                <div class="success text-lg p-2 font-bold">
                                   <p class="bg-slate-300 p-2 text-green " >{{ session('successmessage')}}</p>
                                </div>

                              @endif

                              @if (session('empaty'))

                                  <div class="text-red-500">
                                    {{ session('empaty')}}
                                  </div>

                              @endif

                              @if (session('menssagem'))

                                <div class="text-red-500  p-2">
                                  {{ session('menssagem')}}
                                </div>

                              @endif

                              @if ( session('total'))
                                 <div class="text-red-500 bg-white p-2">
                                  <p>
                                    {{session('total')}}
                                  </p>
                                 </div>
                              @endif

                              @if ( session('delete'))
                              <div class="text-green p-2 bg-slate-300 ml-20 mr-20 rounded">
                                <p>
                                    {{ session('delete')}}
                                </p>
                              </div>
                              @endif
                                 {{-- verifica se usuario tem pedido para avaliar --}}
                              @if( session('notOrder'))
                              <div class=" bg-yellow-200 p-2 rounded">
                                   <p>
                                       {{ session('notOrder')}}
                                   </p>
                              </div>
                           @endif
                                {{-- lop dos produtos --}}
                        <div class="container max-auto">
                             <div class="bg-white rounded-lg shadow-lg p-6 mb-4">
                                 <div class=" ">

                                    @forelse ($cart as $item)
                                       @if( $item->orderProductProduct && !$item->blindCart )
                                            <div class="mb-4 border-b pb-2">
                                                <div class="flex justify-between items-center mb-2">
                                                    <div class="font-bold text-gray-700">
                                                        <span>produto</span>
                                                    </div>
                                                    <div class="text-gray-700">
                                                        {{ $item->orderProductProduct->name ?? ''}}
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="mb-4 border-b pb-2">
                                                <div class="flex justify-between items-center mb-2">
                                                    <div class="font-bold text-gray-700">
                                                        <span>Quatidade</span>
                                                    </div>
                                                    <div class="text-gray-700">
                                                        <span>{{$item->quanty}}</span>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="mb-4 border-b pb-2">
                                                <div class="flex justify-between items-center mb-2">
                                                <div class="font-bold text-gray-700">
                                                    <span>Preço</span>
                                                </div>
                                                <div class="text-gray-700">
                                                    <span>@money($item->orderProductProduct->price ?? 0)</span>
                                                </div>
                                                </div>
                                            </div>
                                        @else
                                           @if(!empty($item->blindCart))
                                                <div class="mb-4 border-b pb-2">
                                                    <div class="flex justify-between items-center mb-2">
                                                        <div class="font-bold text-gray-700">
                                                            <span>Blinde</span>
                                                        </div>
                                                        <div class="text-gray-700">
                                                            <span>{{ $item->blindCart->name ?? 'Brinde sem nome' }}</span>
                                                        </div>
                                                    </div>
                                                </div>
                                            @endif
                                        @endif

                                        @if( $item->orderProductProduct && $item->orderProductProduct->category_id != 2 && $item->orderProductProduct->category_id != 4 )
                                            <div class="mb-4 border-b pb-2">
                                                <div class="flex justify-between items-center mb-2">
                                                    <div class="font-bold text-gray-700">
                                                        <span>Observação</span>
                                                    </div>
                                                    <div class="text-gray-700">
                                                        @if( $item->observation)
                                                        <span>{{ $item->observation }}</span>
                                                        @else
                                                        //
                                                        @endif
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="mb-4 border-b pb-2">
                                                <div class="flex justify-between items-center mb-2">
                                                    <div class="font-bold text-gray-700">
                                                        <span>Adicionais</span>
                                                    </div>
                                                    <div class="text-gray-700">
                                                        <span>
                                                            @forelse ($item->orderProductAdditional as $additional)
                                                                {{ $additional->name }} ( {{$additional->pivot->quantity}} )
                                                            @empty
                                                            //
                                                            @endforelse
                                                        </span>
                                                    </div>
                                                </div>
                                            </div>
                                        @else
                                           @if( !$item->blindCart)
                                                <div class="mb-4 border-b pb-2">
                                                    <div class="flex justify-between items-center mb-2">
                                                        <div class="font-bold text-gray-700">
                                                            <span>Descrição</span>
                                                        </div>
                                                        <div class="text-gray-700">

                                                            <span>{{ $item->orderProductProduct->description ?? ''}}</span>

                                                        </div>
                                                    </div>
                                                </div>

                                            @endif
                                        @endif
                                        <div class="mb-4 border-b pb-2">
                                            <div class="flex justify-between items-center mb-2">

                                              @if( !$item->blindCart)

                                              <div class="text-gray-700 text-center">
                                                <form action="{{ route('cart.delete', $item->id) }}" method="POST">
                                                    @csrf
                                                    <button type="submit" class="text-white bg-red-500 hover:bg-red-600 rounded px-4 py-2 text-sm font-semibold">Excluir</button>
                                                </form>
                                              </div>

                                              @endif
                                            </div>
                                        </div>
                                        @empty

                                        <div class="bg-yellow-200 p-4 rounded">
                                            <p class="text-gray-200">Sua sacola esta vazia</p>
                                        </div>
                                      @endforelse


                                 </div>
                             </div>

                             {{-- <table class="w-full text-md font-light bg-white shadow-md rounded-lg overflow-hidden">
                                <thead class="bg-gray-200 border-b">
                                    <tr>
                                        <th scope="col" class="px-4 py-2 text-gray-700">Produto</th>
                                        <th scope="col" class="px-4 py-2 text-gray-700">Preço</th>
                                        <th scope="col" class="px-4 py-2 text-gray-700">Quantidade</th>
                                        <th scope="col" class="px-4 py-2 text-gray-700">Observação</th>
                                        <th scope="col" class="px-4 py-2 text-gray-700">Adicionais</th>
                                        <th scope="col" class="px-4 py-2 text-gray-700">Blinde</th>
                                        <th scope="col" class="px-4 py-2 text-gray-700">Ações</th>
                                    </tr>
                                </thead>
                                <tbody>

                                    <tr class="border-b dark:border-neutral-500 hover:bg-gray-50">
                                        <td class="whitespace-nowrap px-4 py-2 ">
                                            @if ($item->orderProductProduct)
                                            <span class=" rounded p-2 px-4">{{ $item->orderProductProduct->name ?? ''}}</span>
                                            @else
                                            <span class="bg-gray-100 text-gray-500 rounded p-2 px-4">//</span>
                                            @endif
                                        </td>

                                        <td class="whitespace-nowrap px-4 py-2">
                                            @if ($item->orderProductProduct)
                                            <span class="bg-gray-100 text-gray-700 rounded p-2 px-4">@money($item->orderProductProduct->price ?? 0)</span>
                                            @else
                                            <span class="bg-gray-100 text-gray-500 rounded p-2 px-4">//</span>
                                            @endif
                                        </td>

                                        <td class="whitespace-nowrap px-4 py-2">
                                            @if ($item->quanty)
                                            <span class="bg-gray-100 text-gray-700 rounded p-2 px-4">{{ $item->quanty }}</span>
                                            @else
                                            <span class="bg-gray-100 text-gray-500 rounded p-2 px-4">//</span>
                                            @endif
                                        </td>

                                        <td class="whitespace-nowrap px-4 py-2 text-gray-700">
                                            @if ($item->observation)
                                            <span class="bg-gray-100 text-gray-700 rounded p-2 px-4">{{ $item->observation }}</span>
                                            @else
                                            <span class="bg-gray-100 text-gray-500 rounded p-2 px-4">//</span>
                                            @endif
                                        </td>

                                        <td class="whitespace-nowrap px-4 py-2 text-gray-700">
                                             @if ($item->orderProductAdditional()->count() > 0)
                                                @foreach ($item->orderProductAdditional as $additional)
                                                @php
                                                    $quantity = $additionalOrderProducts->where('additional_id', $additional->id)->first()->quantity ?? 1;
                                                @endphp
                                                <span class="bg-gray-100 text-gray-700 rounded p-2 px-4">{{ $additional->name }} ( {{ $quantity }} )</span><br>
                                                @endforeach
                                            @else
                                            <span class="bg-gray-100 text-gray-500 rounded p-2 px-4">//</span>
                                            @endif

                                            @forelse ($item->orderProductAdditional as $additional)
                                              {{ $additional->name }} ( {{$additional->pivot->quantity}} )
                                            @empty
                                            //
                                           @endforelse
                                        </td>

                                        <td class="whitespace-nowrap px-4 py-2 text-gray-700">
                                            @if ($item->)
                                            <span class="bg-gray-100 text-gray-700 rounded p-2 px-4">{{ $item->blinCart->name ?? '' }}</span>
                                            @else
                                            <span class="bg-gray-100 text-gray-500 rounded p-2 px-4">//</span>
                                            @endif
                                        </td>

                                        <td class="whitespace-nowrap px-4 py-2">
                                            <form action="{{ route('cart.delete', $item->id) }}" method="POST">
                                                @csrf
                                                <button type="submit" class="text-white bg-red-500 hover:bg-red-600 rounded px-4 py-2 text-sm font-semibold">Excluir</button>
                                            </form>
                                        </td>
                                    </tr>

                                    <tr>
                                        <td colspan="7" class="text-center text-orange-500 font-bold  py-4">Sua sacola está vazia</td>
                                    </tr>

                                </tbody>
                            </table> --}}
                        </div>
                            {{-- Div total --}}
                        <div class="container max-auto  ">

                            <div class="bg-white rounded-lg shadow-lg p-2 mb-2 ">
                                <div class="ml-4 mr-4  container">
                                    <h1 class="font-bold text-gray-700 pt-2 pb-2">TOTAL</h1>

                    <form id="mainForm" action="{{ route('admin.create') }}" method="post">

                                    @csrf

                                    <input type="hidden" name="address_user_types_id" id="address_user_types_id" value="">

                                        <samp  class=" font-bold  p-2  rounded custom-border   mb-2"  id="toremove"> R$ @money($total)</samp>
                                        <samp  class=" font-bold  p-2  rounded custom-border   mb-2"  id="delivery"></samp>
                                        <input type="hidden" name="total" value=" @money ($total)">

                                        @foreach ($cart as $item)
                                            <input type="hidden" name="blindCartId" value="{{ $item->blindCart->id ?? ''}} ">

                                        @endforeach
                                </div>
                            </div>
                        </div>

                        <div class="container max-auto ">
                            <div class=" bg-white rounded-lg shadow-lg p-2 mb-2">
                                <div class="text-center">
                                    <p class="text-gray-700 pb-2 text-sm">o pagamento será realizado na entrega</p>
                                </div>
                                   {{-- forma de entrega --}}
                                <div class="p-4 relative">
                                    <div class=" w-full flex flex-col md:flex-row md:justify-center md:text-center">
                                         <div class=" mb-4 md:mb-0 flex items-center space-x-2">
                                            <input class="toremove  " type="radio" checked value="0" id="" name="delivery" onchange="atualizarValor()" >
                                            <label for="toRemove"  class="text-gray-700  pr-4" >Retirar na lanchonete</label>
                                         </div>

                                          <div class="md:mr-4 mb-2 md:mb-0 flex space-x-2">
                                            <input  class=" custom-border " type="radio" value="1" id="entrega" name="delivery" onchange="atualizarValor()">
                                            <label for="entrega" class="text-gray-700" > Entregar em domicílio</label>
                                            <i class="fa-solid fa-motorcycle fa-xl text-cyan-600"></i>
                                          </div>
                                    </div>
                                </div>
                                     {{-- forma de pagamento --}}
                                <div class=" relative">
                                    <h2 class="text-gray-700 pb-2">forma de pagamento</h2>
                                     <div class="pb-4 w-full flex flex-col md:flex-row md:justify-center md:text-center ml-6">
                                        <div class="md:mr-4 mb-4 md:mb-0 flex items-center space-x-2">
                                            <input class="payment_card custom-border " type="radio" checked value="0" id="" name="payment" >
                                            <label for=""  class="text-gray-700 font-bold pr-4" >Cartão</label>
                                            <select name="credit_card" id="select" class="text-sm p-2 border border-gray-300 rounded mb-2 mt-2 shadow-md hover:shadow-xl transition-shadow duration-300" >
                                                <option  value="visa">Visa</option>
                                                <option  value="Master Card">Master Card</option>
                                                <option  value="Ouro Card">Ouro Card</option>
                                            </select>
                                        </div>

                                        <div class="md:mr-4 mb-2 md:mb-0 flex items-center space-x-2">
                                            <input  class=" custom-border p-2" type="radio" value="1"  name="payment">
                                        <label for="" class="text-gray-700 font-bold " >Dinheiro</label>
                                        </div>
                                     </div>

                                </div>
                                <div class="pl-4 ">
                                    <label for="" class="pb-2 text-gray-700 text-sm">Se seu pagamento for em diheiro preencha este campo aqui em baixo</label><br>
                                    <input type="text" class="text-sm p-2 border border-gray-300 rounded mb-2 mt-2 shadow-md hover:shadow-xl transition-shadow duration-300" name="observation" id="observation" placeholder="ex: troco para 50 reais">
                                </div>

                            </div>
                        </div>
                          {{-- botões de enviar continuar e cadastrar --}}
                        <div class="container max-auto">
                            <div class="bg-white rounded-lg shadow-lg p-2 mb-2">
                                <div class="text-center  overflow-auto">

                                    <button type="submit" id="submitButton" class="text-sm p-2
                                    border-b-2 border-l-2 border-r-2
                                    bg-gradient-to-r from-cyan-100 to-emerald-500
                                    rounded mb-2 mt-2 shadow-lg
                                    hover:shadow-xl transition-shadow
                                    duration-300">
                                        <span id="buttonText">ENVIAR PEDIDO</span>
                                        <span id="buttonSpinner" style="display: none;">
                                            <div class="spinner"></div>
                                        </span>
                                    </button>

                    </form>

                                </div>

                                    <div class="p-2 text-center">
                                        <a href="{{ route('client.show')}}">
                                            <button class="text-sm p-2 border-b-2 border-r-2
                                            border-l-2 rounded mb-2 mt-2 shadow-lg
                                            bg-gradient-to-r from-cyan-100 to-emerald-500
                                            hover:shadow-xl transition-shadow
                                            duration-300">
                                                <SPAN>CONTINUAR COMPRANDO</SPAN>
                                            </button>
                                        </a>
                                    </div>

                                    <button class="text-sm p-2 border-b-4
                                     border-l-2 border-r-2
                                     bg-gradient-to-r from-cyan-100 to-emerald-500
                                     rounded mb-2 mt-2 shadow-lg
                                     hover:shadow-xl
                                     transition-shadow duration-300 "
                                     data-bs-toggle="modal"
                                        data-bs-target="#firstModal">
                                        <span>CADASTRAR UM NOVO ENDEREÇO</span>
                                    </button>
                                </div>
                        </div>


                        <div class="container max-auto">
                            <div class="bg-white rounded-lg shadow-lg p-2 mb-2">
                                @if(session('success'))
                                    <div class=" text-center  bg-white text-green p-4  rounded font-bold">
                                        <p>{{ session('success')}}</p>
                                    </div>
                                @endif
                                {{-- modal para cadastrar o endereço --}}
                                <div class="text-center text-3xl">

                                            {{-- Modall para Cadastrar endereço --}}

                                            <div class="modal fade" id="firstModal" tabindex="-1"
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
                                                        <form action="{{ route('adress.create')}}" method="POST">
                                                        @csrf
                                                                <div class="container">
                                                                    <div class="mb-4 sachadow-black">

                                                                        <p class="text-sm text-start mb-2">adicione aqui um nome para este endereço,por exemplo Minha casa,
                                                                            Meu trabalho, casa da minha Tia Divina
                                                                        </p>
                                                                        <label class="block text-gray-700 text-sm font-bold mb-2" for="Produto">Tipo</label>
                                                                        <input class="mb-2 shadow text-sm appearance-none border rounded sm:w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" type="text" placeholder="Ex: casa, casa da tia Lia, trabalho" name="address_type">
                                                                    </div>

                                                                    <div class="mb-4 sachadow-black">
                                                                        <label class="block text-gray-700 text-sm font-bold mb-2" for="Produto">Cidade</label>
                                                                        <input autocomplete="off" value="" class="  shadow text-sm appearance-none border rounded sm:w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none  " id="city" type="text" placeholder="digite a cidade" name="city">
                                                                        @error('city')
                                                                        <div class=" p-2 ">
                                                                            <span class="error text-red-500">{{ $message }}</span>
                                                                        </div>
                                                                        @enderror
                                                                    </div>
                                                                    <div class="mb-4">
                                                                        <label class="block text-gray-700 text-sm font-bold mb-2" for="Produto">CEP</label>
                                                                        <input autocomplete="off" value=""  class="shadow text-sm appearance-none border rounded sm:w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" id="cep"  onblur="pesquisacep(this.value); placeholder= "digite seu cep" name="zipcode">

                                                                        @error('zipcode')
                                                                            <div class=" p-2">
                                                                                <span class="error text-red-500">{{ $message }}</span>
                                                                            </div>
                                                                        @enderror
                                                                    </div>

                                                                    <div class="mb-4">
                                                                        <label class="block text-gray-700 text-sm font-bold mb-2" for="Produto">Bairro</label>
                                                                        <input autocomplete="off" value="" id="bairro" class="shadow appearance-none border rounded  sm:w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" id="bairro" type="text" placeholder="digite o Bairro" name="district">
                                                                        @error('district')
                                                                            <div class=" p-2">
                                                                            <span class="error text-red-500">{{ $message }}</span>
                                                                            </div>
                                                                        @enderror
                                                                    </div>
                                                                    <div class="mb-4">
                                                                        <label class="block text-gray-700 text-sm font-bold mb-2" for="Produto">Rua</label>
                                                                        <input autocomplete="off" value="" id="rua" class="shadow appearance-none border rounded sm:w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" id="street" type="text" placeholder="digite sua Rua" name="street">
                                                                        @error('street')
                                                                            <div class=" p-2">
                                                                            <span class="error text-red-500">{{ $message }}</span>
                                                                            </div>
                                                                        @enderror
                                                                    </div>
                                                                    <div class="mb-4">
                                                                        <label class="block text-gray-700 text-sm font-bold mb-2" for="Produto">Número</label>
                                                                        <input autocomplete="off" value="" id="numero" class="shadow text-sm appearance-none border rounded sm:w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" id="number"  placeholder="digite seu numero" name="number">
                                                                        @error('number')
                                                                            <div class="p-2">
                                                                            <span class="error text-red-500">{{ $message }}</span>
                                                                            </div>
                                                                        @enderror
                                                                    </div>

                                                                    <div class="mb-4">
                                                                        <label class="block text-gray-700 text-sm font-bold mb-2" for="Produto">Celular</label>
                                                                        <input autocomplete="off" type="tel" value="" id="fone" class="shadow text-sm appearance-none border rounded sm:w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" id="fone"  placeholder="digite seu celular" name="fone">
                                                                        @error('fone')
                                                                            <div class="p-2">
                                                                            <span class="error text-red-500">{{ $message }}</span>
                                                                            </div>
                                                                        @enderror
                                                                    </div>

                                                                    <div class="mb-4 ">
                                                                        <label class="block text-gray-700 text-sm font-bold mb-2" for="Produto">Complemento</label>
                                                                        <input autocomplete="off" value="" id="complemento" class="shadow  appearance-none border rounded sm:w-full py-3 px-3 pb-2 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" id="complement" type="text" placeholder="digite um complemento" name="complement">
                                                                        @error('complement')
                                                                            <div class="p-2">
                                                                            <span class="error text-red-500">{{ $message }}</span>
                                                                            </div>
                                                                        @enderror
                                                                    </div>
                                                                </div>

                                                            <div class="pb-4">
                                                                <button type="submit" class="border text-sm p-2 rounded text-gray-700 bg-orange-300  font-bold hover:orange-500">CADASTRAR</button>
                                                            </div>
                                                        </form>

                                                    </div>

                                                </div>
                                            </div>
                                            </div>

                                </div>

                                @if( $address)


                                        <fieldset>
                                         <legend class="text-base text-center">Tipo de endereço</legend>
                                            <select  name="addressTypeSelect" id="addressType" class="shadow  appearance-none border rounded w-full py-2 pb-2 mb-2 mt-2 text-gray-700 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
                                                        @php
                                                        $hasAddressType = false;
                                                        @endphp
                                                    @foreach($addressUserTypes as $addressUserType)
                                                        @if ($addressUserType->addressType)

                                                            @php
                                                                $hasAddressType = true;
                                                            @endphp

                                                                <option
                                                                    class="text-center text-gray-700"
                                                                    value="{{ $addressUserType->addressType->id }}"
                                                                    data-address-user-type-id="{{ $addressUserType->id }}">
                                                                    {{ $addressUserType->addressType->name }}
                                                                </option>
                                                        @endif
                                                    @endforeach

                                                        @if (!$hasAddressType)
                                                            <option value="">Tipo de endereço não definido</option>
                                                        @endif
                                            </select>
                                        </fieldset>
                                    @foreach($addressUserTypes as $addressUserType)
                                        @if ($addressUserType->addressType)
                                               {{-- mostra endereço --}}
                                            <div id="containers_{{ $addressUserType->addressType->id ?? ''}}" class="containers" style="display: none;">
                                                <div class="mb-4">
                                                    <label class="block text-left text-gray-700 text-sm font-bold mb-2 pl-4">Cidade</label>
                                                    <p class="text-left text-sm p-2 border border-gray-300 rounded mb-2 mt-2 shadow-lg hover:shadow-xl transition-shadow duration-300" id="city_{{ $addressUserType->addressType->id ?? ''}}" type="text" placeholder="digite a cidade" name="city">{{ $addressUserType->address->city ?? '' }}</p>
                                                </div>
                                                <div class="mb-4">
                                                    <label class="block text-left text-gray-700 text-sm font-bold mb-2 pl-4" >CEP</label>
                                                    <p value=""  class="text-sm p-2 border border-gray-300 rounded mb-2 mt-2 shadow-lg hover:shadow-xl transition-shadow duration-300 text-left " id="zipcode_{{ $addressUserType->addressType->id ?? ''}}" type="text" placeholder= "digite seu cep" name="zipcode">{{ $addressUserType->address->zipcode ?? '' }}</p>
                                                </div>

                                                <div class="mb-4">
                                                    <label class="block text-left text-gray-700 text-sm font-bold mb-2 pl-4">Bairro</label>
                                                    <p value="" id="bairro" class="text-left text-sm p-2 border border-gray-300 rounded mb-2 mt-2 shadow-lg hover:shadow-xl transition-shadow duration-300" id="bairro_{{ $addressUserType->addressType->id ?? ''}}" type="text" placeholder="digite o bairro" name="district"> {{ $addressUserType->address->district ?? ''}}</p>
                                                </div>

                                                <div class="mb-4">
                                                    <label class="block text-left text-gray-700 text-sm font-bold mb-2 pl-4" >Rua</label>
                                                    <p value=" " id="rua" class=" text-left text-sm p-2 border border-gray-300 rounded mb-2 mt-2 shadow-lg hover:shadow-xl transition-shadow duration-300 " id="street_{{ $addressUserType->addressType->id ?? ''}}" type="text" placeholder="digite sua rua" name="street">{{ $addressUserType->address->street ?? ''}}</p>
                                                </div>

                                                <div class="mb-4">
                                                    <label class="block text-left text-gray-700 text-sm font-bold mb-2 pl-4" >Número</label>
                                                    <p value=" " id="numero" class=" text-left text-sm p-2 border border-gray-300 rounded mb-2 mt-2 shadow-lg hover:shadow-xl transition-shadow duration-300" id="number_{{ $addressUserType->addressType->id ?? ''}}" type="number"  placeholder="digite seu numero" name="number">{{ $addressUserType->address->number ?? ''}}</p>
                                                </div>

                                                <div class="mb-4">
                                                    <label class="block text-left text-gray-700 text-sm font-bold mb-2 pl-4" >Celular</label>
                                                    <p value=" " id="celular" class=" text-left text-sm p-2 border border-gray-300 rounded mb-2 mt-2 shadow-lg hover:shadow-xl transition-shadow duration-300" id="celular_{{ $addressUserType->addressType->id ?? ''}}" type="text"  placeholder="digite seu whatsap" name="number">{{ $addressUserType->address->fone ?? ''}}</p>
                                                </div>

                                                <div class="mb-4 ">
                                                    <label class="block text-left text-gray-700 text-sm font-bold mb-2 pl-4" >Complemento</label>
                                                    <p value=" " id="complemento" class=" text-left text-sm p-2 border border-gray-300 rounded mb-2 mt-2 shadow-lg hover:shadow-xl transition-shadow duration-300" id="complement_{{ $addressUserType->addressType->id ?? ''}}" type="text" placeholder="digite um complemento" name="complement">{{ $addressUserType->address->complement ?? ''}}</p>
                                                </div>

                                                <!-- Outros campos do endereço aqui -->
                                            </div>
                                        @endif
                                    @endforeach


                                    @else
                                        <div class="bg-slate-400 ml-8 mr-8 rounded mb-4 font-bold text-xl text-yellow-300 text-center p-2 ">
                                            <p class="bg mb-4">
                                                Você ainda não tem um endereço cadastrado click no botão acima para fazer o cadastro!
                                            </p>
                                        </div>
                                    @endif
                            </div>
                        </div>

                        {{-- modal para avaliação --}}

                     <!-- Button trigger modal -->
                     <button type="button" class="border-b-2 border-l-2 border-r-2
                        bg-gradient-to-r from-cyan-100 to-emerald-500
                        rounded mb-2 mt-2 shadow-lg
                        hover:shadow-xl
                        transition-all duration-300 ease-in-out
                        transform hover:scale-105
                        p-2 hover:bg-none hover:bg-emerald-600 hover:text-white"
                            data-bs-toggle="modal" data-bs-target="#firstModal1">
                        Avaliar o estabelecimento
                    </button>
                    <!-- Modal para avaliação -->
            <div class="modal fade bg-yellow-100" id="firstModal1" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">

                            <h6 class="text-sm">Avalie como foi sua experiencia na plataforma bem como o produto que esta consumindo</h6>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <!-- Seu formulário aqui -->
                            <form action="/reviews" method="POST" class="space-y-4">
                                @csrf
                                <input type="hidden" name="order_id" value="{{ $orderId }}">

                                <!-- Avaliação -->
                                <div class="flex flex-col">
                                    <label for="rating" class="mb-2 font-semibold text-gray-700">Avaliação:</label>
                                    <select name="rating" id="rating" required class="p-2 border rounded-lg bg-gray-100 focus:ring focus:ring-yellow-400">
                                        <option value="5">5 - Excelente</option>
                                        <option value="4">4 - Muito bom</option>
                                        <option value="3">3 - Bom</option>
                                        <option value="2">2 - Regular</option>
                                        <option value="1">1 - Ruim</option>
                                    </select>
                                </div>

                                <!-- Comentário -->
                                <div class="flex flex-col">
                                    <label for="comment" class="mb-2 font-semibold text-gray-700">Comentário (opcional):</label>
                                    <textarea name="comment" id="comment" rows="4" class="p-2 border rounded-lg bg-gray-100 focus:ring focus:ring-yellow-400" placeholder="Escreva seu comentário..."></textarea>
                                </div>

                                <!-- Botão de envio -->
                                <div class="text-right">
                                    <button type="submit" class="border-b-2 border-l-2 border-r-2
                                    bg-gradient-to-r from-cyan-100 to-emerald-500
                                    rounded mb-2 mt-2 shadow-lg
                                    hover:shadow-xl
                                    transition-all duration-300 ease-in-out
                                    transform hover:scale-105
                                    p-2 hover:bg-none hover:bg-emerald-600 hover:text-white">
                                        Enviar Avaliação
                                    </button>
                                </div>
                            </form>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="bg-gradient-to-r from-yellow-300
                             to-red-500 border-r-2
                               hover:bg-none hover:bg-red-400
                               transition-all duration-400 ease-in-out
                               hover:text-white
                               p-2 rounded"
                               data-bs-dismiss="modal">Fechar</button>
                        </div>
                    </div>
                </div>
            </div>
              @php
                 $ratingsDescripitions = array(
                    5 => "Execlente",
                    4 =>  "Muito bom",
                    3 =>  "Bom",
                    2 =>   "Regular",
                    1 =>  "Ruim"
                );
              @endphp

              <div class="text-start container max-auto pt-2">

                 <div class="bg-white rounded-lg shadow-lg p-2 mb-2">
                    <h2 class="text-center font-bold text-bluee">Avaliações</h2>

                    @foreach ($reviews as $review)
                        <div class="bg-blue-50 border-l-4 border-blue-500 text-bluee p-4 mt-4 rounded-lg shadow-md">
                            <strong>Avaliação: </strong>{{ $ratingsDescripitions[$review->rating] }} {{$review->rating}} /5<br>
                            <strong>Comentário: </strong>{{ $review->comment }}<br>
                            <em>Enviado por: {{ $review->user->name }} em {{ $review->created_at->format('d/m/Y') }}</em>
                        </div>
                        <hr>
                    @endforeach
                    <a href="{{ route('reviews.index') }}" class="text-bluee  hover:underline">Ver mais</a>
                 </div>
              </div>
        </div>
      {{-- <script>
        function playAlertSound()
        {
        var audio = document.getElementById('alert-audio');
        audio.play();
        }
      </script> --}}


   <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.min.js" integrity="sha384-cuYeSxntonz0PPNlHhBs68uyIAVpIIOZZ5JqeqvYYIcEL727kskC66kF92t6Xl2V" crossorigin="anonymous"></script>
    <script>

$(document).ready(function() {
    // Esconder todos os contêineres de detalhes de endereço
    $('.containers').hide();

    // Função para atualizar o valor do input hidden
    function updateHiddenInput() {
        var selectedAddressType = $('#addressType').val();
        var addressUserTypesId = $('#addressType').find('option:selected').data('address-user-type-id');
        $('#address_user_types_id').val(addressUserTypesId);

        // Mostrar o contêiner correspondente ao tipo de endereço selecionado
        $('#containers_' + selectedAddressType).show();
    }

    // Quando o valor do menu suspenso for alterado
    $('#addressType').change(function() {
        // Esconder todos os contêineres de detalhes de endereço
        $('.containers').hide();

        // Atualizar o valor do input hidden
        updateHiddenInput();
    });

    // Configurar o valor inicial do input hidden e mostrar o contêiner correspondente
    updateHiddenInput();
});



function atualizarValor() {
    const opcoes = document.getElementsByName('delivery');
    var entregaInput = document.getElementById('entrega');
    var toremove = document.getElementById('toremove');
    var delivery = document.getElementById('delivery');
    let total = "<?php echo $total; ?>";
    const taxa = 6.00;
    let totalAmount = 0;



for (let i = 0; i <opcoes.length; i++) {
    if (opcoes[i].checked) {

        if (opcoes[i].value === '0') {

            delivery.style.display = 'none';
            toremove.style.display = 'block';

        } else if (opcoes[i].value === '1') {

          toremove.style.display = 'none';
          delivery.style.display = 'block';
          totalAmount = parseFloat(total) + parseFloat(taxa);

        }
    }
          totalAmount = totalAmount.toFixed(2);
          totalAmount = totalAmount.replace(".",",");
          delivery.innerHTML = 'R$' + "_" + totalAmount;
}
}



   // Selecionando os elementos relevantes

    const paymentRadioButtons = document.querySelectorAll('input[name="payment"]');
    const observationInput = document.getElementById('observation');

    // Função para verificar e atualizar o estado do campo de observação

    function updateObservationField() {
        // Verificando qual opção de pagamento está selecionada

        const selectedPayment = document.querySelector('input[name="payment"]:checked').value;

        // Se a opção selecionada for "Cartão", desabilita o campo de observação

        if (selectedPayment === '0') {
            observationInput.disabled = true;
            observationInput.classList.add('disabled');
        } else {
            observationInput.disabled = false;
            observationInput.classList.remove('disabled');
        }
    }

    // Adicionando um event listener para cada botão de rádio de pagamento

    paymentRadioButtons.forEach(function(radioButton) {
        radioButton.addEventListener('change', updateObservationField);
    });

    // Chamando a função para atualizar o estado do campo de observação quando a página carregar

    updateObservationField();


    document.getElementById('addressType').addEventListener('change', function() {
    var selectedValue = this.value;
    document.getElementById('address_user_types_id').value = selectedValue; // ou outra lógica se necessário
    document.getElementById('address_id').value = this.options[this.selectedIndex].dataset.addressId; // ou outra lógica se necessário
});

    $(document).ready(function() {
    $('#mainForm').on('submit', function(event) {

        // Desabilitar o botão para evitar cliques duplos
        $('#submitButton').prop('disabled', true);

        // Mostrar o spinner e ocultar o texto do botão
        $('#buttonText').hide();
        $('#buttonSpinner').show();


    });
});




    </script>


@vite('resources/js/app.js')
</body>
</html>
