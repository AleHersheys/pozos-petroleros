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

    if($_SERVER['REQUEST_METHOD']==='POST'){
        $_SESSION['datos'] = $_POST;
        header('Location: '.$_SERVER['PHP_SELF']."?".$_SERVER['QUERY_STRING']);
        exit;
    }

    if(isset($_SESSION['datos'])){
        $_POST = $_SESSION['datos'];
        if(isset($_POST['fecha']) && isset($_POST['medicion'])){

            $fecha = $_POST['fecha'];
            $medicion = $_POST['medicion'];
    
            $peticion = peticion("INSERT INTO mediciones (pozo, fecha, medicion) VALUES ('$id', '$fecha', '$medicion')");
    
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
    <title>Añadir mediciones</title>
    <link rel="icon" href="./img/icon.png">
    <link rel="stylesheet" href="./style.css">
</head>
<body>
    <div class="contenedor">
        <h1>AÑADIR MEDICIONES</h1>
        <h2>Inserte la información requerida:</h2>
        <form method="post">
            <div class="form-group">
                <input type="number" required step = "any" min="1" name="medicion" placeholder="Valor de la medición" class="input__text">
                <input type="date" required name="fecha">
            </div>
            <div class="btn__group">
                <input type="submit" name="guardar" value="Guardar" class="btn btn__primary">
                <a href="index.php" class="btn btn__danger">Cancelar</a>
                
            </div>
        </form>
    </div>
</body>
</html>