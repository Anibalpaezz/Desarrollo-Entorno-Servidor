<?php
    $conectar = new mysqli("localhost", "anibal", "nico", "inmobiliaria");

    if ($conectar -> connect_errno) {
        die("Error al conectar: " . $conectar -> connect_error);
    }

    $consulta = "SELECT * FROM noticias";
    if ($mostrar = $conectar -> query($consulta)) {
        while ($fila = $mostrar -> fetch_row()) {
            foreach($fila  as $valor) {
                echo $valor;
            }

            $mostrar -> close();
        }

        $conectar -> close();
    }
?>