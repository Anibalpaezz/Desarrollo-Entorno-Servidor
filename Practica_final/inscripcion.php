<?php
include("conectar.php");
include("estilos.html");

/* session_start();

if (!isset($_SESSION['usuario']) || !isset($_SESSION['permisos'])) {
    header('Location: index.html');
    exit();
}

$usuario = $_SESSION['usuario'];
$valor = $_SESSION['permisos']; */

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $dni = $_POST["DNI"];
    $apellidos = $_POST["apellidos"];
    $nombre = $_POST["nombre"];
    $telefono = $_POST["telefono"];
    $correo = $_POST["correo"];
    $pass = $_POST["pass"];
    $cod_centro = $_POST["cod_centro"];
    $ctic = isset($_POST["ctic"]) ? 1 : 0;
    $gtic = isset($_POST["gtic"]) ? 1 : 0;
    $grupo = $_POST["grupo"];
    $ingles = isset($_POST["ingles"]) ? 1 : 0;
    $n_cargo = $_POST["n_cargo"];
    $situacion = $_POST["situacion"];

    $tiempo = $_POST["tiempo"];
    $introducido = new DateTime($tiempo);
    $ahora = new DateTime('now');
    $antiguedad = $ahora->diff($introducido);
    $diasAntiguedad = $antiguedad->format('%a');
    $años = number_format($diasAntiguedad / 365.25, 2);

    $especialidad = $_POST["especialidad"];

    $puntos = 0;
    if ($ctic == 1) {
        $puntos += 4;
    }
    if ($gtic == 1) {
        $puntos += 3;
    }
    if ($ingles == 1) {
        $puntos += 3;
    }
    if ($n_cargo == "Director" || $n_cargo == "Jefe de estudios" || $n_cargo == "Secretario") {
        $puntos += 2;
    }
    if ($n_cargo == "Jefe de departamento") {
        $puntos += 1;
    }
    if ($años >= 15) {
        $puntos += 1;
    }
    if ($situacion == "1") {
        $puntos += 1;
    }

    $insercion = "INSERT INTO solicitantes (dni, apellidos, nombre, telefono, correo, pass, codigocentro, coordinadortic, grupotic, nombregrupo, pbilin, nombrecargo, situacion, fechanac, especialidad, puntos) 
            VALUES ('$dni', '$apellidos', '$nombre', '$telefono', '$correo', '$pass', '$cod_centro', $ctic, $gtic, '$grupo', $ingles, '$n_cargo', '$situacion', '$tiempo', '$especialidad', '$puntos')";

    if (mysqli_query($conexion, $insercion)) {
        echo "
            Registro exitoso.<br>
            DNI: $dni <br>
            Apellidos: $apellidos <br>
            Nombre: $nombre <br>
            Telefono: $telefono <br>
            Correo: $correo <br>
            Contraseña: $pass <br>
            Codigo de centro: $cod_centro <br>
            Coordinador TIC: $ctic <br>
            Grupo TIC: $gtic <br>
            Nombre de grupo: $grupo <br>
            Bilingüe: $ingles <br>
            Nombre de cargo: $n_cargo <br>
            Situacion: $situacion <br>
            ";

    } else {
        echo "Error en el registro: " . mysqli_error($conexion);
    }

    mysqli_close($conexion);
}

?>