<?php
include("PHP/conexion.php");
session_start();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['correo'])) {
        $destinatario = $_POST['correo'];

        try {
            if (!filter_var($destinatario, FILTER_VALIDATE_EMAIL)) {
                throw new Exception('Correo electrónico no válido');
            }

            $inser_reserva = conectarBD()->prepare('INSERT INTO reservas (numMesa, restaurante, email, fecha, hora, estado, numPersonas) VALUES (:numMesa, :restaurante, :email, :fecha, :hora, "R", :numPersonas)');
            $inser_reserva->bindParam(':numMesa', $_SESSION['mesa'], PDO::PARAM_INT);
            $inser_reserva->bindParam(':restaurante', $_SESSION['restaurante'], PDO::PARAM_STR);
            $inser_reserva->bindParam(':email', $destinatario, PDO::PARAM_STR);
            $inser_reserva->bindParam(':fecha', $_SESSION['fecha'], PDO::PARAM_STR);
            $inser_reserva->bindParam(':hora', $_SESSION['hora'], PDO::PARAM_STR);
            $inser_reserva->bindParam(':numPersonas', $_SESSION['comensales'], PDO::PARAM_INT);

            if ($inser_reserva->execute()) {
                $mensajeConfirmacion = "¡Reserva completada con éxito! Hemos enviado un correo de confirmación a tu dirección. Gracias por elegirnos.";

                echo $mensajeConfirmacion;
            }
        } catch (Exception $e) {
            echo 'Error: ' . $e->getMessage();
        }
    } else {
        echo 'No se ha seleccionado ninguna mesa.';
    }
}
?>
