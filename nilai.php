<?php
session_start();
if(!isset($_SESSION['session_username'])){
    header("location:login.php");
    exit();
}
$conn = mysqli_connect("localhost", "root", "", "data_saw");
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SPK-Saw | Nilai Produk</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Custom CSS -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
    <!-- DataTables CSS -->
    <link href="https://cdn.datatables.net/1.11.5/css/dataTables.bootstrap5.min.css" rel="stylesheet">
    <!-- DataTables JS -->
    <script src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.11.5/js/dataTables.bootstrap5.min.js"></script>
    <script src= "script.js"></script>
    <link rel="shortcut icon" href="img/logo.jpg">
    <link rel="stylesheet" href="style.css">
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
            -webkit-animation: spin 0.5s linear infinite;
            animation: spin 0.5s linear infinite;
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
        td, th {
            vertical-align: middle; /* Center text vertically */
            text-align: center; /* Center text horizontally */
            font-size: 18px; /* Increase font size */
        }
    </style>
</head>
<body>
<div class="loader"></div>
<div class="sidebar">
    <p class="">Nilai Produk</p>
    <a href="home.php">Home</a>
    <a href="item.php">Produk</a>
    <a href="nilai.php" class="active">Nilai Produk</a>
    <a href="criteria.php">Kriteria</a>
    <a href="calculation.php">Perhitungan</a>
    <a href="akun.php">Akun</a>
    <div><a href="logout.php" style="margin-top: 40vh;">Log out</a></div>
</div>
<div class="content">
    <h1>Daftar Nilai Produk</h1>
    <button type="button" class="btn btn-primary mb-2"><a href="add_value.php" class="text-white text-decoration-none">Add</a></button>
    <table id="example" class="table table-striped overflow-auto">
        <thead>
        <tr>
            <th scope="col">No</th>
            <th scope="col">Id Produk</th>
            <th scope="col">Nama Barang</th>
            <th scope="col">Bulan</th>
            <th scope="col">Kebutuhan Santri</th>
            <th scope="col">Harga Jual</th>
            <th scope="col">Total Penjualan</th>
            <th scope="col">Aksi</th>
        </tr>
        </thead>
        <tbody>
        <?php
        $no = 1;
        $ambildata = mysqli_query($conn,"SELECT n.id, n.id_produk, n.bulan, n.h_jual, n.k_santri, n.t_penjualan, p.nama_produk 
                                        FROM n_produk n
                                        JOIN produk p ON n.id_produk = p.id_produk
                                        ORDER BY n.id ASC");

        while ($tampil = mysqli_fetch_assoc($ambildata)) {
            echo "
              <tr>
              <td class='items-center'>$no</td>
              <td class='items-center'>$tampil[id_produk]</td>
              <td class='items-center'>$tampil[nama_produk]</td>
              <td class='items-center'>$tampil[bulan]</td>
              <td class='items-center'>$tampil[k_santri]</td>
              <td class='items-center'>$tampil[h_jual]</td>
              <td class='items-center'>$tampil[t_penjualan]</td>
              <td class='items-center'>
                <div class='d-flex'>
                  <button type='button' class='px-2 btn btn-primary mx-2 mb-0' data-bs-toggle='modal' data-bs-target='#editModal$tampil[id]'>Edit</button>
                  <a href='delete_value.php?id=$tampil[id]' class='px-2 btn btn-danger mb-0'>Delete</a>
                </div>
              </td>
              </tr>
              ";
            $no++;
        }
        ?>
        </tbody>
    </table>

    <!-- Modals for Edit -->
    <?php
    $ambildata = mysqli_query($conn,"SELECT n.id, n.id_produk, n.bulan, n.h_jual, n.k_santri, n.t_penjualan, p.nama_produk 
                                    FROM n_produk n
                                    JOIN produk p ON n.id_produk = p.id_produk
                                    ORDER BY n.id ASC");

    while ($tampil = mysqli_fetch_assoc($ambildata)) {
        ?>
        <div class='modal fade' id='editModal<?php echo $tampil['id']; ?>' tabindex='-1' aria-labelledby='editModalLabel' aria-hidden='true'>
            <div class='modal-dialog'>
                <div class='modal-content'>
                    <div class='modal-header'>
                        <h5 class='modal-title' id='editModalLabel'>Edit Produk</h5>
                        <button type='button' class='btn-close' data-bs-dismiss='modal' aria-label='Close'></button>
                    </div>
                    <div class='modal-body'>
                        <form action='editValue.php' method='post'>
                            <div class='mb-3'>
                                <label for='Id' class='form-label'>Id Penilaian</label>
                                <input type='text' class='form-control' id='Id' name='Id' value='<?php echo $tampil['id']; ?>' readonly>
                            </div>
                            <div class='mb-3'>
                                <label for='nProduk' class='form-label'>Nama Produk</label>
                                <input type='text' class='form-control' id='nProduk' name='nProduk' value='<?php echo $tampil['nama_produk']; ?>' readonly>
                            </div>
                            <div class='mb-3'>
                                <label for='nBulan' class='form-label'>Bulan</label>
                                <input type='text' class='form-control' id='nBulan' name='nBulan' value='<?php echo $tampil['bulan']; ?>'>
                            </div>
                            <div class='mb-3'>
                                <label for='hJual' class='form-label'>Harga Jual</label>
                                <input type='text' class='form-control' id='hJual' name='hJual' value='<?php echo $tampil['h_jual']; ?>'>
                            </div>
                            <div class='mb-3'>
                                <label for='kSantri' class='form-label'>Kebutuhan Santri</label>
                                <input type='text' class='form-control' id='kSantri' name='kSantri' value='<?php echo $tampil['k_santri']; ?>'>
                            </div>
                            <div class='mb-3'>
                                <label for='tPenjualan' class='form-label'>Total Penjualan</label>
                                <input type='text' class='form-control' id='tPenjualan' name='tPenjualan' value='<?php echo $tampil['t_penjualan']; ?>'>
                            </div>
                            <button type='button' class='btn btn-secondary' data-bs-dismiss='modal'>Close</button>
                            <button type='submit' class='btn btn-primary'>Save changes</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <?php } ?>
</div>

<script>
    window.addEventListener('load', function() {
        setTimeout(function() {
            document.querySelector('.loader').style.display = 'none';
            document.querySelector('.content').style.display = 'block';
        }, 400);
    });
</script>
</body>
</html>
