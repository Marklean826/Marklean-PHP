<?php
session_start();
if (!isset($_SESSION['codigo_verificacion'])) {
    header("Location: recuperar.php"); // Redirigir si no hay código
    exit();
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['codigo']) && isset($_POST['nueva_contrasena'])) {
        $codigoIngresado = $_POST['codigo'];
        $nuevaContrasena = $_POST['nueva_contrasena'];

        // Verificar si el código es correcto
        if ($codigoIngresado == $_SESSION['codigo_verificacion']) {
            // Actualizar la contraseña en la base de datos
            require_once $_SERVER['DOCUMENT_ROOT'].'/MARKLEAN/PHP/conexionDB.php';

            $correo = $_SESSION['correo'];
            $sql = "UPDATE usuario SET contrasena = :nueva_contrasena WHERE correo = :correo";
            $stmt = $conectar->prepare($sql);
            $stmt->execute([
                ':nueva_contrasena' => $nuevaContrasena,
                ':correo' => $correo
            ]);

            echo "<script>alert('Contraseña actualizada exitosamente'); window.location.href='../../LOGIN_2.0/view/interfaces/login.html';</script>";
            session_destroy(); // Limpiar sesión
        } else {
            echo "<script>alert('Código de verificación incorrecto'); window.history.back();</script>";
        }
    }
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../view/css/recuperarContrasena.css"> <!-- Vincula el archivo CSS -->
    <title>Cambiar Contraseña</title>
</head>
<body>
    <main class="reset-password">
        <h2>Cambiar Contraseña</h2>
        <form action="cambiarContrasena.php" method="POST">
            <input type="password" name="nueva_contrasena" placeholder="Nueva Contraseña" required>
            <a href="../view/interfaces/index.html" class="btn-homes">Cambiar contraseña</a>

            <a href="../view/interfaces/index.html" class="btn-home">Volver al Inicio</a>
        </form>
    </main>
</body>
</html>
