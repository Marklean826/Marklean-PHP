<?php
session_start();
if (!isset($_SESSION['codigo_verificacion'])) {
    header("Location: recuperar.php"); // Redirigir si no hay código
    exit();
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../../LOGIN_2.0/view/css/recuperarContrasena.css"> <!-- Vincula el archivo CSS -->
    <title>Verificar Código</title>
</head>
<body>
    <main class="reset-password">
        <h2>Verificar Código</h2>
        <form action="cambiarContrasena.php" method="POST">
            <input type="text" name="codigo" placeholder="Código de Verificación" required>
            <button type="submit">Verificar Código</button>

            <a href="../view/interfaces/index.html" class="btn-home">Volver al Inicio</a>
        </form>
    </main>
</body>
</html>
