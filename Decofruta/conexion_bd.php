<?php

$server = 'localhost';
$username = 'root';
$password = '';
$database = 'bd_decofruta';

try {
    // Crear una nueva conexión PDO
    $conn = new PDO("mysql:host=$server;dbname=$database;charset=utf8", $username, $password);
    // Configurar PDO para que lance excepciones en caso de error
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    
} catch (PDOException $e) {
    // En caso de error, mostrar el mensaje de la excepción
    die('La conexión falló: ' . $e->getMessage());
}

?>



