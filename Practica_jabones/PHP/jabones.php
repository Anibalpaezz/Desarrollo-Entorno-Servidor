<?php
session_start();
if (!isset($_SESSION['usuario'])) {
    header('Location: ../index.html');
}
?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lista de Jabones</title>
    <link rel="stylesheet" href="../CSS/fuentes.css">
    <link rel="stylesheet" href="../CSS/jabones.css">
</head>

<body>
    <nav id="navegacion">
        <a href=""><button></button></a>
        <a href=""><button>Ver carrito</button></a>
        <a href="cerrar_sesion.php"><button>Cerrar sesion</button></a>
    </nav>
    <div class="portada-cont">
        <img id="portada" src="../Images/portada.png" alt="Foto de portada">
    </div>

    <h1>Bienvenido a ENJABON-(ARTE)</h1>
    <div id="jabones-caja">

        <?php
        include("conexion.php");

        try {
            $consulta = "SELECT * FROM productos";
            $resultado = $conexion->prepare($consulta);
            $resultado->execute();

            if ($resultado->rowCount() > 0) {
                while ($row = $resultado->fetch(PDO::FETCH_ASSOC)) {
                    echo '<a href="mostrar_jabon.php?id=' . $row['producto_ID'] . '" class="soap-link">';
                    echo '<div class="soap-box">';
                    echo '<img src="' . $row['imagen'] . '" alt="' . $row['nombre'] . '" class="soap-image"><br>';
                    echo '<strong>' . $row['nombre'] . '</strong><br>';
                    echo '</div>';
                    echo '</a>';
                }

            } else {
                echo "No se encontraron jabones en la base de datos.";
            }
        } catch (PDOException $e) {
            echo "Error al ejecutar la consulta: " . $e->getMessage();
        }

        $conexion = null;
        ?>
    </div>

</body>

</html>