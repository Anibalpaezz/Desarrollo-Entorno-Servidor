<?php
include("conectar.php");
include("estilos.html");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nombre = $_POST["nombre"];
    $apellidos = $_POST["apellidos"];
    $email = $_POST["email"];
    $contrasena = $_POST["contrasena"];
    $permisos = 0;

    $consulta = "INSERT INTO usuarios (nombre, contraseña, permisos) 
                 VALUES ('$nombre', '$contrasena', '$permisos')";

    if (mysqli_query($conexion, $consulta)) {
        echo "Registro exitoso.";
    } else {
        echo "Error en el registro: " . mysqli_error($conexion);
    }

    mysqli_close($conexion);
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registro de Usuario</title>
    <link rel="stylesheet" href="estilos.css">
</head>

<body>
    <h2>Registro de Usuario</h2>
    <form action="registro.php" method="post">
        Nombre: <input type="text" name="nombre" required><br><br>
        Apellidos: <input type="text" name="apellidos" required><br><br>
        Email: <input type="email" name="email" required><br><br>
        Contraseña: <input type="text" name="contrasena" required><br><br>
        <button type="submit">Registrarse</button>
        <a href="index.html"><button type="button">Inicio</button></a>
    </form>
</body>

</html>
