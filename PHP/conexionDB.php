<?php
// Configuración de la base de datos
$host = 'localhost'; // Servidor de la base de datos
$dbname = 'maxiaseo2'; // Nombre de la base de datos
$username = 'root'; // Usuario de la base de datos
$password = 'Tohka0811'; // Contraseña de la base de datos

try {
    // Conexión a la base de datos
    $conectar = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8", $username, $password);
    $conectar->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    echo "Error de conexión: " . $e->getMessage();
    exit;
}
?>
