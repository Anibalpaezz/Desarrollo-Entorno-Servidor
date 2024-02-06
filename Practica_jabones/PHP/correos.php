<?php
require("../Mail/src/PHPMailer.php");
require("../Mail/src/SMTP.php");

function enviarmail($subject, $body, $recipient, $attachmentPath) {
    $smtpServidor = "localhost";
    $smtpUsuario = "nico@troyan";
    $smtpClave = "nico";
    $smtpPuerto = 25;

    $mail = new PHPMailer(true);

    try {
        $mail->isSMTP();
        $mail->Mailer = "smtp";
        $mail->SMTPAutoTLS = true;
        $mail->isHTML(true);
        $mail->Port = $smtpPuerto;
        $mail->Host = $smtpServidor;
        $mail->SMTPAuth = true;
        $mail->Username = $smtpUsuario;
        $mail->Password = $smtpClave;
        $mail->setFrom($smtpUsuario, "Jaboneria Scarlatti");
        $mail->Subject = $subject;
        $mail->addAddress($recipient);
        $mail->Body = $body;

        if ($attachmentPath !== null && file_exists($attachmentPath)) {
            $mail->addAttachment($attachmentPath);
        }

        $mail->send();
        return true;
    } catch (Exception $e) {
        return "Error al enviar el mail: " . $mail->ErrorInfo;
    }
}