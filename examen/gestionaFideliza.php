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
    <title>Acciones</title>
</head>

<body>
    <?php
    if ($_SESSION['permisos'] == 1) {
        echo "si";
        echo "<a href='lista_cupones.php'><button>Ver cupones</button></a>";
        echo "<a href='asigna_cupones.php'><button>Asignar cupones</button></a>";

    } else {
        echo "no";
        echo "<a href='lista_cupones.php'><button>Ver cupones</button></a>";
    }
    ?>

    <a href="cerrar_sesion.php"><button>Cerrar sesion</button></a>
</body>

</html>