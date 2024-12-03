<?php
require $_SERVER['DOCUMENT_ROOT'] . '/MARKLEAN/PHP/conexionDB.php';

// Verifica si se recibió el ID del cliente
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id_cliente = $_POST['ID'] ?? null; // Asegúrate de que el nombre sea 'id_cliente'

    // Debugging
    error_log("ID de cliente recibido: " . print_r($id_cliente, true));

    if (empty($id_cliente)) {
        echo "<script>alert('ID de cliente no válido.'); window.location.href = '../ADMIN/cliente.php';</script>";
        exit();
    }

    try {
        // Código para verificar y eliminar...
    } catch (PDOException $e) {
        error_log("Error al eliminar el cliente: " . $e->getMessage());
        echo "<script>alert('Error al eliminar el cliente: " . htmlspecialchars($e->getMessage()) . "'); window.location.href = '../ADMIN/cliente.php';</script>";
    }
} else {
    echo "<script>alert('Método de solicitud no válido.'); window.location.href = '../ADMIN/cliente.php';</script>";
}


    try {
        // Verificar si el cliente existe antes de eliminar
        $sqlVerificar = "SELECT COUNT(*) FROM cliente WHERE ID = :ID";
        $stmtVerificar = $conectar->prepare($sqlVerificar);
        $stmtVerificar->execute([':ID' => $id_cliente]);
        $clienteExiste = $stmtVerificar->fetchColumn();

        if ($clienteExiste == 0) {
            echo "<script>alert('El cliente no existe.'); window.location.href = '../ADMIN/cliente.php';</script>";
            exit();
        }

        // Preparar la consulta SQL para eliminar el cliente
        $sql = "DELETE FROM cliente WHERE ID = :ID";
        $stmt = $conectar->prepare($sql);
        $stmt->execute([':ID' => $id_cliente]);

        echo "<script>alert('Cliente eliminado con éxito.'); window.location.href = '../ADMIN/cliente.php';</script>";
    } catch (PDOException $e) {
        echo "Error al eliminar el cliente: " . $e->getMessage();
    }

?>
