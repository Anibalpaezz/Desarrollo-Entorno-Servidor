<?php
include("conectar.php");
include("estilos.html");

if(isset($_GET['codigo'])) {
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

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nombre = $_POST['nombre'];
    $abierto = isset($_POST['abierto']) ? 1 : 0;
    $numeroplazas = $_POST['numeroplazas'];
    $numeroSolicitudes = $_POST['numeroSolicitudes'];
    $plazoinscripcion = $_POST['plazoinscripcion'];

    $actualiza_cursos = "UPDATE cursos SET nombre='$nombre', abierto=$abierto, numeroplazas=$numeroplazas, numeroSolicitudes=$numeroSolicitudes, plazoinscripcion='$plazoinscripcion' WHERE codigo=$codigo";

    $resultado_actualiza = mysqli_query($conexion, $actualiza_cursos);

    if (!$resultado_actualiza) {
        die('Error en la actualización: ' . mysqli_error($conexion));
    }

    header('Location: cursos.php');
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Curso</title>
</head>
<body>
    <h1>Editar Curso</h1>
    <form method="post" action="">
        <label for="nombre">Nombre:</label>
        <input type="text" name="nombre" value="<?php echo $curso['nombre']; ?>"><br>

        <label for="abierto">Abierto:</label>
        <input type="checkbox" name="abierto" <?php echo ($curso['abierto'] ? 'checked' : ''); ?>><br>

        <label for="numeroplazas">Número de Plazas:</label>
        <input type="number" name="numeroplazas" value="<?php echo $curso['numeroplazas']; ?>"><br>

        <label for="numeroSolicitudes">Número de Solicitudes:</label>
        <input type="number" name="numeroSolicitudes" value="<?php echo $curso['numeroSolicitudes']; ?>"><br>

        <label for="plazoinscripcion">Plazo de Inscripción:</label>
        <input type="date" name="plazoinscripcion" value="<?php echo $curso['plazoinscripcion']; ?>"><br>

        <input type="submit" value="Guardar cambios">
    </form>
</body>
</html>
