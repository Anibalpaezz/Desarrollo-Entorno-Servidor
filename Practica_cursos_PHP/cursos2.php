<?php
//Conecto los estilos y la conexion
include("conectar.php");
include("estilos.php");

/* session_start();
if (!isset($_SESSION['usuario'])) {
    header('Location: index.html');
}

$usuario = $_SESSION['usuario'];
$valor = $_SESSION['permisos']; */

$disponibles = "SELECT * FROM cursos WHERE abierto = 1";
$todos = "SELECT * FROM cursos";

$resultado_disponibles = mysqli_query($conexion, $disponibles);
$resultado_todos = mysqli_query($conexion, $todos);

//Muestr los cursos para invitados
if ($resultado_disponibles && mysqli_num_rows($resultado_disponibles) > 0) {
    echo '<div id="contenido">';
    echo '<h1>Todos los cursos</h1>
        <table border="1">
        <tr>
            <th>Código</th>
            <th>Nombre</th>
            <th>Abierto</th>
            <th>Número de Plazas</th>
            <th>Plazo de Inscripción</th>
        </tr>';

    while ($row = mysqli_fetch_assoc($resultado_disponibles)) {
        echo '<tr>
            <td>' . $row['codigo'] . '</td>
            <td>' . $row['nombre'] . '</td>
            <td>' . ($row['abierto'] ? 'Sí' : 'No') . '</td>
            <td>' . $row['numeroplazas'] . '</td>
            <td>' . $row['plazoinscripcion'] . '</td>
        </tr>';
    }

    echo '</table>';

    echo '<a href="index.html"><button class="button">Menu</button></a>';
    echo '</div>';

    mysqli_free_result($resultado_disponibles);
    mysqli_close($conexion);
} else {
    echo "<h1>No hay registros en la tabla Cursos</h1>";
}

?>