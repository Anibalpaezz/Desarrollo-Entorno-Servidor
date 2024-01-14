<?php
include("conectar.php");
include("estilos.html");

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

$solicitantes = "SELECT s.dni, s.codigocurso, s.fechasolicitud, s.admitido, COUNT(*) AS total_admitido FROM solicitudes s
INNER JOIN solicitantes st ON s.dni = st.dni WHERE s.codigocurso = $codigo_curso GROUP BY st.dni ORDER BY total_admitido DESC, st.puntos DESC;";

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
} else {
    echo "No hay solicitantes para seleccionar o el curso ya está completo.";
}

mysqli_close($conexion);




// Consulta para obtener los solicitantes ordenados por preferencia
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



/* // Aquí puedes almacenar los DNI de los solicitantes seleccionados en un array
$solicitantes_seleccionados = array();

// Supongamos que $numero_plazas es el número de plazas disponibles en el curso
while ($fila = mysqli_fetch_assoc($resultado_solicitantes)) {
    $solicitantes_seleccionados[] = $fila['dni'];
    if (count($solicitantes_seleccionados) >= $fila['numeroplazas']) {
        break; // Si ya se han cubierto todas las plazas, sal del bucle
    }
}

// Actualizar la tabla de solicitudes marcando a los solicitantes como admitidos
foreach ($solicitantes_seleccionados as $dni) {
    $actualiza_tabla = "UPDATE solicitudes SET admitido = true WHERE dni = '$dni' AND codigocurso = $codigo_curso";
    mysqli_query($conexion, $actualiza_tabla);
}

// Redirigir a la página deseada (puedes cambiar 'pagina_destino' por la URL correcta)
header("Location: pagina_destino");
exit; */

?>