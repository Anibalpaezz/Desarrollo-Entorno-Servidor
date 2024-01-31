<?php
include("conexion.php");

session_start();
if (!isset($_SESSION['usuario'])) {
    header('Location: ../index.html');
}

if ($_SERVER["REQUEST_METHOD"] === "GET") {

        $coste = $conexion->prepare("SELECT sum(precio) FROM productos INNER JOIN item_cesta ON productos.producto_ID = item_cesta.producto_ID INNER JOIN cesta ON item_cesta.cesta_ID = cesta.cesta_ID WHERE email = :usuario");
        $coste->bindParam(":usuario", $_SESSION['usuario']);

        if ($coste->execute()) {
            $suma = $coste->fetchColumn();

            $fecha_actual = (new DateTime('now'))->format('Y-m-d');
            $fecha_prevista = (new DateTime('now'))->add(new DateInterval('P5D'))->format('Y-m-d');

            $pedido = $conexion->prepare("INSERT INTO pedidos (email, fecha_pedido, fecha_entrega, total_pedido, entregado) VALUES (:usuario, :fecha_actual, :fecha_prevista, :suma, false)");
            $pedido->bindParam(':usuario', $_SESSION['usuario']);
            $pedido->bindParam(':fecha_actual', $fecha_actual);
            $pedido->bindParam(':fecha_prevista', $fecha_prevista);
            $pedido->bindParam(':suma', $suma);

            if ($pedido->execute()) {
                echo "Pedido insertado correctamente.";
            }

            
        }
}
?>
