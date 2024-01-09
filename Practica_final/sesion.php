<?php
include("conectar.php");
include("estilos.html");

session_start();
$usuario = $_POST["usuario"];
$contraseña = $_POST["pass"];

$consulta_usuario = "SELECT * FROM usuarios WHERE nombre LIKE '$usuario' AND pass LIKE '$contraseña'";
$consulta_permisos = "SELECT permisos FROM usuarios WHERE nombre LIKE '$usuario'";

$resultado_usuario = mysqli_query($conexion, $consulta_usuario);

if ($resultado_usuario && mysqli_num_rows($resultado_usuario) > 0) {
    $resultado_permisos = mysqli_query($conexion, $consulta_permisos);
    $fila_permisos = mysqli_fetch_assoc($resultado_permisos);
    $valor_permisos = $fila_permisos['permisos'];

    $_SESSION['usuario'] = $usuario;
    $_SESSION['permisos'] = $valor_permisos;

    header('Location: acciones.php');

    mysqli_free_result($resultado_permisos);
} else {
    header('Location: index.html');
}

mysqli_free_result($resultado_usuario);
mysqli_close($conexion);

?>
