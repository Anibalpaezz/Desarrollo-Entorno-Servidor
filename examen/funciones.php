<?php
function comprueba_premio($descripcion, $conexion)
{
    $consulta = $conexion->prepare("SELECT premioid FROM premios WHERE ddescrip LIKE :descrip");
    $consulta->bindParam(":descrip", $descripcion, PDO::PARAM_STR);

    if ($consulta->execute()) {
        if ($consulta->rowCount() > 0) {
            return $consulta->fetchColumn();
        }
        return false;
    } else {
        return false;
    }
}

?>