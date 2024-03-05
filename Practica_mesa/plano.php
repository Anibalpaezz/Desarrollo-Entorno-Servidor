<?php
include("PHP/conexion.php");
session_start();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $restaurante = $_POST['restaurante'];
    $comensales = $_POST['comensales'];
    $fecha = $_POST['dia'];
    $hora = $_POST['horas'];

    $_SESSION['restaurante'] = $restaurante;
    $_SESSION['comensales'] = $comensales;
    $_SESSION['fecha'] = $fecha;
    $_SESSION['hora'] = $hora;

    function reservas($restaurante)
    {
        try {
            $consulta = conectarBD()->prepare("SELECT * FROM mesa 
        INNER JOIN reservas ON mesa.numMesa = reservas.numMesa 
        WHERE mesa.restaurante = :restaurante");
            $consulta->bindParam(":restaurante", $restaurante);
            if ($consulta->execute()) {
                echo "";
            } else {
                echo "Error al consultar las reservas";
            }
        } catch (\Throwable $th) {
            throw $th;
        }


        $reservadas = $consulta->fetchAll(PDO::FETCH_ASSOC);

        return $reservadas;
    }

    function sitios($mesaId)
    {
        try {
            $consulta = conectarBD()->prepare("SELECT capacidad FROM mesa WHERE numMesa = :numMesa");
            $consulta->bindParam(":numMesa", $mesaId);
            $consulta->execute();
        } catch (\Throwable $th) {
            throw $th;
        }

        $sitios = $consulta->fetch(PDO::FETCH_ASSOC);
        return $sitios['capacidad'];
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" href="Icon/favicon logo.png" type="image/x-icon">
    <link rel="stylesheet" href="CSS/plano.css">
    <title>Mesas</title>
</head>

<body>
    <h2>Bienvenido a
        <?php echo $restaurante ?>
    </h2>
    Reservado: <img style="max-width: 25px;" src="Images/reservada.png" alt="Mesa Reservada">
    Disponible <img style="max-width: 25px;" src="Images/disponible.png" alt="Mesa Disponible">
    <br><br><br>
    <form action="confirmacion.php" method="POST">
        <table>
            <?php
            $numFilas = 3;
            $numColumnas = 3;

            for ($i = 0; $i < $numFilas; $i++) {
                echo '<tr>';
                for ($j = 0; $j < $numColumnas; $j++) {
                    $mesaId = $i * $numColumnas + $j + 1;
                    echo '<td>';
                    echo '<input type="radio" name="mesas" value="' . $mesaId . '" id="' . $mesaId . '"';


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

                    // Use sitios() to get the capacity
                    if ($mesaReservada) {
                        echo '<img class="disponible" src="Images/disponible.png" alt="Mesa Disponible">';
                    } else {
                        echo '<img class="reservada" src="Images/reservada.png" alt="Mesa Reservada">';
                    }
                    echo "<br>";
                    echo 'Mesa ' . $mesaId;
                    echo ' para ' . sitios($mesaId) . ' comensales';

                    echo '</label>';
                    echo '</td>';
                }
                echo '</tr>';
            }
            ?>
        </table>
        <button type="submit">Enviar</button>
    </form>
</body>

</html>