<?php
    $host = "localhost";
    $bd = "cursoscp";
    $usuario = "anibal";
    $pass = "nico";

    try {
        $conexion = new PDO("mysql:host=$host;dname=$bd", $usuario, $pass);
        $conexion -> setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        echo "Conexion correcta";
    } catch (PDOException $e) {
        echo "Error de conex" . $e -> getMessage();
    }
?>