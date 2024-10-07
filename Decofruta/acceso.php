<?php
session_start();

try {
    if (isset($_SESSION['user_id'])) {
        // Obtener el rol del usuario
        require 'conexion_bd.php';
        $records = $conn->prepare('SELECT id_rol FROM usuarios WHERE id_usuario = :id_usuario');
        $records->bindParam(':id_usuario', $_SESSION['user_id']);
        $records->execute();
        $results = $records->fetch(PDO::FETCH_ASSOC);

        if ($results) {
            if ($results['id_rol'] == 2) {
                header('Location: clienteInicio.php');
            } elseif ($results['id_rol'] == 1) {
                header('Location: administradorProductos.php');
            }
            exit();
        }
    }

    require 'conexion_bd.php';

    $message = '';

    if (!empty($_POST['email']) && !empty($_POST['password'])) {
        $records = $conn->prepare('SELECT id_usuario, email, password, id_rol FROM usuarios WHERE email = :email');
        $records->bindParam(':email', $_POST['email']);
        $records->execute();
        $results = $records->fetch(PDO::FETCH_ASSOC);

        if ($results && password_verify($_POST['password'], $results['password'])) {
            $_SESSION['user_id'] = $results['id_usuario'];
            // Redirigir según el rol del usuario
            if ($results['id_rol'] == 2) {
                header('Location: clienteInicio.php');
            } elseif ($results['id_rol'] == 1) {
                header('Location: administradorProductos.php');
            }
            exit();
        } else {
            $message = 'Lo siento, esas credenciales no coinciden';
        }
    }
} catch (PDOException $e) {
    // Manejo de errores
    $message = 'Error en la base de datos: ' . $e->getMessage();
    exit;
} finally {
    // Cerrar la conexión
    $conn = null;
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Decofruta</title>
    <link rel="shortcut icon" type="image" href="./image/logo.png">
    <link rel="stylesheet" href="stylesForm.css">
    <!-- icons links -->
    <link href='https://unpkg.com/boxicons@2.1.2/css/boxicons.min.css' rel='stylesheet'>
</head>
<body>

    <form action="" method="POST">
        <a href="clienteInicio.php"><i class='bx bx-x-circle'></i></a>
        <h1 class="title">Acceso</h1>
        <label>
            <i class='bx bx-envelope'></i>
            <input placeholder="correo electrónico" type="email" id="email" name="email" required>
        </label>
        <label>
            <i class='bx bx-key'></i>
            <input placeholder="contraseña" type="password" id="password" name="password" required>
        </label>
        <a href="#" class="link">¿Olvidaste tu contraseña?</a>
        <a href="registro.php" class="link">Crea una cuenta</a>

        <button type="submit" id="button">Acceder</button>
    </form>
    
</body>
</html>
