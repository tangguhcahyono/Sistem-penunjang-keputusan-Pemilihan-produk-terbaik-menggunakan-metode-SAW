<?php
// Menghubungkan ke database
$conn = mysqli_connect("localhost", "root", "", "data_saw");


$errors = [];

// Fungsi untuk membersihkan data input
function clean_input($data) {
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}

// Memeriksa apakah form telah disubmit
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Memeriksa dan membersihkan setiap input
    $Id = clean_input($_POST["Id"]);
    $nProduk = clean_input($_POST["nProduk"]);
    $nBulan = clean_input($_POST["nBulan"]);
    $hJual = clean_input($_POST["hJual"]);
    $kSantri = clean_input($_POST["kSantri"]);
    $tPenjualan = clean_input($_POST["tPenjualan"]);

    // Memeriksa apakah field Id tidak kosong
    if (empty($Id)) {
        $errors[] = "Id harus diisi";
    }

    // Memeriksa apakah field Nama Produk tidak kosong
    if (empty($nProduk)) {
        $errors[] = "Nama Produk harus diisi";
    }
    if (empty($nBulan)) {
        $errors[] = "Nama Produk harus diisi";
    }
    if (empty($hJual)) {
        $errors[] = "Harga Jual harus diisi";
    }
    if (empty($kSantri)) {
        $errors[] = "Kebutuhan Santri harus diisi";
    }
    if (empty($tPenjualan)) {
        $errors[] = "Total Penjualan harus diisi";
    }
    // Jika tidak ada error, lanjutkan dengan proses perubahan data
    if (empty($errors)) {
        // Persiapkan query untuk memperbarui data produk
        $query = "UPDATE n_produk SET bulan = '$nBulan', h_jual = '$hJual', k_santri = '$kSantri', t_penjualan = '$tPenjualan' WHERE id = '$Id'";
        // Eksekusi query
        if (mysqli_query($conn, $query)) {
            // Jika berhasil, redirect ke halaman item.php
            header("Location: nilai.php");
            exit;
        } else {
            // Jika terjadi kesalahan, tampilkan pesan error
            echo "Error: " . $query . "<br>" . mysqli_error($conn);
        }
    }
}

