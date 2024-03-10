<?php
function leerArchivo($nombreArchivo) {
    $contenido = file_get_contents($nombreArchivo);

    if ($contenido !== false) {
        return $contenido;
    } else {
        return 'Hubo un error al leer el archivo.';
    }
}

$nombreArchivo = 'mi_archivo.txt';

$resultadoLectura = leerArchivo($nombreArchivo);

if (is_string($resultadoLectura)) {
    echo $resultadoLectura;
} else {
    echo 'Contenido del archivo: ' . $resultadoLectura;
}

function leerArchivoSeparado($nombreArchivo) {
    $contenido = file_get_contents($nombreArchivo);

    if ($contenido !== false) {
        $valores = explode(';', $contenido);
        return $valores;
    } else {
        return 'Hubo un error al leer el archivo.';
    }
}

$nombreArchivo = 'mi_archivo.txt';

$resultadoLectura = leerArchivoSeparado($nombreArchivo);

if (is_array($resultadoLectura)) {
    foreach ($resultadoLectura as $valor) {
        echo $valor . '<br>';
    }
} else {
    echo $resultadoLectura;
}

function leerArchivo1($nombreArchivo) {
    $archivo = fopen($nombreArchivo, 'r');
    $contenido = '';

    if ($archivo) {
        while (($linea = fgets($archivo)) !== false) {
            $contenido .= $linea;
        }

        fclose($archivo);
        return $contenido;
    } else {
        return 'Hubo un error al leer el archivo.';
    }
}

$nombreArchivo = 'mi_archivo.txt';
$resultadoLectura = leerArchivo1($nombreArchivo);

if (is_string($resultadoLectura)) {
    echo $resultadoLectura;
} else {
    echo 'Contenido del archivo: ' . $resultadoLectura;
}

function leerArchivoSeparado2($nombreArchivo) {
    $archivo = fopen($nombreArchivo, 'r');
    $valores = [];

    if ($archivo) {
        while (($linea = fgets($archivo)) !== false) {
            $valores = explode(';', $linea);
        }

        fclose($archivo);
        return $valores;
    } else {
        return 'Hubo un error al leer el archivo.';
    }
}

$nombreArchivo = 'mi_archivo.txt';
$resultadoLectura = leerArchivoSeparado2($nombreArchivo);

if (is_array($resultadoLectura)) {
    foreach ($resultadoLectura as $valor) {
        echo $valor . '<br>';
    }
} else {
    echo $resultadoLectura;
}
