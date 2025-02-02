<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <script src="https://kit.fontawesome.com/03e947ed86.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
    <title>centerCart</title>
</head>

<body>
    @vite('resources/css/app.css')
    <div class="container mx-auto">
        <div class="text-start">
            @foreach ($order as $item)
                <div class="text-center mb-2" style="font-size:24px;">
                    <h2 class="text-lg">Pedido N- {{ $item->id }}</h2>
                </div>

                <div class="card p-2" style="font-size:24px;">
                    <div class="text-star">
                        <p>Cliente: {{ $item->orderUser->name }}</p>
                        <p>É para entregar: {{ $item->delivery ? 'Sim' : 'Não' }}</p>
                        <p>Data: {{ $item->created_at->format('d/m/Y H:i') }}</p>
                        <p>Forma de pagamento: {{ $item->payment ? 'Dinheiro' : 'Cartão' }}</p>
                        <p>{{ $item->observation }}</p>
                        <h2 class="font-bold">Total: @money($item->total)</h2>

                        <h4 class="pb-2">PRODUTO</h4>
                        @foreach ($item->orderList as $list)
                            <p>{{ $list->product->name ?? '' }} ({{ $list->quamtity }})</p>

                            @if ($list->product && ($list->product->category_id != 2 && $list->product->category_id != 4))
                                <p>Observação: {{ $list->observation ?? '//' }}</p>

                                @if ($list->orderAdditional->isNotEmpty())
                                    <p>Adicionais:
                                        {{ $list->orderAdditional->map(fn($additional) => $additional->name . ' (' . $additional->pivot->quantity . ')')->join(', ') }}
                                    </p>
                                @else
                                    <p>Adicionais: //</p>
                                @endif
                            @endif
                            @if($list->product && ($list->product->category_id == 2 || $list->product->category_id == 4 ) )
                                     <p>{{ $list->product->description }}</p>
                            @endif
                        @endforeach

                        {{-- Exibe o brinde, se houver --}}
                        @foreach ($item->orderList as $list)
                            @if ($list->blindCart)
                                <p>Brinde: {{ $list->blindCart->name ?? '' }}</p>
                                @break
                            @endif
                        @endforeach
                    </div>
                </div>

                {{-- container que mostra endereço --}}
                <div class="container pb-4">
                    <div class="" style="font-size: 24px;">
                        @if( $item->delivery == 1)
                            <h3 class="font-bold text-lg mb-4">ENDEREÇO PARA ENTREGA</h3>
                            @foreach ($item->orderList as $list)
                                @if ($list->addressUserType && $list->addressUserType->address)
                                    <div class="mb-4 text-start">

                                            <p class="ml-2">Tipo de Endereço: {{ $list->addressUserType->addressType->name ?? 'N/A' }}</p>

                                        {{-- Dados do endereço --}}

                                            <p class="ml-2">Cidade:{{ $list->addressUserType->address->city }}</p>
                                            <p class="ml-2">Rua:{{ $list->addressUserType->address->street }} N° {{ $list->addressUserType->address->number }} </p>
                                            <p class="ml-2">Bairro:{{ $list->addressUserType->address->district }}</p>
                                            <p class="ml-2">Fone:{{ $list->addressUserType->address->fhone }}</p>
                                            <p class="ml-2">Complemento:{{ $list->addressUserType->address->complement }}</p>
                                        </div>
                                    </div>
                                    @break
                                @endif
                            @endforeach
                        @else

                        @endif
                    </div>
                </div>
            @endforeach
        </div>

    @vite('resources/js/app.js')
</body>
</html>
