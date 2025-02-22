<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <script src="https://kit.fontawesome.com/03e947ed86.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
    <title>View-impress</title>
</head>

<body>
    @vite('resources/css/app.css')
    <div class="container mx-auto">
        <div class="text-start">


                <div class="text-center mb-2" style="font-size:24px;">
                    <h2 class="">Pedido N- {{ $order->id ?? ''}}</h2>
                </div>

                <div class="card p-2" style="font-size:28px;">
                    <div class="text-star">
                        <p>Cliente: {{ $order->orderUser->name ?? ''}}</p>
                        <p>É para entregar: {{ $order->delivery ? 'Sim' : 'Não' }}</p>
                        <p>Data: {{ $order->created_at->format('d/m/Y H:i') }}</p>
                        <p>Forma de pagamento: {{ $order->payment ? 'Dinheiro' : 'Cartão' }}</p>
                        <p>{{ $order->observation }}</p>
                        <h2 class="font-bold pt-2 pb-2">Total: @money($order->total)</h2>

                        <h4 class="pb-2">PRODUTO</h4>
                        @foreach ($order->orderList as $list)
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


                        {{-- Exibe o brinde, se houver --}}
                        @foreach ($order->orderList as $list)
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
                        @if( $order->delivery == 1)
                            <h3 class="font-bold text-lg mb-4" style="font-size: x-large">ENDEREÇO PARA ENTREGA</h3>
                            @foreach ($order->orderList as $list)
                                @if ($list->addressUserType && $list->addressUserType->address)
                                    <div class="mb-4 text-start text-3xl">

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
