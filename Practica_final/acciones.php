<?php

include("conectar.php");
include("estilos.php");

session_start();
if(!isset($_SESSION['usuario'])){
    header('Location: index.html');
}

$usuario = $_SESSION['usuario'];
$valor = $_SESSION['permisos'];


echo "<h2>Bienvenido, " . $_SESSION['usuario'] . "!</h2>";

if ($_SESSION['permisos'] == 1) {
    echo '<a href="cursos.php"><button type="button">Todos los cursos</button></a>';
    echo '<a href="solicitud.php"><button type="button">Crear solicitante(Prueba)</button></a>';
    echo '<a href="solicitudes.php"><button type="button">Ver solicitudes</button></a>';
} else if ($_SESSION['permisos'] == 0) {
    echo '<a href="cursos.php"><button type="button">Cursos disponibles</button></a>';
}

echo '<a href="cerrar_sesion.php"><button class="button">Cerrar sesion</button></a>';

?>