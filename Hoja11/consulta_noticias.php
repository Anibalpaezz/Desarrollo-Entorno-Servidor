<?php
include("conectar.php");
include("estilos.html");

session_start();

if (!isset($_SESSION['usuario']) || !isset($_SESSION['permisos'])) {
    header('Location: index.html');
    exit();
}

$usuario = $_SESSION['usuario'];
$valor = $_SESSION['permisos'];

$consulta = "SELECT * FROM noticias";
if ($resultado = mysqli_query($conexion, $consulta)) {
    echo "<table border='1'>";
    echo "<tr><th>ID</th><th>Título</th><th>Autor</th><th>Categoria</th><th>Fecha</th><th>Contenido</th></tr>";

    while ($fila = mysqli_fetch_row($resultado)) {
        echo "<tr>";
        echo "<td>$fila[0]</td>";
        echo "<td>$fila[1]</td>";
        echo "<td>$fila[2]</td>";
        echo "<td>$fila[3]</td>";
        echo "<td>$fila[4]</td>";
        echo "<td><img src='imagenes/$fila[5]'></td>";
        echo "</tr>";
    }

    echo "</table>";
    echo '<a href="acciones.php"><button class="button">Volver</button></a>';
    mysqli_free_result($resultado);
}

mysqli_close($conexion);

?>