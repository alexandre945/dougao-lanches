<!DOCTYPE html>
<html lang="pt-br">
<head>
    <!-- ... (códigos anteriores) -->
</head>
<body class="bg-yellow-100">
  <div class="container mx-auto pt-2">
    <div class="text-center mb-2">
        <h1 class="p-2 pt-2 font-bold">LISTAGEM DE PEDIDOS SAIRAM PARA ENTREGA</h1>

        <div class="overflow-auto">
            @include('layouts.statusNavegation')
        </div>


            <div class="card p-2 pt-2 ">
            @forelse ($orders as $item)
    <form action="{{ route('pdf.imprimird',$item->id)}}" method="POST">

                        @php

                            $user = $item->user_id

                        @endphp

                        @php
                            // $userOrderCount = $userCount->firstWhere('id', $users)->UserOrder_count;
                            $userCount = $item->where('user_id', $user)->count();
                        @endphp
                <div class="">
                    <div class=" text-start bg-white rounded-lg shadow-lg p-2">
                        <div class="text-center mb-2">
                            Pedido N- {{ $item->id }}
                        </div>
                        {{-- Seu conteúdo do pedido aqui --}}
                        <p>Nome do Cliente: {{ $item->orderUser->name }}</p>
                        <p>Quantidade de Pedidos na Plataforma: {{ $userCount }}</p>
                        <p>Data: {{ $item->created_at->format('d/m/Y H:i') }}</p>
                        <p>Total: @money($item->total)</p>
                        <p>Entrega: {{ $item->delivery ? 'Sim' : 'Não' }}</p>
                        <p>Forma de pagamento: {{ $item->payment ? 'Dinheiro' : 'Cartão' }}</p>
                        <p>Observação: {{ $item->observation ?? 'Nenhuma observação' }}</p>
                        {{-- Adicione outras informações conforme necessário --}}
                    </div>
                    <div class="overflow-auto">
                      <div class="bg-white rounded-lg shadow-lg p-2 mt-2">
                            @foreach ($item->orderList as $list)
                              @if($list->product && !$list->product->blindCart)
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

                            @foreach( $item->orderList as $list)
                            @if( $list->blindCart )
                                <div class="mb-4 border-b pb-2 pr-4">
                                    <div class="flex justify-between items-center mb-2">
                                        <div class="font-bold text-gray-700">
                                            <span>Brinde</span>
                                        </div>

                                        <div class="text-gray-700">
                                            {{ $list->blindCart->name ?? 'sem nome' }}
                                            @break
                                        </div>

                                    </div>
                                </div>
                            @endif
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

                    <div class="flex flex-col md:flex-row space-y-4 md:space-y-0 md:space-x-4">

                        </form>

                        <!-- Saiu Para Entrega Button -->
                        <form action="{{ route('status.delivery', $item->id) }}" method="POST" class="flex-1">
                            @csrf
                            <button type="submit" class="border-l-4 border-green-500 bg-gradient-to-r from-green to-green-600  font-bold py-2 px-4 rounded-lg hover:from-green- hover:to-green hover:text-whitek focus:outline-none focus:ring-2 focus:ring-green-600 focus:ring-opacity-50">
                                ENTREGUE
                            </button>
                        </form>

                        <!-- Voltar Button -->
                        <a href="{{ route('panel.admin') }}" class="flex-1">
                            <button class="bg-gradient-to-r from-purple-400 to-purple-600 text-white font-bold py-2 px-4 rounded-lg hover:from-purple-500 hover:to-purple-700 focus:outline-none focus:ring-2 focus:ring-purple-600 focus:ring-opacity-50">
                                Voltar
                            </button>
                        </a>
                    </div>


            </div>

        @empty
            <p class="pt-4 font-bold text-lg">Sem Pedidos com status sairam para entrega!</p>
            <marquee>Para o dia: {{ $date }}</marquee>
        @endforelse
    </div>
    <a href="{{ route('panel.admin')}}">
        <button class="bg-slate-300 mt-2 hover:bg-blue-700 border font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline" type="submit">
            Voltar
        </button>
    </a>
  </div>
</body>
</html>
