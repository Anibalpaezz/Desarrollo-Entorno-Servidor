<?php
include("conectar.php");
include("estilos.php");

session_start();
if (!isset($_SESSION['usuario'])) {
    header('Location: index.html');
}

$solicitudes = "SELECT * FROM solicitudes";
$resultado_solicitudes = mysqli_query($conexion, $solicitudes);

if ($resultado_solicitudes) {
    echo '<div id="contenido">';
    echo '<h1>Lista de Solicitudes</h1>
        <table>
        <tr>
            <th>DNI</th>
            <th>Código Curso</th>
            <th>Fecha Solicitud</th>
            <th>Admitido</th>
        </tr>';


    while ($fila = mysqli_fetch_assoc($resultado_solicitudes)) {
        echo '<tr>
        <td>' . $fila['dni'] . '</td>
        <td>' . $fila['codigocurso'] . '</td>
        <td>' . $fila['fechasolicitud'] . '</td>
        <td>' . ($fila['admitido'] ? 'Sí' : 'No') . '</td>
        </tr>';
    }

    echo '</table>';
    echo '<a href="acciones.php"><button class="button">Menu</button></a>';
    echo '</div>';

} else {
    echo "Error al obtener los datos de la tabla solicitudes: " . mysqli_error($conexion);
}



mysqli_close($conexion);
?>