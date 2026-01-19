<?php
session_start();
if (!isset($_SESSION['admin'])) {
    exit("Akses ditolak");
}

include "../php/koneksi.php";

/* Ambil filter */
$keyword = isset($_GET['keyword']) ? $_GET['keyword'] : '';
$status  = isset($_GET['status']) ? $_GET['status'] : '';

$sql = "SELECT * FROM pendaftaran WHERE 1";

if (!empty($keyword)) {
    $sql .= " AND nama_lengkap LIKE '%$keyword%'";
}

if (!empty($status)) {
    $sql .= " AND status='$status'";
}

$sql .= " ORDER BY id DESC";
$query = mysqli_query($koneksi, $sql);

/* Header Excel */
header("Content-Type: application/vnd.ms-excel");
header("Content-Disposition: attachment; filename=data_pendaftaran.xls");

echo "<table border='1'>";
echo "<tr>
        <th>No</th>
        <th>Nama Lengkap</th>
        <th>Jenis Kelamin</th>
        <th>Nama Ayah</th>
        <th>Nama Ibu</th>
        <th>No HP</th>
        <th>Status</th>
      </tr>";

$no = 1;
while ($row = mysqli_fetch_assoc($query)) {
    echo "<tr>
            <td>".$no++."</td>
            <td>".$row['nama_lengkap']."</td>
            <td>".$row['jenis_kelamin']."</td>
            <td>".$row['nama_ayah']."</td>
            <td>".$row['nama_ibu']."</td>
            <td>".$row['no_hp']."</td>
            <td>".$row['status']."</td>
          </tr>";
}

echo "</table>";
