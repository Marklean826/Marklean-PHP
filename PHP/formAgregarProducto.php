<?php
require 'conexionDB.php'; // Este archivo ya tiene la conexión PDO

// Inicializa la variable para los resultados de búsqueda
$resultados = [];

// Verifica si se han enviado los datos del formulario de búsqueda
if ($_SERVER['REQUEST_METHOD'] == 'GET' && isset($_GET['codigoProducto'])) {
    $codigoProducto = $_GET['codigoProducto'];
    $estadoProducto = $_GET['estadoProducto'];

    // Prepara la consulta SQL para buscar productos por nombre
    $sql = "SELECT * FROM producto WHERE nombre LIKE :codigoProducto";

    // Si se seleccionó un estado, añade a la consulta
    if ($estadoProducto !== '') {
        $sql .= " AND estado = :estadoProducto";
    }

    $stmt = $conectar->prepare($sql);

    // Bind de los parámetros
    $paramCodigo = '%' . $codigoProducto . '%';
    $stmt->bindParam(':codigoProducto', $paramCodigo);

    if ($estadoProducto !== '') {
        $stmt->bindParam(':estadoProducto', $estadoProducto);
    }

    $stmt->execute();
    $resultados = $stmt->fetchAll(PDO::FETCH_ASSOC);
}

// Obtener datos del formulario para crear el producto
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['tipoProducto'])) {
    $tipoProducto = $_POST['tipoProducto'];
    $nombre = $_POST['nombre'];
    $stock = $_POST['stock'];
    $precioVenta = $_POST['precioVenta'];
    $categoria = $_POST['categoria'];
    $fechaEntrada = $_POST['fechaEntrada'];
    $estado = !empty($_POST['estado']) ? $_POST['estado'] : 'activo'; // Valor por defecto
    $proveedor = $_POST['proveedor'];
    $razonSocial = $_POST['razonSocial'];
    $iva = '0.19';

    try {
        // Preparar la consulta de inserción
        $sql = "INSERT INTO entradaproducto (tipo, stock, nombre, precioVenta, categoria, fecha, estado, proveedor, razonSocial) 
                VALUES (:tipoProducto, :stock, :nombre, :precioVenta, :categoria, :fechaEntrada, :estado, :proveedor, :razonSocial)";

        // Preparar la sentencia
        $stmt = $conectar->prepare($sql);

        // Ejecutar la sentencia con los valores del formulario
        $stmt->execute([
            ':tipoProducto' => $tipoProducto,
            ':stock' => $stock,
            ':nombre' => $nombre,
            ':precioVenta' => $precioVenta,
            ':categoria' => $categoria,
            ':fechaEntrada' => $fechaEntrada,
            ':estado' => $estado,
            ':proveedor' => $proveedor,
            ':razonSocial' => $razonSocial
        ]);

        // Verifica si se insertó
        if ($stmt->rowCount() > 0) {

            echo "<script>alert('Entrada de producto registrada.');</script>";

            echo "<script>
            window.location.href = '../ADMIN/productos.php'; // En caso de un rol desconocido
          </script>";
          
         
        } else {
            echo "<script>alert('No se pudo registrar el producto.');</script>";
            echo "<script>
            window.location.href = '../ADMIN/productos.php'; // En caso de un rol desconocido
          </script>";
        }

        // Inserción en la tabla producto
        $sqlProducto = "INSERT INTO producto (nombre, categoria, tipo, stock, precio, iva) 
                        VALUES (:nombre, :categoria, :tipoProducto, :stock, :precioVenta, :iva)";

        $stmtProducto = $conectar->prepare($sqlProducto);
        $stmtProducto->execute([
            ':nombre' => $nombre,
            ':categoria' => $categoria,
            ':tipoProducto' => $tipoProducto,
            ':stock' => $stock,
            ':precioVenta' => $precioVenta,
            ':iva' => $iva
        ]);


        // Eliminar redirección a la página de productos
        // En lugar de redirigir, mantenemos el formulario en la misma página
    } catch (PDOException $e) {
        echo "Error al insertar el producto: " . $e->getMessage();
    }
}
?>

<!-- Aquí comienza el formulario para crear productos -->
<form id="crearProductoForm" method="POST" action="">
    <h3>Registrar Producto</h3>
    <label for="tipoProducto">Tipo:</label>
    <input type="text" id="tipoProducto" name="tipoProducto" required>
    
    <label for="nombre">Nombre:</label>
    <input type="text" id="nombre" name="nombre" required>
    
    <label for="stock">Stock:</label>
    <input type="number" id="stock" name="stock" required>
    
    <label for="precioVenta">Precio de Venta:</label>
    <input type="number" id="precioVenta" name="precioVenta" required step="0.01">
    
    <label for="categoria">Categoría:</label>
    <input type="text" id="categoria" name="categoria" required>
    
    <label for="fechaEntrada">Fecha de Entrada:</label>
    <input type="date" id="fechaEntrada" name="fechaEntrada" required>
    
    <label for="estado">Estado:</label>
    <select id="estado" name="estado">
        <option value="activo">Activo</option>
        <option value="inactivo">Inactivo</option>
    </select>
    
    <label for="proveedor">Proveedor:</label>
    <input type="text" id="proveedor" name="proveedor" required>
    
    <label for="razonSocial">Razón Social:</label>
    <input type="text" id="razonSocial" name="razonSocial" required>
    
    <button type="submit">Crear Producto</button>
</form>

