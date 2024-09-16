<?php
session_start();
if (!isset($_SESSION['session_username'])) {
    header("location:login.php");
    exit();
}
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
    $produkId = clean_input($_POST["produkId"]);
    $nProduk = clean_input($_POST["nProduk"]);
    $imageFile = $_FILES["productImage"];

    // Memeriksa apakah field Produk Id tidak kosong
    if (empty($produkId)) {
        $errors[] = "Produk Id harus diisi";
    }

    // Memeriksa apakah field Nama Produk tidak kosong
    if (empty($nProduk)) {
        $errors[] = "Nama Produk harus diisi";
    }

    // Memeriksa apakah file gambar telah diunggah
    if ($imageFile['error'] !== UPLOAD_ERR_OK) {
        $errors[] = "Gambar harus diupload";
    } else {
        // Memeriksa ekstensi file gambar
        $allowedExtensions = ['jpg', 'jpeg', 'png', 'gif'];
        $fileExtension = pathinfo($imageFile['name'], PATHINFO_EXTENSION);

        if (!in_array($fileExtension, $allowedExtensions)) {
            $errors[] = "Hanya file gambar dengan ekstensi jpg, jpeg, png, gif yang diperbolehkan";
        }

        // Memeriksa ukuran file gambar (maksimal 2MB)
        if ($imageFile['size'] > 2 * 1024 * 1024) {
            $errors[] = "Ukuran file gambar terlalu besar (maksimal 2MB)";
        }
    }

    // Jika tidak ada error, lanjutkan dengan proses form
    if (empty($errors)) {
        include_once("config.php");

        // Mengatur nama file gambar
        $imageName = $produkId . '.' . $fileExtension;
        $targetDirectory = 'img/';
        $targetFile = $targetDirectory . $imageName;

        // Memindahkan file gambar ke folder tujuan
        if (move_uploaded_file($imageFile['tmp_name'], $targetFile)) {
            // Insert data into table
            $result = mysqli_query($mysqli, "INSERT INTO produk(id_produk, nama_produk, gambar) VALUES('$produkId', '$nProduk', '$imageName')");

            // Redirect atau tampilkan pesan sukses
            header("Location: item.php");
            exit;
        } else {
            $errors[] = "Terjadi kesalahan saat mengunggah gambar";
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>SPK-Saw | Tambah Produk</title>
  <!-- Bootstrap CSS -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
  <link rel="shortcut icon" href="img/logo.jpg">
  <style>
    .loader {
        position: fixed;
        left: 50%;
        top: 50%;
        transform: translate(-50%, -50%);
        border: 8px solid #f3f3f3;
        border-radius: 50%;
        border-top: 8px solid #3498db;
        width: 60px;
        height: 60px;
        -webkit-animation: spin 0.2s linear infinite;
        animation: spin 0.2s linear infinite;
        z-index: 1000;
    }

    @-webkit-keyframes spin {
        0% { -webkit-transform: rotate(0deg); }
        100% { -webkit-transform: rotate(360deg); }
    }

    @keyframes spin {
        0% { transform: rotate(0deg); }
        100% { transform: rotate(360deg); }
    }

    .content {
        display: none;
    }
    .error {
      color: red;
    }
  </style>
</head>
<body>
  <div class="loader"></div>
  <div class="container content">
    <h1 class="mt-5">Tambah Produk</h1>
    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post" enctype="multipart/form-data">
      <?php
        $conn = mysqli_connect("localhost", "root", "", "data_saw");
        $sql = "SELECT id_produk FROM produk ORDER BY id_produk DESC LIMIT 1";
        $result = mysqli_query($conn, $sql);

        if ($result) {
            if (mysqli_num_rows($result) > 0) {
                $row = mysqli_fetch_assoc($result);
                $last_id_produk = $row["id_produk"];
            } else {
                $last_id_produk = 0; // Jika tidak ada data, mulai dari 0
            }
        } else {
            $last_id_produk = 0;
        }
      ?>
      <div class="mb-3">
        <label for="produkId" class="form-label">Produk Id</label>
        <input type="text" class="form-control" id="produkId" name="produkId" value="<?php echo $last_id_produk + 1 ?>" readonly>
        <span class="error"><?php echo isset($errors[0]) ? $errors[0] : ''; ?></span>
      </div>
      <div class="mb-3">
        <label for="nProduk" class="form-label">Nama Produk</label>
        <input type="text" class="form-control" id="nProduk" name="nProduk">
        <span class="error"><?php echo isset($errors[1]) ? $errors[1] : ''; ?></span>
      </div>
      <div class="mb-3">
        <label for="productImage" class="form-label">Gambar Produk</label>
        <input type="file" class="form-control" id="productImage" name="productImage">
        <span class="error"><?php echo isset($errors[2]) ? $errors[2] : ''; ?></span>
      </div>
      <button type="submit" class="btn btn-primary" name="Submit">Submit</button>
    </form>
  </div>
  <!-- Bootstrap JS (optional) -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
  <script>
    window.addEventListener('load', function () {
        setTimeout(function () {
            document.querySelector('.loader').style.display = 'none';
            document.querySelector('.content').style.display = 'block';
        }, 600);
    });
  </script>
</body>
</html>
