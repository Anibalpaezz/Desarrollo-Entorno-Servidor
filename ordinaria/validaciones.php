<?php
$correo = "";
$dni = "";
$correoError = "";
$dniError = "";

// Procesa el formulario cuando se envía
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Obtiene los valores del formulario
    $correo = $_POST["correo"];
    $dni = $_POST["dni"];

    // Validar correo electrónico
    if (!validarCorreoElectronico($correo)) {
        $correoError = "Formato de correo electrónico no válido";
    }

    // Validar DNI
    if (!validarDNI($dni)) {
        $dniError = "DNI no válido";
    }
}

function validarCorreoElectronico($correo) {
    $patronCorreo = "/^[a-zA-Z0-9._-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,4}$/";
    return preg_match($patronCorreo, $correo);
}

function validarDNI($dni) {
    $patronDNI = "/^[0-9]{8}[TRWAGMYFPDXBNJZSQVHLCKE]$/i";
    if (preg_match($patronDNI, $dni)) {
        $letra = strtoupper(substr($dni, -1));
        $numeros = substr($dni, 0, 8);
        $letraCalculada = "TRWAGMYFPDXBNJZSQVHLCKE"[$numeros % 23];

        if ($letra == $letraCalculada) {
            return true;
        } else {
            return false;
        }
    } else {
        return false;
    }
}

?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Formulario con Validación</title>
</head>
<body>

<form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
    <label for="correo">Correo Electrónico:</label>
    <input type="text" name="correo" value="<?php echo $correo; ?>">
    <span style="color: red;"><?php echo $correoError; ?></span>
    <br>

    <label for="dni">DNI:</label>
    <input type="text" name="dni" value="<?php echo $dni; ?>">
    <span style="color: red;"><?php echo $dniError; ?></span>
    <br>

    <input type="submit" value="Enviar">
</form>

</body>
</html>
