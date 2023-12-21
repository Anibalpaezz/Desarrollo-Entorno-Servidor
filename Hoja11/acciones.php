<?php
include("conectar.php");
include("estilos.html");

session_start();

$usuario = $_SESSION['usuario'];
$valor = $_SESSION['permisos'];

echo "<h2>Bienvenido, " . $_SESSION['usuario'] . "!</h2>";

echo '<a href="consulta_noticias.php?id=1"><button class="button">Consultar Noticia 1</button></a>';
echo '<a href="consulta_noticias2.php?id=2"><button class="button">Consultar Noticia 2</button></a>';
echo '<a href="consulta_noticias3.php?id=3"><button class="button">Consultar Noticia 3</button></a>';
echo '<a href="encuesta.php?id=3"><button class="button">Votar en encuesta</button></a>';
echo '<a href="encuesta_resultados.php?id=3"><button class="button">Resultados encuesta</button></a>';

if ($valor == "1") {
    
    echo '<a href="eliminar_noticias.php"><button class="button">Borrar Noticia</button></a>';
    echo '<a href="insertar_noticias.php"><button class="button">Insertar Noticia</button></a>';
    echo '<a href="borrar_usuarios.php"><button class="button">Borrar Usuarios</button></a>';
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