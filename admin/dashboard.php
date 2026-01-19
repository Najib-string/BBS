<?php
session_start();

/* ======================
   CEK LOGIN ADMIN
====================== */
if (!isset($_SESSION['admin'])) {
    header("Location: login.php");
    exit;
}

/* ======================
   KONEKSI DATABASE
====================== */
include "../php/koneksi.php";

/* ======================
   STATISTIK DASHBOARD
====================== */
$total_pendaftar = mysqli_fetch_assoc(
    mysqli_query($koneksi, "SELECT COUNT(*) AS total FROM pendaftaran")
)['total'];

$total_proses = mysqli_fetch_assoc(
    mysqli_query($koneksi, "SELECT COUNT(*) AS total FROM pendaftaran WHERE status='proses'")
)['total'];

$total_diterima = mysqli_fetch_assoc(
    mysqli_query($koneksi, "SELECT COUNT(*) AS total FROM pendaftaran WHERE status='diterima'")
)['total'];

$total_ditolak = mysqli_fetch_assoc(
    mysqli_query($koneksi, "SELECT COUNT(*) AS total FROM pendaftaran WHERE status='ditolak'")
)['total'];

/* ======================
   FILTER & SEARCH
====================== */
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
$total = mysqli_num_rows($query);
?>

<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <title>Dashboard Admin - Babussalamku</title>

    <!-- Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">

    <link rel="stylesheet" href="../css/style.css">
</head>

<body>

    <div class="container mt-5">

        <!-- ======================
         HEADER
    ====================== -->
        <div class="d-flex justify-content-between align-items-center mb-4">
            <div>
                <h2>Dashboard Admin</h2>
                <p class="mb-0">
                    Login sebagai: <strong><?php echo htmlspecialchars($_SESSION['admin']); ?></strong>
                </p>
            </div>
            <a href="logout.php" class="btn btn-danger">Logout</a>
        </div>

        <!-- ======================
         STATISTIK CARD
    ====================== -->
        <div class="row mb-4">

            <div class="col-md-3">
                <div class="card text-bg-primary shadow">
                    <div class="card-body text-center">
                        <h6>Total Pendaftar</h6>
                        <h2><?php echo $total_pendaftar; ?></h2>
                    </div>
                </div>
            </div>

            <div class="col-md-3">
                <div class="card text-bg-warning shadow">
                    <div class="card-body text-center">
                        <h6>Status Proses</h6>
                        <h2><?php echo $total_proses; ?></h2>
                    </div>
                </div>
            </div>

            <div class="col-md-3">
                <div class="card text-bg-success shadow">
                    <div class="card-body text-center">
                        <h6>Diterima</h6>
                        <h2><?php echo $total_diterima; ?></h2>
                    </div>
                </div>
            </div>

            <div class="col-md-3">
                <div class="card text-bg-danger shadow">
                    <div class="card-body text-center">
                        <h6>Ditolak</h6>
                        <h2><?php echo $total_ditolak; ?></h2>
                    </div>
                </div>
            </div>

        </div>

        <!-- ======================
         FILTER & SEARCH
    ====================== -->
        <form method="GET" class="row g-2 mb-3">

            <div class="col-md-5">
                <input type="text"
                    name="keyword"
                    class="form-control"
                    placeholder="Cari nama santri..."
                    value="<?php echo htmlspecialchars($keyword); ?>">
            </div>

            <div class="col-md-3">
                <select name="status" class="form-select">
                    <option value="">Semua Status</option>
                    <option value="proses" <?php if ($status == 'proses') echo 'selected'; ?>>Proses</option>
                    <option value="diterima" <?php if ($status == 'diterima') echo 'selected'; ?>>Diterima</option>
                    <option value="ditolak" <?php if ($status == 'ditolak') echo 'selected'; ?>>Ditolak</option>
                </select>
            </div>

            <div class="col-md-4">
                <button type="submit" class="btn btn-primary">Cari</button>
                <a href="dashboard.php" class="btn btn-secondary">Reset</a>
            </div>

        </form>

        <!-- ======================
         TOMBOL EXPORT
    ====================== -->
        <div class="mb-3">
            <a href="export_pdf.php?keyword=<?php echo urlencode($keyword); ?>&status=<?php echo urlencode($status); ?>"
                target="_blank"
                class="btn btn-danger">
                Export PDF
            </a>
        </div>

        <!-- ======================
         TABEL DATA
    ====================== -->
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
                                <th>Nama Lengkap</th>
                                <th>Jenis Kelamin</th>
                                <th>Orang Tua</th>
                                <th>No HP</th>
                                <th>Status</th>
                                <th width="230">Aksi</th>
                            </tr>
                        </thead>

                        <tbody>
                            <?php if ($total > 0): ?>
                                <?php $no = 1;
                                while ($row = mysqli_fetch_assoc($query)): ?>
                                    <tr>
                                        <td><?php echo $no++; ?></td>
                                        <td><?php echo htmlspecialchars($row['nama_lengkap']); ?></td>
                                        <td><?php echo htmlspecialchars($row['jenis_kelamin']); ?></td>
                                        <td>
                                            Ayah: <?php echo htmlspecialchars($row['nama_ayah']); ?><br>
                                            Ibu: <?php echo htmlspecialchars($row['nama_ibu']); ?>
                                        </td>
                                        <td><?php echo htmlspecialchars($row['no_hp']); ?></td>
                                        <td>
                                            <?php
                                            if ($row['status'] == 'proses') {
                                                echo '<span class="badge bg-warning text-dark">Proses</span>';
                                            } elseif ($row['status'] == 'diterima') {
                                                echo '<span class="badge bg-success">Diterima</span>';
                                            } else {
                                                echo '<span class="badge bg-danger">Ditolak</span>';
                                            }
                                            ?>
                                        </td>
                                        <td>

                                            <!-- Tombol Detail (SELALU ADA) -->
                                            <a href="detail_pendaftar.php?id=<?php echo $row['id']; ?>"
                                                class="btn btn-info btn-sm mb-1">
                                                Detail
                                            </a>

                                            <?php if ($row['status'] == 'proses') { ?>

                                                <!-- MUNCUL HANYA JIKA MASIH PROSES -->
                                                <a href="ubah_status.php?id=<?php echo $row['id']; ?>&status=diterima"
                                                    class="btn btn-success btn-sm mb-1"
                                                    onclick="return confirm('Terima pendaftar ini?')">
                                                    Terima
                                                </a>

                                                <a href="ubah_status.php?id=<?php echo $row['id']; ?>&status=ditolak"
                                                    class="btn btn-danger btn-sm mb-1"
                                                    onclick="return confirm('Tolak pendaftar ini?')">
                                                    Tolak
                                                </a>

                                            <?php } ?>

                                        </td>

                                    </tr>
                                <?php endwhile; ?>
                            <?php else: ?>
                                <tr>
                                    <td colspan="7" class="text-center">Data tidak ditemukan</td>
                                </tr>
                            <?php endif; ?>
                        </tbody>

                    </table>
                </div>

            </div>
        </div>

    </div>

</body>

</html>