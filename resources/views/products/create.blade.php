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
   .painel{
    margin-left: 50px;
    margin-right: 50px;
   }
   .slate{
    background-color: rgb(228, 217, 217);
    border: 2px solid black;
   }
  
    </style>

    <title>CreateProduct</title>
</head>
<body>
    @vite('resources/css/app.css')

    <div class="container pt-2 pb-2">
     
       <div class="text-center sm:ml-32 ml-32">
          <div class=" center">
                  <div class="">
                            
                          <div class="  text-center pr-4  rounded container ">
                            <h1 class="text-center  font-bold  pt-4">SEJA BEM VINDO AO SEU PAINEL ADMINISTRATIVO</h1> <br>  
                                  <h2 class="font-bold text-lg"> {{Auth::user()->name}} </h2>
                                        <div class="text-center p-2 ">
                                          <h1 class="font-bold">CATEGORIAS</h1>
                                        </div>
                                  <div class=" pl-2 pb-2 painel">

                                      <a href="{{ route('showbeer')}}" class=""><div class=" slate  p-2 mt-2 ml-2 rounded">BEBIDAS</div></a>
                                      <a href="{{ route('showcombo')}}" class=""><div class=" slate  p-2 rounded mt-2 ml-2">COMBOS</div></a>
                                      <a href="{{ route('create.product')}}" class=""><div class=" slate  p-2 rounded mt-2 ml-2">LANCHES</div></a>
                                      <a href="{{ route('user.bomboniere')}}" class=""><div class=" slate  p-2 rounded mt-2 ml-2">BOMBONIÉRE</div></a>
                                      <a href="{{ route('order.show')}}" class=""><div class= "slate p-2 rounded mt-2 ml-2">PEDIDOS</div></a>
                                          <div class="pt-2">
                                            <h1 class= "font-bold p-2">CADASTRO E ATUALIZAÇOÊS DE PRODUTOS</h1>
                                          </div>
                                      <a href="{{ route('new.project')}}" class=""><div class=" slate p-2 rounded mt-2 ml-2">CADASTRAR NOVO PRODUTO</div></a>
                                      <a href="{{ route('view.category')}}" class=""><div class=" slate p-2 rounded mt-2 ml-2">CADASTRAR NOVA CATEGORIA</div></a>
                                      <a href="{{ route('view.aditional')}}" class=""><div class=" slate p-2 rounded mt-2 ml-2">CADASTRAR NOVO ADICIONAL</div></a>
                                      <a href="{{ route('client.show')}}" class=""><div class=" slate p-2 rounded mt-2 ml-2 mb-2">CLIENTES</div></a>
                                      <div class="pt-2">
                                        <h1 class= "font-bold p-2">RESUMO DOS PEDIDOS</h1>
                                        <a href="{{ route('summary.index')}}" class=""><div class=" slate p-2 rounded mt-2 ml-2 mb-2">RESUMO</div></a>
                                      </div>
                                  </div>
                          </div>
                  </div>

             <p class="text-center text-gray-500 text-xs">
        
               &copy;2024 todos os direitos reservados desenvolvendor web Alexandre Roberto.
             </p>
         </div>
    </div>
    @vite('resources/js/app.js')

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.min.js" integrity="sha384-cuYeSxntonz0PPNlHhBs68uyIAVpIIOZZ5JqeqvYYIcEL727kskC66kF92t6Xl2V" crossorigin="anonymous"></script>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
</body>
</html>
 