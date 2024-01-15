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
        @import url(https://fonts.googleapis.com/css2?family=Archivo+Black&display=swap);input,table{width:100%}#contenido,div,h1{text-align:center}input,select{padding:8px;margin-bottom:15px;box-sizing:border-box}*{font-family:Archivo Black;font-weight:100}table{border-collapse:collapse}td,th{border:1px solid #a5a5a5;text-align:left;padding:8px}th{background-color:#7fb3d5}td{background-color:#ebebeb}img{width:200px}body{font-family:Arial,sans-serif;background-color:#f2f2f2;color:#333;margin:0;padding:0}form{max-width:400px;margin:20px auto;background-color:#f9f9f9;padding:20px;border-radius:5px;box-shadow:0 0 10px rgba(0,0,0,.1)}label{display:block;margin-bottom:8px;color:#555}button{background-color:#8e44ad;padding:10px 15px;border:none;border-radius:5px;cursor:pointer;margin-right:5px;margin-top:5px;color:#fff;text-decoration:none}button:hover{background-color:#6c3483}div{margin-top:10px}a{color:#8e44ad}a:hover{text-decoration:underline}select{border:1px solid #a5a5a5;color:#333}
    </style>
</head>

<body>
<div id="contenido">
    <h1>Registro de Usuario</h1>
    <form action="inscripcion.php" method="post">
        <label for="DNI">DNI:</label>
        <input type="text" id="DNI" name="DNI" maxlength="9"><br><br>

        <label for="apellidos">Apellidos:</label>
        <input type="text" id="apellidos" name="apellidos"><br><br>

        <label for="nombre">Nombre:</label>
        <input type="text" id="nombre" name="nombre"><br><br>

        <label for="pass">Contraseña:</label>
        <input type="text" id="pass" name="pass"><br><br>

        <label for="telefono">Telefono:</label>
        <input type="text" id="telefono" name="telefono"  maxlength="12"><br><br>

        <label for="correo">Correo electronico:</label>
        <input type="email" id="correo" name="correo"><br><br>

        <label for="cod_centro">Codigo de centro:</label>
        <input type="text" id="cod_centro" name="cod_centro"><br><br>

        <label for="ctic">Coordinador TIC:</label>
        <input type="checkbox" id="ctic" name="ctic"><br><br>

        <label for="gtic">Grupo TIC:</label>
        <input type="checkbox" id="gtic" name="gtic"><br><br>

        <label for="grupo">Nombre de grupo:</label>
        <input type="text" id="grupo" name="grupo"><br><br>

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
        <input type="date" id="tiempo" name="tiempo"><br><br>

        <label for="especialidad">Especialidad:</label>
        <input type="text" id="especialidad" name="especialidad"><br><br>

        <button type="submit">Registrarse</button>
<!--         <a href="acciones.php"><button class="button">Menu</button></a> -->
    </form>
    <a href="acciones.php"><button class="button">Menu</button></a>

</div>
</body>

</html>