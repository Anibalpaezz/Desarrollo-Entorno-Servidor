<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);


if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nombreFotoSeleccionada = $_POST['src_foto_seleccionada'];
    $destinatario = $_POST['destinatario'];
    $asunto = $_POST['tema'];
    $mensaje = $_POST['mensaje'];


    /* echo $asunto; */
    /* echo $destinatario; */
    /* echo $nombreFotoSeleccionada; */
    /* echo $mensaje; */


    require "/var/www/html/ejer_mail/PHPMailer-master/src/PHPMailer.php";
    require "/var/www/html/ejer_mail/PHPMailer-master/src/SMTP.php";



    $smtpServidor = "localhost";
    $smtpUsuario = "anibal@troyan";
    $smtpClave = "nico1234";
    $smtpPuerto = 25;

    $mail = new PHPMailer();

    /* require('/var/www/html/github/servidorphp/PHPMailer-master/src/PHPMailer.php');
    require('/var/www/html/github/servidorphp/PHPMailer-master/src/SMTP.php');
    $mail = new PHPMailer();
    $mail->isSMTP();
    $mail->Mailer = "SMTP";
    $mail->SMTPAutoTLS = true;
    $mail->isHTML(true);
    $mail->Port = 25;
    $mail->Host = "localhost";
    $mail->SMTPAuth = true;
    $mail->Username = "jefe@nicolas.com";
    $mail->Password = "jefe";
    $mail->From = "anibal@troyan.com;
    $mail->FromName = "jefe";
    $mail->Timeout = 30; */

    /* try { */
        $mail->isSMTP();
        $mail->Mailer = "SMTP";
        $mail->SMTPAutoTLS = true;
        $mail->isHTML(true);
        $mail->Port = 25;
        $mail->Host = "localhost";
        $mail->SMTPAuth = true;
        $mail->Username = "anibal@troyan.com";
        $mail->Password = "nico1234";
        $mail->From = "anibal@troyan.com";
        $mail->FromName = "yo";


        $mail->addAddress("nico@troyan.com");
        $mail->Subject = 'Probando';
        $mail->Body = 'Hola';
        

        
        

        if ($mail->send()) {
            echo 'Correo enviado correctamente.';
        } else {
            echo 'Error al enviar el correo: ', $mail->ErrorInfo;
        }
        
    /* } catch (Exception $e) {
        echo 'Error al enviar el correo: ', $mail->ErrorInfo;
    } */
} else {
    header('location: index.html');
}



