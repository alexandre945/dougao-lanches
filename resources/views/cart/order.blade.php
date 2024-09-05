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
<body>

<div class="container mx-auto pt-2">
    <div class="text-center mb-2">
        <h1 class="p-2 pt-2 font-bold">LISTAGEM DE PEDIDOS</h1>

        <div class="overflow-auto">
            @include('layouts.statusNavegation')
        </div>

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

        @forelse ($orders as $item)
            <div class="card p-2 pt-2">
                <div class="card-header">
                    Pedido N- {{ $item->id }}
                </div>

                @php
                    $userCount = $orders->where('user_id', $item->user_id)->count();
                @endphp

                <div class="card-body">
                    <div class=" text-start">
                        <p class="text-card">Nome do Cliente: {{ $item->orderUser->name }}</p>
                        <p class="text-card">Quantidade de Pedidos na Plataforma: {{ $userCount }}</p>
                        <p class="text-card">Data: {{ $item->created_at->format('d/m/Y H:i') }}</p>
                        <p class="font-bold">Total: @money($item->total)</p>
                        <p class="text-card">Entrega: {{ $item->delivery ? 'Sim' : 'Não' }}</p>
                        <p class="text-card">Forma de pagamento: {{ $item->payment ? 'Dinheiro' : 'Cartão' }}</p>
                        <p class="text-card">Observação: {{ $item->observation ?? '//' }}</p>
                    </div>

                    <div class="overflow-auto">
                        <table class="table table-hover mt-3" style="max-height: 300px; overflow-y: auto;">
                            <thead>
                                <tr>
                                    <th>Produto</th>
                                    <th>Quantidade</th>
                                    <th>Preço</th>
                                    <th>Observação</th>
                                    <th>Adicionais</th>
                                    <th>Brindes</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($item->orderList as $list)
                                    <tr class="overflow-auto">
                                        <td>{{ $list->product->name ?? '' }}</td>
                                        <td>{{ $list->quamtity }}</td>
                                        <td>@money($list->value)</td>
                                        <td>{{ $list->observation ?? '//' }}</td>
                                        <td>
                                            @forelse ($list->orderAdditional as $additional)
                                                {{ $additional->name }} ( {{$additional->pivot->quantity}} )
                                            @empty
                                                //
                                            @endforelse
                                        </td>
                                        <td>
                                            @if ($list->blindCart)
                                                {{ $list->blindCart->name }}
                                                @break
                                            @else
                                                //
                                            @endif
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>

                    <div class="container pt-4 pb-4">
                        <h1 class="font-bold">ENDEREÇO PARA ENTREGA</h1>
                             {{-- @dd($item->orderlist) --}}
                        @foreach ($item->orderList as $list)
                            @if ($list->addressUserType && $list->addressUserType->address)
                                    <div class="p-2 text-start">
                                        <label for="">Tipo de Endereço:</label>
                                        <span class="p-2 mr-2 font-bold">{{ $list->addressUserType->addressType->name ?? 'N/A' }}</span>
                                    </div>
                                <div class="flex flex-wrap content-start pb-4">
                                    <div class="p-2 text-start">
                                        <label for="">Cidade:</label>
                                        <span class="p-2 mr-2 font-bold">{{ $list->addressUserType->address->city }}</span>
                                    </div>
                                    <div class="p-2 text-start">
                                        <label for="">Rua:</label>
                                        <span class="p-2 mr-2 font-bold">{{ $list->addressUserType->address->street }}</span>
                                    </div>
                                    <div class="p-2 text-start">
                                        <label for="">Bairro:</label>
                                        <span class="p-2 mr-2 font-bold">{{ $list->addressUserType->address->district }}</span>
                                    </div>
                                    <div class="p-2 text-start">
                                        <label for="">Número:</label>
                                        <span class="p-2 mr-2 font-bold">{{ $list->addressUserType->address->number }}</span>
                                    </div>
                                    <div class="p-2 text-start">
                                        <label for="">Fone:</label>
                                        <span class="p-2 mr-2 font-bold">{{ $list->addressUserType->address->fone }}</span>
                                    </div>
                                    <div class="p-2 text-start">
                                        <label for="">Complemento:</label>
                                        <span class="p-2 mr-2 font-bold">{{ $list->addressUserType->address->complement }}</span>
                                    </div>
                                    @break
                                </div>
                            @endif
                        @endforeach
                    </div>

                    <div class="flex p-2">
                        <form action="{{ route('update.status', ['id' => $item->id]) }}" method="POST">
                            @csrf
                            <button class="delivery border rounded p-2 button">ACEITAR PEDIDO</button>
                        </form>
                        <form action="{{ route('refused.status', $item->id) }}" method="post">
                            @csrf
                            <button class="deliveryd border rounded p-2 button hover:text-blue-800">RECUSAR PEDIDO</button>
                        </form>
                    </div>

                </div>
                <a href="{{ route('panel.admin')}}">
                    <button class="bg-blue-500 hover:bg-blue-700 border font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline" type="submit">
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
