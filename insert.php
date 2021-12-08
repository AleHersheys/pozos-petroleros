<?php
    session_start();
    include_once("./bdd.php");

    if($_SERVER['REQUEST_METHOD']==='POST'){
        $_SESSION['datos'] = $_POST;
        header('Location: '.$_SERVER['PHP_SELF']."?".$_SERVER['QUERY_STRING']);
        exit;
    }

    if(isset($_SESSION['datos'])){
        $_POST = $_SESSION['datos'];
        if(isset($_POST['nombre']) && isset($_POST['profundidad'])){

            $nombre = $_POST['nombre'];
            $profundidad = $_POST['profundidad'];
    
            $peticion = peticion("INSERT INTO pozos (nombre, profundidad) VALUES ('$nombre', '$profundidad')");
    
            if($peticion) echo "Hecho.";
            else echo "Error.";
        }
        unset($_SESSION['datos']);
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Nuevo Pozo Petrolero</title>
    <link rel="icon" href="./img/icon.png">
    <link rel="stylesheet" href="./style.css">
</head>
<body>
    <div class="contenedor">
        <h1>CREAR NUEVO POZO PETROLERO</h1>
        <h2>Inserte la información requerida:</h2>
        <form method="post">
            <div class="form-group">
                <input type="text" required name="nombre" placeholder="Nombre del pozo" class="input__text">
                <input type="number" required step = "any" min="1" name="profundidad" placeholder="Profundidad del pozo" class="input__text">
            </div>
            <div class="btn__group">
                <input type="submit" name="guardar" value="Guardar" class="btn btn__primary">
                <a href="index.php" class="btn btn__danger">Cancelar</a>
                
            </div>
        </form>
    </div>
</body>
</html>