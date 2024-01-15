<?php
    include("conectar.php");
    include("estilos.html");
    
    session_start();
    if (!isset($_SESSION['usuario'])) {
        header('Location: index.html');
    }

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $nombre = $_POST['nombre'];
        $abierto = isset($_POST['abierto']) ? 1 : 0;
        $numeroplazas = $_POST['numeroplazas'];
        $numeroSolicitudes = $_POST['numeroSolicitudes'];
        $plazoinscripcion = $_POST['plazoinscripcion'];
    
        $crea_cursos = "INSERT INTO cursos (nombre, abierto, numeroplazas, numeroSolicitudes, plazoinscripcion) VALUES ('$nombre', $abierto, $numeroplazas, $numeroSolicitudes, '$plazoinscripcion')";
    
        $resultado_crear = mysqli_query($conexion, $crea_cursos); 
    
        if (!$resultado_crear) {
            die('Error en la actualización: ' . mysqli_error($conexion));
        }
    
        header('Location: cursos.php');
        exit;
    }
?>

<?php
include("conectar.php");
include("estilos.html");
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Creacion de curso</title>
    <link rel="stylesheet" href="estilos.css">
    <style>
        
    </style>
</head>

<body>
    <h2>Nuevo curso</h2>
    <form method="post" action="crear_curso.php">
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

        <input type="submit" value="Guardar">
    </form>

    <a href="acciones.php"><button class="button">Menu</button></a>
</body>

</html>