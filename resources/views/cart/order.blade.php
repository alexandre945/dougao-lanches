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
            <div class="bg-yellow-300 border p-2 ml-12 mr-12 mb-4 text-center" style="background-color: rgb(243, 217, 66);">
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
                {{-- @php

                  $user = $item->user_id

                @endphp

                @php
                    $userCount = $orders->whe(vifre('user_id', $user )->count();
                @endphp --}}

                <div class="card-body ">
                    <div class=" text-start bg-white rounded-lg shadow-lg p-2">
                        <div class="text-center mb-2">
                            Pedido N- {{ $item->id }}
                        </div>
                        <p class="text-card">Nome do Cliente: {{ $item->orderUser->name }}</p>
                        <p class="text-card">Quantidade de Pedidos na Plataforma: {{ $userOrderCount[$item->user_id] ?? 0 }}</p>
                        <p class="text-card">Data: {{ $item->created_at->format('d/m/Y H:i') }}</p>
                        <p class="font-bold">Total: @money($item->total)</p>
                        <p class="text-card">Entrega: {{ $item->delivery == 1 ? 'Sim' : 'Não' }}</p>
                        <p class="text-card">Forma de pagamento: {{ $item->payment ? 'Dinheiro' : 'Cartão' }}</p>

                        @if($item->payment)
                        <!-- Se for dinheiro -->
                        <p class="text-card">Troco: {{ $item->observation ?? 'Sem troco informado' }}</p>

                        @else
                        <!-- Se for cartão -->
                            <p class="text-card">Tipo de cartão: {{ $item->observation ?? 'Sem informações do cartão' }}</p>
                        @endif

                    </div>

                    <div class="overflow-auto">
                        <div class="bg-white rounded-lg shadow-lg p-2 mt-2">

                                    @foreach ( $item->orderList as $list )
                                    {{-- <pre>{{ dd($list->blindCart) }}</pre> --}}
                                    @if ( $list->product && !$list->product->blindCart )
                                        <div class="mb-4  pb-2 pr-4">
                                            <div class="flex justify-between items-center mb-2">
                                                <div class="font-bold text-gray-700">
                                                    <span>produto</span>
                                                </div>
                                                <div class="text-gray-700 flex flex-row gap-2">
                                                   <p class="pt-2">{{ $list->product->name ?? ''}}</p>  <p class="text-red-400 text-3xl">({{ $list->quamtity}})</p>
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

                          @if( $list->blindCart ?? '')
                                         <div class="mb-4 border-b pb-2 pr-4">
                                             <div class="flex justify-between items-center mb-2">
                                                 <div class="font-bold text-gray-700">
                                                     <span>Brinde</span>
                                                 </div>

                                                 <div class="text-gray-700">
                                                     {{ $list->blindCart->name ?? 'sem nome' }}

                                                 </div>

                                             </div>
                                         </div>
                                     @endif


                                    @endif

                                    @if( $list->product && $list->product->category_id !=2 && $list->product->category_id != 4 )
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

                                       @if( $list->product && ($list->product->category_id == 2 || $list->product->category_id == 4))
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

                                          <!-- Exibir o separador somente entre os produtos -->
                                        @if (!$loop->last)  <!-- Condição: mostrar apenas se não for o último produto -->
                                            <div class="flex justify-center items-center my-4">
                                                <div class="border-t border-gray-300 flex-grow"></div>
                                                 <span class="mx-2 text-blue">✦</span>
                                                <div class="border-t border-gray-300 flex-grow"></div>
                                            </div>
                                        @endif

                                    @endforeach


                        </div>
                    </div>

                       {{-- container que mostra endereço --}}
                    <div class="container pb-4">
                        @if($item->delivery == 1)
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
                                                    <span class="ml-2">{{ $list->addressUserType->address->fhone }}</span>
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
                         @endif
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
                        {{-- <form action="{{ route('refused.status', $item->id) }}" method="post">
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
                        </form> --}}
                        <!-- Botão para abrir o modal -->
                        <button type="button" onclick="openModal()"
                        class="bg-gradient-to-r from-yellow-300 to-red-300 rounded p-2 text-sm hover:text-white transition-all duration-300 ease-in-out transform hover:scale-105 border-r-4 border-l border-t border-red-500 border-b-2 hover:bg-red-500">
                        RECUSAR PEDIDO
                        </button>
                    </div>

                    <!-- Modal -->
                    <div id="refuseModal" style="display: none;" class="fixed inset-0 flex items-center justify-center bg-black bg-opacity-50">
                        <div class="bg-white rounded-lg p-6 w-96">
                            <h2 class="text-xl font-bold mb-4">Motivo da Recusa</h2>

                            <form action="{{ route('refused.status', $item->id) }}" method="post">
                                @csrf
                                <label for="rejection_reason">Escolha o motivo:</label>

                                    <select name="rejection_reason" id="rejection_reason" class="w-full border border-gray-300 rounded p-2 mt-2 mb-4">
                                        <option value="já fechamos">Já fechamos</option>
                                        <option value="ingredientes indisponíveis">Ingredientes indisponíveis</option>
                                        <option value="não atendemos nesta localidade">Não atendemos nesta localidade</option>
                                    </select>
                                      {{-- campo para usuario escrever o motivo da rejeiçaõ --}}

                                      <label for="custom_rejection_reason">OU escreva o motivo:</label>
                                      <textarea name="custom_rejection_reason" id="custom_rejction_reason" cols="30" rows="5"></textarea>

                                <button type="submit" class="bg-green text-white rounded p-2 w-full hover:bg-red-700 transition-all duration-300 ease-in-out">
                                    Confirmar Recusa
                                </button>
                            </form>

                            <button onclick="closeModal()" class="text-red-500 mt-4">Cancelar</button>
                        </div>
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
       <!-- Voltar Button -->
       <a href="{{ route('panel.admin') }}" class="flex-1">
            <button class="bg-gradient-to-r from-purple-400 to-purple-600 text-white font-bold py-2 px-4 rounded-lg hover:from-purple-500 hover:to-purple-700 focus:outline-none focus:ring-2 focus:ring-purple-600 focus:ring-opacity-50">
                Voltar
            </button>
       </a>
</div>

@vite('resources/js/app.js')

    <script>

           //função para abrir modal
        function openModal() {
                document.getElementById('refuseModal').style.display = 'flex';
            }

            function closeModal() {
                document.getElementById('refuseModal').style.display = 'none';
            }

                // Função para verificar o status da lanchonete
        function verificarStatusLanchonete() {
            return fetch('/statusLanchonete')
                .then(response => response.json())
                .then(data => data.isOpen) // Retorna true se a lanchonete estiver aberta
                .catch(error => {
                    console.error('Erro ao verificar o status da lanchonete:', error);
                    return false; // Em caso de erro, considerar fechado para evitar requisições
                });
        }

        // Recuperar o timestamp do último pedido verificado do localStorage (se existir)
        let ultimoPedidoVerificado = localStorage.getItem('ultimoPedidoVerificado') ? new Date(localStorage.getItem('ultimoPedidoVerificado')) : null;
        let audioHabilitado = false;

        // Tocar som "silencioso" para habilitar o áudio
        const audioSilencioso = new Audio('/sounds/new_order.mp3');
        audioSilencioso.volume = 0; // Definir volume zero para ser inaudível
        audioSilencioso.play()
            .then(() => {
                audioHabilitado = true; // Agora o áudio está habilitado
            })
            .catch(error => console.error('Erro ao ativar áudio:', error));

        // Função para verificar se há um novo pedido
        function verificarNovoPedido() {
            fetch('/checkNewOrder')
                .then(response => response.json())
                .then(data => {
                    if (data.ultimo_pedido) {
                        const ultimoPedidoAtual = new Date(data.ultimo_pedido);

                        // Verificar se é um pedido novo em relação ao último verificado
                        if (!ultimoPedidoVerificado || ultimoPedidoAtual > ultimoPedidoVerificado) {
                            // Atualizar o timestamp do último pedido verificado
                            ultimoPedidoVerificado = ultimoPedidoAtual;
                            localStorage.setItem('ultimoPedidoVerificado', ultimoPedidoAtual); // Salvar no localStorage

                            // Reproduzir som ao detectar novo pedido, se permitido
                            if (audioHabilitado) {
                                const audio = new Audio('/sounds/canpainhaSounds.mp3');
                                audio.play()

                                .then(() => {
                                    // Espera um pequeno tempo para recarregar após tocar o som
                                    setTimeout(() => location.reload(), 1000); // 1000 ms (1 segundo)
                                })
                                .catch(error => console.error('Erro ao reproduzir o áudio:', error));

                            }


                        }
                    }
                })
                .catch(error => console.error('Erro ao verificar novos pedidos:', error));
        }
          // Iniciar a verificação de pedidos apenas se a lanchonete estiver aberta
            verificarStatusLanchonete().then(isOpen => {
                if (isOpen) {
                    // Se a lanchonete estiver aberta, iniciar o intervalo de verificação
                    setInterval(verificarNovoPedido, 10000);
                    verificarNovoPedido(); // Primeira chamada imediata
                } else {
                    console.log("Lanchonete fechada - verificação de novos pedidos pausada.");
                }
            });


    </script>


</body>
</html>
