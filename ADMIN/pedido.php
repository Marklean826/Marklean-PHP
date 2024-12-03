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
    <!-- Enlace a la hoja de estilos principal -->
    <link rel="stylesheet" href="../ADMIN/CSS/pedido.css">
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
            <a href="../ADMIN/pedido.php">
                <img src="../ICONOS/pedidos.svg" alt="Pedidos">
                <span>PEDIDOS</span>
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

        <section id="pedidos">
            <h2>Consultar Pedidos</h2>

            <div class="contenedor-columnas centrado">
                <div class="columna-izquierda">
                    <form id="buscarVentaForm">
                        <label for="numeroVenta">Código del pedido:</label>
                        <input type="text" id="numeroVenta" name="numeroVenta">
                        <button type="submit">Buscar</button>
                    </form>

                    <form id="agregarProductoForm">
                        <label for="codigoProducto">Nombre del cliente:</label>
                        <input type="text" id="codigoProducto" name="codigoProducto">
                        <button type="submit">Agregar</button>
                    </form>

                    <div class="codigoFactura">
                        <label for="codigoFactura">Generar factura del pedido:</label>
                        <button id="" type="button">Generar</button>
                    </div>
                </div>

                <div class="columna-derecha">
                    <div id="listaProductos">
                        <h4>Productos en Venta</h4>
                        <table id="productosVenta">
                            <thead>
                                <tr>
                                    <th>Código</th>
                                    <th>Cantidad</th>
                                    <th>Descripción</th>
                                    <th>Estado</th>
                                    <th>Fecha</th>
                                    <th>Precio</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>1001</td>
                                    <td>3</td>
                                    <td>Jabón multiusos</td>
                                    <td>Pendiente</td>
                                    <td>20-10-2024</td>
                                    <td>7.000</td>
                                </tr>
                                <!-- Aquí se listarán dinámicamente los productos agregados -->
                            </tbody>
                        </table>
                        <div class="codigoAgregar">
                            <label for="codigoAgregar">Agregar producto al pedido:</label>
                            <button id="btnAbrirPopup" type="button">Agregar</button>


                        </div>
                    </div>
                    <section class="total">
                        <div>
                            <label for="total">Generar factura del pedido:</label>
                            <input type="text" id="total" name="total">
                            <button type="button">Guardar Cambios</button>
                            <button type="button">Eliminar Pedidos</button>
                        </div>
                    </section>
                </div>
            </div>

            <!-- Contenedor del popup -->
             
            <div class="contenedor-popup" id="contenedor-popup">
                <div class="popup" id="popup">
                    <span id="btn-cerrar-popup" class="btn-cerrar-popup">X</span> <!-- Botón X para cerrar el popup -->
                    <h3>Agregar Producto</h3>
                    <form action="#">
                        <label for="codigoProducto">Código del producto:</label>
                        <input type="text" id="codigoProductoPopup" name="codigo-Producto" required>
            
                        <label for="nombre-Producto">Nombre del producto:</label>
                        <input type="text" id="nombreProductoPopup" name="nombre-Producto" required>
            
                        <label for="cantidad-Producto">Cantidad:</label>
                        <input type="number" id="cantidadProductoPopup" name="cantidad-Producto" min="1" required>
            
                        <label for="categoria-Producto">Categoría:</label>
                        <select id="categoriaProductoPopup" name="categoria-Producto" required>
                            <option value="">Seleccione una categoría</option>
                            <option value="limpiezaDelHogar">Limpieza del hogar</option>
                            <option value="alimentacion">Alimentación</option>
                            <option value="electronica">Electrónica</option>
                        </select>
            
                        <label for="fechaIngresoProducto">Fecha de ingreso:</label>
                        <input type="date" id="fechaIngresoProductoPopup" name="fechaIngresoProducto" required>
            
                        <button type="submit" class="btn-submit" value="Agregar producto">Agregar producto</button>
                    </form>
                </div>
            </div>
            
    </main>

    <footer class="footer">
        <p>Derechos reservados © 2024 MARKLEAN</p>
    </footer>

    <!-- Inclusión del archivo JavaScript -->
    <script src="../ADMIN/JS/pedido.js"></script>
</body>
</html>
