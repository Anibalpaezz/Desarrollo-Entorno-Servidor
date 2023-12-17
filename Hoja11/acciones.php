<?php
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
            if ($valor == "1") {
                echo '<label>Crear Noticia:</label><button type="submit" name="crear">Crear</button>';

                echo '<label>Eliminar Noticia:</label><button type="submit" name="eliminar">Eliminar</button>';

                echo '<label>Consultar Noticia:</label>';
                echo '<select name="consultar">';
                echo '<option value="1">Consultar Noticia 1</option>';
                echo '<option value="2">Consultar Noticia 2</option>';
                echo '<option value="3">Consultar Noticia 3</option>';
                echo '</select>';
                echo '<button type="submit" name="enviar">Enviar</button>';
            } else if ($valor == "0") {
                echo '<label>Eliminar Noticia:</label><button type="submit" name="eliminar">Eliminar</button>';
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