<?php
session_start();
include 'koneksi.php';

$username = $_POST['username'];
$password = md5($_POST['password']);

$query = mysqli_query($koneksi, 
    "SELECT * FROM admin WHERE username='$username' AND password='$password'"
);

$data = mysqli_num_rows($query);

if ($data > 0) {
    $_SESSION['admin'] = $username;
    header("Location: ../admin/dashboard.php");
    exit;
} else {
    echo "<script>
            alert('Username atau Password salah!');
            window.location='../admin/login.php';
          </script>";
}
