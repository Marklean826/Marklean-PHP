<?php
session_start(); // Iniciar sesión
require_once $_SERVER['DOCUMENT_ROOT'].'/MARKLEAN/PHP/conexionDB.php'; // Archivo de conexión a la base de datos

// Verificar si el formulario de inicio de sesión ha sido enviado
if ($_SERVER["REQUEST_METHOD"] == "POST") {

    // Obtener los datos del formulario
    $correo = $_POST['correo'];
    $contrasena = $_POST['contrasena'];

    try {
        // Preparar la consulta SQL para verificar el correo
        $sql = "SELECT * FROM usuario WHERE correo = :correo";
        $stmt = $conectar->prepare($sql);
        $stmt->execute([':correo' => $correo]);

        // Obtener el usuario
        $usuario = $stmt->fetch(PDO::FETCH_ASSOC);

        // Verificar si el usuario existe y la contraseña es correcta
        if ($usuario && password_verify($contrasena, $usuario['contrasena'])) {
            // Guardar el nombre, correo y rol del usuario en la sesión
            $_SESSION['usuario_nombre'] = $usuario['nombres'];
            $_SESSION['usuario_correo'] = $usuario['correo'];
            $_SESSION['usuario_rol'] = $usuario['rol']; // Almacenar el rol del usuario

            // Redirigir según el rol del usuario
            if ($usuario['rol'] === 'admin') {
                echo "<script>
                       
                        window.location.href = '../../ADMIN/venta.php'; // Ruta para admin
                      </script>";
            } elseif ($usuario['rol'] === 'usuario') {
                echo "<script>
                       
                        window.location.href = '../../catalogo.php'; // Ruta para usuario regular
                      </script>";
            } else {
                echo "<script>
                        alert('Rol no reconocido');
                        window.location.href = '../view/interfaces/login.html'; // En caso de un rol desconocido
                      </script>";
            }
        } else {
            echo "<script>
                    alert('Correo o contraseña incorrectos');
                    window.location.href = '../view/interfaces/login.html'; // Redirigir al login si falla
                  </script>";
        }
    } catch (PDOException $e) {
        echo "Error en el inicio de sesión: " . $e->getMessage();
    }
} else {
    echo "Método no permitido.";
}
?>
