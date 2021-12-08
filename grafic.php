<?php
    session_start();
    include_once("./bdd.php");

    $id = '';

    if($_SERVER['REQUEST_METHOD']==='GET'){
        if(isset($_GET['id']) && !empty($_GET['id'])) {
           $id = $_GET['id'];
        } else {
            header('Location:index.php');
        }
    }

    $peticion = peticion("SELECT * FROM mediciones WHERE pozo = '$id'");
    $datosmediciones = [];
    $fechas = [];
    $valores = [];
    
    if(mysqli_num_rows($peticion) > 0) {
        while($array = mysqli_fetch_array($peticion)) {
           array_push($datosmediciones, $array);
           array_push($fechas, $array['fecha']);
           array_push($valores, $array['medicion']);
        }
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gráficos de Pozos Petroleros</title>
    <link rel="icon" href="./img/icon.png">
    <link rel="stylesheet" href="./style.css">
</head>
<body>
    <canvas id = "lineChart" height = "400" width = "400"></canvas>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        const CHART = document.getElementById("lineChart");
        console.log(CHART);
        let lineChart = new Chart(CHART, {
            type: "line",
            data: {
                labels: [<?php echo '"'.implode('","',  $fechas ).'"' ?>],
                datasets: [{
                    label: 'Gráfica de pozos petroleros',
                    data: [<?php echo '"'.implode('","',  $valores ).'"' ?>],
                    fill: false,
                    borderColor: 'rgb(75, 192, 192)',
                    tension: 0.1,
                    backgroundColor: 'rgb(255, 255, 255, 1)',
                }]
        }
    })
    </script>
</body>
</html>