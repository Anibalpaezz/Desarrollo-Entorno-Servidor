<?php
require('../PDF/Generador/fpdf.php');

// Aquí puedes agregar configuraciones adicionales si es necesario

$pdf = new FPDF();
$pdf->AddPage();

// Contenido HTML que deseas convertir a PDF
$html = '<h1>Ejemplo de HTML a PDF</h1><p>Este es un párrafo de ejemplo.</p>';

// Agregar el contenido HTML al PDF
$pdf->WriteHTML($html);

// Salida del PDF
$pdf->Output('output.pdf', 'F');
?>