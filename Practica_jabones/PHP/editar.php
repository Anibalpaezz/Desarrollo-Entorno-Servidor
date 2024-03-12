<?php
include("conexion.php");

if(isset($_POST['edit_id']) && isset($_POST['editar_producto'])) {
    $productoID = $_POST['edit_id'];

    try {
        $conexion = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8mb4", $username, $password);
        $conexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $conexion->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);

        $query = $conexion->prepare("SELECT * FROM productos WHERE producto_ID = :id");
        $query->bindParam(':id', $productoID);
        $query->execute();
        $producto = $query->fetch(PDO::FETCH_ASSOC);

    } catch (PDOException $e) {
        die("Error al conectar: " . $e->getMessage());
    }
}

if(isset($_POST['actualizar_producto'])) {
    $productoID = $_POST['id'];
    $nombre = $_POST['nombre'];
    $descripcion = $_POST['descripcion'];
    $peso = $_POST['peso'];
    $precio = $_POST['precio'];

    try {
        $conexion = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8mb4", $username, $password);
        $conexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $conexion->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);

        $query = $conexion->prepare("UPDATE productos SET nombre = :nombre, descripcion = :descripcion, peso = :peso, precio = :precio WHERE producto_ID = :id");
        $query->bindParam(':nombre', $nombre);
        $query->bindParam(':descripcion', $descripcion);
        $query->bindParam(':peso', $peso);
        $query->bindParam(':precio', $precio);
        $query->bindParam(':id', $productoID);
        $query->execute();

        header("Location: admin.php");
        exit();

    } catch (PDOException $e) {
        die("Error al conectar: " . $e->getMessage());
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <link rel="stylesheet" href="../CSS/global.css">
    <link rel="shortcut icon" href="../Icon/favicon logo.png" type="image/x-icon">
    <title>Editar Producto</title>
</head>

<body>

    <h1>Editar Producto</h1>

    <form method="post" action="">
        <input type="hidden" name="id" value="<?php echo $producto['producto_ID']; ?>">
        <label for="nombre">Nombre:</label>
        <input type="text" name="nombre" value="<?php echo $producto['nombre']; ?>" required><br>

        <label for="descripcion">Descripción:</label>
        <textarea name="descripcion" required><?php echo $producto['descripcion']; ?></textarea><br>

        <label for="peso">Peso:</label>
        <input type="text" name="peso" value="<?php echo $producto['peso']; ?>" required><br>

        <label for="precio">Precio:</label>
        <input type="text" name="precio" value="<?php echo $producto['precio']; ?>" required><br>

        <button type="submit" name="actualizar_producto">Actualizar Producto</button>
    </form>

</body>

</html>
