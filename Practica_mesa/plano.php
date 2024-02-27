<?php
include("PHP/conexion.php");

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $restaurante = $_POST['restaurante'];
    $comensales = $_POST['comensales'];
    $fecha = $_POST['dia'];
    $hora = $_POST['horas'];

    /* $dia = $fecha->format('d');
    $mes = $fecha->format('m');
    $año = $fecha->format('Y'); */


    function reservas($restaurante)
    {
        try {
            $consulta = conectarBD()->prepare("SELECT * FROM mesa 
        INNER JOIN reservas ON mesa.numMesa = reservas.numMesa 
        WHERE mesa.restaurante = :restaurante");
            $consulta->bindParam(":restaurante", $restaurante);
            $consulta->execute();
        } catch (\Throwable $th) {
            throw $th;
        }


        $resultados = $consulta->fetchAll(PDO::FETCH_ASSOC);

        return $resultados;
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <style>
        *,
        body {
            text-align: center
        }

        button,
        img {
            cursor: pointer
        }

        * {
            align-items: center
        }

        body {
            background-color: #cab991;
            color: #333;
            align-items: center;
            justify-content: center;
            margin: 0
        }

        img {
            max-width: 75px;
        }

        input[type=radio] {
            display: none
        }

        input[type=radio]:checked+#fotos {
            border: 2px solid red;
        }

        #fotos {
            display: inline-block;
            cursor: pointer;
            margin: 5px;
            padding: 5px;
            border: 2px solid #ccc
        }

        table {
            margin-top: 15px;
            margin-left: auto;
            margin-right: auto
        }

        .reservada {
            cursor: not-allowed;
        }

        .disponible {
            cursor: pointer;
        }
    </style>
    <title>Mesas</title>
</head>

<body>
    <h2>Bienvenido a
        <?php echo $restaurante ?>
    </h2>
    Reservado: <img style="max-width: 25px;" src="Images/reservada.png" alt="Mesa Reservada">
    Disponible <img style="max-width: 25px;" src="Images/disponible.png" alt="Mesa Disponible">
    <br><br><br>
    <table>
        <?php
        $numFilas = 3;
        $numColumnas = 3;

        for ($i = 0; $i < $numFilas; $i++) {
            echo '<tr>';
            for ($j = 0; $j < $numColumnas; $j++) {
                $mesaId = $i * $numColumnas + $j + 1;
                echo '<td>';
                echo '<input type="radio" name="mesas" id= ' . $mesaId;

                $mesaReservada = true;
                $resultados = reservas($restaurante);
                foreach ($resultados as $row) {
                    if ($row['numMesa'] == $mesaId) {
                        $mesaReservada = false;
                        break;
                    }
                }
                if ($mesaReservada === false) {
                    echo ' disabled';
                }
                echo '>';
                echo '<label id="fotos" for=' . $mesaId . '>';

                if ($mesaReservada) {
                    echo '<img class="disponible" src="Images/disponible.png" alt="Mesa Disponible">';
                } else {
                    echo '<img class="reservada" src="Images/reservada.png" alt="Mesa Reservada">';
                }

                echo '</label>';
                echo '</td>';
            }
            echo '</tr>';
        }
        ?>
    </table>
</body>

</html>