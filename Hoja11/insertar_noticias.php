<?php
include("conectar.php");
include("estilos.html");

session_start();

if (!isset($_SESSION['usuario']) || !isset($_SESSION['permisos'])) {
    header('Location: index.html');
    exit();
}

$usuario = $_SESSION['usuario'];
$valor = $_SESSION['permisos'];

$categorias = [];
$consulta_categorias = "SELECT DISTINCT categoria FROM noticias";
if ($resultado = mysqli_query($conexion, $consulta_categorias)) {
    while ($fila = mysqli_fetch_assoc($resultado)) {
        $categorias[] = $fila['categoria'];
    }
    mysqli_free_result($resultado);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $titulo = $_POST["titulo"];
    $texto = $_POST["texto"];
    $categoria = $_POST["categoria"];
    $fecha = $_POST["fecha"];

    if (isset($_FILES["imagen"]) && $_FILES["imagen"]["error"] == 0) {
        // Obtiene el nombre del archivo
        $nombreArchivo = $_FILES["imagen"]["name"];


        // Muestra la información (puedes ajustarlo según tus necesidades)
        echo 'Nombre del archivo: ' . $nombreArchivo . '<br>';
    } else {
        echo 'Error al subir el archivo.';
    }

    $consulta = "INSERT INTO noticias (titulo, texto, categoria, fecha, imagen) VALUES ('$titulo', '$texto', '$categoria', '$fecha', '$nombreArchivo')";

    if (mysqli_query($conexion, $consulta)) {
        echo "Noticia insertada correctamente.";
    } else {
        echo "Error al insertar la noticia: " . mysqli_error($conexion);
    }

    mysqli_close($conexion);
}


?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Insertar Noticia</title>
    <link rel="stylesheet" href="estilos.css">
</head>

<body>
    <h2>Insertar Noticia</h2>
    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post" enctype="multipart/form-data">
        Título: <input type="text" name="titulo" required><br><br>
        Texto: <textarea name="texto" cols="30" rows="10" required></textarea><br><br>
        Categoría:
        <select name="categoria" required>
            <?php foreach ($categorias as $categoria) { ?>
                <option value="<?php echo $categoria; ?>">
                    <?php echo $categoria; ?>
                </option>
            <?php } ?>
        </select><br><br>
        Fecha: <input type="date" name="fecha" required><br><br>
        Imagen: <input type="file" name="imagen" required><br><br>
        <button type="submit" name="enviar">Enviar</button>
    </form>
    <a href="acciones.php"><button class="button">Volver</button></a>
</body>

</html>