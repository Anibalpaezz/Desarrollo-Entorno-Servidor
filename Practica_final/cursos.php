<?php
include("conectar.php");
include("estilos.php");

session_start();
if (!isset($_SESSION['usuario'])) {
    header('Location: index.html');
}

$usuario = $_SESSION['usuario'];
$valor = $_SESSION['permisos'];

$disponibles = "SELECT * FROM cursos WHERE abierto = 1";
$todos = "SELECT * FROM cursos";

$resultado_disponibles = mysqli_query($conexion, $disponibles);
$resultado_todos = mysqli_query($conexion, $todos);

if ($_SESSION['permisos'] == 1) {
    if ($resultado_todos && mysqli_num_rows($resultado_todos) > 0) {
        echo '<h1>Todos los cursos</h1>
        <table border="1">
        <tr>
            <th>Código</th>
            <th>Nombre</th>
            <th>Abierto</th>
            <th>Número de Plazas</th>
            <th>Número de Solicitudes</th>
            <th>Plazo de Inscripción</th>
            <th colspan="3">Acciones</th>
        </tr>';

        while ($row = mysqli_fetch_assoc($resultado_todos)) {
            echo '<tr>
            <td>' . $row['codigo'] . '</td>
            <td>' . $row['nombre'] . '</td>
            <td>' . ($row['abierto'] ? 'Sí' : 'No') . '</td>
            <td>' . $row['numeroplazas'] . '</td>
            <td>' . $row['numeroSolicitudes'] . '</td>
            <td>' . $row['plazoinscripcion'] . '</td>
            <td><a href="edit_cursos.php?codigo=' . $row['codigo'] . '">Editar</a></td>
            <td><a href="abrir_cerrar.php?codigo=' . $row['codigo'] . '&abrir=abrir">Abrir</a></td>
            <td><a href="abrir_cerrar.php?codigo=' . $row['codigo'] . '&cerrar=cerrar">Cerrar</a></td>
        </tr>';
        }

        echo '</table>';

        echo '<a href="acciones.php"><button class="button">Menu</button></a>';
        echo '<a href="crear_curso.php"><button class="button">Crear curso</button></a>';

        mysqli_free_result($resultado_todos);
        mysqli_close($conexion);
    } else {
        echo "<h1>No hay registros en la tabla Cursos</h1>";
    }
} else {
    if ($resultado_disponibles && mysqli_num_rows($resultado_disponibles) > 0) {
        echo '<h1>Todos los cursos</h1>
        <table border="1">
        <tr>
            <th>Código</th>
            <th>Nombre</th>
            <th>Abierto</th>
            <th>Número de Plazas</th>
            <th>Número de Solicitudes</th>
            <th>Plazo de Inscripción</th>
        </tr>';

        while ($row = mysqli_fetch_assoc($resultado_disponibles)) {
            echo '<tr>
            <td>' . $row['codigo'] . '</td>
            <td>' . $row['nombre'] . '</td>
            <td>' . ($row['abierto'] ? 'Sí' : 'No') . '</td>
            <td>' . $row['numeroplazas'] . '</td>
            <td>' . $row['numeroSolicitudes'] . '</td>
            <td>' . $row['plazoinscripcion'] . '</td>
            <td><a href="confirma_inscripcion.php?codigo=' . $row['codigo'] . '">Inscribirse</a></td>
        </tr>';
        }

        echo '</table>';

        echo '<a href="acciones.php"><button class="button">Menu</button></a>';

        mysqli_free_result($resultado_disponibles);
        mysqli_close($conexion);
    } else {
        echo "<h1>No hay registros en la tabla Cursos</h1>";
    }
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Menú de Inicio</title>
    <link rel="stylesheet" href="estilos.css">
</head>

<body>

</body>

</html>