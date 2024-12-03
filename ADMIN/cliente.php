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
$productos = []; // Para almacenar los productos que se buscan
$clientes = []; // Para almacenar los clientes registrados

// Verificar si hay un término de búsqueda
if (isset($_GET['search-term'])) {
    $searchTerm = $_GET['search-term'];

    try {
        // Consulta para obtener los clientes que coinciden con el término de búsqueda
        $sql = "SELECT * FROM cliente WHERE nombre LIKE :searchTerm";
        $stmt = $conectar->prepare($sql);
        $stmt->execute([':searchTerm' => '%' . $searchTerm . '%']);

        // Obtener resultados
        if ($stmt->rowCount() > 0) {
            $clientes = $stmt->fetchAll(PDO::FETCH_ASSOC);
        } else {
            $clientes = []; // No hay resultados
        }
    } catch (PDOException $e) {
        echo "Error: " . $e->getMessage();
    }
} else {
    // Consulta para obtener todos los clientes registrados si no hay término de búsqueda
    $sqlClientes = "SELECT * FROM cliente";
    $stmtClientes = $conectar->prepare($sqlClientes);
    $stmtClientes->execute();
    $clientes = $stmtClientes->fetchAll(PDO::FETCH_ASSOC);
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gestión de Clientes - Sistema POS</title>
    <link rel="stylesheet" href="../ADMIN/CSS/cliente.css">
    <link rel="stylesheet" href="../ADMIN/CSS/productos.css">
    <style>
        /* Estilo para la tabla de resultados */
        #clientes {
            width: 100%;
            border-collapse: collapse;
        }

        #clientes th, #clientes td {
            border: 1px solid #ddd;
            padding: 8px;
        }

        #clientes th {
            background-color: #f2f2f2;
        }

        /* Fondo blanco para las filas */
        #clientes tbody tr {
            background-color: white; /* Fondo blanco */
        }

        /* Alternar colores de fondo para mejorar la legibilidad */
        #clientes tbody tr:nth-child(even) {
            background-color: #f9f9f9; /* Fondo gris claro */
        }

        /* Estilo para el popup */
        .popup {
            display: none; /* Oculto por defecto */
            position: fixed;
            z-index: 1000;
            left: 0;
            top: 0;
            width: 100%;
            height: 100%;
            overflow: auto;
            background-color: rgba(0,0,0,0.5); /* Fondo semi-transparente */
        }

        .popup-content {
            background-color: #fefefe;
            margin: 15% auto;
            padding: 20px;
            border: 1px solid #888;
            width: 80%;
            max-width: 500px;
        }

        .close-btn {
            color: #aaa;
            float: right;
            font-size: 28px;
            font-weight: bold;
        }

        .close-btn:hover,
        .close-btn:focus {
            color: black;
            text-decoration: none;
            cursor: pointer;
        }
    </style>
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
            <span>Bienvenido, <?php echo htmlspecialchars($nombreUsuario); ?></span>
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
            <a href="../ADMIN/cliente.php" class="active">
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

        <section id="Cliente">
            <br>
            <h2>Buscar/editar clientes existentes</h2>

            <section class="contenedor">
                <section class="search-section">
                    <form id="search-form" method="get" action="cliente.php">
                        <label for="search-term">Nombre del Cliente:</label>
                        <input type="text" id="search-term" name="search-term" placeholder="Ingrese el término de búsqueda" required>
                        <button type="submit">Buscar</button>
                    </form>
                </section>
            </section>

            <!-- Clientes Registrados -->
            <section class="results-section">
                <h3>Clientes Encontrados</h3>
                <table id="clientes">
                    <thead>
                        <tr>
                            <th>NOMBRE CLIENTE</th>
                            <th>CORREO ELECTRÓNICO</th>
                            <th>TELÉFONO</th>
                            <th>ACCIONES</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if (!empty($clientes)): ?>
                            <?php foreach ($clientes as $cliente): ?>
                                <tr>
                                    <td><?php echo isset($cliente['nombre']) ? htmlspecialchars($cliente['nombre']) : 'N/A'; ?></td>
                                    <td><?php echo isset($cliente['email']) ? htmlspecialchars($cliente['email']) : 'N/A'; ?></td>
                                    <td><?php echo isset($cliente['telefono']) ? htmlspecialchars($cliente['telefono']) : 'N/A'; ?></td>
                                    <td>
                                        <form action="../PHP/clienteEliminado.php" method="post" style="display:inline;">
                                            <input type="hidden" name="ID" value="<?php echo isset($cliente['ID']) ? htmlspecialchars($cliente['ID']) : ''; ?>">
                                            <button type="submit" onclick="return confirm('¿Estás seguro de eliminar este cliente?');">Eliminar</button>
                                        </form>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        <?php else: ?>
                            <tr><td colspan='4'>No se encontraron clientes con ese nombre.</td></tr>
                        <?php endif; ?>
                    </tbody>
                </table>
            </section>
        </section>

        <!-- Formulario para agregar cliente -->
        <section class="add-customer-section">
            <h2>Agregar Nuevo Cliente</h2>
            <button type="button" id="open-popup-btn">Agregar</button>
        </section>

        <!-- Popup del formulario -->
        <div id="popup-form" class="popup">
            <div class="popup-content">
                <span class="close-btn">&times;</span>
                <h2>Agregar Cliente</h2>
                <form action="../PHP/buscar_cliente.php" method="post">
                    <label for="nombre">Nombre:</label>
                    <input type="text" id="nombre" name="nombre" required>

                    <label for="email">Correo Electrónico:</label>
                    <input type="email" id="email" name="email" required>

                    <label for="telefono">Teléfono:</label>
                    <input type="text" id="telefono" name="telefono" required>

                    <label for="direccion">Dirección:</label>
                    <input type="text" id="direccion" name="direccion" required>

                    <label for="ciudad">Ciudad:</label>
                    <select id="ciudad" name="ciudad" required>
                        <option value="">Seleccione una ciudad</option>
                        <option value="Bogotá">Bogotá</option>
                        <option value="Medellín">Medellín</option>
                        <option value="Cali">Cali</option>
                        <option value="Barranquilla">Barranquilla</option>
                        <option value="Cartagena">Cartagena</option>
                        <option value="Bucaramanga">Bucaramanga</option>
                        <option value="Pereira">Pereira</option>
                        <option value="Manizales">Manizales</option>
                        <option value="Santa Marta">Santa Marta</option>
                        <option value="Cúcuta">Cúcuta</option>
                        <option value="Ibagué">Ibagué</option>
                        <option value="Villavicencio">Villavicencio</option>
                        <option value="Neiva">Neiva</option>
                        <option value="Armenia">Armenia</option>
                        <option value="Montería">Montería</option>
                    </select> <br>

                    <button type="submit">Agregar Cliente</button>
                </form>
            </div>
        </div>

        <script>
            // Script para manejar el popup
            document.getElementById('open-popup-btn').onclick = function() {
                document.getElementById('popup-form').style.display = 'block';
            }

            document.querySelector('.close-btn').onclick = function() {
                document.getElementById('popup-form').style.display = 'none';
            }

            window.onclick = function(event) {
                if (event.target == document.getElementById('popup-form')) {
                    document.getElementById('popup-form').style.display = 'none';
                }
            }
        </script>
        <script src="../ADMIN/js/cliente.js"></script>
    </main>
</body>
</html>
