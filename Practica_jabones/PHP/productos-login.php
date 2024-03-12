<?php
session_start();
if (!isset($_SESSION['usuario'])) {
    header('Location: ../index.html');
}

$productosPorPagina = 5;
$paginaActual = isset($_GET['page']) ? intval($_GET['page']) : 1;
$inicio = ($paginaActual - 1) * $productosPorPagina;
?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" href="../Icon/favicon logo.png" type="image/x-icon">
    <title>Enjabon-arte</title>
    <link rel="stylesheet" href="../CSS/global.css">
    <link rel="stylesheet" href="../CSS/productos-login.css">
</head>

<body>
    <nav class="navegacion">
        <?php
        if ($_SESSION['permisos'] == 1) {
            echo '<a href="admin.php"><button>Administracion</button></a>';
        }
        ?>
        <a href="carrito.php"><button>Ver carrito</button></a>
        <a href="cerrar_sesion.php"><button>Cerrar sesion</button></a>
    </nav>
    <div class="portada-cont">
        <img class="portada" src="../Images/portada.png" alt="Foto de portada">
    </div>

    <div class="titulos">
        <h1>Bienvenido a ENJABON-(ARTE)</h1>
        <?php
        include("conexion.php");

        $primera_compra = $conexion->prepare("SELECT email FROM pedidos WHERE email = :usuario");
        $primera_compra->bindParam(":usuario", $_SESSION["usuario"]);
        $primera_compra->execute();

        if ($primera_compra->rowCount() == 0) {
            echo '<h2>35% de descuento en la primera compra</h2>';
        } else {
            echo '';
        }
        ?>
    </div>

    <div class="jabones-caja">

        <?php
        try {
            $totalProductos = $conexion->query("SELECT COUNT(*) FROM productos")->fetchColumn();

            $totalPaginas = ceil($totalProductos / $productosPorPagina);

            $consulta = "SELECT * FROM productos LIMIT $inicio, $productosPorPagina";
            $resultado = $conexion->prepare($consulta);
            $resultado->execute();

            if ($resultado->rowCount() > 0) {
                while ($row = $resultado->fetch(PDO::FETCH_ASSOC)) {
                    echo '<a href="mostrar_jabon.php?id=' . $row['producto_ID'] . '">';
                    echo '<div class="soap-box">';
                    echo '<img src="../' . $row['imagen'] . '" alt="' . $row['nombre'] . '" class="soap-image"><br>';
                    echo '<strong>' . $row['nombre'] . '</strong><br>';
                    if ($primera_compra->rowCount() == 0) {
                        $precio_original = $row['precio'];
                        $descuento = $precio_original * 0.35;
                        $precio_con_descuento = $precio_original - $descuento;
                        echo '<del>' . $precio_original . '</del> ' . number_format($precio_con_descuento, 2) . '€';
                    } else {
                        echo $row['precio'] . '€';
                    }
                    echo '</div>';
                    echo '</a>';
                }

                echo '<div class="pagination">';
                for ($i = 1; $i <= $totalPaginas; $i++) {
                    echo " ";
                    echo '<a href="?page=' . $i . '">' . $i . '</a>';
                }
                echo '</div>';

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
