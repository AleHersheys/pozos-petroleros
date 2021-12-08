<?php
    include_once("./bdd.php");

    if($_SERVER['REQUEST_METHOD']==='GET'){
        if(isset($_GET['id']) && !empty($_GET['id'])) {
            $peticion4 = peticion("DELETE FROM pozos WHERE id_pozo = '{$_GET['id']}'");
            $peticion5 = peticion("DELETE FROM mediciones WHERE pozo = '{$_GET['id']}'");
        }
    }

    $peticion = peticion('SELECT * FROM pozos');
    $datospozo = [];

    if(mysqli_num_rows($peticion) > 0) {
        while($array = mysqli_fetch_array($peticion)) {
           array_push($datospozo, $array);
        }
    }

    $peticion2 = peticion('SELECT * FROM mediciones ORDER BY pozo');
    $datosmediciones = [];
    
    if(mysqli_num_rows($peticion2) > 0) {
        while($array = mysqli_fetch_array($peticion2)) {
           $peticion3 = peticion("SELECT nombre FROM pozos WHERE id_pozo = '{$array['pozo']}'");
           $nombrepozo = mysqli_fetch_array($peticion3);
           $array['nombre'] = $nombrepozo['nombre'];
           array_push($datosmediciones, $array);
        }
    }
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mediciones de Pozos Petroleros</title>
    <link rel="icon" href="./img/icon.png">
    <link rel="stylesheet" href="./style.css">
</head>
<body>
    <h1>Aplicación web en PHP para la toma de mediciones de manómetros de pozos petroleros</h1>
    <div class="contenedor">
        <h3>Esta aplicación le permite hacer registro de pozos petroleros y su información además de mostrar un gráfico con el historial.</h3>
        <div class="barra__buscador">
            <form action="" class="formulario" method="post">
                <a href="insert.php" class="btn btn__nuevo">Nuevo</a>
            </form>
        </div>
        <table>
            <h2>Pozos:</h2>
                <?php if(count($datospozo) > 0): ?>
                    <thead>
                        <tr class="head">
                            <td>Id:</td>
                            <td>Nombre:</td>
                            <td>Profundidad:</td>
                            <td colspan="2">Acción:</td>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach($datospozo as $pozo): ?>
                            <tr class="tabla">
                                <td><?= $pozo['id_pozo'] ?></td>
                                <td><?= $pozo['nombre'] ?></td>
                                <td><?= $pozo['profundidad'] ?></td>
                                <td class="boton"><a href="./mediciones.php?id=<?php echo $pozo['id_pozo'] ?>">Añadir mediciones</a></td>
                                <td class="boton"><a href="./grafic.php?id=<?php echo $pozo['id_pozo'] ?>">Gráfica</a></td>
                                <td class="boton"><a href="./index.php?id=<?php echo $pozo['id_pozo'] ?>">Borrar</a></td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                <?php else:?>
                    <h3>No se encontró nada.</h3>
                <?php endif; ?>
        </table>
        <table>
            <h2>Mediciones:</h2>
                <?php if(count($datosmediciones) > 0): ?>
                    <thead>
                        <tr class="head">
                        <td>Id:</td>
                        <td>Nombre:</td>
                        <td>Valor:</td>
                        <td>Fecha:</td>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach($datosmediciones as $mediciones): ?>
                            <tr class="tabla">
                                <td><?= $mediciones['id_medicion'] ?></td>
                                <td><?= $mediciones['nombre'] ?></td>
                                <td><?= $mediciones['medicion'] ?></td>
                                <td><?= $mediciones['fecha'] ?></td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                <?php else:?>
                    <h3>No se encontró nada.</h3>
                <?php endif; ?>
        </table>
    </div>
</body>
</html>