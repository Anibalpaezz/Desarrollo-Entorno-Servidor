<?php
//Importo los estilos y la conexion a la base de datos
include("conectar.php");
include("estilos.php");

//Compruebo si se ha creado la sesion
session_start();
if (!isset($_SESSION['usuario'])) {
    header('Location: index.html');
}

//Verifico que se llegue por metodo post
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nombre = $_POST['nombre'];
    $abierto = isset($_POST['abierto']) ? 1 : 0;
    $numeroplazas = $_POST['numeroplazas'];
    $numeroSolicitudes = $_POST['numeroSolicitudes'];
    $plazoinscripcion = $_POST['plazoinscripcion'];

    //Creo un curso con los datos recibidos
    $crea_cursos = "INSERT INTO cursos (nombre, abierto, numeroplazas, numeroSolicitudes, plazoinscripcion) VALUES ('$nombre', $abierto, $numeroplazas, $numeroSolicitudes, '$plazoinscripcion')";

    $resultado_crear = mysqli_query($conexion, $crea_cursos);

    if (!$resultado_crear) {
        die('Error en la actualización: ' . mysqli_error($conexion));
    }

    header('Location: cursos.php');
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Creacion de curso</title>
    <link rel="stylesheet" href="estilos.css">
    <style>
        @import url(https://fonts.googleapis.com/css2?family=Archivo+Black&display=swap);

        input,
        table {
            width: 100%
        }

        #contenido,
        div,
        h1 {
            text-align: center
        }

        input,
        select {
            padding: 8px;
            margin-bottom: 15px;
            box-sizing: border-box
        }

        * {
            font-family: Archivo Black;
            font-weight: 100
        }

        table {
            border-collapse: collapse
        }

        td,
        th {
            border: 1px solid #a5a5a5;
            text-align: left;
            padding: 8px
        }

        th {
            background-color: #7fb3d5
        }

        td {
            background-color: #ebebeb
        }

        img {
            width: 200px
        }

        body {
            font-family: Arial, sans-serif;
            background-color: #f2f2f2;
            color: #333;
            margin: 0;
            padding: 0
        }

        form {
            max-width: 400px;
            margin: 20px auto;
            background-color: #f9f9f9;
            padding: 20px;
            border-radius: 5px;
            box-shadow: 0 0 10px rgba(0, 0, 0, .1)
        }

        label {
            display: block;
            margin-bottom: 8px;
            color: #555
        }

        button {
            background-color: #8e44ad;
            padding: 10px 15px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            margin-right: 5px;
            margin-top: 5px;
            color: #fff;
            text-decoration: none
        }

        button:hover {
            background-color: #6c3483
        }

        div {
            margin-top: 10px
        }

        a {
            color: #8e44ad
        }

        a:hover {
            text-decoration: underline
        }

        select {
            border: 1px solid #a5a5a5;
            color: #333
        }
    </style>
</head>

<body>
    <div id="contenido">
        <h2>Nuevo curso</h2>
        <form method="post" action="crear_curso.php">
            <label for="nombre">Nombre:</label>
            <input type="text" name="nombre" value="<?php echo $curso['nombre']; ?>"><br>

            <label for="abierto">Abierto:</label>
            <input type="checkbox" name="abierto" <?php echo ($curso['abierto'] ? 'checked' : ''); ?>><br>

            <label for="numeroplazas">Número de Plazas:</label>
            <input type="number" name="numeroplazas" value="<?php echo $curso['numeroplazas']; ?>"><br>

            <label for="numeroSolicitudes">Número de Solicitudes:</label>
            <input type="number" name="numeroSolicitudes" value="<?php echo $curso['numeroSolicitudes']; ?>"><br>

            <label for="plazoinscripcion">Plazo de Inscripción:</label>
            <input type="date" name="plazoinscripcion" value="<?php echo $curso['plazoinscripcion']; ?>"><br>

            <input type="submit" value="Guardar">
        </form>

        <a href="acciones.php"><button class="button">Menu</button></a>
    </div>
</body>

</html>