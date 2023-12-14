<?php
$archivo = "visitas.txt";
$page = $_SERVER['PHP_SELF'];
$sec = "0.1";
header("Refresh: $sec; url=$page");

/* if (!$abrir = fopen('visitas.txt', 'w+')) {
    die ("error");
} */

if (file_exists($archivo)) {
    $fp = fopen($archivo, "r+");
    $contador = fread($fp, 16);
    $contador = (int)$contador - 800;
    
    rewind($fp);
    
    fwrite($fp, $contador);

    fclose($fp);
    
    echo "Esta es la visita número: $contador";
} else {
    echo "No se pudo abrir el archivo de visitas.";
}
?>
