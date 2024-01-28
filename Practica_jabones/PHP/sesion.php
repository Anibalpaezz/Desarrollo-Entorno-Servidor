<?php
include("conexion.php");

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    if (isset($_POST["usuario"])) {
        $usuario = $_POST["usuario"];
    }

    if (isset($_POST["pass"])) {
        $pass = $_POST["pass"];
    }

    /* echo $usuario;
    echo $pass; */

    function correo($usuario)
    {
        $patron_correo = '/^[a-zA-Z0-9._-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,4}$/';

        return preg_match($patron_correo, $usuario);
    }

    function nombre($usuario)
    {
        $patron_nombre = '/^[A-Za-z\s]+$/';

        return preg_match($patron_nombre, $usuario);
    }

    if (correo($usuario)) {
        $consulta = $conexion->prepare("SELECT * FROM clientes WHERE email = ? AND pass = ?");

        try {
            $consulta->bindParam(1, $usuario);
            $consulta->bindParam(2, $pass);

            $consulta->execute();
            $resultado = $consulta->fetch(PDO::FETCH_ASSOC);

            if ($resultado) {
                echo "bien correo";
                header("Location: jabones.php");
            } else {
                echo "mal correo";
                header("Location: ../index.html");
            }
        } catch (PDOException $e) {
            die("Error en la consulta: " . $e->getMessage());
        }
    } else if (nombre($usuario)) {
        $consulta = $conexion->prepare("SELECT * FROM administradores WHERE usuario = ? AND pass = ?");

        try {
            $consulta->bindParam(1, $usuario);
            $consulta->bindParam(2, $pass);

            $consulta->execute();
            $resultado = $consulta->fetch(PDO::FETCH_ASSOC);

            if ($resultado) {
                echo "bien user";
                header("Location: jabones.php");
            } else {
                echo "mal user";
                header("Location: ../index.html");
            }
        } catch (PDOException $e) {
            die("Error en la consulta: " . $e->getMessage());
        }
    } else {
        echo "Todo mal";
    }
}
