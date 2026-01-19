<?php
session_start();

if (!isset($_SESSION['admin'])) {
    header("Location: login.php");
    exit;
}

include "../php/koneksi.php";

$id = $_GET['id'];
$data = mysqli_query($koneksi, "SELECT * FROM pendaftaran WHERE id='$id'");
$row = mysqli_fetch_assoc($data);

if (!$row) {
    echo "Data tidak ditemukan!";
    exit;
}
?>

<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <title>Detail Pendaftar</title>

    <!-- Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body>

    <div class="container mt-5">

        <a href="dashboard.php" class="btn btn-secondary mb-3">← Kembali</a>

        <a href="cetak_detail_pdf.php?id=<?= $row['id']; ?>"
            target="_blank"
            class="btn btn-danger mb-3 ms-2">
            🖨️ Cetak PDF
        </a>

        <div class="card shadow">
            <div class="card-header bg-primary text-white">
                <h5 class="mb-0">Detail Pendaftar Santri</h5>
            </div>

            <div class="card-body">

                <h6 class="text-primary">Data Pribadi</h6>
                <table class="table table-bordered">
                    <tr>
                        <th>Nama Lengkap</th>
                        <td><?= htmlspecialchars($row['nama_lengkap']); ?></td>
                    </tr>
                    <tr>
                        <th>NIK</th>
                        <td><?= htmlspecialchars($row['nik']); ?></td>
                    </tr>
                    <tr>
                        <th>Tempat Lahir</th>
                        <td><?= htmlspecialchars($row['tempat_lahir']); ?></td>
                    </tr>
                    <tr>
                        <th>Tanggal Lahir</th>
                        <td><?= htmlspecialchars($row['tanggal_lahir']); ?></td>
                    </tr>
                    <tr>
                        <th>Jenis Kelamin</th>
                        <td><?= htmlspecialchars($row['jenis_kelamin']); ?></td>
                    </tr>
                    <tr>
                        <th>Alamat</th>
                        <td><?= htmlspecialchars($row['alamat']); ?></td>
                    </tr>
                    <tr>
                        <th>No HP</th>
                        <td><?= htmlspecialchars($row['no_hp']); ?></td>
                    </tr>
                    <tr>
                        <th>Email</th>
                        <td><?= htmlspecialchars($row['email']); ?></td>
                    </tr>
                </table>

                <h6 class="text-primary mt-4">Data Orang Tua</h6>
                <table class="table table-bordered">
                    <tr>
                        <th>Nama Ayah</th>
                        <td><?= htmlspecialchars($row['nama_ayah']); ?></td>
                    </tr>
                    <tr>
                        <th>Pekerjaan Ayah</th>
                        <td><?= htmlspecialchars($row['pekerjaan_ayah']); ?></td>
                    </tr>
                    <tr>
                        <th>Nama Ibu</th>
                        <td><?= htmlspecialchars($row['nama_ibu']); ?></td>
                    </tr>
                    <tr>
                        <th>Pekerjaan Ibu</th>
                        <td><?= htmlspecialchars($row['pekerjaan_ibu']); ?></td>
                    </tr>
                    <tr>
                        <th>No HP Orang Tua</th>
                        <td><?= htmlspecialchars($row['no_hp_ortu']); ?></td>
                    </tr>
                </table>

                <h6 class="text-primary mt-4">Data Pendidikan</h6>
                <table class="table table-bordered">
                    <tr>
                        <th>Asal Sekolah</th>
                        <td><?= htmlspecialchars($row['asal_sekolah']); ?></td>
                    </tr>
                    <tr>
                        <th>Tahun Lulus</th>
                        <td><?= htmlspecialchars($row['tahun_lulus']); ?></td>
                    </tr>
                    <tr>
                        <th>Alasan Daftar</th>
                        <td><?= htmlspecialchars($row['alasan_daftar']); ?></td>
                    </tr>
                    <tr>
                        <th>Status</th>
                        <td><?= htmlspecialchars($row['status']); ?></td>
                    </tr>
                </table>

                <h6 class="text-primary mt-4">📎 Dokumen Persyaratan</h6>

                <table class="table table-bordered align-middle">
                    <tr>
                        <th>Kartu Keluarga (KK)</th>
                        <td>
                            <?php if (!empty($row['kk'])) { ?>
                                <a href="../uploads/dokumen/<?= htmlspecialchars($row['kk']); ?>" target="_blank" class="btn btn-sm btn-primary">
                                    Lihat
                                </a>
                            <?php } else {
                                echo "-";
                            } ?>
                        </td>
                    </tr>

                    <tr>
                        <th>Akta Kelahiran</th>
                        <td>
                            <?php if (!empty($row['akta_kelahiran'])) { ?>
                                <a href="../uploads/dokumen/<?= htmlspecialchars($row['akta_kelahiran']); ?>" target="_blank" class="btn btn-sm btn-primary">
                                    Lihat
                                </a>
                            <?php } else {
                                echo "-";
                            } ?>
                        </td>
                    </tr>

                    <tr>
                        <th>KTP Orang Tua</th>
                        <td>
                            <?php if (!empty($row['ktp_ortu'])) { ?>
                                <a href="../uploads/dokumen/<?= htmlspecialchars($row['ktp_ortu']); ?>" target="_blank" class="btn btn-sm btn-primary">
                                    Lihat
                                </a>
                            <?php } else {
                                echo "-";
                            } ?>
                        </td>
                    </tr>

                    <tr>
                        <th>Ijazah / Surat Lulus</th>
                        <td>
                            <?php if (!empty($row['ijazah'])) { ?>
                                <a href="../uploads/dokumen/<?= htmlspecialchars($row['ijazah']); ?>" target="_blank" class="btn btn-sm btn-primary">
                                    Lihat
                                </a>
                            <?php } else {
                                echo "-";
                            } ?>
                        </td>
                    </tr>

                    <tr>
                        <th>Pas Foto</th>
                        <td>
                            <?php if (!empty($row['pas_foto'])) { ?>
                                <img src="../uploads/dokumen/<?= htmlspecialchars($row['pas_foto']); ?>"
                                    width="120"
                                    class="img-thumbnail">
                            <?php } else {
                                echo "-";
                            } ?>
                        </td>
                    </tr>
                </table>


            </div>
        </div>

    </div>

</body>

</html>