<?php
include("conexion.php");
$id = isset($_GET['id']) ? $_GET['id'] : null;

if ($id) {
    $consulta = $conexion->prepare("SELECT * FROM productos WHERE producto_ID = ?");
    $consulta->bindParam(1, $id);
    $consulta->execute();
    $row = $consulta->fetch(PDO::FETCH_ASSOC);

    echo '<h1>' . $row['nombre'] . '</h1>';
    echo '<img src="' . $row['imagen'] . '" alt="' . $row['nombre'] . '">';
    echo '<p>' . $row['descripcion'] . '</p>';
} else {
    echo 'ID no proporcionado.';
}
?>
