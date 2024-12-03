// Función para abrir el popup de crear producto
function abrirPopupCrearProducto() {
    document.getElementById("popupCrearProducto").style.display = "block";
}

// Función para cerrar el popup de crear producto
function cerrarPopupCrearProducto() {
    document.getElementById("popupCrearProducto").style.display = "none";
}

// Función para abrir el popup de agregar stock
function abrirPopupAgregarStock() {
    document.getElementById("popupAgregarStock").style.display = "block";
}

// Función para cerrar el popup de agregar stock
function cerrarPopupAgregarStock() {
    document.getElementById("popupAgregarStock").style.display = "none";
}

// Agregar eventos a los botones
document.getElementById("nuevoProductoBtn").onclick = abrirPopupCrearProducto;
document.getElementById("agregarStockBtn").onclick = abrirPopupAgregarStock;

// Cerrar los popups al hacer clic fuera del contenido del popup
window.onclick = function(event) {
    const popupCrear = document.getElementById("popupCrearProducto");
    const popupAgregar = document.getElementById("popupAgregarStock");
    
    if (event.target === popupCrear) {
        cerrarPopupCrearProducto();
    }
    if (event.target === popupAgregar) {
        cerrarPopupAgregarStock();
    }
};

function actualizarStock(productId, nuevoStock) {
    fetch(`/api/productos/${productId}/actualizar`, {
        method: 'PUT',
        headers: {
            'Content-Type': 'application/json',
        },
        body: JSON.stringify({ stock: nuevoStock }),
    })
    .then(response => {
        if (!response.ok) {
            throw new Error('Error al actualizar el stock');
        }
        return response.json();
    })
    .then(data => {
        console.log('Stock actualizado:', data);
        // Aquí puedes actualizar el DOM si es necesario
    })
    .catch(error => {
        console.error('Error:', error);
    });
}
