<?php
require 'conexionDB.php';

if (isset($_POST['productoSeleccionado']) && isset($_POST['cantidad'])) {
    $productoSeleccionado = $_POST['productoSeleccionado'];
    $cantidad = $_POST['cantidad'];

    try {
        // Preparar la consulta de actualización
        $sql = "UPDATE producto SET stock = stock + :cantidad WHERE nombre = :productoSeleccionado";
        $stmt = $conectar->prepare($sql);
        $stmt->execute([
            ':cantidad' => $cantidad,
            ':productoSeleccionado' => $productoSeleccionado
        ]);

        echo json_encode(['success' => true]);
    } catch (PDOException $e) {
        echo json_encode(['success' => false, 'message' => $e->getMessage()]);
    }
} else {
    echo json_encode(['success' => false, 'message' => 'Datos no proporcionados']);
}
?>
