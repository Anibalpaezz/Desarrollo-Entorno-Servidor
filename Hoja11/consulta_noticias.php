<?php
    include("conectar.php");

    $consulta = "SELECT * FROM noticias";
    if ($resultado = mysqli_query($conexion, $consulta)) {
        while ($fila = mysqli_fetch_row($resultado)) {
            printf("%s, %s, %s, %s, %s, %s", $fila[0], $fila[1], $fila[2], $fila[3], $fila[4], $fila[5]);
            echo "<br><br>";
        }
        mysqli_free_result($resultado);
    }
    mysqli_close($conexion);
?>