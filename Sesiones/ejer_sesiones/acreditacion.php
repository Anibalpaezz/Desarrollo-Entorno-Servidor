<?php
session_start();
$usuario_correcto = 'anibal';
$contraseña_correcta = '123456';

if (isset($_SESSION['usuario'])) {
    header("Location: informacion.php");
    exit();
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $usuario = $_POST['usuario'];
    $contraseña = $_POST['contrasena'];

    if (!empty($usuario) && !empty($contraseña)) {
        if ($usuario == $usuario_correcto && $contraseña == $contraseña_correcta) {
            $_SESSION['usuario'] = $usuario;
            header("Location: informacion.php");
            exit();
        } else {
            echo("Acreditacion incorrecta");
        }
    } else {
        header("Location: hola.php");
        exit();
    }
}
?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Iniciar Sesión</title>
</head>

<body>
    <h1>Inicio de Sesión</h1>
    <form method="post" action="acreditacion.php">
        <label for="usuario">Usuario:</label>
        <input type="text" name="usuario"><br>

        <label for="contrasena">Contrasena:</label>
        <input type="password" name="contrasena"><br>

        <input type="submit" value="Iniciar Sesión">
    </form>
</body>

</html>