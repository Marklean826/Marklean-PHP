<?php
require 'conexionDB.php'; // Asegúrate de que esta conexión sea correcta

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $idProducto = filter_input(INPUT_POST, 'idProducto', FILTER_VALIDATE_INT);

    if ($idProducto !== false) {
        try {
            $sql = "DELETE FROM producto WHERE id = :id";
            $stmt = $conectar->prepare($sql);
            $stmt->execute([':id' => $idProducto]);
            echo "<script>
                    alert('Producto eliminado correctamente');
                    window.location.href = '../ADMIN/productos.php';
                  </script>";
        } catch (PDOException $e) {
            echo "Error al eliminar el producto: " . $e->getMessage();
        }
    } else {
        echo "ID de producto no válido.";
    }
}
?>
