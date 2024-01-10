<?php
include("conectar.php");
include("estilos.html");

session_start();

$usuario = $_SESSION['usuario'];
$valor = $_SESSION['permisos'];

echo "<h2>Bienvenido, " . $_SESSION['usuario'] . "!</h2>";

if ($_SESSION['permisos'] == 1) {
    echo '<a href="cursos.php"><button type="button">Todos los cursos</button></a>';
    echo '<a href="solicitud.php"><button type="button">Crear solicitante(Prueba)</button></a>';
} else {
    echo '<a href="cursos.php"><button type="button">Cursos disponibles</button></a>';
}

echo '<a href="cerrar_sesion.php"><button class="button">Cerrar sesion</button></a>';
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Menú de Inicio</title>
    <link rel="stylesheet" href="estilos.css">
</head>

<body>

</body>

</html>