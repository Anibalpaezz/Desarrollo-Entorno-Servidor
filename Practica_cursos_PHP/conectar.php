<?php
//Script de creacion de la conex a la base de datos
$conexion = mysqli_connect("localhost", "anibal", "nico", "cursoscp");

if (!$conexion) {
    die("Error al conectar: " . mysqli_connect_error());
}
?>