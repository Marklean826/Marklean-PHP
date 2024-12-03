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
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="CSS/carrito.css">
</head>
<body>
    
    <header class="header">
        <figure class="logo">
            <a href="catalogo.php">
            <img src="IMG/logo.png" alt="Logo">
        </a>
        </figure>
        <nav class="navigation">
            <ul>
              
            </ul>
        </nav>
        <section class="user-info">
        <span>Bienvenido, <?php echo htmlspecialchars($nombreUsuario); ?>  </span>
            <a href="#" class="cart-icon">
                <img src="ICONOS/carrito.svg" alt="Carrito">
                <span class="cart-count">0</span>
            </a>
            <a href="../MARKLEAN/LOGIN_2.0/view/interfaces/index.html" class="logout">Salir</a>
        </section>
    </header>
    
    
    
    
    <!-- Banner -->
    <section class="banner">
        <div class="banner-content">
            <h1>¡Gracias por elegirnos!</h1>
            <p>Apreciamos tu preferencia y estamos aquí para ayudarte en lo que necesites. ¡Esperamos que disfrutes de tu experiencia con nosotros!</p>
          
        </div>
    </section>


    
  <!-- Carrito -->
  <div id="cart" class="cart-section">
    <h2>Carrito de Compras</h2>
    <div class="cart-items"></div>
    <div class="cart-summary">
        <p>Total: <span class="cart-total-price">$0.00</span></p>
        <button class="checkout-btn" id="checkout-btn">Proceder a la compra</button>

    </div>
</div>

<!-- Popup de Pago -->
<div id="payment-popup" class="popup">
    <div class="popup-content">
        <span class="close-btn">&times;</span>
        <h2>Pago de Productos</h2>
        <form action="#">
            <div class="form-group">
                <label for="nombre">Nombre Completo</label>
                <input type="text" id="nombre" name="nombre" required>
            </div>
            <div class="form-group">
                <label for="correo">Correo Electrónico</label>
                <input type="email" id="correo" name="correo" required>
            </div>
            <div class="form-group">
                <label for="metodo-pago">Método de Pago</label>
                <select id="metodo-pago" name="metodo-pago" required>
                    <option value="">Selecciona un método de pago</option>
                    <option value="efectivo">Efectivo</option>
                    <option value="pse">PSE</option>
                    <option value="tarjeta">Tarjeta de Crédito</option>
                </select>
            </div>
            <div id="efectivo-fields" class="form-group hidden">
                <label for="efectivo">Monto en Efectivo</label>
                <input type="text" id="efectivo" name="efectivo">
            </div>
            <div id="pse-fields" class="form-group hidden">
                <label for="pse">Banco PSE</label>
                <select id="pse" name="pse">
                    <option value="">Selecciona un banco</option>
                    <option value="banco1">Banco 1</option>
                    <option value="banco2">Banco 2</option>
                    <option value="banco3">Banco 3</option>
                </select>
            </div>
            <div id="tarjeta-fields" class="form-group hidden">
                <label for="tarjeta">Número de Tarjeta</label>
                <input type="text" id="tarjeta" name="tarjeta">
            </div>
            <div class="form-group">
                <label for="fecha">Fecha de Vencimiento</label>
                <input type="text" id="fecha" name="fecha" placeholder="MM/AA" required>
            </div>
            <div class="form-group">
                <label for="cvv">CVV</label>
                <input type="text" id="cvv" name="cvv" required>
            </div>
            <div class="form-group">
                <button type="submit">Pagar</button> <br>
            </div>
        </form>
    </div>
</div>


<!--chatbot -->

<div class="chat-bubble" id="chatBubble">
    <span class="bubble-text"> <img src="../MARKLEAN/ICONOS/chatbot.svg" alt=""></span>
</div>

<div class="bubble-content" id="bubbleContent">
    <div class="headers">
        <span class="close-btn" id="closeBtn">&times;</span>
        <h2>Asistente virtual</h2>
    </div>
    <div class="chat-messages" id="chatMessages">
        <p>Bienvenido al chat. ¿En qué puedo ayudarte?</p>
    </div>
    <input type="text" id="userInput" placeholder="Escribe tu mensaje...">
    <button id="sendBtn">Enviar</button>
</div>


<footer class="footer">
    <p>Derechos reservados © 2024 MARKLEAN</p>
</footer>




<script src="../MARKLEAN/JS/catalogo.js"></script>


</body>
</html>