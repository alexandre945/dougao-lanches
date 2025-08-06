<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <script src="https://kit.fontawesome.com/03e947ed86.js" crossorigin="anonymous"></script>
    {{-- <script src="{{asset('js/index-cart.js')}}"></script> --}}
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
                                     <div class="">
                                        <p class="text-2xl font-bold">CARRINHO ADIMINISTRATIVO</p>
                                     </div>
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
                                                        <div class=" items-center mb-2">
                                                            <form action="{{ route('admin.manual.destroy',$item->id)}}" method="POST">
                                                                @csrf
                                                              
                                                                <button type="submit" class="text-white bg-red-500 hover:bg-red-600 rounded px-4 py-2 text-sm font-semibold">Excluir</button>
                                                            </form>
                                                        </div>
 
                                                        </div>
                                                    </div>
                                                @empty
                                                    <div class="bg-gradient-to-r from-indigo-500 to-purple-500 bg-opacity-90 text-white rounded-lg shadow-lg shadow-yellow-200 p-6 mb-8 pb-2 relative group max-w-sm mx-auto border-4 border-yellow-100">
                                                        <p class="text-gray-200">Sua sacola esta vazia</p>
                                                    </div>
                                                @endforelse

                                            </div>
                                        </div>
                                    </div>
                                    {{-- Div total --}}
                                    <div class=" container max-auto ">

                                        <div class=" rounded-lg shadow-lg p-6 mb-4">
                                            <div class="ml-4 mr-4  container bg-white p-2">
                                                <h1 class="font-bold text-gray-700 pt-2 pb-2">TOTAL</h1>

                                            <form id="mainForm" action="{{ route('admin.create') }}" method="post">

                                                        @csrf

                                                        <input type="hidden" name="address_user_types_id" id="address_user_types_id" value="">

                                                                <p class="font-bold">@money($total)</p>
                                                                @php
                                                                    $total = $total ?? 0;
                                                                    $payment = optional($productInfo)->payment ?? '';
                                                                    $delivery = optional($productInfo)->delivery ?? '';
                                                                @endphp

                                                            <input type="hidden" name="total" value=" @money ($total)">
                                                            <input type="hidden" name="payment" value="{{ $productInfo->payment ?? '' }}">
                                                            <input type="hidden" name="delivery" value="{{ $productInfo->payment ?? '' }}">
                                                            <input type="hidden" name="observation" id="observation_hidden" value="">
                                                            <input type="hidden" name="credit_card" id="credit_card_hidden" value="">

                                                            @foreach ($cart as $item)
                                                                <input type="hidden" name="blindCartId[]" value="{{ $item->blindCart->id ?? '' }} ">

                                                            @endforeach
                                            </form>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="container max-auto ">

                                            <div class="p-4 text-center bg-white">

                                                        @if(session('success'))
                                                        <div class=" text-center  bg-white text-green p-4  rounded font-bold">
                                                            <p>{{ session('success')}}</p>
                                                        </div>
                                                        @endif
                                                        <div class="text-center">
                                                            <p class="text-gray-700 pb-2 text-sm">o pagamento será realizado na entrega</p>
                                                        </div>
                                                        <div class="sm:flex-col space-x-4 justify-center text-center bg-white rounded-lg shadow-lg p-2 mb-2">
                                                            <h2 class="text-gray-700 pb-2 font-bold">Forma de entrega</h2>


                                                            <!-- Opção: Retirar na Lanchonete -->
                                                            <div class="flex space-x-2 text-center items-center justify-center">
                                                                <span>Retirar na Lanchonete</span>
                                                                <form action="{{ route('update.delivery') }}" method="post">
                                                                    @csrf
                                                                    <input type="hidden" name="delivery" value="0">
                                                                    <button type="submit"
                                                                        class="w-10 h-10 flex items-center justify-center border rounded-full text-gray-700">
                                                                        @if(($productInfo->delivery ?? null) === 0)
                                                                            <i class="fa-solid fa-square-check" style="color:green;"></i>
                                                                        @else
                                                                            <i class="fa-regular fa-circle"></i>
                                                                        @endif
                                                                    </button>
                                                                </form>
                                                            </div>

                                                            <!-- Opção: Entregar em domicílio -->
                                                            <div class="flex space-x-2 text-center items-center justify-center">
                                                                <span>Entregar em domicílio</span>
                                                                <form action="{{ route('update.delivery') }}" method="post">
                                                                    @csrf
                                                                    <input type="hidden" name="delivery" value="1">
                                                                    <button type="submit"
                                                                        class="w-10 h-10 flex items-center justify-center border rounded-full text-gray-700">
                                                                        @if(($productInfo->delivery ?? null) === 1)
                                                                            <i class="fa-solid fa-square-check" style="color:green;"></i>
                                                                        @else
                                                                            <i class="fa-regular fa-circle"></i>
                                                                        @endif
                                                                    </button>
                                                                </form>
                                                            </div>
                                                        </div>


                                                        <div class="bg-white rounded-lg shadow-lg p-2 mb-2">
                                                            <h2 class="text-gray-700 pb-2 mt-4 font-bold">Forma de pagamento</h2>

                                                            <!-- Opção: Cartão/Pix na máquina -->
                                                            <div class=" w-full flex flex-col md:flex-row md:justify-center md:text-center ml-6">
                                                                <div class="md:mr-4 mb-4 md:mb-0 flex items-center space-x-2">
                                                                    <div>
                                                                        <span>Cartão</span>
                                                                        <form action="{{ route('update.payment') }}" method="post">
                                                                            @csrf
                                                                            <input type="hidden" name="payment" value="1">
                                                                            <button type="submit"
                                                                                class="payment-btn w-10 h-10 flex items-center justify-center border rounded-full text-gray-700"
                                                                                onclick="setPaymentMethod(1)">
                                                                                @if(($productInfo->payment ?? null) === 0)
                                                                                    <i class="fa-solid fa-square-check" style="color: green;"></i>
                                                                                @else
                                                                                    <i class="fa-regular fa-circle"></i>
                                                                                @endif
                                                                            </button>
                                                                        </form>
                                                                    </div>
                                                                    @if(($productInfo->payment ?? null) == 1 )

                                                                    @else
                                                                        <select name="credit_card" id="credit_card_select" class="text-sm p-2 border border-gray-300 rounded mb-2 mt-2 shadow-md hover:shadow-xl transition-shadow duration-300">
                                                                            <option value="visa">Visa</option>
                                                                            <option value="Master Card">Master Card</option>
                                                                            <option value="Ouro Card">Ouro Card</option>
                                                                            <option value="pix na maquina">Pix na máquina</option>
                                                                        </select>
                                                                    @endif
                                                                </div>

                                                                <!-- Opção: Dinheiro -->
                                                                <div class="md:mr-4 mb-2 md:mb-0 flex items-center space-x-2">
                                                                    <div>
                                                                        <span>Dinheiro</span>
                                                                        <form action="{{ route('update.payment') }}" method="post">
                                                                            @csrf
                                                                            <input type="hidden" name="payment" value="0">
                                                                            <button type="submit"
                                                                                class="payment-btn w-10 h-10 flex items-center justify-center border rounded-full text-gray-700 mb-2"
                                                                                onclick="setPaymentMethod(0)">
                                                                                @if(($productInfo->payment ?? null) === 1)
                                                                                    <i class="fa-solid fa-square-check" style="color: green;"></i>
                                                                                @else
                                                                                    <i class="fa-regular fa-circle"></i>
                                                                                @endif
                                                                            </button>
                                                                        </form>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            @error('observation')
                                                                <div class="mt-1 text-sm text-red-600 bg-red-100 p-2 rounded">
                                                                    {{ $message }}
                                                                </div>
                                                            @enderror

                                                            <!-- Campo para observação do troco -->
                                                            @if(($productInfo->payment ?? null) == 0)

                                                            @else
                                                                <div class=" justify-center flex">
                                                                    <div class="pl-4">
                                                                        <label for="observation" class="pb-2 text-gray-700 text-sm">
                                                                            <p class="text-sm" >INFORME O VALOR DO TROCO</p>
                                                                        </label><br>
                                                                        <input type="text"
                                                                            class="text-sm p-2 border-2-black rounded mb-2  hover:shadow-xl transition-shadow duration-300"
                                                                            id="observation"
                                                                            placeholder="Ex: Troco para 50 Reais"
                                                                        >
                                                                    </div>
                                                                </div>
                                                            @endif
                                                        </div>

                                            </div>
                                    </div>


                            {{-- botões de enviar continuar e cadastrar --}}
                            <div class="container max-auto">
                                <div class="bg-white rounded-lg shadow-lg p-2 mb-2">

                                        <div class="p-2 text-center">
                                            <a href="{{ route('admin.manual-order.create')}}">
                                                <button class="bg-gradient-to-r from-green to-lime-300  font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline border-l-4 border-blue border-t-2">
                                                    <SPAN>CONTINUAR COMPRANDO</SPAN>
                                                </button>
                                            </a>
                                        </div>

                                   
                                    </div>
                                </div>


                                <div class="container max-auto">
                                    <div class="bg-white rounded-lg shadow-lg p-2 mb-2">
                                       <h1>DADOS DO CLIENTE</h1>
                                           <form action="/seu-endpoint-aqui" method="POST">
                                                @csrf 
                                                <div class="mb-3 text-center">
                                                    <label for="nome" class="form-label">Nome</label>
                                                    <input type="text" class="form-control rounded w-75 mx-auto" placeholder="Nome do cliente" id="nome" name="nome" required>
                                                </div>
                                                <div class="mb-3 text-center">
                                                    <label for="zap" class="form-label">Zap</label>
                                                    <input type="text" class="form-control rounded w-75 mx-auto" id="zap" name="zap" required>
                                                </div>
                                                <div class="mb-3 text-center">
                                                    <label for="rua" class="form-label">Rua</label>
                                                    <input type="text" class="form-control rounded w-75 mx-auto" id="rua" name="rua" required>
                                                </div>
                                                <div class="mb-3 text-center">
                                                    <label for="bairro" class="form-label">Bairro</label>
                                                    <input type="text" class="form-control rounded w-75 mx-auto" id="bairro" name="bairro" required>
                                                </div>
                                                <div class="mb-3 text-center">
                                                    <label for="numero" class="form-label">Número</label>
                                                    <input type="text" class="form-control rounded w-75 mx-auto" id="numero" name="numero" required>
                                                </div>
                                                <div class="mb-3 text-center">
                                                    <label for="referencia" class="form-label">Referência</label>
                                                    <input type="text" class="form-control rounded w-75 mx-auto" id="referencia" name="referencia" required>
                                                </div>
                                                <button type="submit" class="btn btn-primary">Salvar</button>
                                            </form>

                                    </div>

                                    <button type="submit" id="submitButton" class="bg-gradient-to-r from-green to-lime-300  font-bold py-2 px-4 mb-2 rounded focus:outline-none focus:shadow-outline border-l-4 border-blue border-t-2">
                                        <span id="buttonText">ENVIAR PEDIDO</span>
                                        <span id="buttonSpinner" style="display: none;">
                                            <div class="spinner"></div>
                                        </span>
                                    </button>

                                </div>

                          
        </div>



   <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.min.js" integrity="sha384-cuYeSxntonz0PPNlHhBs68uyIAVpIIOZZ5JqeqvYYIcEL727kskC66kF92t6Xl2V" crossorigin="anonymous"></script>
    <script>

document.addEventListener("DOMContentLoaded", function () {
    const selectCard = document.getElementById("credit_card_select");
    const inputHiddenCard = document.getElementById("credit_card_hidden");
    const inputObservation = document.getElementById("observation");
    const inputHiddenObservation = document.getElementById("observation_hidden");

    // Se o select existir, definir o valor inicial do input hidden
    if (selectCard) {
        inputHiddenCard.value = selectCard.value; // Define o valor inicial

        selectCard.addEventListener("change", function () {
            inputHiddenCard.value = selectCard.value;
        });
    }

        // Atualiza o input hidden quando o usuário digita o troco
        if (inputObservation) {
            inputObservation.addEventListener("input", function () {
                inputHiddenObservation.value = inputObservation.value;
            });
        }
    });



    document.addEventListener("DOMContentLoaded", function () {
        const submitButton = document.getElementById("submitButton");
        const buttonText = document.getElementById("buttonText");
        const buttonSpinner = document.getElementById("buttonSpinner");
        const mainForm = document.getElementById("mainForm");

        submitButton.addEventListener("click", function () {
            // Desabilita o botão para evitar envios duplos
            submitButton.disabled = true;

            // Esconde o texto e mostra o spinner
            buttonText.style.display = "none";
            buttonSpinner.style.display = "inline-block";

            // Envia o formulário
            mainForm.submit();
        });
    });


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


//peggar atualização delivery
function updateObservationField() {
        // Pegando o campo de observação
        const observationInput = document.getElementById('observation_hidden');

        // Pegando a opção de entrega selecionada
        const selectedDelivery = document.querySelector('input[name="delivery"]:checked');

        // Verificando se a opção foi encontrada antes de tentar acessar o valor
        if (selectedDelivery) {
            if (selectedDelivery.value === '0') {
                observationInput.disabled = true;
                observationInput.classList.add('disabled');
            } else {
                observationInput.disabled = false;
                observationInput.classList.remove('disabled');
            }
        }
    }

    // Adicionando evento para capturar a mudança na opção de entrega
    document.querySelectorAll('input[name="delivery"]').forEach(input => {
        input.addEventListener('change', updateObservationField);
    });

    // Executa a função no carregamento da página para definir o estado inicial
    document.addEventListener('DOMContentLoaded', updateObservationField);


// function atualizarValor() {
//     const opcoes = document.getElementsByName('delivery');
//     var entregaInput = document.getElementById('entrega');
//     var toremove = document.getElementById('toremove');
//     var delivery = document.getElementById('delivery');
//     let total = "<?php echo $total; ?>";
//     const taxa = 6.00;
//     let totalAmount = 0;



// for (let i = 0; i <opcoes.length; i++) {
//     if (opcoes[i].checked) {

//         if (opcoes[i].value === '0') {

//             delivery.style.display = 'none';
//             toremove.style.display = 'block';

//         } else if (opcoes[i].value === '1') {

//           toremove.style.display = 'none';
//           delivery.style.display = 'block';
//           totalAmount = parseFloat(total) + parseFloat(taxa);

//         }
//     }
//           totalAmount = totalAmount.toFixed(2);
//           totalAmount = totalAmount.replace(".",",");
//           delivery.innerHTML = 'R$' + "_" + totalAmount;
// }
// }



//    Selecionando os elementos relevantes

    // const paymentRadioButtons = document.querySelectorAll('input[name="payment"]');
    // const observationInput = document.getElementById('observation');

    // Função para verificar e atualizar o estado do campo de observação

    // function updateObservationField() {
    //     // Verificando qual opção de pagamento está selecionada

    //     const selectedPayment = document.querySelector('input[name="payment"]:checked').value;

    //     // Se a opção selecionada for "Cartão", desabilita o campo de observação

    //     if (selectedPayment === '0') {
    //         observationInput.disabled = true;
    //         observationInput.classList.add('disabled');
    //     } else {
    //         observationInput.disabled = false;
    //         observationInput.classList.remove('disabled');
    //     }
    // }

    // Adicionando um event listener para cada botão de rádio de pagamento



    // Chamando a função para atualizar o estado do campo de observação quando a página carregar

        // updateObservationField();


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
