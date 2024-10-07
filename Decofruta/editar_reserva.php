<?php
require 'conexion_bd.php';

if (isset($_POST['id'])) {
    try {
        $id = $_POST['id'];
        $fecha_evento = $_POST['fecha_evento'];
        $hora_evento = $_POST['hora_evento'];
        $tipo_evento = $_POST['tipo_evento'];
        $cantidad_personas = $_POST['cantidad_personas'];
        $comentario = $_POST['comentario'];
        $atendido = $_POST['atendido'];

        $sql = "UPDATE reservas_especiales SET fecha_evento = ?, hora_evento = ?, tipo_evento = ?, cantidad_personas = ?, comentario = ?, atendido = ? WHERE id = ?";
        $stmt = $conn->prepare($sql);
        $stmt->execute([$fecha_evento, $hora_evento, $tipo_evento, $cantidad_personas, $comentario, $atendido, $id]);

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
