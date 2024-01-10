<?php
include("conectar.php");
include("estilos.html");

session_start();
$usuario = $_POST["usuario"];
$contraseña = $_POST["pass"];

$consulta_solicitante = "SELECT * FROM solicitantes WHERE nombre LIKE '$usuario' AND pass LIKE '$contraseña'";
$resultado_solicitante = mysqli_query($conexion, $consulta_usuario);

$consulta_admin = "SELECT * FROM usuarios WHERE nombre LIKE '$usuario' AND pass LIKE '$contraseña'";
$resultado_admin = mysqli_query($conexion, $consulta_usuario);

if ($resultado_usuario && mysqli_num_rows($resultado_solicitante) > 0 || $resultado_admin && mysqli_num_rows($resultado_admin) > 0) {
    $_SESSION['usuario'] = $usuario;

    header('Location: acciones.php');

    mysqli_free_result($resultado_permisos);
} else {
    header('Location: index.html');
}

mysqli_free_result($resultado_usuario);
mysqli_close($conexion);

?>
