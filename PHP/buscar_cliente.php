<?php
require $_SERVER['DOCUMENT_ROOT'] . '/MARKLEAN/PHP/conexionDB.php'; // Asegúrate de que la ruta sea correcta

// Verifica si se recibieron datos del formulario
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nombre = $_POST['nombre'] ?? null;
    $email = $_POST['email'] ?? null;
    $telefono = $_POST['telefono'] ?? null;
    $direccion = $_POST['direccion'] ?? null;
    $ciudad = $_POST['ciudad'] ?? null;

    // Validar que los datos no estén vacíos
    if (empty($nombre) || empty($email) || empty($telefono) || empty($direccion) || empty($ciudad)) {
        echo "<script>alert('Todos los campos son obligatorios.'); window.history.back();</script>";
        exit();
    }

    try {
        // Preparar la consulta SQL para insertar los datos del cliente
        $sql = "INSERT INTO cliente (nombre, email, telefono, direccion, ciudad) 
                VALUES (:nombre, :email, :telefono, :direccion, :ciudad)";

        // Preparar la sentencia
        $stmt = $conectar->prepare($sql);

        // Ejecutar la consulta con los valores
        $stmt->execute([
            ':nombre' => $nombre,
            ':email' => $email,
            ':telefono' => $telefono,
            ':direccion' => $direccion,
            ':ciudad' => $ciudad
        ]);

        echo "<script>alert('Cliente registrado con éxito.'); window.location.href = '../ADMIN/cliente.php';</script>";
    } catch (PDOException $e) {
        echo "Error al registrar el cliente: " . $e->getMessage();
    }
} else {
    echo "<script>alert('Método de solicitud no válido.'); window.location.href = '../ADMIN/cliente.php';</script>";
}
?>
