<?php
session_start();

if (!isset($_SESSION['admin'])) {
    header("Location: login.php");
    exit;
}

require('../fpdf/fpdf.php');
include "../php/koneksi.php";

$id = $_GET['id'];
$query = mysqli_query($koneksi, "SELECT * FROM pendaftaran WHERE id='$id'");
$data = mysqli_fetch_assoc($query);

if (!$data) {
    die("Data tidak ditemukan");
}

$pdf = new FPDF('P','mm','A4');
$pdf->AddPage();

/* Judul */
$pdf->SetFont('Arial','B',16);
$pdf->Cell(0,10,'Detail Data Pendaftar Santri',0,1,'C');
$pdf->Ln(5);

/* Data Pribadi */
$pdf->SetFont('Arial','B',12);
$pdf->Cell(0,8,'Data Pribadi',0,1);

$pdf->SetFont('Arial','',11);
$pdf->Cell(50,8,'Nama Lengkap',0,0);
$pdf->Cell(0,8,': '.$data['nama_lengkap'],0,1);

$pdf->Cell(50,8,'NIK',0,0);
$pdf->Cell(0,8,': '.$data['nik'],0,1);

$pdf->Cell(50,8,'Tempat Lahir',0,0);
$pdf->Cell(0,8,': '.$data['tempat_lahir'],0,1);

$pdf->Cell(50,8,'Tanggal Lahir',0,0);
$pdf->Cell(0,8,': '.$data['tanggal_lahir'],0,1);

$pdf->Cell(50,8,'Jenis Kelamin',0,0);
$pdf->Cell(0,8,': '.$data['jenis_kelamin'],0,1);

$pdf->Cell(50,8,'Alamat',0,0);
$pdf->MultiCell(0,8,': '.$data['alamat']);

$pdf->Cell(50,8,'No HP',0,0);
$pdf->Cell(0,8,': '.$data['no_hp'],0,1);

$pdf->Cell(50,8,'Email',0,0);
$pdf->Cell(0,8,': '.$data['email'],0,1);

$pdf->Ln(4);

/* Data Orang Tua */
$pdf->SetFont('Arial','B',12);
$pdf->Cell(0,8,'Data Orang Tua',0,1);

$pdf->SetFont('Arial','',11);
$pdf->Cell(50,8,'Nama Ayah',0,0);
$pdf->Cell(0,8,': '.$data['nama_ayah'],0,1);

$pdf->Cell(50,8,'Pekerjaan Ayah',0,0);
$pdf->Cell(0,8,': '.$data['pekerjaan_ayah'],0,1);

$pdf->Cell(50,8,'Nama Ibu',0,0);
$pdf->Cell(0,8,': '.$data['nama_ibu'],0,1);

$pdf->Cell(50,8,'Pekerjaan Ibu',0,0);
$pdf->Cell(0,8,': '.$data['pekerjaan_ibu'],0,1);

$pdf->Cell(50,8,'No HP Orang Tua',0,0);
$pdf->Cell(0,8,': '.$data['no_hp_ortu'],0,1);

$pdf->Ln(4);

/* Data Pendidikan */
$pdf->SetFont('Arial','B',12);
$pdf->Cell(0,8,'Data Pendidikan',0,1);

$pdf->SetFont('Arial','',11);
$pdf->Cell(50,8,'Asal Sekolah',0,0);
$pdf->Cell(0,8,': '.$data['asal_sekolah'],0,1);

$pdf->Cell(50,8,'Tahun Lulus',0,0);
$pdf->Cell(0,8,': '.$data['tahun_lulus'],0,1);

$pdf->Cell(50,8,'Alasan Daftar',0,0);
$pdf->MultiCell(0,8,': '.$data['alasan_daftar']);

$pdf->Cell(50,8,'Status',0,0);
$pdf->Cell(0,8,': '.$data['status'],0,1);

$pdf->Ln(10);

/* Tanda tangan */
$pdf->Cell(0,8,'Dicetak pada: '.date('d-m-Y'),0,1,'R');
$pdf->Ln(15);
$pdf->Cell(0,8,'Admin Babussalamku',0,1,'R');

$pdf->Output("I", "Detail_Pendaftar_".$data['nama_lengkap'].".pdf");
?>
