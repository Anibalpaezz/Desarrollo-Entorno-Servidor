<?php
include("conectar.php");
include("estilos.html");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    session_set_cookie_params(3600);

    session_start();
    $usuario = $_POST["usuario"];
    $contraseña = $_POST["pass"];

    $consulta_usuario = "SELECT * FROM usuarios WHERE nombre LIKE '$usuario' AND contraseña LIKE '$contraseña'";
    $consulta_permisos = "SELECT permisos FROM usuarios WHERE nombre LIKE '$usuario'";

    $resultado_usuario = mysqli_query($conexion, $consulta_usuario);

    if ($resultado_usuario && mysqli_num_rows($resultado_usuario) > 0) {
        $resultado_permisos = mysqli_query($conexion, $consulta_permisos);
        $fila_permisos = mysqli_fetch_assoc($resultado_permisos);
        $valor_permisos = $fila_permisos['permisos'];

        $_SESSION['usuario'] = $usuario;
        $_SESSION['permisos'] = $valor_permisos;

        if ($valor_permisos == "1") {
            echo "<h2>Bienvenido, " . $_SESSION['usuario'] . "!</h2>";

            echo '<a href="consulta_noticias.php?id=1"><button class="button">Consultar Noticia 1</button></a>';
            echo '<a href="consulta_noticias2.php?id=2"><button class="button">Consultar Noticia 2</button></a>';
            echo '<a href="consulta_noticias3.php?id=3"><button class="button">Consultar Noticia 3</button></a>';
            echo '<a href="encuesta.php?id=3"><button class="button">Votar en encuesta</button></a>';
            echo '<a href="encuesta_resultados.php?id=3"><button class="button">Resultados encuesta</button></a>';
            echo '<a href="eliminar_noticias.php"><button class="button">Borrar Noticia</button></a>';
            echo '<a href="insertar_noticias.php"><button class="button">Insertar Noticia</button></a>';
            echo '<a href="borrar_usuarios.php"><button class="button">Borrar Usuarios</button></a>';
            echo '<a href="cerrar_sesion.php"><button class="button">Cerrar sesion</button></a>';
        } else if ($valor_permisos == "0") {
            echo '<a href="consulta_noticias.php?id=1"><button class="button">Consultar Noticia 1</button></a>';
            echo '<a href="consulta_noticias2.php?id=2"><button class="button">Consultar Noticia 2</button></a>';
            echo '<a href="consulta_noticias3.php?id=3"><button class="button">Consultar Noticia 3</button></a>';
            echo '<a href="encuesta.php?id=3"><button class="button">Votar en encuesta</button></a>';
            echo '<a href="encuesta_resultados.php?id=3"><button class="button">Resultados encuesta</button></a>';
            echo '<a href="cerrar_sesion.php"><button class="button">Cerrar sesion</button></a>';
        } else {
            echo "Error: el valor de permisos es desconocido.";
        }

        mysqli_free_result($resultado_permisos);
    } else {
        echo "Error: no se encuentra ese usuario en la base de datos";
        echo "<br>";
        echo $usuario;
        echo $contraseña;
        header('Location: principal.html');
        exit();
    }

    mysqli_free_result($resultado_usuario);
    mysqli_close($conexion);
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Menú de Inicio</title>
    <link rel="stylesheet" href="estilos.css">
</head>

<body>

</body>

</html>