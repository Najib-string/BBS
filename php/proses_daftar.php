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

    // =====================
    // UPLOAD DOKUMEN
    // =====================
    $folder = "../uploads/dokumen/";

    function uploadFile($file, $folder) {
        if ($file['error'] === 0) {
            $namaFile = time() . "_" . basename($file['name']);
            $target   = $folder . $namaFile;
            move_uploaded_file($file['tmp_name'], $target);
            return $namaFile;
        }
        return null;
    }

    $kk             = uploadFile($_FILES['kk'], $folder);
    $akta_kelahiran = uploadFile($_FILES['akta_kelahiran'], $folder);
    $ktp_ortu       = uploadFile($_FILES['ktp_ortu'], $folder);
    $ijazah         = uploadFile($_FILES['ijazah'], $folder);
    $pas_foto       = uploadFile($_FILES['pas_foto'], $folder);


 // =====================
    // STATUS DEFAULT
    // =====================
    $status = "proses";

    // =====================
    // QUERY INSERT
    // =====================
    $query = "INSERT INTO pendaftaran (
        nama_lengkap,
        no_hp,
        alamat,
        nik,
        tempat_lahir,
        tanggal_lahir,
        jenis_kelamin,
        email,
        asal_sekolah,
        tahun_lulus,
        nama_ayah,
        pekerjaan_ayah,
        nama_ibu,
        pekerjaan_ibu,
        no_hp_ortu,
        alasan_daftar,
        kk,
        akta_kelahiran,
        ktp_ortu,
        ijazah,
        pas_foto,
        status
    ) VALUES (
        '$nama_lengkap',
        '$no_hp',
        '$alamat',
        '$nik',
        '$tempat_lahir',
        '$tanggal_lahir',
        '$jenis_kelamin',
        '$email',
        '$asal_sekolah',
        '$tahun_lulus',
        '$nama_ayah',
        '$pekerjaan_ayah',
        '$nama_ibu',
        '$pekerjaan_ibu',
        '$no_hp_ortu',
        '$alasan',
        '$kk',
        '$akta_kelahiran',
        '$ktp_ortu',
        '$ijazah',
        '$pas_foto',
        '$status'
    )";

    if (mysqli_query($koneksi, $query)) {
        echo "<script>
            alert('Pendaftaran berhasil! Data & dokumen tersimpan.');
            window.location.href='../pendaftaran.html';
        </script>";
    } else {
        echo "Error: " . mysqli_error($koneksi);
    }

} else {
    echo "Akses tidak valid!";
}   