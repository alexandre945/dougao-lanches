<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <script src="https://kit.fontawesome.com/03e947ed86.js" crossorigin="anonymous"></script>
    <script src="{{asset('js/index-cart.js')}}"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
    <title>Termos de uso</title>
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

    <h1 class="text-center pb-4 font-bold">Termos de Uso</h1>

<p>Estes Termos de Uso regem a utilização do nosso sistema de delivery.</p>

<h2>1. Aceitação dos Termos</h2>
<p>Ao utilizar nosso sistema, você declara estar de acordo com os termos aqui descritos.</p>

<h2>2. Responsabilidades do Usuário</h2>
<p>O usuário compromete-se a utilizar o sistema apenas para fins legítimos, respeitando a legislação vigente e os bons costumes.</p>

<h2>3. Limitação de Responsabilidade</h2>
<p>Não nos responsabilizamos por eventuais problemas decorrentes do uso inadequado ou indevido do sistema.</p>

<h2>4. Alterações nos Termos</h2>
<p>Reservamo-nos o direito de modificar estes Termos de Uso a qualquer momento. A versão atualizada será publicada nesta página.</p>

<p class="mt-4 italic">Última atualização: 30/04/2025</p>

<div class="mt-6 flex items-start">
    <input type="checkbox" id="acceptTerms" class="mr-2 mt-1">
    <label for="acceptTerms" class="text-sm">
        Li e aceito os termos de uso.
    </label>
</div>

<div class="mt-4">
    <button
        onclick="redirectIfAccepted()"
        class="bg-emerald-500 text-white px-4 py-2 rounded hover:bg-emerald-600 transition">
        Continuar
    </button>
</div>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.min.js" integrity="sha384-cuYeSxntonz0PPNlHhBs68uyIAVpIIOZZ5JqeqvYYIcEL727kskC66kF92t6Xl2V" crossorigin="anonymous"></script>
@vite('resources/js/app.js')
<script>
    function redirectIfAccepted() {
        const checkbox = document.getElementById('acceptTerms');
        if (checkbox.checked) {
            // Redireciona para a rota desejada
            window.location.href = "{{ route('client.show') }}";
        } else {
            alert('Você precisa aceitar os termos para continuar.');
        }
    }
</script>
</body>
</html>
