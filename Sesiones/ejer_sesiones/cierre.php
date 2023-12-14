<?php
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['cerrar_sesion'])) {
        session_unset();

        if (isset($_COOKIE[session_name()])) {
            setcookie(session_name(), '', time()-3600, '/');
        }

        session_destroy();

        header("Location: acreditacion.php");
        exit();
    }
?>