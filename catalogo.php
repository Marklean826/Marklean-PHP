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
    <title>Tienda de Productos de Aseo</title>
    <link rel="stylesheet" href="CSS/catalogo.css">
</head>
<body>
<header class="header">
    <figure class="logo">
        <a href="../MARKLEAN/catalogo.php">
        <img src="IMG/logo.png" alt="Logo">
    </a>
    </figure>
    <nav class="navigation">
        <ul>
          
        </ul>
    </nav>
    
        <!-- Otros elementos del encabezado -->
        <section class="user-info">
        <span>Bienvenido, <?php echo htmlspecialchars($nombreUsuario); ?>  </span>
            <a href="carrito.php" class="cart-icon">
                <img src="ICONOS/carrito.svg" alt="Carrito">
                <span class="cart-count">0</span>
            </a>
            <a href="../MARKLEAN/LOGIN_2.0/view/interfaces/index.html" class="logout">Salir</a>
        </section>
   
    
</header>




<!-- Banner -->
<section class="banner">
    <div class="banner-content">
        <h1>BIENVENIDO A MARKLEAN</h1>
        <p>Encuentra los mejores productos para tu cuidado personal y del hogar.</p>
      
    </div>
</section>






    <!-- Categorías -->
    <section class="categories">
        <h2>Categorías</h2>
        <div class="category-list">


            <div class="category-item">
                <a href="#cuidado-hogar">Accesorios para el hogar </a>
            </div>

            <div class="category-item">
                <a href="#higiene-corporal">Higiene Corporal</a>
            </div>
            <div class="category-item">
                <a href="#cuidado-capilar">Cuidado Capilar</a>
            </div>

            <div class="category-item">
                <a href="#higiene-bucal">Higiene Bucal</a>
            </div>

            <div class="category-item">
                <a href="#limpieza-superficie">Limpieza de Superficies </a>
            </div>

            <div class="category-item">
                <a href="#limpieza-pisos">Limpieza de Pisos </a>
            </div>

            <div class="category-item">
                <a href="#limpieza-ropa">Limpieza de Ropa </a>
            </div>

            <div class="category-item">
                <a href="#producto-lavavajillas">Productos para Lavavajillas </a>
            </div>

            

        </div>
    </section>
</main>




<section id="cuidado-hogar" class="products2">
    <h2>Accesorios para el hogar</h2>
</section >
<main class="main-content">
    <section class="products2">
    <article class="product-item">
    <img src="IMG/jarron.png" alt="Producto 2">
    <h3>Jarrón decorativo</h3>
    <p>$21.900</p>
    <button class="add-to-cart">Comprar</button>
    <button class="add-to-cart">Agregar al Carrito</button>
    <div class="ar-view">
    <span class="ar-text"><b>Ver en AR</b></span>
    <div class="ar-icon-container">
        <img src="IMG/jarronQR.png" alt="Icono AR" class="ar-icon">
    </div>
</div>

</article>
       



        <article class="product-item">
    <img src="IMG/caballoAR.png" alt="Producto 2">
    <h3>Caballo en porcelana</h3>
    <p>$89.900</p>
    <button class="add-to-cart">Comprar</button>
    <button class="add-to-cart">Agregar al Carrito</button>
    <div class="ar-view">
    <span class="ar-text"><b>Ver en AR</b></span>
    <div class="ar-icon-container">
        <img src="IMG/caballoQR.png" alt="Icono AR" class="ar-icon">
    </div>
</div>

</article>




<article class="product-item">
    <img src="IMG/sillaAR.png" alt="Producto 2">
    <h3>Silla de tela fina</h3>
    <p>$109.900</p>
    <button class="add-to-cart">Comprar</button>
    <button class="add-to-cart">Agregar al Carrito</button>
    <div class="ar-view">
    <span class="ar-text"><b>Ver en AR</b></span>
    <div class="ar-icon-container">
        <img src="IMG/sillaQR.png" alt="Icono AR" class="ar-icon">
    </div>
</div>

</article>
      
        <!-- Más productos aqui -->
    </section>
</main>







  <!-- Productos Aseo Personal -->
  <section id="higiene-corporal" class="products">
    <h2>Higiene Corporal</h2>
</section>
<main class="main-content">
    <section class="products2">
        <article class="product-item">
            <img src="IMG/jabon-liquido.png" alt="Producto 1">
            <h3>Jabón Líquido</h3>
            <p>$4.900</p>
            <button class="add-to-cart">Comprar</button>
            <button class="add-to-cart">Agregar al Carrito</button>
            
        </article>
        <article class="product-item">
            <img src="IMG/keratina1.png" alt="Producto 2">
            <h3>Shampoo</h3>
            <p>$5.900</p>
            <button class="add-to-cart">Comprar</button>
            <button class="add-to-cart">Agregar al Carrito</button>
           
        </article>
        <article class="product-item">
            <img src="IMG/acondicionador.png" alt="Producto 3">
            <h3>Jabón Dove</h3>
            <p>$3.900</p>
            <button class="add-to-cart">Comprar</button>
            <button class="add-to-cart">Agregar al Carrito</button>
            <!-- Este producto no tiene opción de AR -->
        </article>

    
        <!-- Más productos aqui -->
    </section>
</main>



<section id="cuidado-capilar" class="products2">
    <h2>Cuidado Capilar</h2>
</section >
<main class="main-content">
    <section class="products2">
        <article class="product-item">
            <img src="IMG/shampoo-fortificante.png" alt="Producto 1">
            <h3>Shampoo fortificante </h3>
            <p>$6.900</p>
            <button class="add-to-cart">Comprar</button>
            <button class="add-to-cart">Agregar al Carrito</button>
           
        </article>
        <article class="product-item">
            <img src="IMG/acondicionador-hidratante.png" alt="Producto 2">
            <h3>Acondicionador hidratante</h3>
            <p>$9.900</p>
            <button class="add-to-cart">Comprar</button>
            <button class="add-to-cart">Agregar al Carrito</button>
   
        </article>
        <article class="product-item">
            <img src="IMG/MASCARILLA-CAPILAR.png" alt="Producto 3">
            <h3>Mascarilla capilar</h3>
            <p>$11.900</p>
            <button class="add-to-cart">Comprar</button>
            <button class="add-to-cart">Agregar al Carrito</button>
            <!-- Este producto no tiene opción de AR -->
        </article>
        <!-- Más productos aqui -->
    </section>
</main>



<section id="higiene-bucal" class="products2">
    <h2>Higiene Bucal</h2>
</section >
<main class="main-content">
    <section class="products2">
        <article class="product-item">
            <img src="IMG/cepillo-electrico.png" alt="Producto 1">
            <h3>Cepillo eléctrico</h3>
            <p>$60.900</p>
            <button class="add-to-cart">Comprar</button>
            <button class="add-to-cart">Agregar al Carrito</button>
        
        </article>
        <article class="product-item">
            <img src="IMG/listerine-control.png" alt="Producto 2">
            <h3>Listerine</h3>
            <p>$8.900</p>
            <button class="add-to-cart">Comprar</button>
            <button class="add-to-cart">Agregar al Carrito</button>
         
        </article>
        <article class="product-item">
            <img src="IMG/pasta-dental.png" alt="Producto 3">
            <h3>Pasta dental</h3>
            <p>$3.900</p>
            <button class="add-to-cart">Comprar</button>
            <button class="add-to-cart">Agregar al Carrito</button>
            <!-- Este producto no tiene opción de AR -->
        </article>
        <!-- Más productos aqui -->
    </section>
</main>



<section id="limpieza-superficie" class="products2">
    <h2>Limpieza de Superficies</h2>
</section >
<main class="main-content">
    <section class="products2">
        <article class="product-item">
            <img src="IMG/desinfectante-multiusos.png" alt="Producto 1">
            <h3>Spray multiusos desinfectante</h3>
            <p>$5.900</p>
            <button class="add-to-cart">Comprar</button>
            <button class="add-to-cart">Agregar al Carrito</button>
           
        </article>
        <article class="product-item">
            <img src="IMG/pano-microfibra.png" alt="Producto 2">
            <h3>Paños de microfibra</h3>
            <p>$2.900</p>
            <button class="add-to-cart">Comprar</button>
            <button class="add-to-cart">Agregar al Carrito</button>
     
        </article>
        <article class="product-item">
            <img src="IMG/toallas-desinfectantes.png" alt="Producto 3">
            <h3>Toallitas desinfectantes</h3>
            <p>$3.900</p>
            <button class="add-to-cart">Comprar</button>
            <button class="add-to-cart">Agregar al Carrito</button>
            <!-- Este producto no tiene opción de AR -->
        </article>
        <!-- Más productos aqui -->
    </section>
</main>




<section id="limpieza-pisos" class="products2">
    <h2>Limpieza de Pisos</h2>
</section >
<main class="main-content">
    <section class="products2">
        <article class="product-item">
            <img src="IMG/Alex-limpiador.png" alt="Producto 1">
            <h3>Detergente para pisos de madera</h3>
            <p>$4.900</p>
            <button class="add-to-cart">Comprar</button>
            <button class="add-to-cart">Agregar al Carrito</button>
       
        </article>
        <article class="product-item">
            <img src="IMG/mopa-con-spray.png" alt="Producto 2">
            <h3>Mopa con spray</h3>
            <p>$22.900</p>
            <button class="add-to-cart">Comprar</button>
            <button class="add-to-cart">Agregar al Carrito</button>
   
        </article>
        <article class="product-item">
            <img src="IMG/limpiador-pisos.png" alt="Producto 3">
            <h3>Limpiador de pisos de cerámica</h3>
            <p>$6.900</p>
            <button class="add-to-cart">Comprar</button>
            <button class="add-to-cart">Agregar al Carrito</button>
            <!-- Este producto no tiene opción de AR -->
        </article>
        <!-- Más productos aqui -->
    </section>
</main>




<section id="limpieza-ropa" class="products2">
    <h2>Limpieza de Ropa</h2>
</section >
<main class="main-content">
    <section class="products2">
        <article class="product-item">
            <img src="IMG/detergente.png" alt="Producto 1">
            <h3>Detergente líquido para ropa</h3>
            <p>$2.900</p>
            <button class="add-to-cart">Comprar</button>
            <button class="add-to-cart">Agregar al Carrito</button>
          
        </article>
        <article class="product-item">
            <img src="IMG/suavitel.png" alt="Producto 2">
            <h3>Suavizante de telas</h3>
            <p>$5.900</p>
            <button class="add-to-cart">Comprar</button>
            <button class="add-to-cart">Agregar al Carrito</button>
    
        </article>
        <article class="product-item">
            <img src="IMG/QUITAMANCHAS.png" alt="Producto 3">
            <h3>Quitamanchas en spray</h3>
            <p>$12.900</p>
            <button class="add-to-cart">Comprar</button>
            <button class="add-to-cart">Agregar al Carrito</button>
            <!-- Este producto no tiene opción de AR -->
        </article>
        <!-- Más productos aqui -->
    </section>
</main>




<section id="producto-lavavajillas" class="products2">
    <h2>Productos de Lavavajillas</h2>
</section >
<main class="main-content">
    <section class="products2">
        <article class="product-item">
            <img src="IMG/pastillas-finish.png" alt="Producto 1">
            <h3>Pastillas para lavavajillas</h3>
            <p>$4.900</p>
            <button class="add-to-cart">Comprar</button>
            <button class="add-to-cart">Agregar al Carrito</button>
        
        </article>
        <article class="product-item">
            <img src="IMG/brillo.png" alt="Producto 2">
            <h3>Abrillantador para lavavajillas</h3>
            <p>$5.900</p>
            <button class="add-to-cart">Comprar</button>
            <button class="add-to-cart">Agregar al Carrito</button>
     
        </article>
        <article class="product-item">
            <img src="IMG/lavaloza.png" alt="Producto 3">
            <h3>Limpiador de lavavajillas</h3>
            <p>$1.900</p>
            <button class="add-to-cart">Comprar</button>
            <button class="add-to-cart">Agregar al Carrito</button>
            <!-- Este producto no tiene opción de AR -->
        </article>
        <!-- Más productos aqui -->
    </section>
</main>






  <!-- Carrito -->
  <div id="cart" class="cart-section">
    <h2>Carrito de Compras</h2>
    <div class="cart-items"></div>
    <div class="cart-summary">
        <p>Total: <span class="cart-total-price">$0.00</span></p>
        <button class="checkout-btn">Proceder a la compra</button>
    </div>
</div>



<!--chatbot -->
<div class="chat-bubble" id="chatBubble">
    <span class="bubble-text"> <img src="../MARKLEAN/ICONOS/chatbot.svg" alt=""></span>
</div>

<div class="bubble-content" id="bubbleContent">
    <div class="headers">
        <span class="close-btn" id="closeBtn">&times;</span>
        <h2>Asistente Virtual</h2>
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


<script src="../MARKLEAN/JS/chatbot.js"></script>
<script src="../MARKLEAN/JS/catalogo.js"></script>


<!-- AR.js -->
<script src="https://aframe.io/releases/1.2.0/aframe.min.js"></script>
<script src="https://cdn.jsdelivr.net/gh/jeromeetienne/AR.js/aframe/build/aframe-ar.js"></script>

</body>
</html>


