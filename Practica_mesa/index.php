<?php
include("PHP/conexion.php");

function horas() {
    $archivo = fopen("horas.txt", "r");

    if ($archivo === false) {
        echo "No se pudo abrir el archivo.\n";
        exit(1);
    }

    while (($linea = fgets($archivo)) !== false) {
        $horas[] = $linea;
    }

    fclose($archivo);
    return $horas;
}

function restaurante() {
    try {
        $consulta = conectarBD()->prepare("SELECT DISTINCT restaurante FROM mesa");
        if ($consulta->execute()) {
            echo "bien";
            $resultados = $consulta->fetchAll();
            return $resultados;
        }
    } catch (\Throwable $th) {
        throw $th;
    }
}

function comensales() {
    try {
        $consulta = conectarBD()->prepare("SELECT DISTINCT capacidad FROM mesa");
        if ($consulta->execute()) {
            echo "bien";
            $resultados = $consulta->fetchAll();
            return $resultados;
        }
    } catch (\Throwable $th) {
        throw $th;
    }
}


?>

<!DOCTYPE html>
<html>

<head>
    <title>Mesa-alvas las citas</title>
    <!-- <link rel="stylesheet" type="text/css" href="CSS/index.css"> -->
</head>

<body>
    <form action="plano.php" method="post">
        <select name="restaurante" id="restaurante">
            <?php
            $resultados = restaurante();

            if ($resultados) {
                foreach ($resultados as $row) {
                    echo "<option value='{$row['restaurante']}'>{$row['restaurante']}</option>";
                }
            } else {
                echo "<option value=''>No hay restaurantes disponibles</option>";
            }
            ?>
        </select>

        <select name="comensales" id="comensales">
            <?php
            $resultados = comensales();

            if ($resultados) {
                foreach ($resultados as $row) {
                    echo "<option value='{$row['capacidad']}'>{$row['capacidad']}</option>";
                }
            } else {
                echo "<option value=''>No hay restaurantes disponibles</option>";
            }
            ?>
        </select>

        <select name="horas" id="horas">
            <?php
            $horas = horas();

            if ($horas) {
                foreach ($horas as $linea) {
                    echo "<option value='{$linea}'>{$linea}</option>";
                }
            } else {
                echo "<option value=''>No hay horas disponibles</option>";
            }
            ?>
        </select>

        <input type="date" name="dia" id="dia">

        <button type="submit">Enviar</button>
    </form>
</body>

</html>