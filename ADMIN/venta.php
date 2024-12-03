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
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sistema POS</title>
    <link rel="stylesheet" href="../ADMIN/CSS/venta.css">
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
            <span>Bienvenido, <?php echo htmlspecialchars($nombreUsuario); ?>  </span>
            <a href="../LOGIN_2.0/view/interfaces/index.html" class="logout">Salir</a>
        </section>
    </header>

    <main>
        <nav class="side-menu">
            <a href="../ADMIN/venta.php">
                <img src="../ICONOS/ventas.svg" alt="Ventas">
                <span>VENTAS</span>
            </a>
           
            <a href="../ADMIN/productos.php">
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

        <!-- Sección de ventas -->
        <section id="ventas">
            <h2>Ventas</h2>
            <div class="contenedor-columnas centrado">
                <div class="columna-izquierda">

                    <form id="agregarProductoForm" onsubmit="return agregarProducto();">
                        <h3>Agregar producto a la venta</h3>
                        <label for="codigoProducto">Nombre del producto:</label>
                        <input type="text" id="codigoProducto" name="codigoProducto">
                        <label for="cantidadProducto">Cantidad:</label>
                        <input type="number" id="cantidadProducto" name="cantidadProducto" min="1">
                        <button type="submit">Agregar</button>
                    </form>
                </div>

                <div class="columna-derecha">
                    <div id="listaProductos">
                        <h3>Productos en Venta</h3>
                        <table id="productosVenta">
                            <thead>
                                <tr>
                                    <th>Código</th>
                                    <th>Cantidad</th>
                                    <th>Producto</th>
                                    <th>Fecha</th>
                                    <th>Precio</th>
                                    <th>Acciones</th>
                                </tr>
                            </thead>
                            <tbody>
                                <!-- Aquí se listarán dinámicamente los productos agregados -->
                            </tbody>
                        </table>
                        <p>Total: <span id="totalVenta">0.00</span></p>
                    </div>
                    <div class="acciones">
                        <button id="generarFacturaBtn">Generar Factura</button>
                        <button id="generarVentaBtn">Generar Venta</button>
                    </div>
                </div>
            </div>
        </section>
    </main>

    <footer class="footer">
        <p>Derechos reservados © 2024 MARKLEAN</p>
    </footer>

    <script src="../ADMIN/JS/ventas.js"></script>
</body>
</html>
