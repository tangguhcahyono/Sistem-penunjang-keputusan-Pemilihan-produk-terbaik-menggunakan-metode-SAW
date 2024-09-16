<?php
// Include database connection file
include_once("config.php");


if (isset($_GET['id_produk'])) {
    // Menghapus data berdasarkan id_produk
    $id_produk = $_GET['id_produk'];
    
    // Mulai transaksi
    $mysqli->begin_transaction();

    try {
        // Ambil nama gambar dari tabel produk
        $sql_get_image = "SELECT gambar FROM produk WHERE id_produk = ?";
        $stmt_get_image = $mysqli->prepare($sql_get_image);
        $stmt_get_image->bind_param("i", $id_produk);
        $stmt_get_image->execute();
        $result = $stmt_get_image->get_result();
        $data = $result->fetch_assoc();

        $imageFile = $data['gambar'];

        // Hapus gambar dari direktori img
        if (!empty($imageFile) && file_exists("img/$imageFile")) {
            unlink("img/$imageFile");
        }

        // Hapus dari tabel n_produk
        $sql_n_produk = "DELETE FROM n_produk WHERE id_produk = ?";
        $stmt_n_produk = $mysqli->prepare($sql_n_produk);
        $stmt_n_produk->bind_param("i", $id_produk);
        $stmt_n_produk->execute();

        // Hapus dari tabel produk
        $sql_produk = "DELETE FROM produk WHERE id_produk = ?";
        $stmt_produk = $mysqli->prepare($sql_produk);
        $stmt_produk->bind_param("i", $id_produk);
        $stmt_produk->execute();

        // Commit transaksi
        $mysqli->commit();

        // Menutup statement
        $stmt_get_image->close();
        $stmt_n_produk->close();
        $stmt_produk->close();

    
        header("Location: item.php");
        exit;

    } catch (Exception $e) {
        $mysqli->rollback();
        echo "Gagal menghapus data: " . $e->getMessage();
    }
}


$mysqli->close();

