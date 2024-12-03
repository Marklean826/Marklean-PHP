<?php
// Conexión a la base de datos
include_once '../PHP/conexionDB.php';

if (isset($_GET['nombreProducto'])) {
    $nombreProducto = $_GET['nombreProducto'];

    // Consulta para buscar el producto por su nombre
    $query = $conn->prepare("SELECT ID, nombre, cantidad, precio, fecha FROM productos WHERE nombre LIKE ?");
    $query->execute(["%$nombreProducto%"]);

    $producto = $query->fetch(PDO::FETCH_ASSOC);

    if ($producto) {
        echo json_encode(['success' => true, 'producto' => $producto]);
    } else {
        echo json_encode(['success' => false]);
    }
}
?>
