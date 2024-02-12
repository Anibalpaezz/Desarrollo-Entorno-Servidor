<?php
include("conexion.php");
session_start();
if (!isset($_SESSION['usuario'])) {
    header('Location: ../index.html');
}


if ($_SESSION['permisos'] == 1) {
    $consulta = $conexion->prepare('SELECT * FROM cupones');
    $consulta->execute();

    if ($consulta->rowCount() > 0) {
        echo '<div id="contenido">';
        echo '<h1>Todos los cursos</h1>
        <table border="1">
        <tr>
            <th>Cliente</th>
            <th>Premio</th>
            <th>Fecha inicio</th>
            <th>Fecha validez</th>
        </tr>';

        while ($row = $consulta->fetch(PDO::FETCH_ASSOC)) {
            echo '<tr>
            <td>' . $row['clienteid'] . '</td>
            <td>' . $row['premioid'] . '</td>
            <td>' . $row['fechai_validez'] . '</td>
            <td>' . $row['fechaf_validez'] . '</td>
        </tr>';
        }

        echo '</table>';
        echo '</div>';
    } else {
        echo "<h1>No hay registros en la tabla Cursos</h1>";
    }

} else {
    echo "no";
    echo "<a href='lista_cupones.php'><button>Ver cupones</button></a>";
}
?>