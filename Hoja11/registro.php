<?php
include("conectar.php");
include("estilos.html");

$usuario = $_POST["usuario"];
$contraseña = $_POST["pass"];

$consulta = "SELECT * FROM usuarios WHERE nombre LIKE '$usuario'";
if ($resultado = mysqli_query($conexion, $consulta)) {
    if (mysqli_num_rows($resultado) > 0) {
        mysqli_close($conexion);
        header("Location: acciones.php");
        exit();
    }
} else {
    echo "No se encuentra ese usuario en la base de datos";
    die();
}
?>