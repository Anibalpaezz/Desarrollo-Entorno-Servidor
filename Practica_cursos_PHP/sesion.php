<?php
//Conecto los estilos y la conexion
include("conectar.php");
include("estilos.php");

session_start();

$usuario = $_POST["usuario"];
$contraseña = $_POST["pass"];

$consulta_solicitante = "SELECT * FROM solicitantes WHERE nombre LIKE '$usuario' AND pass LIKE '$contraseña'";
$resultado_solicitante = mysqli_query($conexion, $consulta_solicitante);

$consulta_admin = "SELECT * FROM usuarios WHERE nombre LIKE '$usuario' AND pass LIKE '$contraseña'";
$resultado_admin = mysqli_query($conexion, $consulta_admin);

//Creo las sesiones en funcion de los permisos del usuario
if ($resultado_solicitante && mysqli_num_rows($resultado_solicitante) > 0) {
    $_SESSION['usuario'] = $usuario;
    $permisos = 0;
    $_SESSION['permisos'] = $permisos;

    header('Location: acciones.php');

    mysqli_free_result($resultado_solicitante);
    mysqli_free_result($resultado_admin);
    mysqli_close($conexion);

} else if ($resultado_admin && mysqli_num_rows($resultado_admin) > 0) {
    $_SESSION['usuario'] = $usuario;
    $permisos = 1;
    $_SESSION['permisos'] = $permisos;

    header('Location: acciones.php');

    mysqli_free_result($resultado_solicitante);
    mysqli_free_result($resultado_admin);
    mysqli_close($conexion);
} else {
    header('Location: index.html');

    mysqli_free_result($resultado_solicitante);
    mysqli_free_result($resultado_admin);
    mysqli_close($conexion);
}

?>