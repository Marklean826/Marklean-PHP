<?php
session_start();
require '../PHP/conexionDB.php';

header('Content-Type: application/json');
error_reporting(E_ALL);
ini_set('display_errors', 1); // Habilita la visualización de errores para depuración

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $data = json_decode(file_get_contents('php://input'), true);

    // Comprobar si se recibieron productos
    if (isset($data['productos']) && is_array($data['productos'])) {
        try {
            // Iniciar la transacción
            $conectar->beginTransaction();

            foreach ($data['productos'] as $producto) {
                // Actualizar el stock de cada producto
                $sql = "UPDATE producto SET stock = stock - :cantidad WHERE ID = :ID";
                $stmt = $conectar->prepare($sql);
                $stmt->bindParam(':cantidad', $producto['cantidad']);
                $stmt->bindParam(':ID', $producto['ID']);
                $stmt->execute();

                // Opcional: Manejar si la consulta no afecta ninguna fila
                if ($stmt->rowCount() == 0) {
                    throw new Exception("No se pudo actualizar el producto con ID: " . $producto['ID']);
                }
            }

            // Confirmar la transacción
            $conectar->commit();
            echo json_encode(['success' => true]);
        } catch (Exception $e) {
            // Revertir la transacción en caso de error
            $conectar->rollBack();
            echo json_encode(['success' => false, 'message' => 'Error al actualizar el stock: ' . $e->getMessage()]);
        }
    } else {
        echo json_encode(['success' => false, 'message' => 'Datos de productos no válidos']);
    }
} else {
    echo json_encode(['success' => false, 'message' => 'Método no permitido']);
}
?>
