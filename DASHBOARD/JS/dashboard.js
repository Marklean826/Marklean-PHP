document.addEventListener('DOMContentLoaded', function() {
    // Datos de ejemplo para las gráficas
    const ventasDiariasData = [12, 19, 3, 5, 2, 3, 10];
    const productosMasVendidosData = [5, 10, 15, 20, 25];
    const ventasPorCategoriaData = [10, 20, 30, 40];

    // Gráfica de Ventas Diarias
    const ventasDiariasCtx = document.getElementById('ventasDiariasChart').getContext('2d');
    const ventasDiariasChart = new Chart(ventasDiariasCtx, {
        type: 'line',
        data: {
            labels: ['Lun', 'Mar', 'Mié', 'Jue', 'Vie', 'Sáb', 'Dom'],
            datasets: [{
                label: 'Ventas Diarias',
                data: ventasDiariasData,
                backgroundColor: 'rgba(0, 123, 255, 0.2)',
                borderColor: 'rgba(0, 123, 255, 1)',
                borderWidth: 1
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false
        }
    });

    // Gráfica de Productos Más Vendidos
    const productosMasVendidosCtx = document.getElementById('productosMasVendidosChart').getContext('2d');
    const productosMasVendidosChart = new Chart(productosMasVendidosCtx, {
        type: 'bar',
        data: {
            labels: ['Producto A', 'Producto B', 'Producto C', 'Producto D', 'Producto E'],
            datasets: [{
                label: 'Productos Más Vendidos',
                data: productosMasVendidosData,
                backgroundColor: 'rgba(40, 167, 69, 0.2)',
                borderColor: 'rgba(40, 167, 69, 1)',
                borderWidth: 1
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false
        }
    });

    // Gráfica de Ventas por Categoría
    const ventasPorCategoriaCtx = document.getElementById('ventasPorCategoriaChart').getContext('2d');
    const ventasPorCategoriaChart = new Chart(ventasPorCategoriaCtx, {
        type: 'pie',
        data: {
            labels: ['Categoría A', 'Categoría B', 'Categoría C', 'Categoría D'],
            datasets: [{
                label: 'Ventas por Categoría',
                data: ventasPorCategoriaData,
                backgroundColor: [
                    'rgba(255, 99, 132, 0.2)',
                    'rgba(54, 162, 235, 0.2)',
                    'rgba(255, 206, 86, 0.2)',
                    'rgba(75, 192, 192, 0.2)'
                ],
                borderColor: [
                    'rgba(255, 99, 132, 1)',
                    'rgba(54, 162, 235, 1)',
                    'rgba(255, 206, 86, 1)',
                    'rgba(75, 192, 192, 1)'
                ],
                borderWidth: 1
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false
        }
    });
});
