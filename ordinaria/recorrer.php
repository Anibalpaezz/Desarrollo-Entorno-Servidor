<?php
include("conexion.php");
include("funciones.php");

try {
    // Iniciar transacción
    $conexion->beginTransaction();

    // Obtener premios activos
    $premios = $conexion->prepare("SELECT premioid FROM premios WHERE fechai_validez < CURRENT_DATE AND fechaf_validez > CURRENT_DATE");
    $premios->execute();

    if ($premios->rowCount() > 0) {
        // Iterar sobre los premios
        while ($row1 = $premios->fetch(PDO::FETCH_ASSOC)) {
            // Obtener clientes
            $clientes = $conexion->prepare("SELECT clienteid FROM clientes WHERE clientes.clienteid NOT LIKE 1");
            $clientes->execute();

            if ($clientes->rowCount() > 0) {
                // Iterar sobre los clientes
                while ($row2 = $clientes->fetch(PDO::FETCH_ASSOC)) {
                    // Insertar cupones
                    $insercion = $conexion->prepare("INSERT INTO cupones (clienteid, premioid, fechai_validez, fechaf_validez) VALUES (:cliente, :premio, :hoy, :semana)");
                    $insercion->bindParam(":premio", $row1["premioid"], PDO::PARAM_STR);
                    $insercion->bindParam(":cliente", $row2["clienteid"], PDO::PARAM_STR);
                    $insercion->bindParam(":hoy", $fecha_actual, PDO::PARAM_STR);
                    $insercion->bindParam(":semana", $fecha_valida, PDO::PARAM_STR);

                    if (!$insercion->execute()) {
                        throw new Exception("Error al insertar cupones");
                    }
                }
            }
        }

        // Confirmar transacción si todo está bien
        $conexion->commit();
        echo "Proceso completado exitosamente.";
    } else {
        echo "No hay premios activos.";
    }
} catch (Exception $e) {
    // Revertir transacción en caso de error
    $conexion->rollBack();
    echo "Error: " . $e->getMessage();
}

include("conexion.php");
include("funciones.php");

function obtenerFechaActual() {
    return (new DateTime('now'))->format('Y-m-d');
}

function obtenerFechaValida() {
    return (new DateTime('now'))->add(new DateInterval('P7D'))->format('Y-m-d');
}

function insertarCupon($conexion, $clienteId, $premioId, $fechaActual, $fechaValida) {
    $insercion = $conexion->prepare("INSERT INTO cupones (clienteid, premioid, fechai_validez, fechaf_validez) 
                                    VALUES (:cliente, :premio, :hoy, :semana)");
    $insercion->bindParam(":premio", $premioId, PDO::PARAM_STR);
    $insercion->bindParam(":cliente", $clienteId, PDO::PARAM_STR);
    $insercion->bindParam(":hoy", $fechaActual, PDO::PARAM_STR);
    $insercion->bindParam(":semana", $fechaValida, PDO::PARAM_STR);

    return $insercion->execute();
}

function obtenerArticuloMax($conexion, $clienteId) {
    $articulo = $conexion->prepare("SELECT articuloid FROM compras 
                                    INNER JOIN itemcompras ON compras.compraid = itemcompras.compraid 
                                    WHERE clienteid LIKE :cliente 
                                    GROUP BY articuloid 
                                    ORDER BY SUM(unidades) DESC LIMIT 1");
    $articulo->bindParam(":cliente", $clienteId, PDO::PARAM_STR);

    return $articulo->execute() ? $articulo->fetchColumn() : false;
}

// ... (otras funciones)

$fecha_actual = obtenerFechaActual();
$fecha_valida = obtenerFechaValida();

$premios = $conexion->prepare("SELECT premioid FROM premios WHERE fechai_validez < CURRENT_DATE AND fechaf_validez > CURRENT_DATE");

try {
    if ($premios->execute() && $premios->rowCount() > 0) {
        while ($row1 = $premios->fetch(PDO::FETCH_ASSOC)) {
            $clientes = $conexion->prepare("SELECT clienteid FROM clientes WHERE clientes.clienteid NOT LIKE 1");

            if ($clientes->execute() && $clientes->rowCount() > 0) {
                while ($row2 = $clientes->fetch(PDO::FETCH_ASSOC)) {
                    if (insertarCupon($conexion, $row2["clienteid"], $row1["premioid"], $fecha_actual, $fecha_valida)) {
                        $articulo_max = obtenerArticuloMax($conexion, $row2["clienteid"]);
                        
                        // ... (continúa con el resto del código)
                    } else {
                        echo "No se pudo insertar el cupón para cliente " . $row2["clienteid"] . "<br>";
                    }
                }
            } else {
                echo "No hay clientes<br>";
            }
        }
    } else {
        echo "No hay premios disponibles<br>";
    }
} catch (PDOException $e) {
    echo "Error al ejecutar la consulta: " . $e->getMessage();
}
?>

