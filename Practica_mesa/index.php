<?php
include("PHP/conexion.php");

function horas() {
    $archivo = fopen("horas.txt", "r");

    if ($archivo === false) {
        echo "No se pudo abrir el archivo.\n";
        exit(1);
    }

    while (($linea = fgets($archivo)) !== false) {
        $horas[] = $linea;
    }

    fclose($archivo);
    return $horas;
}

function restaurante() {
    try {
        $consulta = conectarBD()->prepare("SELECT DISTINCT restaurante, capacidad FROM mesa");
        if ($consulta->execute()) {
            echo "bien";
            $resultados = $consulta->fetchAll();
            return $resultados;
        }
    } catch (\Throwable $th) {
        throw $th;
    }
}
?>

<!DOCTYPE html>
<html>

<head>
    <title>Slide Navbar</title>
    <!-- <link rel="stylesheet" type="text/css" href="CSS/index.css"> -->
    <link href="https://fonts.googleapis.com/css2?family=Jost:wght@500&display=swap" rel="stylesheet">
</head>

<body>
    <select name="restaurante" id="restaurante">
        <?php
        $resultados = restaurante();

        if ($resultados) {
            foreach ($resultados as $row) {
                echo "<option value='{$row['restaurante']}'>{$row['restaurante']}</option>";
            }
        } else {
            echo "<option value=''>No hay restaurantes disponibles</option>";
        }
        ?>
    </select>
    
    <select name="horas" id="horas">
        <?php
        $horas = horas();

        if ($horas) {
            foreach ($horas as $linea) {
                echo "<option value='{$linea}'>{$linea}</option>";
            }
        } else {
            echo "<option value=''>No hay horas disponibles</option>";
        }
        ?>
    </select>
    <!-- <div class="main">
        <input type="checkbox" id="chk" aria-hidden="true">

        <div class="signup">
            <form>
                <label for="chk" aria-hidden="true">Sign up</label>
                <input type="text" name="txt" placeholder="User name" required="">
                <input type="email" name="email" placeholder="Email" required="">
                <input type="password" name="pswd" placeholder="Password" required="">
                <button>Sign up</button>
            </form>
        </div>

        <div class="login">
            <form>
                <label for="chk" aria-hidden="true">Login</label>
                <input type="email" name="email" placeholder="Email" required="">
                <input type="password" name="pswd" placeholder="Password" required="">
                <button>Login</button>
            </form>
        </div>
    </div> -->
</body>

</html>