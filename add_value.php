<?php
session_start();
if(!isset($_SESSION['session_username'])){
    header("location:login.php");
    exit();
}
$conn = mysqli_connect("localhost", "root", "", "data_saw");
$errors = [];

// Fungsi untuk membersihkan data input
function clean_input($data) {
    return htmlspecialchars(stripslashes(trim($data)));
}

// Fungsi untuk memeriksa apakah produk dengan id_produk tertentu ada di tabel produk
function check_produk_existence($conn, $id_produk) {
    $query = "SELECT id_produk FROM produk WHERE id_produk = '$id_produk'";
    $result = mysqli_query($conn, $query);
    return mysqli_num_rows($result) > 0;
}

// Memeriksa apakah form telah disubmit
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $produkId = clean_input($_POST["produkId"]);
    $nProduk = clean_input($_POST["nProduk"]);
    $nBulan = clean_input($_POST["nBulan"]);
    $hJual = clean_input($_POST["hJual"]);
    $kSantri = clean_input($_POST["kSantri"]);
    $tPenjualan = clean_input($_POST["tPenjualan"]);

    if (empty($produkId)) $errors[] = "Produk Id harus diisi";
    if (empty($nProduk)) $errors[] = "Nama Produk harus diisi";
    if (empty($nBulan)) $errors[] = "Bulan harus diisi";
    if (empty($hJual)) $errors[] = "Nilai harga jual harus diisi";
    if (empty($kSantri)) $errors[] = "Nilai kebutuhan santri harus diisi";
    if (empty($tPenjualan)) $errors[] = "Nilai total penjualan harus diisi";

    if (!check_produk_existence($conn, $produkId)) $errors[] = "Maaf, Produk dengan ID tersebut tidak ada.";

    if (empty($errors)) {
        include_once("config.php");
        $result = mysqli_query($mysqli, "INSERT INTO n_produk(id_produk, bulan, h_jual, k_santri, t_penjualan) VALUES('$produkId', '$nBulan', '$hJual', '$kSantri', '$tPenjualan')");
        header("Location: nilai.php");
        exit;
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>SPK-Saw | Tambah Nilai Produk</title>
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
    .custom-select {
        position: relative;
    }
    .select-selected {
        background-color: #eee;
        padding: 10px;
        border: 1px solid #ddd;
        cursor: pointer;
    }
    .select-items {
        position: absolute;
        background-color: #fff;
        border: 1px solid #ddd;
        width: 100%;
        max-height: 200px;
        overflow-y: auto;
        z-index: 1;
    }
    .select-items div,
    .select-items input {
        padding: 10px;
        cursor: pointer;
    }
    .select-items div:hover {
        background-color: #ddd;
    }
    .select-hide {
        display: none;
    }
  </style>
</head>
<body>
  <div class="loader"></div>
  <div class="container content">
    <h1 class="mt-5">Tambah Nilai</h1>
    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
      <div class="mb-3">
        <label for="produkId" class="form-label">Produk Id</label>
        <input type="text" class="form-control" id="produkId" name="produkId" value="<?php echo isset($produkId) ? $produkId : ''; ?>" readonly>
      </div>
      <div class="mb-3">
        <label for="nProduk" class="form-label">Nama Produk</label>
        <div class="custom-select">
          <div class="select-selected">Silahkan Pilih Produk</div>
            <div class="select-items select-hide">
              <input type="text" name="nProduk" id="nProduk" class="form-control select-search" placeholder="Cari Produk...">
              <?php
                $sql = "SELECT * FROM produk ORDER BY id_produk DESC";
                $result = $conn->query($sql);
                while ($row = $result->fetch_assoc()){
              ?>
                <div data-id="<?php echo $row['id_produk']?>"><?php echo $row['nama_produk']?></div>
                  <?php      
                  }
                  ?>
            </div>
          </div>
        </div>
      <div class="mb-3">
        <label for="nBulan" class="form-label">Bulan</label>
        <input type="text" class="form-control" id="nBulan" name="nBulan">
        <p class="mt-3 text-danger fw-bold">NB : Contoh Penulisan Bulan Sebagai Berikut = Mei 2024</p>
        <span class="error"><?php echo isset($errors) && !empty($errors) ? $errors[1] : ''; ?></span>
      </div>
      <div class="mb-3">
        <label for="kSantri" class="form-label">Kebutuhan Santri</label>
        <input type="text" class="form-control" id="kSantri" name="kSantri">
        <span class="error"><?php echo isset($errors) && !empty($errors) ? $errors[1] : ''; ?></span>
      </div>
      <div class="mb-3">
        <label for="hJual" class="form-label">Harga Jual</label>
        <input type="text" class="form-control" id="hJual" name="hJual">
        <span class="error"><?php echo isset($errors) && !empty($errors) ? $errors[1] : ''; ?></span>
      </div>
      <div class="mb-3">
        <label for="tPenjualan" class="form-label">Total Penjualan</label>
        <input type="text" class="form-control" id="tPenjualan" name="tPenjualan">
        <span class="error"><?php echo isset($errors) && !empty($errors) ? $errors[1] : ''; ?></span>
      </div>
      <button type="submit" class="btn btn-primary" name="Submit">Submit</button>
    </form>
  </div>
  <!-- Bootstrap JS (optional) -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
  <script>
    document.addEventListener('DOMContentLoaded', function() {
    var selected = document.querySelector('.select-selected');
    var selectItems = document.querySelector('.select-items');
    var searchInput = document.querySelector('.select-search');
    var nProdukInput = document.getElementById('nProduk'); // Tambahkan ini

      // Menangani klik pada elemen dropdown
    selected.addEventListener('click', function() {
          selectItems.classList.toggle('select-hide');
    });

      // Menangani pencarian dalam dropdown
    searchInput.addEventListener('keyup', function() {
      var filter = searchInput.value.toUpperCase();
      var items = selectItems.getElementsByTagName('div');
          
      for (var i = 0; i < items.length; i++) {
        var item = items[i];
        if (item.textContent.toUpperCase().indexOf(filter) > -1) {
              item.style.display = "";
            } else {
                item.style.display = "none";
              }
         }
      });

      // Menangani klik pada item dropdown
      selectItems.addEventListener('click', function(e) {
          if (e.target && e.target.nodeName == "DIV") {
              var selectedText = e.target.textContent;
              var selectedId = e.target.getAttribute('data-id');
              selected.textContent = selectedText;
              document.getElementById('produkId').value = selectedId;
              nProdukInput.value = selectedText; // Update nProduk input
              selectItems.classList.add('select-hide');
          }
      });

      // Menutup dropdown ketika mengklik di luar elemen
      document.addEventListener('click', function(e) {
        if (!selected.contains(e.target) && !selectItems.contains(e.target)) {
          selectItems.classList.add('select-hide');
        }
      });
        // Menghilangkan loader setelah halaman siap
        document.querySelector('.loader').style.display = 'none';
        document.querySelector('.content').style.display = 'block';
      });
  </script>
</body>
</html>
