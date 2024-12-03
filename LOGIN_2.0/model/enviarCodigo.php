<?php
require_once $_SERVER['DOCUMENT_ROOT'].'/MARKLEAN/PHP/conexionDB.php'; // Asegúrate de que la ruta es correcta

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['correo'])) {
        $correo = $_POST['correo'];

        // Aquí debes verificar si el correo está registrado en la base de datos
        $sql = "SELECT * FROM usuario WHERE correo = :correo";
        $stmt = $conectar->prepare($sql);
        $stmt->execute([':correo' => $correo]);

        if ($stmt->rowCount() > 0) {
            // Generar un código de verificación
            $codigoVerificacion = rand(100000, 999999); // Código de 6 dígitos

            // Enviar el código por correo (reemplaza con tu propia lógica de envío)
            $asunto = "Código de verificación para recuperar contraseña";
            $mensaje = "Tu código de verificación es: " . $codigoVerificacion;
            mail($correo, $asunto, $mensaje); // Función mail de PHP

            // Guardar el código en sesión para verificar después
            session_start();
            $_SESSION['codigo_verificacion'] = $codigoVerificacion;
            $_SESSION['correo'] = $correo;

            echo "<script>alert('Código enviado a $correo'); window.location.href='verificarCodigo.php';</script>";
        } else {
            echo "<script>alert('Correo no registrado'); window.history.back();</script>";
        }
    }
}
?>
