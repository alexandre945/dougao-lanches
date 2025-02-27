
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <script src="https://kit.fontawesome.com/03e947ed86.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
    <title>centerCart</title>
    @vite('resources/css/app.css')

</head>
<body>
    <div class="container mx-auto pt-4 flex flex-col items-center">
        <!-- Título -->
        <h1 class="text-xl md:text-2xl font-bold text-gray-800 mb-4 text-center">
            GRÁFICO DE LANCHES MAIS VENDIDOS
        </h1>

        <!-- Gráfico -->
        <div class="w-full max-w-3xl h-[400px] md:h-[500px] lg:h-[600px] bg-white shadow-lg rounded-lg p-4">
            <canvas id="salesChart"></canvas>
        </div>

        <!-- Botão Voltar -->
        <a href="{{ route('panel.admin')}}" class="mt-6">
            <button class="bg-gradient-to-r from-blue-500 to-blue-700 hover:from-blue-600 hover:to-blue-800 tex font-semibold py-2 px-6 rounded-lg shadow-md transition-all duration-300 transform hover:scale-105">
                ← Voltar
            </button>
        </a>
    </div>


     <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

     <script>
        // Obtenha os dados do controlador
        var data = <?php echo json_encode($data); ?>;

        // Configure os dados para o Chart.js
        var labels = data.map(function(item) {
            return item.productName;
        });

        var quantities = data.map(function(item) {
            return item.quantity;
        });
        //   doughnut
        // Crie um gráfico de pizza
        // doughnut
        // bar
        // line
        var ctx = document.getElementById('salesChart').getContext('2d');
        var myChart = new Chart(ctx, {
            type: 'pie',
            data: {
                labels: labels,
                datasets: [{
                    data: quantities,
                    backgroundColor: [
                        'rgba(0,0,128)',       // Navy
                        'rgba(107,142,35)',    // OliveDrab
                        'rgba(79,79,79)',      // DarkGray
                        'rgba(255,0,0)',       // Red
                        'rgba(255,255,0)',     // Yellow
                        'rgba(0,250,154)',     // MediumSpringGreen
                        'rgba(255,222,173)',   // NavajoWhite
                        'rgba(222,184,135)',   // BurlyWood
                        'rgba(123,104,238)',   // MediumSlateBlue
                        'rgba(138,43,226)',    // BlueViolet
                        'rgba(139,0,139)',     // DarkMagenta
                        'rgba(199,21,133)',    // MediumVioletRed
                        'rgba(255,165,0)',     // Orange
                        'rgba(34,139,34)',     // ForestGreen
                        'rgba(0,191,255)',     // DeepSkyBlue
                        'rgba(75,0,130)',      // Indigo
                        'rgba(240,128,128)',   // LightCoral
                        'rgba(46,139,87)',     // SeaGreen
                        'rgba(210,105,30)',    // Chocolate
                        'rgba(255,20,147)',    // DeepPink
                        'rgba(0,128,128)',     // Teal
                        'rgba(255,69,0)',      // OrangeRed
                        'rgba(218,112,214)',   // Orchid
                        'rgba(154,205,50)',    // YellowGreen
                        'rgba(70,130,180)',    // SteelBlue
                        'rgba(205,92,92)',     // IndianRed
                        'rgba(176,196,222)',   // LightSteelBlue
                        'rgba(255,140,0)',     // DarkOrange
                        'rgba(0,255,127)',     // SpringGreen
                        'rgba(147,112,219)'    // MediumPurple
                    ],
                }],
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
            }
        });
    </script>


</body>
</html>
