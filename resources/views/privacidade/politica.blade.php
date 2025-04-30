<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <script src="https://kit.fontawesome.com/03e947ed86.js" crossorigin="anonymous"></script>
    <script src="{{asset('js/index-cart.js')}}"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
    <title>Política de Privacidade</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            max-width: 800px;
            margin: 0 auto;
            padding: 20px;
            line-height: 1.6;
        }
        h1, h2 {
            color: #333;
        }
    </style>


    @vite('resources/css/app.css')
</head>
<body>
    <div class="text">
        <h1 class="text-center pb-2 font-bold">Política de Privacidade</h1>

        <p>Esta Política de Privacidade explica como o nosso sistema de delivery coleta, usa e protege as informações dos usuários.</p>

        <h2>1. Introdução</h2>
        <p>Este aplicativo de delivery valoriza a privacidade dos seus usuários. Esta política descreve como coletamos, usamos e protegemos as informações dos usuários.</p>

        <h2>2. Coleta de Informações</h2>
        <p>Coletamos informações pessoais fornecidas pelos usuários, como nome, número de telefone e endereço, para facilitar o processo de entrega dos pedidos.</p>

        <h2>3. Uso das Informações</h2>
        <p>As informações coletadas são usadas exclusivamente para processar e entregar os pedidos. Não compartilhamos informações pessoais com terceiros, exceto quando necessário para cumprir uma solicitação legal ou proteger os direitos do usuário.</p>

        <h2>4. Proteção das Informações</h2>
        <p>Implementamos medidas de segurança para proteger as informações dos usuários contra acesso não autorizado, alteração ou divulgação.</p>

        <h2>5. Exclusão de Dados do Usuário</h2>
        <p>Os usuários podem solicitar a exclusão de seus dados entrando em contato conosco através do e-mail <a href="mailto:douglas.mariana2020@yahoo.com">douglas.mariana2020@yahoo.com</a> ou seguindo as instruções na página de Exclusão de Dados.</p>

        <h2>6. Alterações nesta Política</h2>
        <p>Reservamo-nos o direito de atualizar esta política de privacidade periodicamente. Informaremos os usuários sobre quaisquer mudanças importantes.</p>

        <h2>7. Contato</h2>
        <p>Para dúvidas sobre esta política, entre em contato através de <a href="douglas.mariana2020@yahoo.com">douglas.mariana2020@yahoo.com</a>.</p>
          <!-- Botão que abre o modal -->
<button onclick="document.getElementById('deleteModal').showModal()" class="bg-red-600 text-white px-4 py-2 rounded hover:bg-red-700">
    Excluir Conta
</button>

<!-- Modal -->
<dialog id="deleteModal" class="rounded-lg shadow-lg p-6 w-full max-w-md">
    <h1 class="text-center">{{ $user->name}}</h1>
    <h2 class="text-lg font-bold mb-4 text-center text-red-700">Deseja mesmo excluir sua conta?</h2>
    <p class="mb-4 text-sm text-gray-600 text-center">Esta ação é irreversível e todos os seus dados serão apagados.</p>

    <form method="POST" action="{{ route('user.delete') }}" class="flex justify-center">
        @csrf
        @method('DELETE')
        <button type="submit" class="bg-red-600 text-white px-4 py-2 rounded hover:bg-red-700">
            Confirmar Exclusão
        </button>
    </form>

    <div class="mt-4 flex justify-center">
        <button onclick="document.getElementById('deleteModal').close()" class="text-gray-500 hover:text-gray-700">Cancelar</button>
    </div>
</dialog>

         <a href="{{ route('client.show') }}">
            <button class="bg-slate-500 rounded-md hover:bg-slate-300 hover:text-gray p-2">voltar</button>
         </a>
    </div>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.min.js" integrity="sha384-cuYeSxntonz0PPNlHhBs68uyIAVpIIOZZ5JqeqvYYIcEL727kskC66kF92t6Xl2V" crossorigin="anonymous"></script>
@vite('resources/js/app.js')
</body>
</html>
