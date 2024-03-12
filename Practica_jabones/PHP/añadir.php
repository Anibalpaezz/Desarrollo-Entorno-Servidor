<?php
include("conexion.php");

$nombreError = $descripcionError = $pesoError = $precioError = $fotoError = "";

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $nombre = $_POST['nombre'];
    if (preg_match('/[0-9]/', $nombre)) {
        $nombreError = "El nombre no debe contener números";
    }

    $descripcion = $_POST['descripcion'];
    if (preg_match('/[0-9]/', $descripcion)) {
        $descripcionError = "La descripción no debe contener números";
    }

    $peso = $_POST['peso'];
    if (!is_numeric($peso)) {
        $pesoError = "El peso debe ser un número";
    }

    $precio = $_POST['precio'];
    if (!is_numeric($precio)) {
        $precioError = "El precio debe ser un número";
    }

    $foto = $_FILES['foto']['name'];
    $allowed_extensions = array("jpg", "png");
    $file_extension = pathinfo($foto, PATHINFO_EXTENSION);
    if (!in_array($file_extension, $allowed_extensions)) {
        $fotoError = "Solo se permiten archivos JPG y PNG";
    }

    if (empty($nombreError) && empty($descripcionError) && empty($pesoError) && empty($precioError) && empty($fotoError)) {
        try {
            $insercion = $conexion->prepare("INSERT INTO productos (nombre, descripcion, peso, precio, imagen) VALUES (:nombre, :descripcion, :peso, :precio, :foto)");

            $insercion->bindParam(':nombre', $nombre);
            $insercion->bindParam(':descripcion', $descripcion);
            $insercion->bindParam(':peso', $peso);
            $insercion->bindParam(':precio', $precio);

            $ruta = "Images/" . $foto;
            $insercion->bindParam(':foto', $ruta);

            move_uploaded_file($_FILES['foto']['tmp_name'], '../Images/' . $foto);

            if (!file_exists('../Images/' . $foto)) {
                $fotoError = "Error uploading the file.";
            } else {
                $insercion->execute();
            }
            header('Location: productos-login.php');
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
    <link rel="shortcut icon" href="../Icon/favicon logo.png" type="image/x-icon">
    <title>Enjabon-arte</title>
    <link rel="stylesheet" href="../CSS/global.css">
    <style>
        .form-container {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 10px;
            background: none;
        }

        .form-group {
            margin-bottom: 10px;
            background: none;
        }
    </style>
</head>

<body>
    <div id="contenido">
        <h1>Añadir un producto</h1>
        <form action="añadir.php" method="post" enctype="multipart/form-data">
            <div class="form-container">
                <div class="form-group">
                    <label for="nombre">Nombre: </label>
                    <input type="text" id="nombre" name="nombre" maxlength="255">

                    <span class="error">
                        <?php echo $nombreError; ?>
                    </span>
                </div>

                <div class="form-group">
                    <label for="descripcion">Descripción:</label>
                    <input type="text" id="descripcion" name="descripcion">
                    <span class="error">
                        <?php echo $descripcionError; ?>
                    </span>
                </div>

                <div class="form-group">
                    <label for="peso">Peso:</label>
                    <input type="number" id="peso" name="peso">
                    <span class="error">
                        <?php echo $pesoError; ?>
                    </span>
                </div>

                <div class="form-group">
                    <label for="precio">Precio:</label>
                    <input type="number" id="precio" name="precio">
                    <span class="error">
                        <?php echo $precioError; ?>
                    </span>
                </div>

                <div class="form-group">
                    <label for="foto">Fotografia:</label>
                    <input type="file" id="foto" name="foto">
                    <span class="error">
                        <?php echo $fotoError; ?>
                    </span>
                </div>
            </div>


            <button type="submit">Añadir</button>
        </form>
        <a href="../index.html"><button class="button">Menu</button></a>
    </div>
</body>

</html>