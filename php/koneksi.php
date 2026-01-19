<?php
$koneksi = mysqli_connect("localhost", "root", "", "babussalamku");

if (!$koneksi) {
    die("Koneksi database gagal: " . mysqli_connect_error());
}
