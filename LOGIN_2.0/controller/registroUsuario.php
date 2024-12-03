<?php
require_once $_SERVER['DOCUMENT_ROOT'].'/MARKLEAN/PHP/conexionDB.php'; // Este archivo debe tener la conexión a la base de datos

// Verificar si el formulario ha sido enviado
if ($_SERVER["REQUEST_METHOD"] == "POST") {

    // Obtener los datos del formulario
    $identificacion = $_POST['identificacion'];
    $nombres = $_POST['nombres'];
    $apellidos = $_POST['apellidos'];
    $telefono = $_POST['telefono'];
    $correo = $_POST['correo'];
    $contrasena = password_hash($_POST['contrasena'], PASSWORD_DEFAULT); // Encriptar la contraseña
    $rol = $_POST ['rol'];

    try {
        // Preparar la consulta SQL para insertar los datos del usuario
        $sql = "INSERT INTO usuario (identificacion, nombres, apellidos, telefono, correo, contrasena, rol) 
                VALUES (:identificacion, :nombres, :apellidos, :telefono, :correo, :contrasena, :rol)";

        // Preparar la sentencia
        $stmt = $conectar->prepare($sql);

        // Ejecutar la consulta con los valores
        $stmt->execute([
            ':identificacion' => $identificacion,
            ':nombres' => $nombres,
            ':apellidos' => $apellidos,
            ':telefono' => $telefono,
            ':correo' => $correo,
            ':contrasena' => $contrasena,
            'rol' => $rol
        ]);

        // Redirigir con un mensaje de éxito
        echo "<script>
                alert('Usuario registrado con éxito');
                window.location.href = '../view/interfaces/login.html'; // Cambia la ruta si es necesario
              </script>";
    } catch (PDOException $e) {
        // Manejar el error si ocurre
        echo "Error al registrar el usuario: " . $e->getMessage();
    }
} else {
    // Si no se ha enviado el formulario
    echo "Método no permitido.";
}
?>
