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

    {{-- <script>

      function limpa_formulário_cep() {
              //Limpa valores do formulário de cep.
              document.getElementById('rua').value=("");
              document.getElementById('bairro').value=("");
              document.getElementById('cidade').value=("");
              document.getElementById('numero').value=("");
              document.getElementById('complemento').value=("");
      }

      function meu_callback(conteudo) {
          if (!("erro" in conteudo)) {
              //Atualiza os campos com os valores.
              document.getElementById('rua').value=(conteudo.logradouro);
              document.getElementById('bairro').value=(conteudo.bairro);
              document.getElementById('cidade').value=(conteudo.localidade);
              // document.getElementById('numero').value=(conteudo.numero);
              // document.getElementById('complemento').value=(conteudo.complento);
          } //end if.
          else {
              //CEP não Encontrado.
              limpa_formulário_cep();
              alert("CEP não encontrado.");
          }
      }

      function pesquisacep(valor) {

          //Nova variável "cep" somente com dígitos.
          var cep = valor.replace(/\D/g, '');

          //Verifica se campo cep possui valor informado.
          if (cep != "") {

              //Expressão regular para validar o CEP.
              var validacep = /^[0-9]{8}$/;

              //Valida o formato do CEP.
              if(validacep.test(cep)) {

                  //Preenche os campos com "..." enquanto consulta webservice.
                  document.getElementById('rua').value="...";
                  document.getElementById('bairro').value="...";
                  document.getElementById('cidade').value="...";
                  // document.getElementById('numero').value="...";
                  // document.getElementById('complemento').value="...";

                  //Cria um elemento javascript.
                  var script = document.createElement('script');

                  //Sincroniza com o callback.
                  script.src = 'https://viacep.com.br/ws/'+ cep + '/json/?callback=meu_callback';

                  //Insere script no documento e carrega o conteúdo.
                  document.body.appendChild(script);

              } //end if.
              else {
                  //cep é inválido.
                  limpa_formulário_cep();
                  alert("Formato de CEP inválido.");
              }
          } //end if.
          else {
              //cep sem valor, limpa formulário.
              limpa_formulário_cep();
          }
      };

    </script> --}}


    @vite('resources/css/app.css')
</head>
<body>
      <div class="  text-center md: p-2">
                   <div class="p-2 text-xl text-gray-700 font-bold">
                      <a href="{{route('index.point')}}"  class="cart ">
                        Cartão fidelidade
                        <i class="fa-solid fa-id-card fa-2xl color " ></i>
                      </a>
                   </div>
                  <div class="text-center ">

                        <h1 class="text-xl text-gray-700 font-bold">Bem vindo a sua Sacola de Compras:</h1>
                        <p class="text-gray-700 font-bold">{{ auth()->user()->name }}</p>
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

                                <div class="text-red-500 bg-slate-300 p-2">
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

                    <div class=" block  overflow-auto">

                          <table class=" sm:w-full text-md font-light ">
                              <thead class="border-b ">
                                <tr>
                                    <th scope="col" class="px-4 py-2 text-gray-700">Produto</th>
                                    <th scope="col" class="px-4 py-2 text-gray-700">Preço</th>
                                    <th scope="col" class="px-4 py-2 text-gray-700">Quantidade</th>
                                    <th scope="col" class="px-4 py-2 text-gray-700">Observação</th>
                                    <th scope="col" class="px-4 py-2 text-gray-700">Adicionais</th>
                                    <th scope="col" class="px-4 py-2 text-gray-700">Blinde</th>
                                    <th scope="col" class="px-4 py-2 text-gray-700">Açoẽs</th>

                                </tr>
                              </thead>

                                  @forelse ($cart as $item)
                                        <?php $total = $total?>
                                      <tbody>
                                              <tr class="border-b dark:border-neutral-500">
                                                <td class="whitespace-nowrap px-2 w-auto text-gray-700 font-bold">

                                                   @if ($item->orderProductProduct)
                                                   <span class=" custom-border text-gray-700 additional rounded p-2 px-6 md:px-4 bg-slate-300 font-bold w-full text-sm ">{{ $item->orderProductProduct->name ?? ''}}</span>
                                                   @else
                                                       <div class=" p-2 rounded custom-border ">
                                                        <p>
                                                          //
                                                        </p>
                                                       </div>
                                                   @endif

                                                </td>

                                                  <input type="hidden"  name="product_id" value="{{ $item->orderProductProduct->name ?? ''}}">

                                                <td class="whitespace-nowrap px-6 py-4">
                                                   @if ( $item->orderProductProduct )
                                                    <span class=" custom-border additional  p-2 px-4 font-bold rounded bg-slate-300  text-sm">
                                                      @money($item->orderProductProduct->price ?? 0)
                                                    </span>
                                                   @else
                                                       <div class=" p-2 rounded custom-border ">
                                                        <p>
                                                          //
                                                        </p>
                                                       </div>
                                                   @endif

                                                </td>
                                                <td class="whitespace-nowrap px-6 py-4">
                                                  @if ( $item->quanty)
                                                  <span class="custom-border additional rounded p-2 px-4 bg-slate-300 font-bold text-sm">{{ $item->quanty}}</span>
                                                  @else
                                                      <div class=" p-2 rounded custom-border ">
                                                        <p>
                                                          //
                                                        </p>
                                                      </div>
                                                  @endif

                                                </td>

                                                <td class="text-gray-700  font-bold">
                                                    @if ( $item->observation)
                                                       <div class="">
                                                        <span class="custom-border additional  rounded p-2 px-4 bg-slate-300 font-bold text-sm">{{ $item->observation ?? ''}}</span>
                                                       </div>

                                                    @else
                                                        <div class="">
                                                          <p class=" p-2 rounded custom-border ">
                                                            //
                                                          </p>
                                                        </div>
                                                    @endif


                                                </td>

                                                <td class="text-gray-700 font-bold ">

                                                      @if ($item->orderProductAdditional()->count()>0)
                                                        @foreach ($item->orderProductAdditional as $additional)
                                                          <span class=" additional rounded p-2  px-4 font-bold bg-slate-300 text-sm">{{ $additional->name ?? '' }}</span><br>
                                                        @endforeach
                                                      @else
                                                          <div class=" p-2 rounded custom-border ">
                                                            <p>
                                                              //
                                                            </p>
                                                          </div>
                                                      @endif

                                                </td>
                                                <td class="text-gray-700 font-bold">


                                                        @if ($item->blinCart)
                                                          <span class="custom-border additional  rounded p-2 bg-slate-300 px-6 text-sm">{{ $item->blinCart->name ?? ''}}</span>
                                                        @else
                                                            <div class=" p-2 rounded custom-border ">
                                                              <p>
                                                                //
                                                              </p>
                                                            </div>
                                                        @endif

                                                </td>
                                                <td>

                                                  <form action="{{ route('cart.delete', $item->id) }}" method="POST">
                                                    @csrf
                                                    <div class=" rounded">
                                                        <button class="rounded text-light p-2 additional font-bold text-sm bg-red-500 custom-border ">EXCLUIR</button>
                                                    </div>
                                                </form>
                                                </td>

                                            </tr>

                                    @empty
                                            <p class="text-white text-lg p-2 font-bold">'Sua sacola esta vazia'</p>
                                    @endforelse
                                      </tbody>
                          </table>
                    </div>

                               <div class="  container ">
                                    <div class="rounded  pt-2 mt-2 ">
                                        <div class="ml-4 mr-4  container">
                                            <h1 class="font-bold text-gray-700 pt-2 pb-2">TOTAL</h1>

                                <form id="mainForm" action="{{ route('admin.create') }}" method="post">

                                            @csrf

                                            <input type="hidden" name="address_user_types_id" id="address_user_types_id" value="">

                                                            <samp  class=" font-bold  p-2  rounded custom-border bg-slate-200  mb-2"  id="toremove"> R$ @money($total)</samp>
                                                            <samp  class=" font-bold  p-2  rounded custom-border bg-slate-100  mb-2"  id="delivery"></samp>
                                                            <input type="hidden" name="total" value=" @money ($total)">

                                                            @foreach ($cart as $item)
                                                              <input type="hidden" name="blindCartId" value="{{ $item->blinCart->id ?? ''}} ">

                                                            @endforeach

                                        </div>
                                    </div>
                               </div>

                                          <div class=" pb-2 mt-2">
                                                  <div class="text-center">
                                                      <h1 class="text-gray-700 font-bold pb-2 text-lg">o pagamento será realizado na entrega</h1>
                                                  </div>
                                                  <div class="p-4 relative">
                                                        <div class="pb-4 w-full">

                                                            <input class="toremove  " type="radio" checked value="0" id="" name="delivery" onchange="atualizarValor()" >
                                                            <label for="toRemove"  class="text-gray-700 font-bold pr-4" >Retirar na lanchonete</label>

                                                            <input  class=" custom-border " type="radio" value="1" id="entrega" name="delivery" onchange="atualizarValor()">
                                                            <label for="entrega" class="text-gray-700 font-bold" > Entregar em domicílio</label>
                                                            <i class="fa-solid fa-motorcycle fa-xl text-cyan-600"></i>

                                                        </div>
                                                  </div>

                                                  <div class="pb-4">
                                                        <h2 class="text-gray-700 font-bold pb-2">forma de pagamento</h2>
                                                        <input class="payment_card custom-border " type="radio" checked value="0" id="" name="payment" >
                                                        <label for=""  class="text-gray-700 font-bold pr-4" >Cartão</label>
                                                        <select name="credit_card" id="select" class="rounded additional bg-slate-200 mr-2 custom-border " >
                                                          <option  value="visa">Visa</option>
                                                          <option  value="Master Card">Master Card</option>
                                                          <option  value="Ouro Card">Ouro Card</option>
                                                        </select>

                                                        <input  class=" custom-border " type="radio" value="1"  name="payment">

                                                        <label for="" class="text-gray-700 font-bold " >Dinheiro</label>
                                                          @error('payment')
                                                              <div class="bg-black p-2">
                                                                <samp>{{ $message}}</samp>
                                                              </div>
                                                          @enderror
                                                </div>
                                                <div class="pl-4 ">
                                                  <label for="" class="pb-2 text-gray-700  font-bold">Se seu pagamento for em diheiro preencha este campo aqui em baixo</label><br>
                                                  <input type="text" class="rounded  text-sm custom-border bg-slate-200 additional" name="observation" id="observation" placeholder="ex: troco para 50 reais">
                                                </div>
                                          </div>


                                      <div class="text-center  overflow-auto">

                                        <button type="submit" id="submitButton" class="text-md additional p-2 mb-2 custom-border bg-slate-300 rounded">
                                            <span id="buttonText">ENVIAR PEDIDO</span>
                                            <span id="buttonSpinner" style="display: none;">
                                                <div class="spinner"></div>
                                            </span>
                                        </button>

                                </form>

                                      </div>

                                        <div class="p-2 text-center">
                                          <a href="{{ route('client.show')}}"><button class="text-md additional custom-border  bg-slate-300 rounded p-2">
                                           <SPAN>CONTINUAR COMPRANDO</SPAN>
                                        </button></a>
                                        </div>

                                        <button class=" text-md p-2  custom-border additional bg-slate-300 rounded mb-2 mt-2 " data-bs-toggle="modal"
                                            data-bs-target="#firstModal">
                                            <span>CADASTRAR UM NOVO ENDEREÇO</span>
                                        </button>
                                    </div>

              <div class="">
                            @if(session('success'))
                                <div class=" text-center  bg-white text-green p-4  rounded font-bold">
                                    <p>{{ session('success')}}</p>
                                </div>
                            @endif
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

                            <div class="container">


                                    {{-- @dd($addressUserTypes) --}}

                                    {{-- <label for="addressType">Tipo de Endereço:</label> --}}
                                    <fieldset>
                                      <legend class="text-xl font-bold">Tipo de endereço</legend>
                                      <select  name="addressTypeSelect" id="addressType" class="shadow bg-slate-300 appearance-none border rounded w-full py-2 pb-2 mb-2 mt-2 text-gray-700 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
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
                                        <div id="containers_{{ $addressUserType->addressType->id ?? ''}}" class="containers" style="display: none;">
                                            <div class="mb-4">
                                                <label class="block text-gray-700 text-sm font-bold mb-2 pl-4">Cidade</label>
                                                <p class="text-left border rounded sm:w-full py-2 px-3 text-gray-700 bg-slate-300" id="city_{{ $addressUserType->addressType->id ?? ''}}" type="text" placeholder="digite a cidade" name="city">{{ $addressUserType->address->city ?? '' }}</p>
                                            </div>
                                            <div class="mb-4">
                                                <label class="block text-gray-700 text-sm font-bold mb-2 pl-4" >CEP</label>
                                                <p value=""  class=" border rounded sm:w-full py-2 px-3 text-gray-700 text-left bg-slate-300" id="zipcode_{{ $addressUserType->addressType->id ?? ''}}" type="text" placeholder= "digite seu cep" name="zipcode">{{ $addressUserType->address->zipcode ?? '' }}</p>
                                            </div>

                                            <div class="mb-4">
                                                <label class="block text-gray-700 text-sm font-bold mb-2 pl-4">Bairro</label>
                                                <p value="" id="bairro" class="border rounded  sm:w-full py-2 px-3 text-gray-700 text-left bg-slate-300" id="bairro_{{ $addressUserType->addressType->id ?? ''}}" type="text" placeholder="digite o bairro" name="district"> {{ $addressUserType->address->district ?? ''}}</p>
                                            </div>

                                            <div class="mb-4">
                                                <label class="block text-gray-700 text-sm font-bold mb-2 pl-4" >Rua</label>
                                                <p value=" " id="rua" class=" text-left border rounded sm:w-full py-2 px-3 text-gray-700 bg-slate-300" id="street_{{ $addressUserType->addressType->id ?? ''}}" type="text" placeholder="digite sua rua" name="street">{{ $addressUserType->address->street ?? ''}}</p>
                                            </div>

                                            <div class="mb-4">
                                                <label class="block text-gray-700 text-sm font-bold mb-2 pl-4" >Número</label>
                                                <p value=" " id="numero" class=" text-left border rounded sm:w-full py-2 px-3 text-gray-700 bg-slate-300" id="number_{{ $addressUserType->addressType->id ?? ''}}" type="number"  placeholder="digite seu numero" name="number">{{ $addressUserType->address->number ?? ''}}</p>
                                            </div>

                                            <div class="mb-4">
                                                <label class="block text-gray-700 text-sm font-bold mb-2 pl-4" >Celular</label>
                                                <p value=" " id="celular" class=" text-left border rounded sm:w-full py-2 px-3 text-gray-700 bg-slate-300" id="celular_{{ $addressUserType->addressType->id ?? ''}}" type="text"  placeholder="digite seu whatsap" name="number">{{ $addressUserType->address->fone ?? ''}}</p>
                                            </div>

                                            <div class="mb-4 ">
                                                <label class="block text-gray-700 text-sm font-bold mb-2 pl-4" >Complemento</label>
                                                <p value=" " id="complemento" class=" text-left border rounded sm:w-full py-3 px-3 pb-2 text-gray-700 bg-slate-300" id="complement_{{ $addressUserType->addressType->id ?? ''}}" type="text" placeholder="digite um complemento" name="complement">{{ $addressUserType->address->complement ?? ''}}</p>
                                            </div>

                                            <!-- Outros campos do endereço aqui -->
                                        </div>
                                    @endif
                                @endforeach

                            </div>
                                @else
                                <div class="bg-slate-400 ml-8 mr-8 rounded mb-4 font-bold text-xl text-yellow-300 text-center p-2 ">
                                    <p class="bg mb-4">
                                        Você ainda não tem um endereço cadastrado click no botão acima para fazer o cadastro!
                                    </p>
                                </div>
                                @endif



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

//     //LOGICA PARA INPREMENTAR LOANDING DO BOTÃO DE ENVIO
// $(document).ready(function() {
//     $('#orderForm').on('submit', function() {
//         event.preventDefault(); // Previne o envio imediato do formulário
//         // Desabilitar o botão para evitar cliques duplos
//         $('#submitButton').prop('disabled', true);

//         // Mostrar o spinner e ocultar o texto do botão
//         $('#buttonText').hide();
//         $('#buttonSpinner').show();

//            // Simular atraso de 3 segundos antes de enviar o formulário
//            setTimeout(function() {
//             // Enviar o formulário após o atraso
//             $('#orderForm').off('submit').submit();
//         }, 10000); // 3000ms = 3 segundos

//     });

//     // Se o envio do formulário falhar, reabilite o botão e mostre o texto
//     // Isso pode ser feito através de uma lógica extra de manipulação de erros
//     $(document).ajaxError(function() {
//         $('#submitButton').prop('disabled', false);
//         $('#buttonSpinner').hide();
//         $('#buttonText').show();
//     });
// });



    $(document).ready(function() {
    $('#mainForm').on('submit', function(event) {
        event.preventDefault(); // Previne o envio imediato do formulário

        // Desabilitar o botão para evitar cliques duplos
        $('#submitButton').prop('disabled', true);

        // Mostrar o spinner e ocultar o texto do botão
        $('#buttonText').hide();
        $('#buttonSpinner').show();

        // Simular atraso de 10 segundos antes de enviar o formulário
        setTimeout(function() {
            // Submeter o formulário após o atraso
            event.currentTarget.submit();
        }, 10000); // 10000ms = 10 segundos
    });
});




    </script>



</body>
</html>
