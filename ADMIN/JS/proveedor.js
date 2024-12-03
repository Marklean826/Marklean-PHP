document.addEventListener("DOMContentLoaded", function () {
    const popup = document.getElementById("popup-form");
    const openPopupBtn = document.getElementById("open-popup-btn");
    const closePopupBtn = document.querySelector(".close-btn");

    // Mostrar popup al hacer clic en "Agregar"
    openPopupBtn.addEventListener("click", function () {
        popup.style.display = "block";
    });

    // Cerrar popup al hacer clic en la "X"
    closePopupBtn.addEventListener("click", function () {
        popup.style.display = "none";
    });

    // Cerrar popup al hacer clic fuera del contenido del popup
    window.addEventListener("click", function (event) {
        if (event.target === popup) {
            popup.style.display = "none";
        }
    });
});
