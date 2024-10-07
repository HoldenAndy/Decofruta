<?php
require 'conexion_bd.php';

if (isset($_POST['id'])) {
    try {
        $id = $_POST['id'];

        $sql = "DELETE FROM reservas_especiales WHERE id = ?";
        $stmt = $conn->prepare($sql);
        $stmt->execute([$id]);

        header("Location: administradorReservas.php");
        exit();
    } catch (PDOException $e) {
        die('Error en la base de datos: ' . $e->getMessage());
    } finally {
        // Cerrar la conexión a la base de datos
        $conn = null;
    }
}

?>