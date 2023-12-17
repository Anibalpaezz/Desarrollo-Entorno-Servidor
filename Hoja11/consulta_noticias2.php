<?php
include("conectar.php");
include("estilos.html");

$noticiasPorPagina = 2;

$paginaActual = isset($_GET['pagina']) ? $_GET['pagina'] : 1;

$offset = ($paginaActual - 1) * $noticiasPorPagina;

$consulta = "SELECT * FROM noticias LIMIT $offset, $noticiasPorPagina";

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
        echo "<td><img src='$fila[5]'></td>";
        echo "</tr>";
    }

    echo "</table>";

    $totalNoticias = mysqli_num_rows(mysqli_query($conexion, "SELECT * FROM noticias"));

    $totalPaginas = ceil($totalNoticias / $noticiasPorPagina);

    echo "<div>";
    for ($i = 1; $i <= $totalPaginas; $i++) {
        echo "<a href='consulta_noticias2.php?pagina=$i'>$i</a> ";
    }
    echo "</div>";

    mysqli_free_result($resultado);
}

mysqli_close($conexion);
?>
