<?php
require 'conexionDB.php'; // Este archivo debe tener la conexión a la base de datos

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Obtener los datos del formulario
    $nombre = $_POST['nombre'];
    $email = $_POST['email'];
    $telefono = $_POST['telefono'];
    $razonSocial = $_POST['razonSocial'];
    $ciudad = $_POST['ciudad'];

    
        try {
            // Preparar la consulta SQL para insertar los datos del cliente
            $sql = "INSERT INTO proveedor (nombre, email, telefono, razonSocial, ciudad) 
                    VALUES (:nombre, :email, :telefono, :razonSocial, :ciudad)";

            // Preparar la sentencia
            $stmt = $conectar->prepare($sql);

            // Ejecutar la consulta con los valores
            $stmt->execute([
                ':nombre' => $nombre,
                ':email' => $email,
                ':telefono' => $telefono,
                ':razonSocial' => $razonSocial,
                ':ciudad' => $ciudad
            ]);

            echo "<script> 
            alert('Proveedor registrado con exito')
            window.location.href = '../ADMIN/proveedor.php'
          </script>";
        } catch (PDOException $e) {
            echo "Error al registrar el cliente: " . $e->getMessage();
        }
    } 

?>