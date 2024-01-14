<?php
include("conectar.php");
include("estilos.html");

session_start();
if(!isset($_SESSION['usuario'])){
    header('Location: index.html');
}
// Supongamos que ya tienes la conexión a la base de datos en $conexion

// Consulta para obtener los datos de la tabla solicitudes
$sql = "SELECT * FROM solicitudes";
$resultado = mysqli_query($conexion, $sql);

// Verificar si hay filas en el resultado
if ($resultado) {
    // Comienza la estructura HTML
    echo "<html>";
    echo "<head>";
    echo "<title>Lista de Solicitudes</title>";
    echo "</head>";
    echo "<body>";

    // Encabezado de la tabla
    echo "<h2>Lista de Solicitudes</h2>";
    echo "<table border='1'>";
    echo "<tr><th>DNI</th><th>Código Curso</th><th>Fecha Solicitud</th><th>Admitido</th></tr>";

    // Mostrar los datos de la tabla
    while ($fila = mysqli_fetch_assoc($resultado)) {
        echo "<tr>";
        echo "<td>" . $fila['dni'] . "</td>";
        echo "<td>" . $fila['codigocurso'] . "</td>";
        echo "<td>" . $fila['fechasolicitud'] . "</td>";
        echo "<td>" . ($fila['admitido'] ? 'Sí' : 'No') . "</td>";
        echo "</tr>";
    }

    // Cierre de la tabla y del cuerpo HTML
    echo "</table>";
    echo "</body>";
    echo "</html>";
} else {
    // Si hay un error en la consulta, mostrar un mensaje de error
    echo "Error al obtener los datos de la tabla solicitudes: " . mysqli_error($conexion);
}

// Cerrar la conexión a la base de datos
mysqli_close($conexion);
?>
