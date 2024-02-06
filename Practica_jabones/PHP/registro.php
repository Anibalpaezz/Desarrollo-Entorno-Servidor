<?php
include("conexion.php");

$emailError = $passError = $nombreError = $direccionError = $cpError = $telefonoError = "";

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $email = $_POST['email'];
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $emailError = "Formato de correo electrónico no válido";
    }
    $pass = $_POST['pass'];
    $nombre = $_POST['nombre'];
    $direccion = $_POST['direccion'];

    $cp = $_POST['CP'];
    if (!ctype_digit($cp)) {
        $cpError = "El código postal debe contener solo números";
    }

    $telefono = $_POST['telefono'];
    if (!ctype_digit($telefono)) {
        $telefonoError = "El teléfono debe contener solo números";
    }

    if (empty($emailError) && empty($passError) && empty($nombreError) && empty($direccionError) && empty($cpError) && empty($telefonoError)) {
        try {
            $existencia = $conexion->prepare("SELECT COUNT(*) FROM clientes WHERE email = :email");
            $existencia->bindParam(':email', $email);
            $existencia->execute();

            if ($existencia->fetchColumn() > 0) {
                die("El correo ya existe en nuestra base de datos");
            }

            $insercion = $conexion->prepare("INSERT INTO clientes (email, pass, nombre, direccion, CP, telefono) VALUES (:email, :pass, :nombre, :direccion, :cp, :telefono)");

            $insercion->bindParam(':email', $email);
            $insercion->bindParam(':pass', $pass);
            $insercion->bindParam(':nombre', $nombre);
            $insercion->bindParam(':direccion', $direccion);
            $insercion->bindParam(':cp', $cp, PDO::PARAM_INT);
            $insercion->bindParam(':telefono', $telefono);

            $insercion->execute();

            header('Location: ../index.html');
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
    <link rel="stylesheet" href="CSS/global.css">
    <link rel="stylesheet" href="../CSS/registro.css">
</head>

<body>
    <div id="contenido">
        <h1>Registro de Usuario</h1>
        <form action="registro.php" method="post">
            <label for="email">Correo electronico</label>
            <span class="error"><?php echo $emailError; ?></span>
            <input type="text" id="email" name="email" maxlength=""><br><br>

            <label for="pass">Contraseña</label>
            <input type="password" id="pass" name="pass"><br><br>

            <label for="nombre">Nombre</label>
            <input type="text" id="nombre" name="nombre"><br><br>

            <label for="direccion">Direccion</label>
            <input type="text" id="direccion" name="direccion"><br><br>

            <label for="CP">Codigo Postal</label>
            <span class="error"><?php echo $cpError; ?></span>
            <input type="text" id="CP" name="CP"><br><br>

            <label for="telefono">Telefono:</label>
            <span class="error"><?php echo $telefonoError; ?></span>
            <input type="text" id="telefono" name="telefono" maxlength="12"><br><br>
            

            <button type="submit">Registrarse</button>
        </form>
        <a href="../index.html"><button class="button">Menu</button></a>
    </div>
</body>

</html>