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

// Inicializar variables
$resultados = [];
$proveedores = [];

// Verifica si se han enviado los datos del formulario de búsqueda
if ($_SERVER['REQUEST_METHOD'] == 'GET' && isset($_GET['nombreProveedor'])) {
    $nombreProveedor = $_GET['nombreProveedor'];
    $ciudadProveedor = $_GET['ciudadProveedor'];

    // Prepara la consulta SQL para buscar proveedores por nombre
    $sql = "SELECT * FROM proveedor WHERE nombre LIKE :nombreProveedor";

    // Si se seleccionó una ciudad, añade a la consulta
    if ($ciudadProveedor !== '') {
        $sql .= " AND ciudad = :ciudadProveedor";
    }

    $stmt = $conectar->prepare($sql);

    // Bind de los parámetros
    $paramNombre = '%' . $nombreProveedor . '%';
    $stmt->bindParam(':nombreProveedor', $paramNombre);

    if ($ciudadProveedor !== '') {
        $stmt->bindParam(':ciudadProveedor', $ciudadProveedor);
    }

    $stmt->execute();
    $resultados = $stmt->fetchAll(PDO::FETCH_ASSOC);
}

// Consulta para obtener todos los proveedores existentes
$sql = "SELECT * FROM proveedor";
$stmt = $conectar->prepare($sql);
$stmt->execute();
$proveedores = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gestión de Proveedores - Sistema POS</title>
    <link rel="stylesheet" href="../ADMIN/CSS/proveedor.css">
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
            <a href="venta.php">
                <img src="../ICONOS/ventas.svg" alt="Ventas">
                <span>VENTAS</span>
            </a>
            <a href="pedido.php">
                <img src="../ICONOS/pedidos.svg" alt="Pedidos">
                <span>PEDIDOS</span>
            </a>
            <a href="productos.php">
                <img src="../ICONOS/productos.svg" alt="Productos">
                <span>PRODUCTOS</span>
            </a>
            <a href="cliente.php">
                <img src="../ICONOS/clientes.svg" alt="Clientes">
                <span>CLIENTES</span>
            </a>
            <a href="proveedor.php" class="active">
                <img src="../ICONOS/proveedores.svg" alt="Proveedores">
                <span>PROVEEDORES</span>
            </a>
            <a href="../DASHBOARD/dasboard.php">
                <img src="../ICONOS/dashboard.svg" alt="Dashboard">
                <span>DASHBOARD</span>
            </a>
        </nav>

        <section id="gestionProveedores">
            <h2>Gestión de Proveedores</h2>

            <div class="contenedor-columnas">
                <div class="columna-izquierda">
                    <form id="buscarProveedorForm" action="../PHP/buscarProveedor.php" method="GET">
                        <h3>Buscar Proveedor</h3>
                        <label for="nombreProveedor">Nombre del Proveedor:</label>
                        <input type="text" id="nombreProveedor" name="nombreProveedor" required>

                        <label for="ciudadProveedor">Ciudad:</label>
                        <input type="text" id="ciudadProveedor" name="ciudadProveedor">

                        <div class="boton-container">
                            <button type="submit">Buscar</button>
                            <button type="button" onclick="volverAPaginaPrincipal()">Volver</button>
                        </div>
                    </form>

                    <script>
                        function volverAPaginaPrincipal() {
                            window.location.href = '/MARKLEAN/ADMIN/proveedor.php'; // Cambia 'proveedores.php' a la ruta de tu página principal
                        }
                    </script>

                    <div id="opcionesProveedor">
                        <h3>Opciones</h3>
                        <button id="nuevoProveedorBtn">Crear Nuevo Proveedor</button>
                    </div>
                </div>

                <div class="columna-derecha">
                    <div id="listaProveedoresExistentes">
                        <h3>Proveedores Existentes</h3>
                        <table id="proveedoresExistentes">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Nombre</th>
                                    <th>Ciudad</th>
                                    <th>Teléfono</th>
                                    <th>Email</th>
                                    <th>Acciones</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                // Si hay resultados de búsqueda, mostrarlos
                                if (!empty($resultados)) {
                                    foreach ($resultados as $proveedor) {
                                        echo "<tr>
                                            <td>" . htmlspecialchars($proveedor['ID']) . "</td>
                                            <td>" . htmlspecialchars($proveedor['nombre']) . "</td>
                                            <td>" . htmlspecialchars($proveedor['ciudad']) . "</td>
                                            <td>" . htmlspecialchars($proveedor['telefono']) . "</td>
                                            <td>" . htmlspecialchars($proveedor['email']) . "</td>
                                            <td>
                                                <form action='../PHP/eliminarProveedor.php' method='POST'>
                                                    <input type='hidden' name='idProveedor' value='" . $proveedor['ID'] . "'>
                                                    <button type='submit'>Eliminar</button>
                                                </form>
                                            </td>
                                        </tr>";
                                    }
                                } else {
                                    // Si no hay búsqueda, mostrar todos los proveedores
                                    foreach ($proveedores as $proveedor) {
                                        echo "<tr>
                                            <td>" . htmlspecialchars($proveedor['ID']) . "</td>
                                            <td>" . htmlspecialchars($proveedor['nombre']) . "</td>
                                            <td>" . htmlspecialchars($proveedor['ciudad']) . "</td>
                                            <td>" . htmlspecialchars($proveedor['telefono']) . "</td>
                                            <td>" . htmlspecialchars($proveedor['email']) . "</td>
                                            <td>
                                                <form action='../PHP/eliminarProveedor.php' method='POST'>
                                                    <input type='hidden' name='idProveedor' value='" . $proveedor['ID'] . "'>
                                                    <button type='submit'>Eliminar</button>
                                                </form>
                                            </td>
                                        </tr>";
                                    }
                                }
                                ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </section>
    </main>
</body>
</html>
