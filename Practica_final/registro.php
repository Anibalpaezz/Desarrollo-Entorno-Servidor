<?php
include("conectar.php");
include("estilos.php");
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registro de Usuario</title>
    <link rel="stylesheet" href="estilos.css">
    <style>
        body {
            background-color: white;
            color: black;
            font-family: 'Arial', sans-serif;
            margin: 0;
            padding: 0;
        }

        form {
            max-width: 600px;
            margin: 0 auto;
            padding: 20px;
            border: 1px solid tan;
            border-radius: 10px;
            background-color: #f5f5f5;
        }

        input,
        select,
        button {
            width: 100%;
            padding: 8px;
            margin-bottom: 10px;
            border: 1px solid tan;
            border-radius: 5px;
        }

        a {
            color: brown;
            text-decoration: none;
        }

        a:hover {
            text-decoration: underline;
        }

        .button {
            background-color: brown;
            color: white;
            padding: 10px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            text-decoration: none;
            display: inline-block;
            margin-top: 10px;
        }
    </style>
</head>

<body>
    <h1>Registro de Usuario</h1>
    <form action="inscripcion.php" method="post">
        <label for="DNI">DNI:</label>
        <input type="text" id="DNI" name="DNI" required maxlength="9"><br><br>

        <label for="apellidos">Apellidos:</label>
        <input type="text" id="apellidos" name="apellidos" required><br><br>

        <label for="nombre">Nombre:</label>
        <input type="text" id="nombre" name="nombre" required><br><br>

        <label for="pass">Contraseña:</label>
        <input type="text" id="pass" name="pass" required><br><br>

        <label for="telefono">Telefono:</label>
        <input type="text" id="telefono" name="telefono" required maxlength="12"><br><br>

        <label for="correo">Correo electronico:</label>
        <input type="email" id="correo" name="correo" required><br><br>

        <label for="cod_centro">Codigo de centro:</label>
        <input type="text" id="cod_centro" name="cod_centro"><br><br>

        <label for="ctic">Coordinador TIC:</label>
        <input type="checkbox" id="ctic" name="ctic"><br><br>

        <label for="gtic">Grupo TIC:</label>
        <input type="checkbox" id="gtic" name="gtic"><br><br>

        <label for="grupo">Nombre de grupo:</label>
        <input type="text" id="grupo" name="grupo" required><br><br>

        <label for="ingles">Bilingüe:</label>
        <input type="checkbox" id="ingles" name="ingles"><br><br>

        <label for="n_cargo">Cargo:</label>
        <select id="n_cargo" name="n_cargo">
            <option value="Director">Director</option>
            <option value="Jefe de estudios">Jefe de estudios</option>
            <option value="Secretario">Secretario</option>
            <option value="Jefe de departamento">Jefe de departamento</option>
            <option value="Otros" selected>Otros</option>
        </select><br><br>

        <label for="situacion">Situacion:</label>
        <select id="situacion" name="situacion">
            <option value="1">Activo</option>
            <option value="2" selected>Parado</option>
        </select><br><br>

        <label for="tiempo">Antigüedad:</label>
        <input type="date" id="tiempo" name="tiempo" required><br><br>

        <label for="especialidad">Especialidad:</label>
        <input type="text" id="especialidad" name="especialidad" required><br><br>

        <button type="submit">Registrarse</button>
    </form>

    <a href="acciones.php"><button class="button">Menu</button></a>
</body>

</html>