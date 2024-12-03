<?php
require $_SERVER['DOCUMENT_ROOT'] . '/MARKLEAN/PHP/conexionDB.php';

// Verifica si se recibió el ID del proveedor
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id_proveedor = $_POST['ID'] ?? null; // Asegúrate de que el nombre sea 'ID'

    // Debugging
    error_log("ID de proveedor recibido: " . print_r($id_proveedor, true));

    if (empty($id_proveedor)) {
        echo "<script>alert('ID de proveedor no válido.'); window.location.href = '../ADMIN/proveedor.php';</script>";
        exit();
    }

    try {
        // Verificar si el proveedor existe antes de eliminar
        $sqlVerificar = "SELECT COUNT(*) FROM proveedor WHERE ID = :ID";
        $stmtVerificar = $conectar->prepare($sqlVerificar);
        $stmtVerificar->execute([':ID' => $id_proveedor]);
        $proveedorExiste = $stmtVerificar->fetchColumn();

        if ($proveedorExiste == 0) {
            echo "<script>alert('El proveedor no existe.'); window.location.href = '../ADMIN/proveedor.php';</script>";
            exit();
        }

        // Preparar la consulta SQL para eliminar el proveedor
        $sql = "DELETE FROM proveedor WHERE ID = :ID";
        $stmt = $conectar->prepare($sql);
        $stmt->execute([':ID' => $id_proveedor]);

        echo "<script>alert('Proveedor eliminado con éxito.'); window.location.href = '../ADMIN/proveedor.php';</script>";
    } catch (PDOException $e) {
        error_log("Error al eliminar el proveedor: " . $e->getMessage());
        echo "<script>alert('Error al eliminar el proveedor: " . htmlspecialchars($e->getMessage()) . "'); window.location.href = '../ADMIN/proveedor.php';</script>";
    }
} else {
    echo "<script>alert('Método de solicitud no válido.'); window.location.href = '../ADMIN/proveedor.php';</script>";
}
?>
