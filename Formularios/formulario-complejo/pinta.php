<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nombre = $_POST["nombre"];
    $clave = $_POST["clave"];
    $genero = $_POST["genero"];
    $fechaNacimiento = $_POST["fechaNacimiento"];
    $pais = $_POST["pais"];
    $acepto = $_POST["acepto"];
    $comentarios = $_POST["comentarios"];
    
    // Validación del campo "nombre"
    if (empty($nombre)) {
        $nombreError = "El campo Nombre no puede estar vacío.";
    }
    
    // Validación del campo "clave"
    if (strlen($clave) < 6 || strlen($clave) > 12) {
        $claveError = "La clave debe tener entre 6 y 12 caracteres.";
    }
    
    // Validación del campo "genero"
    if (empty($genero)) {
        $generoError = "Debes seleccionar un género.";
    }
    
    // Validación del campo "fechaNacimiento"
    $fechaParts = explode('/', $fechaNacimiento);
    if (count($fechaParts) != 3 || !checkdate($fechaParts[1], $fechaParts[0], $fechaParts[2])) {
        $fechaNacimientoError = "La fecha debe estar en formato dd/mm/aa y ser válida.";
    } else {
        // Calcular la edad a partir de la fecha de nacimiento
        $fechaNacimientoTimestamp = strtotime($fechaNacimiento);
        $edadMinima = strtotime('-18 years');
        if ($fechaNacimientoTimestamp > $edadMinima) {
            $fechaNacimientoError = "Debes ser mayor de 18 años.";
        }
    }
    
    // Validación del campo "pais"
    if (empty($pais)) {
        $paisError = "Debes seleccionar al menos un país.";
    }
    
    // Validación del campo "acepto"
    if (empty($acepto) || $acepto !== "OK") {
        $aceptoError = "Debes aceptar los términos y condiciones.";
    }
    
    // Validación del campo "foto"
    if (isset($_FILES["foto"]) && $_FILES["foto"]["error"] === 0) {
        $allowedExtensions = ["jpg", "jpeg", "png", "gif"];
        $fileExtension = strtolower(pathinfo($_FILES["foto"]["name"], PATHINFO_EXTENSION));
        $maxFileSize = 5 * 1024 * 1024; // 5MB
        if (!in_array($fileExtension, $allowedExtensions) || $_FILES["foto"]["size"] > $maxFileSize) {
            $fotoError = "La foto debe ser en formato jpg, jpeg, png o gif y no debe superar 5MB.";
        }
    }
    
    // Si no hay errores, procesar los datos y mostrar un mensaje de éxito.
    if (!isset($nombreError) && !isset($claveError) && !isset($generoError)
        && !isset($fechaNacimientoError) && !isset($paisError) && !isset($aceptoError)
        && !isset($fotoError)) {
        // Aquí procesa los datos y muestra un mensaje de éxito.
        echo "Datos enviados con éxito. Gracias.";
    } else {
        // Si hay errores, muestra el formulario con mensajes de error.
        include "formulario.html";
    }
} else {
    // Si no se ha enviado el formulario, muestra el formulario vacío.
    include "formulario.html";
}
?>
