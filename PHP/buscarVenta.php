<?php
session_start();
require '../PHP/conexionDB.php';

header('Content-Type: application/json');
error_reporting(E_ALL);
ini_set('display_errors', 1);

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $data = json_decode(file_get_contents('php://input'), true);

    // Comprobar errores al decodificar JSON
    if (json_last_error() !== JSON_ERROR_NONE) {
        echo json_encode(['success' => false, 'message' => 'Error en JSON: ' . json_last_error_msg()]);
        exit;
    }

    // Verificar que los campos estén presentes
    if (isset($data['ID']) && isset($data['stock'])) {
        $codigoProducto = $data['ID'];
        $cantidadProducto = $data['stock'];

        try {
            // Modificar la consulta para buscar por ID o nombre
            $sql = "SELECT * FROM producto WHERE ID = :ID OR nombre = :nombre"; 
            $stmt = $conectar->prepare($sql);
            $stmt->bindParam(':ID', $codigoProducto);
            $stmt->bindParam(':nombre', $codigoProducto); // Usar el mismo valor para nombre
            $stmt->execute();

            if ($stmt->rowCount() > 0) {
                $producto = $stmt->fetch(PDO::FETCH_ASSOC);
                if ($producto['stock'] >= $cantidadProducto) {
                    echo json_encode(['success' => true, 'producto' => $producto]);
                } else {
                    echo json_encode(['success' => false, 'message' => 'Stock insuficiente']);
                }
            } else {
                echo json_encode(['success' => false, 'message' => 'Producto no encontrado en la base de datos']);
            }
        } catch (Exception $e) {
            echo json_encode(['success' => false, 'message' => 'Error: ' . $e->getMessage()]);
        }
    } else {
        echo json_encode(['success' => false, 'message' => 'Datos incompletos']);
    }
} else {
    echo json_encode(['success' => false, 'message' => 'Método no permitido']);
}
