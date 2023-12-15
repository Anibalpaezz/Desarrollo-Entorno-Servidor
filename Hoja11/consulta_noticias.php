<?php
    include("conectar.php");
    include("estilos.html");

    $consulta = "SELECT * FROM noticias";
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
        mysqli_free_result($resultado);
    }
    
    mysqli_close($conexion);
?>
