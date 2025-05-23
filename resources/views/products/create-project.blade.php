 <!DOCTYPE html>
 <html lang="pt-br">
 <head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <script src="https://kit.fontawesome.com/03e947ed86.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
    <title>Create New project</title>

     <style>
        .green {
            color: green;
        }
     </style>

 </head>
 <body>
    @vite('resources/css/app.css')

  <div class="container pt-4">

    <h1 class="pt-2 font-bold text-center">CASDASTRAR NOVO PRODUTO</h1>
    <form action="{{ route('store.product') }}" class=" bg-white shadow-md rounded px-8 pt-6 pb-8 mb-4 " method="post" enctype="multipart/form-data">
      @csrf
      <div class="mb-4">
        <label class="block text-gray-700 text-sm font-bold mb-2" for="Produto">PRODUTO</label>
        <input autocomplete="off"  class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" id="name" type="text" placeholder="digite nome do produto" name="name">
            @error('name')
                <span class="error text-red-600">{{ $message }}</span>
            @enderror
      </div>

      <div class="mb-6">
        <label class="block text-gray-700 text-sm font-bold mb-2" for="discrição"> DESCRIÇÃO</label>
        <input autocomplete="off" class="shadow appearance-none border border-red-500 rounded w-full py-2 px-3 text-gray-700 mb-3 leading-tight focus:outline-none focus:shadow-outline" id="description" type="text" placeholder="digite a discrição do produto" name="description">
            @error('description')
                <span class="error text-red-600">{{ $message }}</span>
            @enderror


      </div>
      <div class="mb-6">
        <label class="block text-gray-700 text-sm font-bold mb-2" for="price">PREÇO</label>
        <input autocomplete="off" class="shadow appearance-none border border-red-500 rounded w-full py-2 px-3 text-gray-700 mb-3 leading-tight focus:outline-none focus:shadow-outline" id="price" type="text" placeholder="digite o preço do produto" name="price">
            @error('price')
                <span class="error text-red-600">{{ $message }}</span>
            @enderror
      </div>

      <div class="mb-6">
        <label class="block text-gray-700 text-sm font-bold mb-2" for="price">IMAGEM</label>
        <input autocomplete="off" class="shadow appearance-none border border-red-500 rounded w-full py-2 px-3 text-gray-700 mb-3 leading-tight focus:outline-none focus:shadow-outline" id="price" type="file"  name="photo">
            @error('photo')
                <span class="error text-red-600">{{ $message }}</span>
            @enderror
      </div>

      <div class="mb-6">
        <label class="block text-gray-700 text-sm font-bold mb-2" for="price">CATEGORIA</label>

        <select name="category_id" id="category"class="rounded ">
          @foreach ($category as $item)
              <option name="category_id" value="{{$item->id}}">{{$item->name}}</option>
          @endforeach
        </select>
      </div>

      <div class="flex items-center justify-between">
        <button class="bg-emerald-400 text-white hover:bg-blue-700 border font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline" type="submit">
          cadastrar
        </button>

        {{-- <a class="inline-block align-baseline font-bold text-sm text-blue-500 hover:text-blue-800" href="#">
          Forgot Password?
        </a> --}}
      </div>
      @if(session('success'))
         <div class="green mt-2">
             {{ session('success')}}
         </div>
       @endif
    </form>
        <a href="{{ route('panel.admin')}}">
            <button class="bg-emerald-400 text-white mb-4 hover:bg-blue-700 border font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline" type="submit">
                Voltar
            </button>
        </a>

  </div>




        @vite('resources/js/app.js')

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.min.js" integrity="sha384-cuYeSxntonz0PPNlHhBs68uyIAVpIIOZZ5JqeqvYYIcEL727kskC66kF92t6Xl2V" crossorigin="anonymous"></script>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
 </body>
 </html>
