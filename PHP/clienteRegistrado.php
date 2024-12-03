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
$clientes = [];

// Verifica si se han enviado los datos del formulario de búsqueda
if ($_SERVER['REQUEST_METHOD'] == 'GET' && isset($_GET['nombreCliente'])) {
    $nombreCliente = $_GET['nombreCliente'];
    $ciudadCliente = $_GET['ciudadCliente'];

    // Prepara la consulta SQL para buscar clientes por nombre
    $sql = "SELECT * FROM cliente WHERE nombre LIKE :nombreCliente";

    // Si se seleccionó una ciudad, añade a la consulta
    if ($ciudadCliente !== '') {
        $sql .= " AND ciudad = :ciudadCliente";
    }

    $stmt = $conectar->prepare($sql);

    // Bind de los parámetros
    $paramNombre = '%' . $nombreCliente . '%';
    $stmt->bindParam(':nombreCliente', $paramNombre);

    if ($ciudadCliente !== '') {
        $stmt->bindParam(':ciudadCliente', $ciudadCliente);
    }

    $stmt->execute();
    $resultados = $stmt->fetchAll(PDO::FETCH_ASSOC);
}

// Consulta para obtener todos los clientes existentes
$sql = "SELECT * FROM cliente";
$stmt = $conectar->prepare($sql);
$stmt->execute();
$clientes = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gestión de Clientes - Sistema POS</title>
    <link rel="stylesheet" href="../ADMIN/CSS/clientes.css">
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
            <a href="cliente.php" class="active">
                <img src="../ICONOS/clientes.svg" alt="Clientes">
                <span>CLIENTES</span>
            </a>
            <a href="proveedor.php">
                <img src="../ICONOS/proveedores.svg" alt="Proveedores">
                <span>PROVEEDORES</span>
            </a>
            <a href="../DASHBOARD/dasboard.php">
                <img src="../ICONOS/dashboard.svg" alt="Dashboard">
                <span>DASHBOARD</span>
            </a>
        </nav>

        <section id="gestionClientes">
            <h2>Gestión de Clientes</h2>

            <div class="contenedor-columnas">
                <div class="columna-izquierda">
                    <form id="buscarClienteForm" action="../PHP/buscarCliente.php" method="GET">
                        <h3>Buscar Cliente</h3>
                        <label for="nombreCliente">Nombre del Cliente:</label>
                        <input type="text" id="nombreCliente" name="nombreCliente" required>

                        <label for="ciudadCliente">Ciudad:</label>
                        <input type="text" id="ciudadCliente" name="ciudadCliente">

                        <div class="boton-container">
                            <button type="submit">Buscar</button>
                            <button type="button" onclick="volverAPaginaPrincipal()">Volver</button>
                        </div>
                    </form>

                    <script>
                        function volverAPaginaPrincipal() {
                            window.location.href = '/MARKLEAN/ADMIN/clientes.php'; // Cambia 'clientes.php' a la ruta de tu página principal
                        }
                    </script>

                    <div id="opcionesCliente">
                        <h3>Opciones</h3>
                        <button id="nuevoClienteBtn">Crear Nuevo Cliente</button>
                    </div>
                </div>

                <div class="columna-derecha">
                    <div id="listaClientesExistentes">
                        <h3>Clientes Existentes</h3>
                        <table id="clientesExistentes">
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
                                    foreach ($resultados as $cliente) {
                                        echo "<tr>
                                            <td>" . htmlspecialchars($cliente['ID']) . "</td>
                                            <td>" . htmlspecialchars($cliente['nombre']) . "</td>
                                            <td>" . htmlspecialchars($cliente['ciudad']) . "</td>
                                            <td>" . htmlspecialchars($cliente['telefono']) . "</td>
                                            <td>" . htmlspecialchars($cliente['email']) . "</td>
                                            <td>
                                                <form action='../PHP/eliminarCliente.php' method='POST'>
                                                    <input type='hidden' name='idCliente' value='" . $cliente['ID'] . "'>
                                                    <button type='submit'>Eliminar</button>
                                                </form>
                                            </td>
                                        </tr>";
                                    }
                                } else {
                                    // Si no hay búsqueda, mostrar todos los clientes
                                    foreach ($clientes as $cliente) {
                                        echo "<tr>
                                            <td>" . htmlspecialchars($cliente['ID']) . "</td>
                                            <td>" . htmlspecialchars($cliente['nombre']) . "</td>
                                            <td>" . htmlspecialchars($cliente['ciudad']) . "</td>
                                            <td>" . htmlspecialchars($cliente['telefono']) . "</td>
                                            <td>" . htmlspecialchars($cliente['email']) . "</td>
                                            <td>
                                                <form action='../PHP/eliminarCliente.php' method='POST'>
                                                    <input type='hidden' name='idCliente' value='" . $cliente['ID'] . "'>
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
