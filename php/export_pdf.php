<?php
session_start();
if (!isset($_SESSION['admin'])) {
    header("Location: login.php");
    exit;
}

include "../php/koneksi.php";
require_once "../lib/fpdf/fpdf.php";

// ======================
// AMBIL FILTER
// ======================
$keyword = isset($_GET['keyword']) ? mysqli_real_escape_string($koneksi, $_GET['keyword']) : '';
$status  = isset($_GET['status'])  ? mysqli_real_escape_string($koneksi, $_GET['status'])  : '';

$sql = "SELECT * FROM pendaftaran WHERE 1";

if (!empty($keyword)) {
    $sql .= " AND nama_lengkap LIKE '%$keyword%'";
}

if (!empty($status)) {
    $sql .= " AND status = '$status'";
}

$sql .= " ORDER BY id DESC";
$query = mysqli_query($koneksi, $sql);

// ======================
// BUAT PDF
// ======================
$pdf = new FPDF('L', 'mm', 'A4');
$pdf->AddPage();

// Judul
$pdf->SetFont('Arial', 'B', 14);
$pdf->Cell(0, 10, 'Laporan Pendaftaran Santri', 0, 1, 'C');
$pdf->SetFont('Arial', '', 11);
$pdf->Cell(0, 8, 'Pondok Pesantren Babussalam', 0, 1, 'C');

$pdf->Ln(5);

// Header tabel
$pdf->SetFont('Arial', 'B', 10);
$pdf->Cell(10, 8, 'No', 1, 0, 'C');
$pdf->Cell(45, 8, 'Nama Lengkap', 1);
$pdf->Cell(20, 8, 'JK', 1, 0, 'C');
$pdf->Cell(45, 8, 'Nama Ayah', 1);
$pdf->Cell(45, 8, 'Nama Ibu', 1);
$pdf->Cell(35, 8, 'No HP', 1);
$pdf->Cell(30, 8, 'Status', 1, 0, 'C');
$pdf->Ln();

// Isi tabel
$pdf->SetFont('Arial', '', 10);
$no = 1;

while ($row = mysqli_fetch_assoc($query)) {
    $pdf->Cell(10, 8, $no++, 1, 0, 'C');
    $pdf->Cell(45, 8, $row['nama_lengkap'], 1);
    $pdf->Cell(20, 8, $row['jenis_kelamin'], 1, 0, 'C');
    $pdf->Cell(45, 8, $row['nama_ayah'], 1);
    $pdf->Cell(45, 8, $row['nama_ibu'], 1);
    $pdf->Cell(35, 8, $row['no_hp'], 1);
    $pdf->Cell(30, 8, ucfirst($row['status']), 1, 0, 'C');
    $pdf->Ln();
}

// ======================
// OUTPUT PDF (DOWNLOAD)
// ======================
$pdf->Output('D', 'laporan_pendaftaran_santri.pdf');
exit;
