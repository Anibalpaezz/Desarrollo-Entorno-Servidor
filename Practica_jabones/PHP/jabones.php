<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lista de Jabones</title>
    <style>
        .soap-box {
            border: 1px solid #ccc;
            padding: 10px;
            margin: 5px;
            width: 100px;
            height: 110px;
            text-align: center;
            display: inline-block;
        }

        .soap-image {
            max-width: 100px;
            height: 75px;
        }
    </style>
</head>

<body>

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

</body>

</html>