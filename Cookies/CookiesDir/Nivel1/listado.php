<?php
    $cookies = $_COOKIE;

    echo "<h2>Cookies creadas</h2>";
    echo "<table>
        <tr border='1'>
            <th>Nombre</th>
            <th>Contenido</th>
        </tr>";

    foreach ($cookies as $nombre => $contenido) {
    echo "<tr>
            <td>$nombre</td>
            <td>$contenido</td>
        </tr>";
    }

    echo "</table>";
?>