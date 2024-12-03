document.addEventListener('DOMContentLoaded', () => {
    const agregarProductoForm = document.getElementById('agregarProductoForm');
    const productosVenta = document.getElementById('productosVenta').getElementsByTagName('tbody')[0];
    const totalVenta = document.getElementById('totalVenta');

    let total = 0; // Inicializamos el total
    let productos = []; // Array para almacenar los productos en la venta

    // Manejo de la adición de productos
    agregarProductoForm.addEventListener('submit', async (event) => {
        event.preventDefault();

        const codigoProducto = document.getElementById('codigoProducto').value;
        const cantidadProducto = parseInt(document.getElementById('cantidadProducto').value, 10);

        if (!codigoProducto || isNaN(cantidadProducto) || cantidadProducto <= 0) {
            alert('Por favor, ingrese un código de producto válido y una cantidad mayor a 0.');
            return;
        }

        try {
            const response = await fetch('../PHP/buscarVenta.php', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json'
                },
                body: JSON.stringify({ ID: codigoProducto, stock: cantidadProducto }) // Enviar el código y cantidad
            });

            const text = await response.text();
            console.log(text);

            try {
                const data = JSON.parse(text);
                if (data.success) {
                    const producto = data.producto;
                    agregarProductoATabla(producto, cantidadProducto);
                    calcularTotal(producto.precio, cantidadProducto);
                    agregarProductoForm.reset();
                } else {
                    alert(`Ocurrió un error al agregar el producto: ${data.message}`);
                }
            } catch (error) {
                alert(`Ocurrió un error en la respuesta del servidor: ${error.message}`);
            }
        } catch (error) {
            alert(`Ocurrió un error al agregar el producto: ${error.message}`);
        }
    });

    // Función para agregar producto a la tabla de ventas
    function agregarProductoATabla(producto, cantidad) {
        const row = productosVenta.insertRow();
        row.insertCell(0).innerText = producto.ID;
        row.insertCell(1).innerText = cantidad;
        row.insertCell(2).innerText = producto.nombre; 
        row.insertCell(3).innerText = new Date().toLocaleDateString(); 
        row.insertCell(4).innerText = (producto.precio * cantidad).toFixed(2); 
        row.insertCell(5).innerHTML = '<button class="eliminar">Eliminar</button>'; 

        productos.push({ ...producto, cantidad }); // Almacenar la cantidad vendida

        row.querySelector('.eliminar').addEventListener('click', () => {
            eliminarProducto(row, producto.precio, cantidad);
        });
    }

    // Función para calcular el total de la venta
    function calcularTotal(precio, cantidad) {
        total += precio * cantidad;
        totalVenta.innerText = total.toFixed(2);
    }

    // Función para eliminar producto de la venta
    function eliminarProducto(row, precio, cantidad) {
        const codigoProducto = row.cells[0].innerText;
        productos = productos.filter(p => p.ID !== codigoProducto);
        total -= precio * cantidad;
        totalVenta.innerText = total.toFixed(2);
        row.remove(); 
    }

    // Generar la venta y actualizar stock
document.getElementById('generarVentaBtn').addEventListener('click', async () => {
    console.log('Generar venta clickeado'); // Añadido para depuración

    if (productos.length === 0) {
        alert('No hay productos para realizar la venta.');
        return;
    }

    try {
        console.log('Enviando productos:', productos); // Añadido para depuración

        const response = await fetch('../PHP/generarVenta.php', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json'
            },
            body: JSON.stringify({ productos: productos.map(p => ({ ID: p.ID, cantidad: p.cantidad })) }) // Enviar ID y cantidad
        });

        const data = await response.json();
        console.log('Respuesta del servidor:', data); // Añadido para depuración

        if (data.success) {
            alert('Venta realizada y stock actualizado');
            productosVenta.innerHTML = ''; // Limpiar la tabla de productos
            totalVenta.innerText = '0.00'; // Reiniciar el total
            productos = []; // Vaciar la lista de productos
            total = 0; // Reiniciar el total en JS
        } else {
            alert('Error al generar la venta: ' + data.message); // Muestra el mensaje de error si falla
        }
    } catch (error) {
        console.error('Error al generar la venta:', error);
    }
});

});


// Generar la factura
document.getElementById('generarFacturaBtn').addEventListener('click', async () => {
    if (productos.length === 0) {
        alert('No hay productos para generar la factura.');
        return;
    }

    // Generar PDF
    try {
        const response = await fetch('../PHP/generarFactura.php', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json'
            },
            body: JSON.stringify(productos) // Enviar la lista de productos
        });

        if (!response.ok) {
            throw new Error('Error al generar la factura');
        }

        // Aquí podrías agregar lógica para manejar la respuesta si es necesario
        // En este caso, el PDF se generará y se mostrará automáticamente.
    } catch (error) {
        console.error('Error al generar la factura:', error);
    }
});
