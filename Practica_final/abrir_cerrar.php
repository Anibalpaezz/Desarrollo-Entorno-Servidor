<?php
include("conectar.php");
include("estilos.php");

if(isset($_GET['codigo'])) {
    $codigo = $_GET['codigo'];
    $abrir = $_GET['abrir'];
    $cerrar = $_GET['cerrar'];

    $codigo_curso = "SELECT * FROM cursos WHERE codigo = $codigo";
    $resultado_codigo = mysqli_query($conexion, $codigo_curso);

    if ($resultado_codigo && mysqli_num_rows($resultado_codigo) > 0) {
        if ($abrir) {
            $abrir_curso = "UPDATE cursos SET abierto = true WHERE codigo = $codigo";
            $resultado_abrir = mysqli_query($conexion, $abrir_curso);

            if (!$resultado_abrir) {
                die('Error en la actualización: ' . mysqli_error($conexion));
            }

            header('Location: cursos.php');
            exit;
        } else if ($cerrar) {
            $cerrar_curso = "UPDATE cursos SET abierto = false WHERE codigo = $codigo";
            $resultado_cerrar = mysqli_query($conexion, $cerrar_curso);

            if (!$resultado_cerrar) {
                die('Error en la actualización: ' . mysqli_error($conexion));
            }

            header('Location: pendientes.php?codigo=' . $codigo);
            exit;
        }
    } else {
        die('Curso no encontrado');
    }
} else {
    die('Código de curso no proporcionado');
}
?>
