<?php
//Conecto los estilos y la conexion
include("conectar.php");
include("estilos.php");

//Verifico que la sesion esta iniciada
session_start();
if (!isset($_SESSION['usuario'])) {
    header('Location: index.html');
}

//Compruebo que el curso se ha selecionado
if (isset($_GET['codigo'])) {
    $codigo = $_GET['codigo'];

    $codigo_curso = "SELECT * FROM cursos WHERE codigo = $codigo";
    $resultado_codigo = mysqli_query($conexion, $codigo_curso);

    if ($resultado_codigo && mysqli_num_rows($resultado_codigo) > 0) {
        $curso = mysqli_fetch_assoc($resultado_codigo);
    } else {
        die('Curso no encontrado');
    }
} else {
    die('Código de curso no proporcionado');
}

//Si se llega por post ejecuta el update con los datos nuevos
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nombre = $_POST['nombre'];
    $abierto = isset($_POST['abierto']) ? 1 : 0;
    $numeroplazas = $_POST['numeroplazas'];
    $numeroSolicitudes = $_POST['numeroSolicitudes'];
    $plazoinscripcion = $_POST['plazoinscripcion'];

    $actualiza_cursos = "UPDATE cursos SET nombre='$nombre', abierto=$abierto, numeroplazas=$numeroplazas, numeroSolicitudes=$numeroSolicitudes, plazoinscripcion='$plazoinscripcion' WHERE codigo=$codigo";

    $resultado_actualiza = mysqli_query($conexion, $actualiza_cursos);

    if (!$resultado_actualiza) {
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
    <title>Editar Curso</title>
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
        <h1>Editar Curso</h1>
        <form method="post" action="">
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

            <input type="submit" value="Guardar cambios">
        </form>
        <a href="acciones.php"><button class="button">Menu</button></a>
    </div>
</body>

</html>