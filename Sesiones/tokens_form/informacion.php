<?php
    session_start();

    if (!isset($_SESSION['usuario'])) {
        header("Location: acreditacion.php");
        exit();
    }
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Logueo correcto</title>
</head>

<body>
    <h1>Elige una opcion</h1>
    <ul>
        <li><a href="transferencia.php">Carmen un 10</a></li>

        <!-- <li>
            <form action="cierre.php" method="post">
                <button type="submit" name="cerrar_sesion">Cerrar Sesión</button>
            </form>
        </li> -->
    </ul>
</body>

</html>