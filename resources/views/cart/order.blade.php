<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <script src="https://kit.fontawesome.com/03e947ed86.js" crossorigin="anonymous"></script>
    <script src="{{ asset('js/index-cart.js') }}"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
    <title>OrderCart</title>

    <style>
        .card-body .delivery {
            background-color: rgb(209, 216, 223);
            color: green;
            transition: 05ms ease-in-out;
        }
        .card-body .delivery:hover {
            background-color: blue;
            color: white;
        }
        .card-body .deliveryd {
            background-color: rgb(209, 216, 223);
            color: red;
        }
        .card-body .deliveryd:hover {
            background-color: blue;
            color: white;
        }
    </style>

</head>
<body class="bg-yellow-100">

<div class="container mx-auto pt-2">


        @if (session('acept'))
            <div class="bg-slate-400 border-spacing-2 text-green p-2 ml-12 mr-12 mb-4">
                <p>{{ session('acept') }}</p>
            </div>
        @endif

        @if (session('refused'))
            <div class="bg-yellow-300 border p-2 ml-12 mr-12 mb-4" style="background-color: rgb(243, 217, 66);">
                <p>{{ session('refused') }}</p>
            </div>
        @endif
        <div class="text-center mb-2 mt-4 ">
            <div class="bg-white rounded-lg shadow-lg p-2">
              <h1 class="p-2 pt-2 font-bold">LISTAGEM DE PEDIDOS</h1>

              <div class="overflow-auto">
                 @include('layouts.statusNavegation')
              </div>
            </div>

          @forelse ($orders as $item)


            <div class=" p-2 pt-2">


                @php
                    $userCount = $orders->where('user_id', $item->user_id)->count();
                @endphp

                <div class="card-body ">
                    <div class=" text-start bg-white rounded-lg shadow-lg p-2">
                        <div class="text-center mb-2">
                            Pedido N- {{ $item->id }}
                        </div>
                        <p class="text-card">Nome do Cliente: {{ $item->orderUser->name }}</p>
                        <p class="text-card">Quantidade de Pedidos na Plataforma: {{ $userCount }}</p>
                        <p class="text-card">Data: {{ $item->created_at->format('d/m/Y H:i') }}</p>
                        <p class="font-bold">Total: @money($item->total)</p>
                        <p class="text-card">Entrega: {{ $item->delivery ? 'Sim' : 'Não' }}</p>
                        <p class="text-card">Forma de pagamento: {{ $item->payment ? 'Dinheiro' : 'Cartão' }}</p>
                        <p class="text-card">Observação: {{ $item->observation ?? '//' }}</p>
                    </div>

                    <div class="overflow-auto">
                        <div class="bg-white rounded-lg shadow-lg p-2 mt-2">

                                    @foreach ( $item->orderList as $list )
                                     @if ( $list && !$list->blindCart )
                                        <div class="mb-4  pb-2 pr-4">
                                            <div class="flex justify-between items-center mb-2">
                                                <div class="font-bold text-gray-700">
                                                    <span>produto</span>
                                                </div>
                                                <div class="text-gray-700">
                                                    {{ $list->product->name ?? ''}}
                                                </div>
                                            </div>
                                        </div>

                                        <div class="mb-4 border-b pb-2 pr-4">
                                            <div class="flex justify-between items-center mb-2">
                                                <div class="font-bold text-gray-700">
                                                    <span>Quantidade</span>
                                                </div>
                                                <div class="text-gray-700">
                                                    {{ $list->quamtity}}
                                                </div>
                                            </div>
                                        </div>
                                        <div class="mb-4 border-b pb-2 pr-4">
                                            <div class="flex justify-between items-center mb-2">
                                                <div class="font-bold text-gray-700">
                                                    <span>Preço</span>
                                                </div>
                                                <div class="text-gray-700">
                                                    @money( $list->value )
                                                </div>
                                            </div>
                                        </div>
                                        @else
                                        @if( !empty( $list->blindCart ))
                                           <div class="mb-4 border-b pb-2 pr-4">
                                                <div class="flex justify-between items-center mb-2">
                                                    <div class="font-bold text-gray-700">
                                                        <span>Brindes</span>
                                                    </div>
                                                    <div class="text-gray-700">
                                                        {{ $list->blindCart->name ?? 'sem nome' }}
                                                    </div>
                                                </div>
                                            </div>
                                        @endif

                                        @endif


                                    @if( $list->product && $list->product->category_id !=2 && $list->product->category_id != 4)
                                        <div class="mb-4 border-b pb-2 pr-4">
                                            <div class="flex justify-between items-center mb-2">
                                                <div class="font-bold text-gray-700">
                                                    <span>Observação</span>
                                                </div>
                                                <div class="text-gray-700">
                                                    {{$list->observation ?? '//' }}
                                                </div>
                                            </div>
                                        </div>

                                        <div class="mb-4 border-b pb-2 pr-4">
                                            <div class="flex justify-between items-center mb-2">
                                                <div class="font-bold text-gray-700">
                                                    <span>Adicionais</span>
                                                </div>
                                                <div class="text-gray-700">
                                                    @forelse ($list->orderAdditional as $additional)
                                                        {{ $additional->name }} ( {{$additional->pivot->quantity}} )
                                                    @empty
                                                        //
                                                    @endforelse
                                                </div>
                                            </div>
                                        </div>
                                    @else
                                    @if( !$list->blindCart)
                                    <div class="mb-4 border-b pb-2">
                                        <div class="flex justify-between items-center mb-2">
                                            <div class="font-bold text-gray-700">
                                                <span>Descrição</span>
                                            </div>
                                            <div class="text-gray-700">

                                                <span>{{ $list->product->description ?? ''}}</span>

                                            </div>
                                        </div>
                                    </div>
                                @endif

                                    @endif
                                    <div class=" bg-yellow-200 pb-2">
                                        <div class="flex justify-between items-center mb-2">

                                        <div class="text-gray-700 text-center">

                                        </div>
                                        </div>
                                    </div>



                                    @endforeach
                        </div>

                    </div>
                       {{-- container que mostra endereço --}}
                    <div class="container pb-4">
                        <div class="bg-white rounded shadow-lg p-4 mt-4">
                            <h1 class="font-bold text-lg mb-4">ENDEREÇO PARA ENTREGA</h1>
                            @foreach ($item->orderList as $list)
                                @if ($list->addressUserType && $list->addressUserType->address)
                                    <div class="mb-4 text-start">
                                        <div class="mb-2">
                                            <label class="font-semibold">Tipo de Endereço:</label>
                                            <span class="ml-2">{{ $list->addressUserType->addressType->name ?? 'N/A' }}</span>
                                        </div>
                                        {{-- Dados do endereço --}}
                                        <div class="grid grid-cols-1 gap-4">
                                            <div>
                                                <label class="font-semibold">Cidade:</label>
                                                <span class="ml-2">{{ $list->addressUserType->address->city }}</span>
                                            </div>
                                            <div>
                                                <label class="font-semibold">Rua:</label>
                                                <span class="ml-2">{{ $list->addressUserType->address->street }}</span>
                                            </div>
                                            <div>
                                                <label class="font-semibold">Bairro:</label>
                                                <span class="ml-2">{{ $list->addressUserType->address->district }}</span>
                                            </div>
                                            <div>
                                                <label class="font-semibold">Número:</label>
                                                <span class="ml-2">{{ $list->addressUserType->address->number }}</span>
                                            </div>
                                            <div>
                                                <label class="font-semibold">Fone:</label>
                                                <span class="ml-2">{{ $list->addressUserType->address->fone }}</span>
                                            </div>
                                            <div>
                                                <label class="font-semibold">Complemento:</label>
                                                <span class="ml-2">{{ $list->addressUserType->address->complement }}</span>
                                            </div>
                                        </div>
                                    </div>
                                    @break
                                @endif
                            @endforeach
                        </div>
                    </div>


                    <div class="flex space-x-4 p-2">
                        <form action="{{ route('update.status', ['id' => $item->id]) }}" method="POST">
                            @csrf
                            <button class="
                                bg-gradient-to-r from-yellow-300 to-greend
                                border-l-4 border-r border-t
                                transition-all duration-300 ease-in-out
                                transform hover:scale-105
                                hover:bg-green
                                border-green border-b-2 rounded p-2
                                button text-sm  hover:text-white
                                ">
                                ACEITAR PEDIDO
                            </button>
                        </form>
                        <form action="{{ route('refused.status', $item->id) }}" method="post">
                            @csrf
                            <button class="
                                bg-gradient-to-r from-yellow-300 to-red-300
                                rounded p-2 text-sm
                                hover:text-white
                                transition-all duration-300 ease-in-out
                                transform hover:scale-105
                                border-r-4 border-l border-t border-red-500
                                border-b-2 hover:bg-red-500 ">
                                RECUSAR PEDIDO
                            </button>
                        </form>
                    </div>

                </div>
                <a href="{{ route('panel.admin')}}">
                    <button class="bg-gradient-to-r from-yellow-400 to-bluee border-l-4 border-blue hover:bg-gradient-to-l hover:from-blue-600 hover:to-yellow-400  font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline" type="submit">
                        Voltar
                    </button>
                </a>
            </div>
        @empty
            <p class="pt-4 font-bold text-lg">Sem Pedidos com status processando no momento!</p>
            <p>Para o dia: {{ $date }}</p>
        @endforelse
    </div>
</div>

@vite('resources/js/app.js')

</body>
</html>
