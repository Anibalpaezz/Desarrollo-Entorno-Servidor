<?php
function escribirEnArchivo1($nombreArchivo, $contenido) {
    $resultado = file_put_contents($nombreArchivo, $contenido);

    if ($resultado !== false) {
        return 'El archivo se ha escrito correctamente.';
    } else {
        return 'Hubo un error al escribir en el archivo.';
    }
}

// Ejemplo de uso
$nombreArchivo = 'mi_archivo.txt';
$contenido = 'Hola, este es un ejemplo de escritura en un archivo usando PHP';

echo escribirEnArchivo1($nombreArchivo, $contenido);

function escribirEnArchivo2($nombreArchivo, $contenido) {
    $archivo = fopen($nombreArchivo, 'w');

    if ($archivo) {
        $resultado = fwrite($archivo, $contenido);
        fclose($archivo);

        if ($resultado !== false) {
            return 'El archivo se ha escrito correctamente.';
        } else {
            return 'Hubo un error al escribir en el archivo.';
        }
    } else {
        return 'No se pudo abrir el archivo para escribir.';
    }
}

$nombreArchivo = 'mi_archivo.txt';
$contenido = 'Hola, este es un ejemplo de escritura en un archivo usando PHP';

echo escribirEnArchivo2($nombreArchivo, $contenido);
