<?php
session_start();
include("conectar.php");
include("estilos.html");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $usuario = $_POST["usuario"];
    $contraseña = $_POST["pass"];

    $consulta_usuario = "SELECT * FROM usuarios WHERE nombre LIKE '$usuario' AND contraseña LIKE '$contraseña'";
    $consulta_admin = "SELECT permisos FROM usuarios WHERE nombre LIKE '$usuario'";

    if ($existe_usuario = mysqli_query($conexion, $consulta_usuario)) {
        if (mysqli_num_rows($existe_usuario) > 0) {
            $es_admin = mysqli_query($conexion, $consulta_admin);
            $fila = mysqli_fetch_assoc($es_admin);
            $valor = $fila['permisos'];

            if ($valor == "1" || $valor == "0") {
                // Usuario autenticado correctamente
                $_SESSION['usuario'] = $usuario;
                $_SESSION['permisos'] = $valor;

                echo "Bienvenido, $usuario.";

                // Resto del código aquí (puedes dejar el código actual para mostrar los botones)

            } else {
                echo "Error el valor es un numero raro";
            }
        } else {
            echo "Error no hay filas";
        }

        mysqli_free_result($existe_usuario);
    } else {
        echo "No se encuentra ese usuario en la base de datos";
        echo "<br>";
        echo $usuario;
        echo $contraseña;
        die();
    }
}

mysqli_close($conexion);
?>
