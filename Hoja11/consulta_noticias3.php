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
$categorias = mysqli_query($conexion, "SELECT DISTINCT categoria FROM noticias");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $categoriaSeleccionada = isset($_POST['categoria']) ? $_POST['categoria'] : 'Todas';

    if ($categoriaSeleccionada === 'Todas') {
        $consulta = "SELECT * FROM noticias";
    } else {
        $consulta = "SELECT * FROM noticias WHERE categoria = '$categoriaSeleccionada'";
    }

    if ($resultado = mysqli_query($conexion, $consulta)) {
        echo "<table border='1'>";
        echo "<tr><th>ID</th><th>Título</th><th>Autor</th><th>Fecha</th><th>Categoría</th><th>Contenido</th></tr>";

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
        mysqli_free_result($resultado);
    }
}

mysqli_close($conexion);


?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <title>Consulta de Noticias</title>
</head>

<body>

    <form method="post" action="consulta_noticias3.php">
        <label for="categoria">Seleccione una categoría:</label>
        <select name="categoria" id="categoria">
            <option value="Todas">Todas</option>
            <?php

            while ($row = mysqli_fetch_assoc($categorias)) {
                $categoria = $row['categoria'];
                echo "<option value='$categoria'>$categoria</option>";
            }
            ?>
        </select>
        <input type="submit" value="Mostrar noticias">
    </form>
    <a href="acciones.php"><button class="button">Volver</button></a>

</body>

</html>