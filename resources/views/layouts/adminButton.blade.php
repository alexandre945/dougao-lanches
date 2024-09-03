<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <script src="https://kit.fontawesome.com/03e947ed86.js" crossorigin="anonymous"></script>
    <title>Menu</title>

</head>
<body>
    <div class="bg-white text-black rounded p-2 mt-2 hidden">
        <form action="{{ route('update.admin')}}" method="post">
            @csrf
            <button type="submit">
                trocar para admin
            </button>
        </form>
      </div>
</body>
</html>
