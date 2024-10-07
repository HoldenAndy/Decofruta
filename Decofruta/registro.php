<?php
require 'conexion_bd.php';

$message = '';

try {
    // Verificar si los campos del formulario no están vacíos
    if (!empty($_POST['names']) && !empty($_POST['phone']) && !empty($_POST['email']) && !empty($_POST['password'])) {
        $email = $_POST['email'];
        
        // Verificar si el correo ya existe en la base de datos
        $sql = "SELECT COUNT(*) as count FROM usuarios WHERE email = :email";
        $stmt = $conn->prepare($sql);
        $stmt->bindParam(':email', $email);
        $stmt->execute();
        $result = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($result['count'] > 0) {
            $message = 'El correo electrónico ya está registrado. Por favor, use otro correo.';
        } else {
            // Si el correo no está registrado, proceder con el registro
            $sql = "INSERT INTO usuarios (nombre, numero_celular, email, password, id_rol) VALUES (:names, :phone, :email, :password, 2)";
            $stmt = $conn->prepare($sql);
            $stmt->bindParam(':names', $_POST['names']); // Se vinculan los valores del formulario a los parámetros
            $stmt->bindParam(':phone', $_POST['phone']);
            $stmt->bindParam(':email', $_POST['email']);
            $password = password_hash($_POST['password'], PASSWORD_BCRYPT);
            $stmt->bindParam(':password', $password);

            if ($stmt->execute()) {
                $message = 'Usuario registrado con éxito';
            } else {
                $message = 'Usuario no registrado';
            }
        }
    } else {
        $message = 'Por favor, complete todos los campos del formulario';
    }
} catch (PDOException $e) {
    $message = 'Error en la base de datos';
    exit;
} finally {
    // Cerrar la conexión a la base de datos
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

    <form action="" method="POST" id="registerForm">
        <a href="clienteInicio.php"><i class='bx bx-x-circle'></i></a>
        <h1 class="title">Regístrate</h1>
        <label>
            <i class='bx bx-user'></i>
            <input placeholder="ingresar nombre" type="text" id="names" name="names" required>
        </label>
        <label>
            <i class='bx bx-phone'></i>
            <input type="tel" id="phone" name="phone" class="form-control" placeholder="Ingrese número de celular" required>
        </label>
        <label>
            <i class='bx bx-envelope'></i>
            <input placeholder="ingresar correo electrónico" type="email" id="email" name="email" required>
        </label>
        <label>
            <i class='bx bx-key'></i>
            <input placeholder="ingresar contraseña" type="password" id="password" name="password" required>
        </label>
        <label>
            <i class='bx bx-check'></i>
            <input placeholder="confirmar contraseña" type="password" id="confirmPassword" name="confirmPassword" required>
        </label>
        <button type="submit" id="button">Registrarme</button>
    </form>

    <?php include 'mensajeFlotante.php'; ?>

    <script src="scriptRegister.js"></script>
</body>
</html>
