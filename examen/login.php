<?php
include("conexion.php");

session_start();

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    if (isset($_POST["usuario"])) {
        $usuario = $_POST["usuario"];
    }

    if (isset($_POST["pass"])) {
        $pass = $_POST["pass"];
    }

    function correo($usuario) {
        $patron_correo = '/^[a-zA-Z0-9._-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,4}$/';

        return preg_match($patron_correo, $usuario);
    }

    function nombre($usuario) {
        $patron_nombre = '/^[A-Zasession_start();
        -z\s]+$/';

        return preg_match($patron_nombre, $usuario);
    }

    if (correo($usuario)) {
        $consulta = $conexion->prepare("SELECT * FROM clientes WHERE cemail = ? AND cclave = ?");

        try {
            $consulta->bindParam(1, $usuario);
            $consulta->bindParam(2, $pass);

            $consulta->execute();
            $resultado = $consulta->fetch(PDO::FETCH_ASSOC);

            if ($resultado) {
                echo "Bien";
                header("Location: gestionaFideliza.php");
                $_SESSION['usuario'] = $usuario;
            } else {
                echo "Mal";
                header("Location: index.html");
            }
        } catch (PDOException $e) {
            die("Error en la consulta: " . $e->getMessage());
        }
    } else if (nombre($usuario)) {
        $consulta = $conexion->prepare("SELECT * FROM administradores WHERE email = ? AND pass = ?");

        try {
            $consulta->bindParam(1, $usuario);
            $consulta->bindParam(2, $pass);

            $consulta->execute();
            $resultado = $consulta->fetch(PDO::FETCH_ASSOC);

            if ($resultado) {
                echo "Bien";
                header("Location: gestionaFideliza.php");
                $_SESSION['usuario'] = $usuario;
                $_SESSION['permisos'] = 1;
            } else {
                echo $error_message = "Credenciales no válidas. Inténtalo de nuevo.";
                header("Location: index.html");
            }
        } catch (PDOException $e) {
            die("Error en la consulta: " . $e->getMessage());
        }
    } else {
        echo "Todo mal";
    }
}
