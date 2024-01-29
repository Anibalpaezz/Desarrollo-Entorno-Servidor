<?php
include("conexion.php");

session_start();
if (!isset($_SESSION['usuario'])) {
    header('Location: ../index.html');
}

$id = isset($_GET['id']) ? $_GET['id'] : null;

if ($id) {
    // Consulta para obtener la información del producto
    $consultaProducto = $conexion->prepare("SELECT * FROM productos WHERE producto_ID = ?");
    $consultaProducto->bindParam(1, $id);
    $consultaProducto->execute();
    $row = $consultaProducto->fetch(PDO::FETCH_ASSOC);

    // Consulta para verificar las compras del cliente en los últimos 30 días
    $fechaLimite = date('Y-m-d', strtotime('-30 days'));
    $consultaCompras = $conexion->prepare("SELECT COUNT(*) as totalCompras FROM pedidos WHERE email = ? AND fecha_pedido >= ?");
    $consultaCompras->bindParam(1, $_SESSION['usuario']); // Ajusta el campo según tu estructura de base de datos
    $consultaCompras->bindParam(2, $fechaLimite);
    $consultaCompras->execute();
    $resultadoCompras = $consultaCompras->fetch(PDO::FETCH_ASSOC);
    $totalCompras = $resultadoCompras['totalCompras'];

    // Muestra la información del producto
    echo '<h1>' . $row['nombre'] . '</h1>';
    echo '<img src="' . $row['imagen'] . '" alt="' . $row['nombre'] . '">';
    echo '<p>' . $row['descripcion'] . '</p>';

    // Modifica el formulario según la cantidad de productos comprados
    /* echo $totalCompras; */
    echo '<form action="añadir_carrito.php" method="post">';
    echo '<input type="number" id="numero" name="numero" min="0" max="' . ($totalCompras == 2 ? 0 : ($totalCompras == 1 ? 1 : 2)) . '" step="1">';
    echo '</form>';
    echo '<a href="añadir_carrito.php"><button>Comprar</button></a>';
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
<!-- <form action="añadir_carrito.php" method="post">
    <input type="number" id="numero" name="numero" min="1" max="2" step="1">
    </form>
    <a href="añadir_carrito.php"><button>Comprar</button></a> -->
</body>
</html>
