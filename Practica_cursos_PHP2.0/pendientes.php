<?php
include("conectar.php");
include("estilos.php");

// Supongamos que recibes el código del curso cerrado en el parámetro $_GET['codigo_curso_cerrado']
$codigo_curso = $_GET['codigo'];

/* $numero_iterador = "SELECT numeroplazas FROM cursos WHERE codigo = $codigo_curso";
$resultado_iterador = mysqli_query($conexion, $numero_iterador);

$solicitantes = "SELECT s.dni, s.codigocurso, s.fechasolicitud, s.admitido, COUNT(*) AS total_admitido FROM solicitudes s
INNER JOIN solicitantes st ON s.dni = st.dni WHERE s.codigocurso = 1 GROUP BY st.dni ORDER BY total_admitido DESC, st.puntos DESC;"; */

/* $solicitantes = "SELECT s.dni, s.apellidos, s.nombre
FROM solicitantes s
LEFT JOIN solicitudes so ON s.dni = so.dni
WHERE so.admitido = false OR so.admitido IS NULL
ORDER BY so.admitido ASC, s.puntos DESC
LIMIT (SELECT numeroplazas FROM cursos WHERE codigo = $codigo_curso);"; */

/* $resultado_solicitantes = mysqli_query($conexion, $solicitantes);

if ($resultado_solicitantes && mysqli_num_rows($resultado_solicitantes) > 0) {
    while ($fila = mysqli_fetch_assoc($resultado_solicitantes)) {
        $dni = $fila['dni'];
        $update_query = "UPDATE solicitudes SET admitido = true WHERE dni = '$dni' AND codigocurso = $codigo_curso;";
        mysqli_query($conexion, $update_query);
    }

    echo "Solicitantes seleccionados y actualizados exitosamente.";
} else {
    echo "No hay solicitantes para seleccionar o el curso ya está completo.";
}

mysqli_close($conexion); */


$numero_iterador = "SELECT numeroplazas FROM cursos WHERE codigo = $codigo_curso";
$resultado_iterador = mysqli_query($conexion, $numero_iterador);
$plazas_disponibles = mysqli_fetch_assoc($resultado_iterador)['numeroplazas'];

$solicitantes = "SELECT s.dni, s.codigocurso, s.fechasolicitud, s.admitido, 
COUNT(*) AS total_admitido FROM solicitudes s
INNER JOIN solicitantes st ON s.dni = st.dni 
WHERE s.codigocurso = $codigo_curso GROUP BY st.dni 
ORDER BY CASE WHEN st.dni IN (SELECT dni FROM solicitudes WHERE codigocurso != $codigo_curso) THEN 1 ELSE 0 END,
total_admitido DESC, st.puntos DESC;";

$resultado_solicitantes = mysqli_query($conexion, $solicitantes);

$num_plazas_asignadas = 0;

if ($resultado_solicitantes && mysqli_num_rows($resultado_solicitantes) > 0) {
    while ($fila = mysqli_fetch_assoc($resultado_solicitantes)) {
        if ($num_plazas_asignadas < $plazas_disponibles) {
            $dni = $fila['dni'];
            $update_query = "UPDATE solicitudes SET admitido = true WHERE dni = '$dni' AND codigocurso = $codigo_curso;";
            mysqli_query($conexion, $update_query);
            $num_plazas_asignadas++;
        } else {
            break;
        }
    }

    echo "Solicitantes seleccionados y actualizados exitosamente.";
    echo '<a href="cursos.php"><button class="button">Volver</button></a>';

} else {
    echo "No hay solicitantes para seleccionar o el curso ya está completo.";
    echo '<a href="cursos.php"><button class="button">Volver</button></a>';
}

mysqli_close($conexion);

/* $solicitantes = "
    SELECT s.dni, s.apellidos, s.nombre
    FROM solicitantes s
    LEFT JOIN solicitudes sol ON s.dni = sol.dni AND sol.admitido = true
    LEFT JOIN cursos c ON sol.codigocurso = c.codigo
    WHERE sol.dni IS NULL
    AND c.codigo = $codigo_curso
    ORDER BY s.puntos DESC
";

$resultado_solicitantes = mysqli_query($conexion, $solicitantes); */

/* 

$solicitantes_seleccionados = array();


while ($fila = mysqli_fetch_assoc($resultado_solicitantes)) {
    $solicitantes_seleccionados[] = $fila['dni'];
    if (count($solicitantes_seleccionados) >= $fila['numeroplazas']) {
        break; // Si ya se han cubierto todas las plazas, sal del bucle
    }
}


foreach ($solicitantes_seleccionados as $dni) {
    $actualiza_tabla = "UPDATE solicitudes SET admitido = true WHERE dni = '$dni' AND codigocurso = $codigo_curso";
    mysqli_query($conexion, $actualiza_tabla);
}


header("Location: pagina_destino");
exit; */

?> */