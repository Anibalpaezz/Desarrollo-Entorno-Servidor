<?php
include("conectar.php");
include("estilos.html");

session_start();

if (!isset($_SESSION['usuario']) || !isset($_SESSION['permisos'])) {
    header('Location: principal.html');
    exit();
}

$usuario = $_SESSION['usuario'];
$valor = $_SESSION['permisos'];

function eliminarNoticias($conexion, $ids) {
    $ids_str = implode(',', $ids);
    $consulta = "DELETE FROM noticias WHERE id IN ($ids_str)";
    mysqli_query($conexion, $consulta);
}

$consulta = "SELECT * FROM noticias";
if ($resultado = mysqli_query($conexion, $consulta)) {
    echo "<div>";
    echo "<form method='post' action='" . htmlspecialchars($_SERVER["PHP_SELF"]) . "'>";
    echo "<table border='1'>";
    echo "<tr><th>ID</th><th>Título</th><th>Autor</th><th>Categoria</th><th>Fecha</th><th>Contenido</th><th>Eliminar</th></tr>";

    while ($fila = mysqli_fetch_row($resultado)) {
        echo "<tr>";
        echo "<td>$fila[0]</td>";
        echo "<td>$fila[1]</td>";
        echo "<td>$fila[2]</td>";
        echo "<td>$fila[3]</td>";
        echo "<td>$fila[4]</td>";
        echo "<td><img src='imagenes/$fila[5]'></td>";
        echo "<td><input type='checkbox' name='seleccion[]' value='$fila[0]'></td>";
        echo "</tr>";
    }

    echo "</table>";
    echo "<br>";
    echo "<button type='submit' name='borrar'>Borrar Seleccionados</button>";
    echo "</form>";
    echo '<a href="acciones.php"><button class="button">Volver</button></a>';
    echo "</div>";
    mysqli_free_result($resultado);

    if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['borrar']) && isset($_POST['seleccion'])) {
        $ids_a_eliminar = $_POST['seleccion'];
        eliminarNoticias($conexion, $ids_a_eliminar);
        header('Location: ' . $_SERVER['PHP_SELF']);
        exit();
    }
}

mysqli_close($conexion);
?>
