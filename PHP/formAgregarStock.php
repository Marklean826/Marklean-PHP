<?php
include 'conexionDB.php'; // Incluye la conexión a la base de datos

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Captura los datos del formulario
    $productoSeleccionado = $_POST['productoSeleccionado'];
    $cantidad = $_POST['cantidad'];

    // Actualiza el stock del producto seleccionado
    $sql = "UPDATE producto SET stock = stock + :cantidad WHERE nombre = :productoSeleccionado";
    $stmt = $conectar->prepare($sql);
    $stmt->execute([
        ':cantidad' => $cantidad,
        ':productoSeleccionado' => $productoSeleccionado
    ]);

    echo "<script> 
    alert('Stock del producto actualizado correctamente')
    window.location.href = '../ADMIN/productos.php'
  </script>";
}
?>
