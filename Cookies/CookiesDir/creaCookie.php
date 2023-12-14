<?php
    $nombre = $_POST['nombre'];
    $contenido = $_POST['contenido'];
    $nivel = $_POST['nivel'];
    $ruta_carpeta = "/CookiesDir/";

    if ($nombre && $contenido) {
        if ($nivel == "a") {
            /* $ruta_carpeta .= 'Nivel1'; */
            setcookie($nombre, $contenido, 0, $ruta_carpeta . 'Nivel1/');
            echo "Cookie creada en ". $ruta_carpeta . 'Nivel1';
        } else if ($nivel == "b") {
            setcookie($nombre, $contenido, 0, $ruta_carpeta.'Nivel2/');
            echo "Cookie creada en ". $ruta_carpeta . 'Nivel2';
        } else {
            setcookie($nombre, $contenido, 0, $ruta_carpeta.'Nivel3/');
            echo "Cookie creada en ". $ruta_carpeta . 'Nivel3';
        }
    }
?>