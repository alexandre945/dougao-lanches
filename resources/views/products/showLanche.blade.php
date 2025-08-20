<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <script src="https://kit.fontawesome.com/03e947ed86.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
    <style>

      .orange {
        width: 400px;
        border-radius: 8px;

      }
    .icon {
      font-size: 30px;
    color: white;
    margin-left: 15px;
    margin-top: 3px;
    }
   .green {
    background-color: rgb(21, 185, 21);
   }


    </style>

    <title>CreateProduct</title>
</head>
<body>
    @vite('resources/css/app.css')

    <div class="container ">

       <div class="text-center text-sm ">
          <div class=" center">


                  @if ( session('update'))
                      <p class="text-green-600 ">{{ session('update')}}</p>
                  @endif

                  @if (session('delete'))

                  <div class="text-green-600">
                      {{ session('delete')}}
                  </div>

                @endif
                <div class="text-center py-6">
                    <h1 class="text-sm font-bold text-gray-700">ÁREA ADMINISTRATIVA</h1>
                    <p class=" text-gray-500">Aqui você pode excluir, atualizar ou desativar um Lanche</p>
                </div>


                   <div class="flex justify-center space-x-2">
                        <a href="{{ route('showbeer') }}">
                            <div class="bg-gradient-to-r from-emerald-400 to-slate-400 border-l-4 border-blue-500 border-t-2 px-3 py-1 mt-2 ml-2 rounded text-xs">
                                BEBIDAS
                            </div>
                        </a>
                        <a href="{{ route('user.bomboniere') }}">
                            <div class="bg-gradient-to-r from-emerald-400 to-slate-400 border-l-4 border-blue-500 border-t-2 px-3 py-1 mt-2 ml-2 rounded text-xs">
                                BOMBONIÉRE
                            </div>
                        </a>
                        <a href="{{ route('showcombo') }}">
                            <div class="bg-gradient-to-r from-emerald-400 to-slate-400 border-l-4 border-blue-500 border-t-2 px-3 py-1 mt-2 ml-2 rounded text-xs">
                                COMBOS
                            </div>
                        </a>
                        <a href="{{ route('promotion.show') }}">
                            <div class="bg-gradient-to-r from-emerald-400 to-slate-400 border-l-4 border-blue-500 border-t-2 px-3 py-1 mt-2 ml-2 rounded text-xs">
                                PROMOÇÕES
                            </div>
                        </a>
                     </div>

        
                        @foreach ($product as $products)

                        <div class="bg-white rounded shadow-md mb-4 ">
                            <div class="p-2 border-b-2  border-gray-200">
                
                               <h1 class="text-start text-2xl p-2">{{$products->name}}</h1>
                            
                            <div class=" flex flex-row justify-between gap-2 text-sm items-center p-2">
                               <p class="text-sm">ATUALIZAR</p>
                              <button class="btn btn-success" data-bs-toggle="modal"
                                data-bs-target="#firstModal{{$products->id}}">
                                <i class="fa-regular fa-pen-to-square text-sm "></i>
                              </button>

                                  <div class="pr-2 produto flex flex-row lg:flex-row  w-full" w-full>
                                    <p class="text-sm">EXCLUIR</p>
                                    <form action="{{ route('delete.product',$products->id)}}" method="post">
                                        @method('DELETE' )
                                        @csrf
                                        <button type="submit" class="" onclick="preventDefoult">
                                          <i class="icon fa-sharp fa-solid fa-trash text-red-500"></i>
                                        </button>
                                    </form>

                                    <form action="{{ route('product.update',$products->id)}}" method="POST" >
                                        @csrf
                                    <div class="flex">
                                          <div class="">
                                            <button type="submit"
                                                class="toggle-button bg-white p-2 ml-2 rounded
                                                @if($products->status == 0) inertex @endif">
                                                {{-- <i class="fa-solid fa-toggle-on"></i> --}}

                                                @if($products->status == 0)

                                                  <p class="pr-2 ">Desativar</p>

                                                @else
                                                  Ativar

                                                @endif
                                            </button>
                                          </div>

                                          <div class="">
                                              @if($products->status == 0)
                                              <button class="green text-white p-2 rounded ml-2 " onclick="preventDefoult"><i class="fa-regular fa-eye"></i></button>
                                              @else
                                              <button class="bg-white text-red-500 p-2 ml-2 rounded"><i class="fa-sharp fa-solid fa-eye-slash"></i></button>
                                              @endif
                                          </div>
                                    </div>

                                    </form>
                                  </div>
                              
                            </div>

                        </div>
                                 <!-- modal -->
                        <div class="modal fade" id="firstModal{{$products->id}}" tabindex="-1"
                            aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header,btn btn-warning">
                                        <h5 class="modal-title pt-4" id="exampleModalLabel">Atualizar</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal"   aria-label="Close">
                                        </button>
                                    </div>
                                    <div class="modal-body">
                                      <form action="{{ route('update.product', $products->id) }}" method="post" enctype="multipart/form-data">
                                          @method('PUT')
                                          @csrf

                                          <fieldset class="grup-control">
                                              <div class="label">
                                                  <h1>PRODUTO</h1>
                                                  <input type="text" class="m-2 rounded" name="name" value="{{ $products->name }}"/><br>
                                              </div>

                                              <div class="label2">
                                                  <h1>DESCRIÇÃO</h1>
                                                  <input type="text" class="m-2 rounded" name="description" value="{{ $products->description }}"/><br>
                                              </div>

                                              <div class="label3">
                                                  <h1>PREÇO</h1>
                                                  <input type="text" class="rounded m-2" name="price" value="{{ number_format($products->price,2, ',', '.') }}"/><br>
                                              </div>

                                              <div class="label3">
                                                  <h1>IMAGEM ATUAL</h1>
                                                  <img src="{{ asset('storage/' . $products->photo) }}" alt="Imagem atual" class="w-32 h-32 object-cover rounded m-2"><br>

                                                  <h1>ALTERAR IMAGEM</h1>
                                                  <input type="file" class="rounded m-2" name="photo"/><br>
                                              </div>

                                              <button class="btn btn-primary text-with bg-primary mt-2" type="submit">Atualizar</button>
                                          </fieldset>
                                      </form>

                                    </div>
                                        <div class="modal-footer mt-10">
                                        <button type="button" class="btn btn-warning"
                                            data-bs-dismiss="modal">Cancelar</button>
                                        </div>
                                    </div>
                                </div>
                        </div>

                           
                        @endforeach
             
                <a href="{{ route('panel.admin')}}">
                    <button class="bg-gradient-to-r from-emerald-400 to-slate-400 border-l-4 border-bluee hover:bg-blue-700 mb-4 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline mt-2" type="submit">
                        Voltar
                    </button>
                </a>
           </div>

         </div>
       </div>



    </div>

      {{-- {{ $product->links()}} --}}

      @vite('resources/js/app.js')
    
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.min.js" integrity="sha384-cuYeSxntonz0PPNlHhBs68uyIAVpIIOZZ5JqeqvYYIcEL727kskC66kF92t6Xl2V" crossorigin="anonymous"></script>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
</body>
</html>
