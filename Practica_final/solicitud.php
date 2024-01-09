<?php
include("conectar.php");
include("estilos.html");

session_start();

if (!isset($_SESSION['usuario']) || !isset($_SESSION['permisos'])) {
    header('Location: index.html');
    exit();
}

$usuario = $_SESSION['usuario'];
$valor = $_SESSION['permisos'];
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Solicitud de curso</title>
    <link rel="stylesheet" href="estilos.css">
</head>

<body>
    <h2>Solicitud de curso</h2>
    <form action="inscripcion.php" method="post">
        DNI: <input type="text" name="DNI" required><br><br>
        Apellidos: <input type="text" name="apellidos" required><br><br>
        Nombre: <input type="text" name="nombre" required><br><br>
        Telefono: <input type="text" name="telefono" required><br><br>
        Correo electronico: <input type="email" name="correo" required><br><br>
        Codigo de centro: <input type="text" name="cod_centro" required><br><br>
        Coordinador TIC: <input type="checkbox" name="ctic" required><br><br>
        Grupo TIC: <input type="checkbox" name="gtic" required><br><br>
        Nombre de grupo: <input type="text" name="grupo" required><br><br>
        Bilingüe: <input type="checkbox" name="ingles" required><br><br>
        Cargo: <input type="checkbox" name="cargo" required><br><br>
        Cargo: <select name="n_cargo" id="">
            <option value="1">Director</option>
            <option value="2">Jefe de estudios</option>
            <option value="3">Secretario</option>
            <option value="4">Jefe de departamento</option>
        </select>
        Situacion: <select name="situacion" id="">
            <option value="1">Activo</option>
            <option value="2">Parado</option>
        </select>
        Antigüedad: <input type="date" name="tiempo" required><br><br>
        Especialidad: <input type="text" name="especialidad" required><br><br>


        <button type="submit">Registrarse</button>
        <a href="index.html"><button type="button">Inicio</button></a>
    </form>
</body>

</html>