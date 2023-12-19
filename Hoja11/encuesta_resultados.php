<?php
include("conectar.php");
include("estilos.html");

$recuento_si = "SELECT votos1 FROM votos";
$recuento_no = "SELECT votos2 FROM votos";
$respuesta_si = mysqli_query($conexion, $recuento_si);
$respuesta_no = mysqli_query($conexion, $recuento_no);

if ($respuesta_si && $respuesta_no) {
    $si_correcto = mysqli_fetch_assoc($respuesta_si);
    $no_correcto = mysqli_fetch_assoc($respuesta_no);

    $valor_si = $si_correcto["votos1"];
    $valor_no = $no_correcto["votos2"];
}

$total = $valor_si + $valor_no;
$porcentaje_si = number_format((($valor_si / $total) * 100), 2);
$porcentaje_no = number_format((($valor_no / $total) * 100), 2);

mysqli_close($conexion);
?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tabla con Barra de Progreso</title>
</head>

<body>
    <h1>Encuesta. Resultados de la encuesta</h1>

    <table>
        <thead>
            <tr>
                <th>Respuesta</th>
                <th>Votos</th>
                <th>Porcentaje</th>
                <th>Representación Gráfica</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td>Si</td>
                <td>
                    <?php echo $valor_si ?>
                </td>
                <td>
                    <?php echo $porcentaje_si ?>
                </td>
                <td>
                    <progress value="<?php echo $porcentaje_si ?>" max="100"></progress>
                    <span>
                        <?php echo $porcentaje_si ?>
                    </span>
                </td>
            </tr>
            <tr>
                <td>No</td>
                <td>
                    <?php echo $valor_no ?>
                </td>
                <td>
                    <?php echo $porcentaje_no ?>
                </td>
                <td>
                    <progress value="<?php echo $porcentaje_no ?>" max="100"></progress>
                    <span>
                        <?php echo $porcentaje_no ?>
                    </span>
                </td>
            </tr>
        </tbody>
    </table>

    <p>Numero total de votos emitidos:
        <?php echo $total ?>
    </p>

    <a href="encuesta.php"><button class="button">Pagina de votacion</button></a>
    <a href="acciones.php"><button class="button">Volver</button></a>
</body>

</html>