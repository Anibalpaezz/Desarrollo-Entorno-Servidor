<?php
include("conectar.php");
include("estilos.html");

session_start();

$usuario = $_SESSION['usuario'];
$valor = $_SESSION['permisos'];
$fecha_solicitud = (new DateTime('now'))->format('Y-m-d');

if (isset($_GET['codigo'])) {
    $codigo = $_GET['codigo'];

    $codigo_curso = "SELECT * FROM cursos WHERE codigo = $codigo";
    $resultado_codigo = mysqli_query($conexion, $codigo_curso);

    if ($resultado_codigo && mysqli_num_rows($resultado_codigo) > 0) {
        $curso = mysqli_fetch_assoc($resultado_codigo);
    } else {
        die('Curso no encontrado');
    }
} else {
    die('Código de curso no proporcionado');
}

$dni_nombre = "SELECT dni FROM solicitantes WHERE nombre = '$usuario'";
$resultado_dni = mysqli_query($conexion, $dni_nombre);

if ($row = mysqli_fetch_assoc($resultado_dni)) {
    $dni = $row['dni'];

    $insert_solicitud = "INSERT INTO solicitudes (dni, codigocurso, fechasolicitud)
    VALUES ('$dni', '$codigo', '$fecha_solicitud')";
    $resultado_solicitud = mysqli_query($conexion, $insert_solicitud);

    if ($resultado_solicitud) {
        echo "Correcto";
    } else {
        die('Error al ejecutar la consulta de inserción: ' . mysqli_error($conexion));
    }
} else {
    die('Error al obtener el DNI del usuario');
}

mysqli_close($conexion);
?>
