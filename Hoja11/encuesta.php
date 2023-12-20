<?php
include("conectar.php");
include("estilos.html");

$respuesta = $_POST['respuesta'];

if ($respuesta === 'votos1' || $respuesta === 'votos2') {
    $añadir_resultados = "UPDATE votos SET $respuesta = $respuesta + 1";
    $añadido = mysqli_query($conexion, $añadir_resultados);

    
} else {
    
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Encuesta</title>
</head>
<body>
    <h1>Encuesta</h1>
    <p>¿Cree usted que el precio de la vivienda seguirá subiendo al ritmo actual?</p>
    <form action="encuesta.php" method="post">
        <label for="si">Si</label>
        <input type="radio" name="respuesta" id="si" value="votos1">

        <label for="no">No</label>
        <input type="radio" name="respuesta" id="no" value="votos2">

        <button type="submit">Enviar</button>
        
    </form>
    <button class="button"><a style="color: white;" href="acciones.php">Volver</a></button>
    <button class="button"><a style="color: white;" href="encuesta_resultados.php">resultados</a></button>
</body>
</html>
