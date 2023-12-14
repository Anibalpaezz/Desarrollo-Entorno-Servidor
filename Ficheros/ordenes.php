<?php
    /* $a =fopen('prueba.txt','r');
    while (!feof($a)) {
        echo fgets($a).'<br>';
    }
    fclose($a); */
    /* if (!$a=fopen('prueba.txt','r'))
    die ("Nada algo has hecho mal");
    echo ("Fichero abierto"); */

    if (!$a = fopen('prueba.txt', 'w+'))
    die("error");
    fwrite($a, "hola carmen\r\n");
    fputs($a, "hola pablo\r\n");
    rewind($a);
    while (!feof($a)) {
        echo fgets($a).'<br>';
    }
    echo "hola";
    fclose($a);
?>