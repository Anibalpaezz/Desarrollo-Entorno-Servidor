<?php

function prueba() {
    $num_args = func_num_args();

    echo "Numero de argumentos son:$num_args<br>\n";

    if ($num_args >= 2) {
        echo "El segundo argumento es: " . func_get_arg(1) . "<br>\n";
    }

    $parametros = func_get_args();
    echo "Array con todos los argumentos:<br>\n";
    print_r($parametros);
}

prueba(1,2,3);

?>