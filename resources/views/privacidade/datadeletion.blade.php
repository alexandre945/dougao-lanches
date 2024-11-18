<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <script src="https://kit.fontawesome.com/03e947ed86.js" crossorigin="anonymous"></script>
    <script src="{{asset('js/index-cart.js')}}"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
    <title>Instruções para Exclusão de Dados</title>


    @vite('resources/css/app.css')
</head>
<body class="m-2">
    <h1 class="text-center mb-4 pt-2">Instruções para Exclusão de Dados</h1>
    <p>Para solicitar a exclusão de seus dados pessoais, envie um e-mail para <strong>alexandresousaroberto@gmail.com</strong> com o assunto "Exclusão de Dados". Inclua as seguintes informações:</p>
    <ul>
        <li>Seu nome completo</li>
        <li>Seu e-mail registrado em nossa plataforma</li>
        <li>Descrição do motivo do pedido</li>
    </ul>
    <p>Assim que recebermos sua solicitação, processaremos a exclusão dos dados em até 30 dias úteis.</p>

    <p>Se tiver alguma dúvida, entre em contato conosco por meio de nosso <a href="alexandresousaroberto@gmail.com">alexandresousaroberto@gmail.com</a>.</p>
     <a href="{{ route('data.deletion')}}">aqui você pode pedir exclusão dos seus dados</a>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.min.js" integrity="sha384-cuYeSxntonz0PPNlHhBs68uyIAVpIIOZZ5JqeqvYYIcEL727kskC66kF92t6Xl2V" crossorigin="anonymous"></script>
@vite('resources/js/app.js')
</body>
</html>
