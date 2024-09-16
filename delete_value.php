<?php
// Include database connection file
include_once("config.php");

// Memeriksa apakah parameter id_produk telah diterima dari URL
if(isset($_GET['id'])) {
    // Menghapus data berdasarkan id_produk
    $id = $_GET['id'];
    $result = mysqli_query($mysqli, "DELETE FROM n_produk WHERE id='$id'");

    // Redirect ke halaman item.php setelah penghapusan data
    header("Location: nilai.php");
    exit;
}
