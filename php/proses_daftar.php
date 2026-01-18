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

    // =====================
    // DATA ORANG TUA
    // =====================
    $nama_ayah      = mysqli_real_escape_string($koneksi, $_POST['nama_ayah']);
    $pekerjaan_ayah = mysqli_real_escape_string($koneksi, $_POST['pekerjaan_ayah']);
    $nama_ibu       = mysqli_real_escape_string($koneksi, $_POST['nama_ibu']);
    $pekerjaan_ibu  = mysqli_real_escape_string($koneksi, $_POST['pekerjaan_ibu']);
    $no_hp_ortu     = mysqli_real_escape_string($koneksi, $_POST['no_hp_ortu']);

    // =====================
    // DATA PENDIDIKAN
    // =====================
    $asal_sekolah = mysqli_real_escape_string($koneksi, $_POST['asal_sekolah']);
    $tahun_lulus  = mysqli_real_escape_string($koneksi, $_POST['tahun_lulus']);
    $alasan       = mysqli_real_escape_string($koneksi, $_POST['alasan_daftar']);