<?php
include("conexion.php");

session_start();
if(!isset($_SESSION['usuario'])){
    header('Location: ../index.html');
}
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
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $row['nombre'] ?></title>
    <link rel="stylesheet" href="../CSS/mostrar_jabon.css">
</head>
<body>
    <a href="añadir_carrito.php"><button>Comprar</button></a>
</body>
</html>
