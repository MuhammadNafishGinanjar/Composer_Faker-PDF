<?php

require_once 'vendor/autoload.php';
session_start();

if (!isset($_POST['data'])) {
    die('Data not found.');
}

// Unserialize the data from POST
$display_data = unserialize($_POST['data']);

ob_start();

// Initialize TCPDF
$pdf = new TCPDF();
$pdf->AddPage();
$pdf->SetFont('helvetica', '', 12);

// Set PDF Title
$pdf->SetTitle('Daftar Nama Palsu dan Email');

// Add title to the PDF
$pdf->Cell(0, 10, 'Daftar Nama Palsu dan Email', 0, 1, 'C');

// Set table headers
$pdf->SetFillColor(200, 220, 255);
$pdf->Cell(30, 10, 'No', 1, 0, 'C', true);
$pdf->Cell(80, 10, 'Nama', 1, 0, 'C', true);
$pdf->Cell(80, 10, 'Email', 1, 1, 'C', true);

// Add data to the table
foreach ($display_data as $i => $data) {
    $pdf->Cell(30, 10, ($i + 1), 1);
    $pdf->Cell(80, 10, htmlspecialchars($data['name']), 1);
    $pdf->Cell(80, 10, htmlspecialchars($data['email']), 1);
    $pdf->Ln();
}

// Output the PDF
$pdf->Output('fake_names_emails.pdf', 'I');

ob_end_flush();

?>