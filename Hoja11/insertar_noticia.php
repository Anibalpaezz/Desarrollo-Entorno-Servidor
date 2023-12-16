<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>News Form</title>
</head>
<body>

<?php
    // Check if the form is submitted
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        // Retrieve form data
        $titulo = $_POST["titulo"];
        $texto = $_POST["texto"];
        $categoria = $_POST["categoria"];

        // Process the form data (you can insert into the database or perform other actions)
        // For now, let's just echo the values
        echo "Titulo: $titulo <br>";
        echo "Texto: $texto <br>";
        echo "Categoria: $categoria <br>";

        // Handling the file upload (you may need to implement further validation and handling)
        if (isset($_FILES["imagen"]) && $_FILES["imagen"]["error"] == UPLOAD_ERR_OK) {
            $target_dir = "uploads/"; // specify your target directory
            $target_file = $target_dir . basename($_FILES["imagen"]["name"]);

            // Move the uploaded file to the desired location
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
