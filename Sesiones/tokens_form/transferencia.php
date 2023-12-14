<?php
session_start();

if (!isset($_SESSION['usuario'])) {
    die();
} else {
    echo '<div class="transfer-form">';
    echo '<form action="procesar_tranferencia.php" method="POST">';
    $token = uniqid();
    $_SESSION['token'] = $token;
    echo '<label for="id_cantidad">Cantidad:</label>';
    echo '<input type="text" id="id_cantidad" name="cantidad"/>';
    echo '<br />';
    echo '<label for="id_destino">Destino:</label>';
    echo '<input type="text" id="id_destino" name="destino"/>';
    echo '<br />';
    echo '<input type="submit" value="Enviar"/>';
    echo '</form>';
    echo '</div>';
}
?>
