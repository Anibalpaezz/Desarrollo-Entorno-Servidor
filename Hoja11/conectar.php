<?php
    $conexion = mysqli_connect("localhost", "anibal", "nico", "inmobiliaria");

    if (!$conexion) {
        die("Error al conectar: " . mysqli_connect_error());
    }

?>