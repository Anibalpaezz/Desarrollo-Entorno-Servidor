<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nombreFotoSeleccionada = $_POST['src_foto_seleccionada'];
    $destinatario = $_POST['destinatario'];
    $asunto = $_POST['tema'];
    $mensaje = $_POST['mensaje'];


    /* echo $asunto; */
    /* echo $destinatario; */
    /* echo $nombreFotoSeleccionada; */
    /* echo $mensaje; */

    require 'PHPMailer-master/src/Exception.php';
    require 'PHPMailer-master/src/PHPMailer.php';
    require 'PHPMailer-master/src/SMTP.php';

    
    
    $smtpServidor = "localhost";
    $smtpUsuario = "anibal@troyan";
    $smtpClave = "nico1234";
    $smtpPuerto = 25;
    
    $mail = new PHPMailer(true);
    
    try {
        $mail->isSMTP();
        $mail->Host = $smtpServidor;
        $mail->SMTPAuth = true;
        $mail->Username = $smtpUsuario;
        $mail->Password = $smtpClave;
        $mail->Port = $smtpPuerto;
        $mail->SMTPSecure = 'tsl';
    
        $mail->setFrom('anibal@troyan.com', 'Anibal');
        $mail->addAddress('seresep879@rentaen.com', 'Yo tambien');
        $mail->Subject = 'Probando';
        $mail->Body = 'Hola';
    
        $mail->send();
        echo 'Correo enviado correctamente.';
    } catch (Exception $e) {
        echo 'Error al enviar el correo: ', $mail->ErrorInfo;
    }




} else {
    header('location: index.html');
}



