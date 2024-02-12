<?php
include("conexion.php");

$emailError = $passError = $nombreError = $apellidoError = "";

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $email = $_POST['email'];
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $emailError = "Formato de correo electrónico no válido";
    }

    $pass = $_POST['pass'];
    if (strlen($pass) < 2) {
        $passError = "La contraseña debe tener como minimo 2 caracteres";
    }

    $nombre = $_POST['nombre'];
    $apellido = $_POST['apellido'];

    if (empty($emailError) && empty($passError) && empty($nombreError) && empty($apellidoError)) {
        try {
            $existencia = $conexion->prepare("SELECT COUNT(*) FROM clientes WHERE cemail = :email");
            $existencia->bindParam(':email', $email);
            $existencia->execute();

            if ($existencia->fetchColumn() > 0) {
                die("El correo ya existe en nuestra base de datos");
            }

            $insercion = $conexion->prepare("INSERT INTO clientes (cnombre, capellido, cclave, cemail) VALUES (:nombre, :apellido, :pass, :email)");

            $insercion->bindParam(':nombre', $nombre);
            $insercion->bindParam(':apellido', $apellido);
            $insercion->bindParam(':pass', $pass);
            $insercion->bindParam(':email', $email);

            $insercion->execute();

            header('Location: index.html');
        } catch (PDOException $e) {
            die("Error al insertar los datos: " . $e->getMessage());
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registro de Usuario</title>
</head>

<body>
    <div id="contenido">
        <h1>Registro de Usuario</h1>
        <form action="registro.php" method="post">
            <div class="form-container">
                <div class="form-group">
                    <label for="email">Correo electrónico:</label>
                    <input type="text" id="email" name="email" maxlength="">
                    <span class="error">
                        <?php echo $emailError; ?>
                    </span>
                </div>

                <div class="form-group">
                    <label for="pass">Contraseña:</label>
                    <input type="password" id="pass" name="pass">
                    <span class="error">
                        <?php echo $passError; ?>
                    </span>
                </div>

                <div class="form-group">
                    <label for="nombre">Nombre:</label>
                    <input type="text" id="nombre" name="nombre">
                </div>

                <div class="form-group">
                    <label for="apellido">Apellido:</label>
                    <input type="text" id="apellido" name="apellido">
                </div>
            </div>

            <button type="submit">Registrarse</button>
        </form><!-- 
        <a href="../index.html"><button class="button">Menu</button></a> -->
    </div>
</body>

</html>