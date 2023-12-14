<?php
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $persona = $_POST['destino'];
        $dinero = $_POST['cantidad'];

        echo "Enviados " . $dinero . " euros a " . $persona;
    }
?>