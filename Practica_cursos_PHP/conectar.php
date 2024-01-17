<?php
    $conexion = mysqli_connect("localhost", "anibal", "nico", "cursoscp");

    if (!$conexion) {
        die("Error al conectar: " . mysqli_connect_error());
    }
?>