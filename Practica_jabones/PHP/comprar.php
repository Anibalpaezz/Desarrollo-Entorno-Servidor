<?php
include("conexion.php");

session_start();
if (!isset($_SESSION['usuario'])) {
    header('Location: ../index.html');
}

if ($_SERVER["REQUEST_METHOD"] === "GET") {

    $coste = $conexion->prepare("SELECT sum(precio) FROM productos INNER JOIN item_cesta ON productos.producto_ID = item_cesta.producto_ID INNER JOIN cesta ON item_cesta.cesta_ID = cesta.cesta_ID WHERE email = :usuario");
    $coste->bindParam(":usuario", $_SESSION['usuario']);

    if ($coste->execute()) {
        $suma = $coste->fetchColumn();

        $fecha_actual = (new DateTime('now'))->format('Y-m-d');
        $fecha_prevista = (new DateTime('now'))->add(new DateInterval('P5D'))->format('Y-m-d');

        $pedido = $conexion->prepare("INSERT INTO pedidos (email, fecha_pedido, fecha_entrega, total_pedido, entregado) VALUES (:usuario, :fecha_actual, :fecha_prevista, :suma, false)");
        $pedido->bindParam(':usuario', $_SESSION['usuario']);
        $pedido->bindParam(':fecha_actual', $fecha_actual);
        $pedido->bindParam(':fecha_prevista', $fecha_prevista);
        $pedido->bindParam(':suma', $suma);

        if ($pedido->execute()) {
            $pedido_id = $conexion->prepare("SELECT pedido_id FROM pedidos WHERE email = :usuario");
            $pedido_id->bindParam(":usuario", $_SESSION["usuario"]);


            if ($pedido_id->execute()) {
                $id = $pedido_id->fetchColumn();

                $item_pedido = $conexion->prepare("INSERT INTO item_pedido (pedido_ID, producto_ID, unidades) SELECT :id, producto_ID, SUM(cantidad) FROM item_cesta INNER JOIN cesta ON item_cesta.cesta_ID = cesta.cesta_ID WHERE email = :usuario GROUP BY producto_ID");
                $item_pedido->bindParam(":id", $id);
                $item_pedido->bindParam(":usuario", $_SESSION['usuario']);

                if ($item_pedido->execute()) {
                    /* echo "todo bien"; */
                    $borrar_cesta = $conexion->prepare("DELETE FROM cesta WHERE email = :usuario");
                    $borrar_cesta->bindParam(":usuario", $_SESSION['usuario']);

                    if ($borrar_cesta->execute()) {
                        require('pdf.php');

                        $pdf = new PDF();
                        $pdf->generatePDF();
                        $pdf->Output('../PDF/' . $aleatorio_factura, 'S');

                        require("../Mail/src/PHPMailer.php");
                        require("../Mail/src/SMTP.php");

                        $smtpServidor = "localhost";
                        $smtpUsuario = "nico@troyan";
                        $smtpClave = "nico";
                        $smtpPuerto = 25;

                        $mail = new PHPMailer();

                        $mail->isSMTP();
                        $mail->Mailer = "SMTP";
                        $mail->SMTPAutoTLS = true;
                        $mail->isHTML(true);
                        $mail->Port = 25;
                        $mail->Host = "localhost";
                        $mail->SMTPAuth = true;
                        $mail->Username = "nico@troyan.com";
                        $mail->Password = "nico";
                        $mail->From = "nico@troyan.com";
                        $mail->Subject = "Factura simplificada";
                        $mail->FromName = "Jaboneria Scarlatti";
                        $mail->addAddress("justin@troyan.com");

                        /* $mail->setFrom('your-email@example.com', 'Your Name');
                        $mail->addAddress('recipient@example.com', 'Recipient Name'); */

                        $mail->Body = "Copia de la factura generada automaticamente";

                        /* $ruta = '../PDF/' . $aleatorio_factura; */
                        $mail->addStringAttachment('../PDF/' . $aleatorio_factura, 'Factura' . $aleatorio_factura . '.pdf');

                        if ($mail->send()) {
                            echo 'Correo enviado correctamente.';
                        } else {
                            echo 'Error al enviar el correo: ', $mail->ErrorInfo;
                        }
                    } else {
                        echo "Error en el borrado de cesta";
                    }
                } else {
                    echo "Error en la insercion a item pedido";
                }
            } else {
                echo "Error en la la consulta de pedido_ID";
            }
        } else {
            echo "Error en la insercion a pedido";
        }
    } else {
        echo "Error en la consulta de precio";
    }
} else {
    echo "Error no se llega por get";
}
?>