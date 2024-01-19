<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $tipo = $_POST['tipo'];

    include "conectar.php";

    try {

        $consulta = "SELECT email FROM informacion";
        $correos = $conexion->prepare($consulta);
        $correos->execute();

        $resultado_correos = $correos->fetchAll(PDO::FETCH_ASSOC);
    } catch (Exception $e) {
        echo 'Excepción: ', $e->getMessage(), "\n";
    }
} else {
    header('location: index.html');
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Correos</title>
    <style>
        img {
            width: 100px;
            height: 65px;
            cursor: pointer;
        }

        input[type="radio"] {
            display: none;
        }

        input[type="radio"]:checked+label {
            border: 2px solid blue;
        }

        label {
            display: inline-block;
            cursor: pointer;
            margin: 5px;
            padding: 5px;
            border: 2px solid #ccc;
        }
    </style>
</head>

<body>
    <h1>Envio de postales</h1>
    <?php
        if ($tipo == 'navidad') {
            
        } else if ($tipo == 'vienna') {
            
        } else {
            
        }
    ?>
    <table>
        <tr>
            <td>
                <input type="radio" name="opciones" id="opcion1">
                <label for="opcion1">
                    <img src="fotos/navidad/1.jpg" alt="">
                </label>
            </td>
            <td>
                <input type="radio" name="opciones" id="opcion2">
                <label for="opcion2">
                    <img src="fotos/navidad/2.jpg" alt="">
                </label>
            </td>
            <td>
                <input type="radio" name="opciones" id="opcion3">
                <label for="opcion3">
                    <img src="fotos/navidad/3.jpg" alt="">
                </label>
            </td>
            <td>
                <input type="radio" name="opciones" id="opcion4">
                <label for="opcion4">
                    <img src="fotos/navidad/4.jpg" alt="">
                </label>
            </td>
            <td>
                <input type="radio" name="opciones" id="opcion5">
                <label for="opcion5">
                    <img src="fotos/navidad/5.jpg" alt="">
                </label>
            </td>
        </tr>
    </table>

    <form action="" method="post">
        Destinatario: <select name="" id="">
            <?php
            if ($correos->rowCount() > 0) {
                foreach ($resultado_correos as $row) {
                    echo "<option value='" . htmlspecialchars($row["email"], ENT_QUOTES) . "'>" . htmlspecialchars($row["email"]) . "</option>";
                }
            } else {
                echo "<option value=''>No hay opciones disponibles</option>";
            }

            $conexion = null;
            ?>
        </select>

        Mensaje: <input type="text" name="mensaje" id="mensaje">

        Tema: <input type="text" name="tema" id="tema">

        <button type="submit">Enviar</button>
    </form>

    <script></script>
</body>

</html>