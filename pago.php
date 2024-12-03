
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pago de Productos</title>
    <link rel="stylesheet" href="/CSS/pago.css">
</head>
<body>
    <div class="container">
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
                <label for="tarjeta">Número de Tarjeta</label>
                <input type="text" id="tarjeta" name="tarjeta" required>
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
                <button type="submit">Pagar</button>
            </div>
        </form>
    </div>
</body>
</html>
