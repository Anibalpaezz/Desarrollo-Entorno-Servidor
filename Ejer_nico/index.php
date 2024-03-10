<?php
include("conexion.php");

try {
    $conexion = conectarBD();

    $stock_productos = $conexion->prepare("SELECT * FROM productos WHERE cantidad_stock < 25");

    $mejores_proveedores = $conexion->prepare("SELECT id FROM proveedores WHERE calidad_producto = 'Alta' ORDER BY tiempo_entrega_dias ASC LIMIT 1;
    ");
    $mejores_proveedores->execute();
    $resul_proveedores = $mejores_proveedores->fetch(PDO::FETCH_ASSOC);

    $cantidad_objetivo = 50;

    if ($stock_productos->execute() && $stock_productos->rowCount() > 0) {
        $result_productos = $stock_productos->fetchAll(PDO::FETCH_ASSOC);
        foreach ($result_productos as $row) {
            echo $row["id"] . " ";
            echo $row["nombre"] . " ";
            echo $row["cantidad_stock"] . "<br>";

            $diferencia = $cantidad_objetivo - $row["cantidad_stock"];
            $precio_total = $diferencia * $row['precio_unitario'];

            try {
                $pedir = $conexion->prepare("INSERT INTO ordenes_compra (id_producto, id_proveedor, cantidad_comprada, precio_total) VALUES (:id_producto, :id_proveedor, :cantidad_comprada, :precio_total)");
            $pedir->bindParam(":id_producto", $row["id"], PDO::PARAM_INT);
            $pedir->bindParam(":id_proveedor", $resul_proveedores['id'], PDO::PARAM_INT);
            $pedir->bindParam(":cantidad_comprada", $diferencia, PDO::PARAM_INT);
            $pedir->bindParam(":precio_total", $precio_total, PDO::PARAM_INT);

            if ($pedir->execute()) {
                echo "si";
            } else {
                echo "no";
            }
            } catch (PDOException $e) {
                die("Error al conectar: " . $e->getMessage());
            }
        }

        echo "se han insertado";
    } else {
        echo "No hay productos con stock inferior a 25.";
    }
} catch (PDOException $e) {
    die("Error al conectar: " . $e->getMessage());
}
