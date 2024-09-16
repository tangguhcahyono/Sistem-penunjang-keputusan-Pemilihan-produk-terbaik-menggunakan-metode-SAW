<?php
// Include database connection file
include_once("config.php");

// Memeriksa apakah parameter id_akun telah diterima dari URL
if(isset($_GET['id_akun'])) {
    // Menghapus data berdasarkan id_akun
    $id_akun = $_GET['id_akun'];
    $result = mysqli_query($mysqli, "DELETE FROM akun WHERE id_akun='$id_akun'");

    // Redirect ke halaman akun.php setelah penghapusan data
    header("Location: akun.php");
    exit;
}

