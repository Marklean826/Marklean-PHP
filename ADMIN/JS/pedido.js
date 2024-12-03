document.addEventListener('DOMContentLoaded', function() {
    // Variables para los elementos del DOM
    var btnAbrirPopup = document.getElementById("btnAbrirPopup");
    var contenedorPopup = document.getElementById("contenedor-popup");
    var popup = document.getElementById("popup");
    var btnCerrarPopup = document.getElementById("btn-cerrar-popup");

    // Event listener para abrir el popup
    btnAbrirPopup.addEventListener('click', function(event) {
        event.preventDefault(); // Evitar el comportamiento por defecto del botón
        contenedorPopup.style.display = 'flex'; // Mostrar el contenedor del popup
    });

    // Event listener para cerrar el popup
    btnCerrarPopup.addEventListener('click', function(event) {
        event.preventDefault(); // Evitar el comportamiento por defecto del botón
        contenedorPopup.style.display = 'none'; // Ocultar el contenedor del popup
    });

    // Event listener para cerrar el popup al hacer clic fuera del mismo
    contenedorPopup.addEventListener('click', function(event) {
        if (event.target === contenedorPopup) {
            contenedorPopup.style.display = 'none'; // Ocultar el contenedor del popup si se hace clic fuera de él
        }
    });
});
