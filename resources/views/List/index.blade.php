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

       <div class="text-center ">
            <div class="pt-4 ">
                  <div class="card bg-slate-100 p-4">
                    <h1>Bem vindo a sua lista de Compras  :  {{ auth()->user()->name}}</h1>
                    <h2>aqui vc pode adicionar itens que você precisa comprar para seu estabelecimento não esquecer</h2>
                  </div>

                  <div class="bg-slate-100 card">
                    <Form action="{{ route('list.create')}}" method="post">

                        @csrf
                        <div class="text pt-20">
                            <form class="grup-control">
                                <fieldset>
                                    <div class="label">
                                        <h2 class="font-bold">PRODUTO</h2>
                                        <input class="bg-slate-50 rounded" type="text" class=" m-2 rounded " name="name"/><br>
                                            @error('name')
                                                <span class="text-red-500 p-2 ">{{ $message}}</span>
                                            @enderror
                                    </div>

                                    <div class="label2">
                                        <h2 class="font-bold">QUANTIDADE</h2>
                                        <input class="bg-slate-50 rounded" type="text" class=" m-2  rounded" name="quantity"/><br>
                                            @error('quantity')
                                                <span class="text-red-500 p-2  ">{{ $message}}</span>
                                            @enderror
                                    </div>

                                <button class="bg-slate-400 hover:bg-blue-700 mb-4 text-white font-bold py-2 px-4 mt-2 rounded focus:outline-none focus:shadow-outline" type="submit">CADASTRAR</button>
                                </fieldset>
                            </form>
                        </div>
                    </Form>

                </div>

                <div class=" w-full  pr-4 overflow-auto text-center mt-4">

                        @if ( session('created'))
                            <div class="bg-slate-100 text-green p-2  rounded font-bold mt-2 w-[400px]">
                                <p>
                                    {{ session('created')}}
                                </p>
                            </div>
                        @endif

                        @if (session('deleted'))
                            <div class="bg-slate-100 p-2 rounded text-green font-bold w-[400px] mt-2">
                                <p>{{ session('deleted')}}</p>
                            </div>
                        @endif



                        <table class=" bg-slate-200  w-full pt-2 min-w-full divide-y divide-gray-200 dark:divide-neutral-700">
                            <thead class="">
                                <tr>
                                    <th class="pt-6">NOME</th>
                                    <th class="">QUANTIDADE</th>
                                    <th>AÇOẼS</th>
                                </tr>
                            </thead>
                            <tbody class="">
                                @forelse ( $list as $item)

                                    <tr>

                                        <td class="p-4 sm:w-60">
                                            {{ $item->name }}
                                        </td>

                                        <td class="p-4">
                                            {{ $item->quantity }}
                                        </td>

                                    <td class="">
                                        <div class="">
                                            <form action="{{ route('list.delete', $item->id)}}" method="post">
                                                @method('DELETE')
                                                @csrf
                                                <button type="submit" class="">
                                                <i class="icon fa-sharp fa-solid fa-trash text-red-500"></i>
                                                </button>
                                            </form>

                                        </div>
                                    </td>

                                    </tr>
                                @empty
                                    <div class="bg-slate-100 p-2 mb-2 mt-2">
                                         <p class="text-2xl font-medium">Lista vazia</p>
                                    </div>
                                @endforelse
                            </tbody>
                        </table>
                        <a href="{{ route('panel.admin')}}">
                            <button class="bg-slate-400 hover:bg-blue-700 mb-4 text-white font-bold py-2 px-4 rounded focus:outline-none mt-2 focus:shadow-outline" type="submit">
                                Voltar
                            </button>
                        </a>
                </div>

            </div>
       </div>
    {{-- {{ $product->links()}} --}}

    @vite('resources/js/app.js')

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.min.js" integrity="sha384-cuYeSxntonz0PPNlHhBs68uyIAVpIIOZZ5JqeqvYYIcEL727kskC66kF92t6Xl2V" crossorigin="anonymous"></script>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
</body>
</html>
