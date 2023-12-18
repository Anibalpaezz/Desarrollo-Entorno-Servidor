<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Introducir noticias</title>
    <link rel="stylesheet" href="estilos.css">
</head>

<body>

    <?php
    include("conectar.php");
    include("estilos.html");

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $titulo = $_POST["titulo"];
        $texto = $_POST["texto"];
        $categoria = $_POST["categoria"];

        echo "Titulo: $titulo <br>";
        echo "Texto: $texto <br>";
        echo "Categoria: $categoria <br>";

        if (isset($_FILES["imagen"]) && $_FILES["imagen"]["error"] == UPLOAD_ERR_OK) {
            $target_dir = "uploads/";
            $target_file = $target_dir . basename($_FILES["imagen"]["name"]);

            if (move_uploaded_file($_FILES["imagen"]["tmp_name"], $target_file)) {
                echo "Imagen uploaded successfully. <br>";
            } else {
                echo "Error uploading image. <br>";
            }
        }
    }
    ?>

    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post" enctype="multipart/form-data">
        Titulo: <input type="text" name="titulo" id="titulo"><br><br>

        Texto: <textarea name="texto" id="texto" cols="30" rows="10"></textarea><br><br>

        Categoria: <select name="categoria" id="categoria">
            <option value="Promociones">Promociones</option>
            <option value="Ofertas">Ofertas</option>
            <option value="Costas">Costas</option>
        </select><br><br>

        Imagen: <input type="file" name="imagen"><br><br>

        <button type="submit">Insertar noticia</button>
    </form>

</body>

</html>