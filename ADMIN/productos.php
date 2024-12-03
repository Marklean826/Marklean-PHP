<?php
session_start(); // Iniciar sesión

// Verificar si el usuario ha iniciado sesión
if (isset($_SESSION['usuario_nombre'])) {
    $nombreUsuario = $_SESSION['usuario_nombre']; // Obtener el nombre del usuario desde la sesión
} else {
    // Si no hay sesión, redirigir al login o manejarlo de otra manera
    header("Location: ../LOGIN_2.0/view/interfaces/login.html");
    exit();
}

// Conectar a la base de datos
require '../PHP/conexionDB.php';

// Consulta para obtener los productos existentes
$sql = "SELECT * FROM producto";
$stmt = $conectar->prepare($sql);
$stmt->execute();
$productos = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gestión de Productos - Sistema POS</title>
    <link rel="stylesheet" href="../ADMIN/CSS/productos.css">
</head>
<body>
    <header class="header">
        <figure class="logo">
            <img src="../IMG/logo.png" alt="Logo">
        </figure>
        <nav class="navigation">
            <ul></ul>
        </nav>
        <section class="user-info">
            <span>Bienvenido, <?php echo htmlspecialchars($nombreUsuario); ?> </span>
            <a href="../LOGIN_2.0/view/interfaces/index.html" class="logout">Salir</a>
        </section>
    </header>

    <main>
        <nav class="side-menu">
            <a href="../ADMIN/venta.php">
                <img src="../ICONOS/ventas.svg" alt="Ventas">
                <span>VENTAS</span>
            </a>
         
            <a href="../ADMIN/productos.php" class="active">
                <img src="../ICONOS/productos.svg" alt="Productos">
                <span>PRODUCTOS</span>
            </a>
            <a href="../ADMIN/cliente.php">
                <img src="../ICONOS/clientes.svg" alt="Clientes">
                <span>CLIENTES</span>
            </a>
            <a href="../ADMIN/proveedor.php">
                <img src="../ICONOS/proveedores.svg" alt="Proveedores">
                <span>PROVEEDORES</span>
            </a>
            <a href="../DASHBOARD/dasboard.php">
                <img src="../ICONOS/dashboard.svg" alt="Dashboard">
                <span>REPORTES</span>
            </a>
        </nav>

        <section id="gestionProductos">
            <h2>Gestión de Productos</h2>

            <div class="contenedor-columnas">
                <div class="columna-izquierda">
                <form id="buscarProductoForm" action="../PHP/buscarProducto.php" method="GET">
    <h3>Buscar Producto</h3>
    <label for="codigoProducto">Nombre del Producto:</label>
    <input type="text" id="codigoProducto" name="codigoProducto" required>

    <label for="estadoProducto">Estado:</label>
    <select id="estadoProducto" name="estadoProducto">
        <option value="">Todos</option>
        <option value="disponible">Disponible</option>
        <option value="no-disponible">No Disponible</option>
    </select>

    <div class="boton-container">
        <button type="submit">Buscar</button>
        <button type="button" onclick="volverAPaginaPrincipal()">Volver</button>
    </div>
</form>


<script>
    function volverAPaginaPrincipal() {
        window.location.href = '/MARKLEAN/ADMIN/productos.php'; // Cambia 'venta.php' a la ruta de tu página principal
    }
</script>



                    <div id="opcionesProducto">
                        <h3>Opciones</h3>
                        <button id="nuevoProductoBtn">Crear Nuevo Producto</button>
                        <button id="agregarStockBtn">Agregar Stock</button>
                    </div>
                </div>

                <div class="columna-derecha">
                    <div id="listaProductosExistentes">
                        <h3>Productos Existentes</h3>
                        <table id="productosExistentes">
                            <thead>
                                <tr>
                                    <th>Código</th>
                                    <th>Nombre</th>
                                    <th>Categoría</th>
                                    <th>Tipo</th>
                                    <th>Estado</th>
                                    <th>Precio</th>
                                    <th>Stock</th>
                                    <th>Acciones</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($productos as $producto): ?>
                                    <tr>
                                        <td><?php echo htmlspecialchars($producto['ID']); ?></td> <!-- Cambié ID a id -->
                                        <td><?php echo htmlspecialchars($producto['nombre']); ?></td>
                                        <td><?php echo htmlspecialchars($producto['categoria']); ?></td>
                                        <td><?php echo htmlspecialchars($producto['tipo']); ?></td>
                                        <td><?php echo htmlspecialchars($producto['estado']); ?></td>
                                        <td><?php echo htmlspecialchars($producto['precio']); ?></td>
                                        <td><?php echo htmlspecialchars($producto['stock']); ?></td>
                                        <td>
                                            
                                        <form action="../PHP/eliminarProducto.php" method="POST">
    <input type="hidden" name="idProducto" value="<?php echo $producto['ID']; ?>">
    <button type="submit">Eliminar</button>
</form>

                                        
                                        </td>
                                    </tr>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </section>

        <!-- Popup para crear producto -->
        <div id="popupCrearProducto" class="popup" style="display: none;">
            <div class="popup-contenido">
                <span class="cerrar-popup" onclick="cerrarPopupCrearProducto()">&times;</span>
                <h2>Agregar Producto</h2>
                <form id="agregarProductoForm" method="POST" action="../PHP/formAgregarProducto.php">
                    <label for="tipoProducto">Tipo de Producto:</label>
                    <select id="tipoProducto" name="tipoProducto" required>
                        <option value="">Seleccione un tipo</option>
                        <option value="normal">Producto Normal</option>
                        <option value="ra">Producto con RA</option>
                    </select>

                    <label for="nombre">Nombre del Producto:</label>
                    <input type="text" id="nombre" name="nombre" required>

                    <label for="stock">Stock de entrada:</label>
                    <input type="number" id="stock" name="stock" required>

                    <label for="precioVenta">Precio del producto:</label>
                    <input type="number" id="precioVenta" name="precioVenta" required>

                    <label for="categoria">Categoría del producto:</label>
                    <select id="categoria" name="categoria" required>
                        <option value="">Seleccione una categoría</option>
                        <option value="Limpieza del hogar">Limpieza del hogar</option>
                        <option value="Alimentación">Alimentación</option>
                        <option value="Electrónica">Electrónica</option>
                    </select>

                    <label for="estado">Estado del producto:</label>
                    <select id="estado" name="estado" required>
                        <option value="">Seleccione un estado</option>
                        <option value="disponible">Disponible</option>
                        <option value="no-disponible">No disponible</option>
                    </select>

                    <label for="fechaEntrada">Fecha de Entrada:</label>
                    <input type="date" id="fechaEntrada" name="fechaEntrada" required>

                    <label for="proveedor">Código del Proveedor:</label>
                    <input type="text" id="proveedor" name="proveedor" required>

                    <label for="razonSocial">Razón Social del Proveedor:</label>
                    <input type="text" id="razonSocial" name="razonSocial" required>

                    <button type="submit" class="button">Agregar Producto</button>
                </form>
            </div>
        </div>

        <!-- Popup para agregar stock -->
        <div id="popupAgregarStock" class="popup" style="display: none;">
            <div class="popup-contenido">
                <span class="cerrar-popup" onclick="cerrarPopupAgregarStock()">&times;</span>
                <h2>Agregar Stock</h2>
                <form id="formAgregarStock" method="POST" action="../PHP/formAgregarStock.php">
    <label for="productoSeleccionado">Seleccionar Producto:</label>
    <input type="text" id="productoSeleccionado" name="productoSeleccionado" required>
    
    <label for="cantidad">Cantidad a Agregar:</label>
    <input type="number" id="cantidad" name="cantidad" required>
    
    <button type="submit">Agregar Stock</button>
</form>

            </div>
        </div>

        <script src="../ADMIN/JS/productos.js"></script>

        
    </main>
</body>
</html>
