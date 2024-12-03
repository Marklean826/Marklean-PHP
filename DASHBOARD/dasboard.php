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
    <title>Reportes</title>
    <!-- Enlace a la hoja de estilos principal -->
    <link rel="stylesheet" href="../DASHBOARD/CSS/dashboard.css">
    <!-- Enlace a la biblioteca Chart.js -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
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

        <section id="dashboard">
            <h2>Dashboard</h2>

            <div class="dashboard-cards">
                <div class="card">
                    <h3>Ventas Diarias</h3>
                    <div class="chart-container">
                        <canvas id="ventasDiariasChart"></canvas>
                    </div>
                </div>
                <div class="card">
                    <h3>Productos Más Vendidos</h3>
                    <div class="chart-container">
                        <canvas id="productosMasVendidosChart"></canvas>
                    </div>
                </div>
                <div class="card">
                    <h3>Ventas por Categoría</h3>
                    <div class="chart-container">
                        <canvas id="ventasPorCategoriaChart"></canvas>
                    </div>
                </div>
            </div>
        </section>
    </main>

    <footer class="footer">
        <p>Derechos reservados © 2024 MARKLEAN</p>
    </footer>

    <!-- Inclusión del archivo JavaScript -->
    <script src="../DASHBOARD/JS/dashboard.js"></script>
</body>
</html>
