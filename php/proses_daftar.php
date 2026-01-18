<?php
// =====================
// KONEKSI DATABASE
// =====================
include "koneksi.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    // =====================
    // DATA PRIBADI
    // =====================
    $nama_lengkap  = mysqli_real_escape_string($koneksi, $_POST['nama_lengkap']);
    $nik           = mysqli_real_escape_string($koneksi, $_POST['nik']);
    $tempat_lahir  = mysqli_real_escape_string($koneksi, $_POST['tempat_lahir']);
    $tanggal_lahir = $_POST['tanggal_lahir'];
    $jenis_kelamin = mysqli_real_escape_string($koneksi, $_POST['jenis_kelamin']);
    $alamat        = mysqli_real_escape_string($koneksi, $_POST['alamat']);
    $no_hp         = mysqli_real_escape_string($koneksi, $_POST['no_hp']);
    $email         = mysqli_real_escape_string($koneksi, $_POST['email']);
