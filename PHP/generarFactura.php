<?php
session_start();
require '../PHP/conexionDB.php';
require_once('../tcpdf/tcpdf.php'); // Asegúrate de que la ruta sea correcta

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $productos = json_decode(file_get_contents('php://input'), true);

    // Crear un nuevo PDF
    $pdf = new TCPDF();
    $pdf->AddPage();

    // Establecer título
    $pdf->SetFont('helvetica', 'B', 16);
    $pdf->Cell(0, 10, 'Factura de Venta', 0, 1, 'C');

    // Encabezado de la tabla
    $pdf->SetFont('helvetica', 'B', 12);
    $pdf->Cell(30, 10, 'Código', 1);
    $pdf->Cell(80, 10, 'Nombre', 1);
    $pdf->Cell(30, 10, 'Cantidad', 1);
    $pdf->Cell(30, 10, 'Precio', 1);
    $pdf->Ln();

    // Contenido de la tabla
    $total = 0;
    $pdf->SetFont('helvetica', '', 12);
    foreach ($productos as $producto) {
        $pdf->Cell(30, 10, $producto['ID'], 1);
        $pdf->Cell(80, 10, $producto['nombre'], 1);
        $pdf->Cell(30, 10, $producto['cantidad'], 1);
        $precioTotal = $producto['precio'] * $producto['cantidad'];
        $pdf->Cell(30, 10, number_format($precioTotal, 2), 1);
        $pdf->Ln();
        $total += $precioTotal;
    }

    // Total
    $pdf->SetFont('helvetica', 'B', 12);
    $pdf->Cell(140, 10, 'Total:', 1);
    $pdf->Cell(30, 10, number_format($total, 2), 1);
    
    // Cerrar y mostrar el PDF
    $pdf->Output('factura.pdf', 'I');
}
?>
