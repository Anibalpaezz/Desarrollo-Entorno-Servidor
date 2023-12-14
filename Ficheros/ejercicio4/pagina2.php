<?php
    $fichero = 'datos.txt';
    $nombre = $_POST['usuario'];
    $coment = $_POST['comentario'];

    if (is_writable($fichero)) {
        if (!$fp = fopen($fichero, 'a+')) {
            die("Error 2");
        }

        if (fwrite($fp, $nombre) === FALSE) {
            die("Error 3");
        }

        if (fwrite($fp, $coment) === FALSE) {
            die("Error 3");
        }

        echo "Correcto";
    }   
?>