<?php
include("conectar.php");
include("estilos.html");

if (isset($_GET['codigo'])) {
    $codigo = $_GET['codigo'];

    // Consulta para obtener DNIs y puntos de los solicitantes para el curso dado
    $consultaSolicitantes = "
        SELECT s.dni, s.puntos
        FROM solicitudes s
        INNER JOIN solicitantes sa ON s.dni = sa.dni
        WHERE s.codigocurso = $codigo
    ";

    $resultadoSolicitantes = mysqli_query($conexion, $consultaSolicitantes);

    if ($resultadoSolicitantes) {
        // Iterar sobre los resultados y mostrar los DNIs y puntos
        while ($row = mysqli_fetch_assoc($resultadoSolicitantes)) {
            $dni = $row['dni'];
            $puntos = $row['puntos'];
            echo "DNI: $dni, Puntos: $puntos<br>";
        }
    } else {
        die('Error en la consulta: ' . mysqli_error($conexion));
    }
} else {
    die('Código de curso no proporcionado');
}
?>
