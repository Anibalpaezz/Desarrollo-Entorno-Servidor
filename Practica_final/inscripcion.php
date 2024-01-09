<?php
include("conectar.php");
include("estilos.html");

session_start();

if (!isset($_SESSION['usuario']) || !isset($_SESSION['permisos'])) {
    header('Location: index.html');
    exit();
}

$usuario = $_SESSION['usuario'];
$valor = $_SESSION['permisos'];

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $dni = $_POST["DNI"];
    $apellidos = $_POST["apellidos"];
    $nombre = $_POST["nombre"];
    $telefono = $_POST["telefono"];
    $correo = $_POST["correo"];
    $cod_centro = $_POST["cod_centro"];
    $ctic = isset($_POST["ctic"]) ? 1 : 0;
    $gtic = isset($_POST["gtic"]) ? 1 : 0;
    $grupo = $_POST["grupo"];
    $ingles = isset($_POST["ingles"]) ? 1 : 0;
    $cargo = isset($_POST["cargo"]) ? 1 : 0;
    $n_cargo = $_POST["cargo"];
    $situacion = $_POST["situacion"];

    $tiempo = $_POST["tiempo"];
    $introducido = new DateTime($tiempo);
    $ahora = new DateTime('now');
    $antiguedad = $ahora->diff($introducido);
    $diasAntiguedad = $antiguedad->format('%a');
    $años = number_format($diasAntiguedad / 365.25, 2);

    $especialidad = $_POST["especialidad"];

    $puntos = 0;
    if ($ctic = 1) {
        $puntos += 4;
    }
    if ($gtic = 1) {
        $puntos += 3;
    }
    if ($pbilin = 1) {
        $puntos += 3;
    }
    if ($cargo = "1" || $cargo = "2" || $cargo = "3") {
        $puntos += 2;
    }
    if ($cargo = "4") {
        $puntos += 1;
    }
    if ($años >= 15) {
        $puntos += 1;
    }
    if ($situacion = "1") {
        $puntos += 1;
    }

    $insercion = "INSERT INTO solicitantes (dni, apellidos, nombre, telefono, correo, codigocentro, coordinadortic, grupotic, nombregrupo, pbilin, cargo, nombrecargo, situacion, fechanac, especialidad, puntos) 
            VALUES ('$dni', '$apellidos', '$nombre', '$telefono', '$correo', '$cod_centro', $ctic, $gtic, '$grupo', $ingles, $cargo, '$nombrecargo', '$situacion', '$tiempo', '$especialidad', '$puntos')";

    if (mysqli_query($conexion, $insercion)) {
        echo "Registro exitoso.";
    } else {
        echo "Error en el registro: " . mysqli_error($conexion);
    }

    mysqli_close($conexion);
}

?>