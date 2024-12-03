// Definición de variables globales
let cart = []; // Arreglo para almacenar los productos del carrito
let cartCountElement = document.querySelector('.cart-count'); // Elemento para mostrar la cantidad de productos en el carrito
let cartItemsElement = document.querySelector('.cart-items'); // Contenedor de los items del carrito en el DOM
let cartTotalPriceElement = document.querySelector('.cart-total-price'); // Elemento para mostrar el precio total del carrito
const exchangeRate = 1000; // Tasa de cambio: 1 USD = 1000 COP (ejemplo)

// Función para guardar el carrito en LocalStorage
function saveCartToLocalStorage() {
    localStorage.setItem('cart', JSON.stringify(cart));
}

// Función para cargar el carrito desde LocalStorage
function loadCartFromLocalStorage() {
    const cartData = localStorage.getItem('cart');
    if (cartData) {
        cart = JSON.parse(cartData);
        updateCart(); // Actualizar el carrito cuando se carga desde LocalStorage
    }
}

// Cargar el carrito desde LocalStorage al cargar la página
window.addEventListener('DOMContentLoaded', () => {
    loadCartFromLocalStorage();
});

// Función para añadir un producto al carrito
function addToCart(product) {
    cart.push(product); // Agregar el producto al carrito
    updateCart(); // Actualizar la representación visual del carrito
    saveCartToLocalStorage(); // Guardar el carrito en LocalStorage
}

// Función para remover un producto del carrito
function removeFromCart(index) {
    cart.splice(index, 1); // Remover el producto del carrito
    updateCart(); // Actualizar la representación visual del carrito
    saveCartToLocalStorage(); // Guardar el carrito en LocalStorage
}

// Función para actualizar la representación visual del carrito
function updateCart() {
    cartItemsElement.innerHTML = ''; // Limpiar el contenedor de items del carrito
    let totalPrice = 0; // Inicializar el precio total del carrito

    // Recorrer todos los productos en el carrito
    cart.forEach((product, index) => {
        totalPrice += product.price; // Sumar el precio del producto al precio total del carrito

        // Crear un elemento para representar el producto en el carrito
        let cartItem = document.createElement('div');
        cartItem.className = 'cart-item';

        // Convertir el precio a pesos colombianos
        let priceInCOP = product.price * exchangeRate;

        // Agregar contenido HTML al elemento del producto en el carrito
        cartItem.innerHTML = `
            <img src="${product.image}" alt="${product.name}">
            <div class="cart-item-info">
                <h4>${product.name}</h4>
                <p>$${priceInCOP.toFixed(2)} COP</p>
            </div>
            <button class="cart-item-remove" onclick="removeFromCart(${index})">Eliminar</button>
        `;

        // Agregar el elemento del producto al contenedor del carrito
        cartItemsElement.appendChild(cartItem);
    });

    // Actualizar la cantidad total de productos en el carrito
    cartCountElement.textContent = cart.length;

    // Calcular el precio total en pesos colombianos
    let totalPriceInCOP = totalPrice * exchangeRate;
    cartTotalPriceElement.textContent = `$${totalPriceInCOP.toFixed(2)} COP`;
}

// Event listeners para los botones "Agregar al Carrito"
document.querySelectorAll('.add-to-cart').forEach(button => {
    button.addEventListener('click', () => {
        // Obtener la información del producto desde el DOM
        const product = {
            name: button.parentElement.querySelector('h3').textContent,
            price: parseFloat(button.parentElement.querySelector('p').textContent.replace('$','')),
            image: button.parentElement.querySelector('img').src
        };
        addToCart(product); // Añadir el producto al carrito
    });
});






var chatBubble = document.getElementById('chatBubble');
var bubbleContent = document.getElementById('bubbleContent');
var closeBtn = document.getElementById('closeBtn');
var userInput = document.getElementById('userInput');
var sendBtn = document.getElementById('sendBtn');
var chatMessages = document.getElementById('chatMessages');

var isInPQRSFlow = false;
var currentStep = 0;
var userInformation = {
    typeOfRequest: "",
    details: ""
};

// Función para abrir el chat
chatBubble.addEventListener('click', function() {
    bubbleContent.style.display = 'block';
    chatBubble.style.display = 'none';
});

// Función para cerrar el chat
closeBtn.addEventListener('click', function() {
    bubbleContent.style.display = 'none';
    chatBubble.style.display = 'flex';
});

// Función para manejar la interacción del usuario
sendBtn.addEventListener('click', function() {
    var userMessage = userInput.value.trim();
    if (userMessage !== '') {
        var userMessageElement = document.createElement('p');
        userMessageElement.className = 'user-message';
        userMessageElement.textContent = userMessage;
        chatMessages.appendChild(userMessageElement);
        userInput.value = '';
        userInput.focus();

        // Si el bot no está en el flujo PQRS, empieza a preguntar por el tipo de solicitud
        if (!isInPQRSFlow) {
            handleInitialMessage(userMessage);
        } else {
            handleUserResponses(userMessage);
        }
    }
});

// Función para manejar el mensaje inicial del usuario
function handleInitialMessage(userMessage) {
    setTimeout(function() {
        var botMessageElement = document.createElement('p');
        botMessageElement.className = 'bot-message';
        var responseMessage = '';

        // Respuestas iniciales con comprensión de palabras clave
        if (userMessage.toLowerCase().includes('ayuda') || userMessage.toLowerCase().includes('hola') || userMessage.toLowerCase().includes('buenas')) {
            responseMessage = '¡Hola! Soy tu asistente virtual. ¿En qué puedo ayudarte hoy? ¿Quieres hacer una petición, queja, reclamo o sugerencia?';
        } else if (userMessage.toLowerCase().includes('petición') || userMessage.toLowerCase().includes('queja') || userMessage.toLowerCase().includes('reclamo') || userMessage.toLowerCase().includes('sugerencia')) {
            responseMessage = 'Parece que quieres hacer una solicitud. Por favor, elige una opción: Petición, Queja, Reclamo o Sugerencia.';
            isInPQRSFlow = true; // Cambiar el estado al flujo PQRS
            userInformation.typeOfRequest = userMessage.toLowerCase(); // Guardar tipo de solicitud
            currentStep++; // Avanzar al siguiente paso
        } else {
            responseMessage = 'Lo siento, no entendí lo que dijiste. ¿Podrías elegir una opción? (Petición, Queja, Reclamo, Sugerencia)';
        }

        botMessageElement.textContent = responseMessage;
        chatMessages.appendChild(botMessageElement);
        chatMessages.scrollTop = chatMessages.scrollHeight;
    }, 1000);
}

// Función para gestionar las respuestas del usuario después de elegir tipo de solicitud
function handleUserResponses(userMessage) {
    setTimeout(function() {
        var botMessageElement = document.createElement('p');
        botMessageElement.className = 'bot-message';
        var responseMessage = '';

        if (currentStep === 1) {
            // Aquí preguntamos más detalles sobre la solicitud
            userInformation.details = userMessage;
            responseMessage = `Por favor, especifica con más detalle tu ${userInformation.typeOfRequest}. ¿Qué exactamente te gustaría que resolviera o cambiara?`;
            currentStep++;
        } else if (currentStep === 2) {
            // Después de obtener detalles, podemos preguntar si quiere agregar más o terminar
            if (userMessage.toLowerCase() === 'sí' || userMessage.toLowerCase() === 'sí, quiero agregar algo más') {
                responseMessage = 'Por favor, escribe más detalles.';
            } else {
                responseMessage = `Gracias por los detalles proporcionados sobre tu ${userInformation.typeOfRequest}. Tu solicitud está en estudio y te contactaremos pronto por correo.`;
                // Aquí podrías enviar la solicitud a un servidor si lo deseas.
                currentStep = 0; // Reiniciar el flujo
                userInformation = {}; // Limpiar la información
                isInPQRSFlow = false; // Salir del flujo PQRS
            }
        } else {
            responseMessage = 'Lo siento, no entendí lo que dijiste. ¿Quieres agregar más detalles o terminar?';
        }

        botMessageElement.textContent = responseMessage;
        chatMessages.appendChild(botMessageElement);
        chatMessages.scrollTop = chatMessages.scrollHeight;
    }, 1000);
}

// Función para reiniciar el flujo cuando el usuario vuelve a escribir
function resetChatFlow() {
    isInPQRSFlow = false;
    currentStep = 0;
    userInformation = {};
}





//pagos
    document.addEventListener('DOMContentLoaded', function() {
        const checkoutBtn = document.getElementById('checkout-btn');
        const paymentPopup = document.getElementById('payment-popup');
        const closeBtn = document.querySelector('.close-btn');
        const paymentForm = document.getElementById('payment-form');

        checkoutBtn.addEventListener('click', function() {
            paymentPopup.style.display = 'flex'; // Mostrar el popup al hacer clic en "Proceder a la compra"
        });

        closeBtn.addEventListener('click', function() {
            paymentPopup.style.display = 'none'; // Ocultar el popup al hacer clic en el botón de cierre
        });

        paymentForm.addEventListener('submit', function(event) {
            event.preventDefault();
            // Aquí puedes procesar el formulario de pago si es necesario
            console.log('Formulario de pago enviado');
            paymentPopup.style.display = 'none'; // Ocultar el popup después de enviar el formulario
        });
    });



