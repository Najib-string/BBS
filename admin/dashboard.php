<?php
session_start();

/* Cek apakah admin sudah login */
if (!isset($_SESSION['admin'])) {
    header("Location: login.php");
    exit;
}

/* Koneksi database */
include "../php/koneksi.php";

/* Ambil data pendaftar */
$query = mysqli_query($koneksi, "SELECT * FROM pendaftaran ORDER BY id DESC");
$total = mysqli_num_rows($query);
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Dashboard Admin - Babussalamku</title>

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- CSS sendiri (opsional) -->
    <link rel="stylesheet" href="../css/style.css">
</head>
<body>

<div class="container mt-5">

    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h2>Dashboard Admin</h2>
            <p class="mb-0">
                Login sebagai: <strong><?php echo $_SESSION['admin']; ?></strong>
            </p>
        </div>
        <a href="logout.php" class="btn btn-danger">Logout</a>
    </div>

    <div class="card shadow">
        <div class="card-body">

            <h5 class="card-title">
                Data Pendaftar
                <span class="badge bg-primary"><?php echo $total; ?></span>
            </h5>

            <div class="table-responsive mt-3">
                <table class="table table-bordered table-striped align-middle">
                    <thead class="table-dark">
                        <tr>
                            <th>No</th>
                            <th>Nama Santri</th>
                            <th>Nama Orang Tua</th>
                            <th>No HP</th>
                            <th>Alamat</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        if ($total > 0) {
                            $no = 1;
                            while ($row = mysqli_fetch_assoc($query)) {
                        ?>
                        <tr>
                            <td><?php echo $no++; ?></td>
                            <td><?php echo htmlspecialchars($row['nama']); ?></td>
                            <td><?php echo htmlspecialchars($row['orang_tua']); ?></td>
                            <td><?php echo htmlspecialchars($row['no_hp']); ?></td>
                            <td><?php echo htmlspecialchars($row['alamat']); ?></td>
                        </tr>
                        <?php
                            }
                        } else {
                        ?>
                        <tr>
                            <td colspan="5" class="text-center">
                                Belum ada data pendaftar
                            </td>
                        </tr>
                        <?php } ?>
                    </tbody>
                </table>
            </div>

        </div>
    </div>

</div>

</body>
</html>
