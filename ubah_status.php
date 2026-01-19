<?php
session_start();
include "../php/koneksi.php";

/* Cek login admin */
if (!isset($_SESSION['admin'])) {
    header("Location: login.php");
    exit;
}

/* Validasi ID */
if (!isset($_GET['id']) || !is_numeric($_GET['id'])) {
    header("Location: dashboard.php");
    exit;
}

$id = (int) $_GET['id'];

/* Validasi status */
$allowed_status = ['diterima', 'ditolak'];

if (!isset($_GET['status']) || !in_array($_GET['status'], $allowed_status)) {
    header("Location: dashboard.php");
    exit;
}

$status = $_GET['status'];

/* Update status */
$query = mysqli_query(
    $koneksi,
    "UPDATE pendaftaran SET status='$status' WHERE id=$id"
);

header("Location: dashboard.php");
exit;
