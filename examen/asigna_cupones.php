<?php
include("conexion.php");
include("funciones.php");

/* $consulta = $conexion->prepare("SELECT premioid FROM premios WHERE fechai_validez < CURRENT_DATE AND fechaf_validez > CURRENT_DATE");
$consulta->execute();
$valor = $consulta->fetchColumn();

$consulta2 = $conexion->prepare("SELECT clienteid from cupones where premioid = :valor");
$consulta2->bindParam(":valor", $valor);
$consulta2->execute();
$valor2 = $consulta2->fetchColumn(); */

$fecha_actual = (new DateTime('now'))->format('Y-m-d');
$fecha_valida = (new DateTime('now'))->add(new DateInterval('P7D'))->format('Y-m-d');

$premios = $conexion->prepare("SELECT premioid FROM premios WHERE fechai_validez < CURRENT_DATE AND fechaf_validez > CURRENT_DATE");
try {
    if ($premios->execute()) {
        if ($premios->rowCount() > 0) {
            while ($row1 = $premios->fetch(PDO::FETCH_ASSOC)) {
                $clientes = $conexion->prepare("SELECT clienteid FROM clientes WHERE clientes.clienteid NOT LIKE 1");
                if ($clientes->execute()) {
                    if ($clientes->rowCount() > 0) {
                        while ($row2 = $clientes->fetch(PDO::FETCH_ASSOC)) {
                            $insercion = $conexion->prepare("INSERT INTO cupones (clienteid, premioid, fechai_validez, fechaf_validez) VALUES (:cliente, :premio, :hoy, :semana)");

                            $insercion->bindParam(":premio", $row1["premioid"], PDO::PARAM_STR);
                            $insercion->bindParam(":cliente", $row2["clienteid"], PDO::PARAM_STR);
                            $insercion->bindParam(":hoy", $fecha_actual, PDO::PARAM_STR);
                            $insercion->bindParam(":semana", $fecha_valida, PDO::PARAM_STR);

                            if ($insercion->execute()) {
                                $clientes2 = $conexion->prepare("SELECT clienteid FROM clientes");
                                if ($clientes2->execute()) {
                                    if ($clientes2->rowCount() > 0) {
                                        while ($row3 = $clientes2->fetch(PDO::FETCH_ASSOC)) {
                                            $articulo = $conexion->prepare("SELECT articuloid from compras inner join itemcompras on compras.compraid = itemcompras.compraid where clienteid like :cliente group by articuloid order by sum(unidades) desc limit 1;");
                                            $articulo->bindParam(":cliente", $row3["clienteid"], PDO::PARAM_STR);

                                            if ($articulo->execute()) {
                                                $articulo_max = $articulo->fetchColumn();
                                                $nombre = $conexion->prepare("SELECT anombre, amarca from articulos where articuloid = :articulo");
                                                $nombre->bindParam(":articulo", $articulo_max, PDO::PARAM_STR);

                                                if ($nombre->execute()) {
                                                    $row4 = $nombre->fetch(PDO::FETCH_ASSOC);
                                                    $descripcion = "25% descuento en " . $row4['anombre'] . " " . $row4['amarca'];
                                                    /* echo $descripcion . $row3['clienteid'] ."<br>"; */

                                                    $id_premio = comprueba_premio($descripcion, $conexion);
                                                    if (!$id_premio) {
                                                        $inser_premio = $conexion->prepare("INSERT INTO premios (ddescrip, fechai_validez, fechaf_validez) VALUES (:descrip, null , null)");
                                                        $inser_premio->bindParam(":descrip", $descripcion, PDO::PARAM_STR);

                                                        $id_premio = $conexion->lastInsertId();
                                                    }

                                                    $insert_cupon = $conexion->prepare("INSERT INTO cupones (clienteid, premioid, fechai_validez, fechaf_validez) VALUES (:clienteid, :premioid, :hoy, :valida)");

                                                    $insert_cupon->bindParam(":clienteid", $row3["clienteid"], PDO::PARAM_STR);
                                                    $insert_cupon->bindParam(":premioid", $id_premio, PDO::PARAM_STR);
                                                    $insert_cupon->bindParam(":hoy", $fecha_actual, PDO::PARAM_STR);
                                                    $insert_cupon->bindParam(":valida", $fecha_valida, PDO::PARAM_STR);


                                                    /* $insertar = $conexion->prepare("INSERT INTO premios (ddescrip, fechai_validez, fechaf_validez) values (:nombre, :hoy, :valida)");

                                                    $insertar->bindParam(":nombre", $row2["clienteid"], PDO::PARAM_STR);
                                                    $insertar->bindParam(":cliente", $row1["premioid"], PDO::PARAM_STR);
                                                    $insertar->bindParam(":hoy", $fecha_actual, PDO::PARAM_STR);
                                                    $insertar->bindParam(":valida", $fecha_valida, PDO::PARAM_STR); */

                                                }
                                            }
                                        }
                                    }
                                }
                            } else {
                                echo "No" . $insercion;
                            }
                        }
                    } else {
                        echo "No hay premios";
                    }
                } else {
                    echo "Error en clientes";
                }
            }
        } else {
            echo "No hay premios";
        }
    } else {
        echo "Error en premios";
    }
} catch (PDOException $e) {
    echo "Error al ejecutar la consulta: " . $e->getMessage();
}



?>