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
        @import url(https://fonts.googleapis.com/css2?family=Archivo+Black&display=swap);

        * {
            font-family: Archivo Black;
            font-weight: 100;
            text-align: center;
            align-items: center;
        }

        body {
            background-color: #cab991;
            color: #333;
            text-align: center;
            align-items: center;
            justify-content: center;
            margin: 0;
        }

        h1 {
            color: #141414;
        }

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

        table {
            margin-top: 15px;
            margin-left: auto;
            margin-right: auto;
        }


        select,
        input[type="text"] {
            width: 200px;
            padding: 10px;
            margin-top: 10px;
        }

        button {
            background-color: #006400;
            color: beige;
            padding: 10px;
            border: none;
            margin-top: 10px;
            cursor: pointer;
        }

        select {
            width: 200px;
        }

        button:hover,
        select:hover {
            background-color: #003300;
        }

        label,
        #destinatario {
            display: inline-block;
            cursor: pointer;
            margin: 5px;
            padding: 5px;
            border: 2px solid #ccc;
        }

        #tabla {}
    </style>
</head>

<body>
    <h1>Envío de postales</h1>
    <div id="tabla">
        <table>
            <tr>
                <td>
                    <input type="radio" name="opciones" id="opcion1">
                    <label for="opcion1">
                        <img src="fotos/<?php echo $tipo ?>/1.jpg" alt="">
                    </label>
                </td>
                <td>
                    <input type="radio" name="opciones" id="opcion2">
                    <label for="opcion2">
                        <img src="fotos/<?php echo $tipo ?>/2.jpg" alt="">
                    </label>
                </td>
                <td>
                    <input type="radio" name="opciones" id="opcion3">
                    <label for="opcion3">
                        <img src="fotos/<?php echo $tipo ?>/3.jpg" alt="">
                    </label>
                </td>
                <td>
                    <input type="radio" name="opciones" id="opcion4">
                    <label for="opcion4">
                        <img src="fotos/<?php echo $tipo ?>/4.jpg" alt="">
                    </label>
                </td>
                <td>
                    <input type="radio" name="opciones" id="opcion5">
                    <label for="opcion5">
                        <img src="fotos/<?php echo $tipo ?>/5.jpg" alt="">
                    </label>
                </td>
            </tr>
        </table>
    </div>


    <form action="" method="post">
        <div id="select"> <label for="destinatario">Destinatario</label><select name="destinatario" id="destinatario">
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
            </select></div>
        <div id="mensaje">Mensaje: <input type="text" name="mensaje" id="mensaje"></div>
        <div id="tema">Tema: <input type="text" name="tema" id="tema"></div>
        <div id="boton"><button type="submit">Enviar</button></div>
    </form>

    <script></script>
</body>

</html>