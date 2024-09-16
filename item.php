<?php
session_start();
if (!isset($_SESSION['session_username'])) {
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
  <title>SPK-Saw | Items</title>
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
  <script src="script.js"></script>
  <link rel="stylesheet" href="style.css">
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
        
        table {
            font-size: 18px;
        }
        
        td, th {
            vertical-align: middle;
            text-align: center;
        }
        
        .items-center {
            justify-content: center;
            align-items: center;
        }

        .img-thumbnail {
            max-width: 100px;
            cursor: pointer;
        }
        
        .modal-img {
            width: 100%;
        }
    </style>
</head>
<body>
  
  <!-- Sidebar -->
  <div class="loader"></div>
  <div class="sidebar">
    <p class="">Produk</p>
    <a href="home.php">Home</a>
    <a href="item.php" class="active">Produk</a>
    <a href="nilai.php">Nilai Produk</a>
    <a href="criteria.php">Kriteria</a>
    <a href="calculation.php">Perhitungan</a>
    <a href="akun.php">Akun</a>
    <div><a href="logout.php" style="margin-top:  40vh;">Log out</a></div>
  </div>
  <!-- Page Content -->
  <div class="content">
      <h1>Daftar Produk</h1>
      <button type="button" class="btn btn-primary mb-2"><a href="add.php" class="text-white text-decoration-none">Add</a></button>
    <table id="example" class="table table-striped overflow-auto">
      <thead>
        <tr>
          <th scope="col">No</th>
          <th scope="col">Produk Id</th>
          <th scope="col">Gambar</th>
          <th scope="col">Nama Barang</th>
          <th scope="col">Aksi</th>
        </tr>
      </thead>
      <tbody>
        <?php
          $no = 1;
          $ambildata = mysqli_query($conn, "SELECT * FROM produk");
          
          while ($tampil = mysqli_fetch_assoc($ambildata)) {
              $imagePath = 'uploads/' . $tampil['gambar']; // Path gambar sesuai database
              echo "
              <tr>
              <td class='items-center'>$no</td>
              <td class='items-center'>$tampil[id_produk]</td>
              <td class='items-center'>
                <img src='img/$tampil[gambar]' alt='$tampil[nama_produk]' class='img-thumbnail' data-bs-toggle='modal' data-bs-target='#imageModal$tampil[id_produk]'>
              </td>
              <td class='items-center'>$tampil[nama_produk]</td>
              <td class='items-center'>
                <div class='d-flex justify-content-center'>
                  <p class='px-2 btn btn-primary mx-2 mb-0' data-bs-toggle='modal' data-bs-target='#exampleModal$tampil[id_produk]'>Edit</p>
                  <p class='px-2 btn btn-danger mb-0'><a href='delete.php?id_produk=$tampil[id_produk]' onclick='return confirm(\"Anda yakin ingin menghapus data ini?\")' class='text-white text-decoration-none'>Delete</a></p>
                </div>
              </td>
              </tr>
              ";
              $no++;
          }
        ?>
      </tbody>
    </table>
    
    <!-- Image Modal -->
    <div class="modal fade" id="imageModal" tabindex="-1" aria-labelledby="imageModalLabel" aria-hidden="true">
      <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
          <div class="modal-header">
            <h5>Nama Barang</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>
          <div class="modal-body">
            <img id="modalImage" src="" alt="Image Preview" class="modal-img">
          </div>
        </div>
      </div>
    </div>

    <!-- Modal -->
    <?php
      $ambildata = mysqli_query($conn, "SELECT * FROM produk");

      while ($tampil = mysqli_fetch_assoc($ambildata)) :
    ?>
      <!-- Image Modal -->
      <div class="modal fade" id="imageModal<?php echo $tampil['id_produk']; ?>" tabindex="-1" aria-labelledby="imageModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
          <div class="modal-content">
            <div class="modal-header">
              <h5><?php echo $tampil['nama_produk']; ?></h5>
              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
              <img id="modalImage" src="img/<?php echo $tampil['gambar']; ?>" alt="Image Preview" class="modal-img">
            </div>
          </div>
        </div>
      </div>
      <!-- Edit Modal -->
      <div class='modal fade' id='exampleModal<?php echo $tampil['id_produk']; ?>' tabindex='-1' aria-labelledby='exampleModalLabel' aria-hidden='true'>
          <div class='modal-dialog'>
              <div class='modal-content'>
                  <div class='modal-header'>
                      <h5 class='modal-title' id='exampleModalLabel'>Edit Produk</h5>
                      <button type='button' class='btn-close' data-bs-dismiss='modal' aria-label='Close'></button>
                  </div>
                  <div class='modal-body'>
                      <form action='edit.php' method='post' enctype='multipart/form-data'>
                          <input type='hidden' name='id_produk' value='<?php echo $tampil['id_produk']; ?>'>
                          <input type='hidden' name='old_gambar' value='<?php echo $tampil['gambar']; ?>'>
                          <div class='mb-3'>
                              <label for='nProduk' class='form-label'>Nama Produk</label>
                              <input type='text' class='form-control' id='nProduk' name='nProduk' value='<?php echo $tampil['nama_produk']; ?>'>
                          </div>
                          <div class='mb-3'>
                              <label for='gambar' class='form-label'>Gambar Produk</label>
                              <input type='file' class='form-control' id='gambar' name='gambar'>
                              <img src='img/<?php echo $tampil['gambar']; ?>' alt='Current Image' class='img-thumbnail mt-2' style='max-width: 100px;'>
                          </div>
                          <button type='button' class='btn btn-secondary' data-bs-dismiss='modal'>Close</button>
                          <button type='submit' name='edit' class='btn btn-primary'>Save changes</button>
                      </form>
                  </div>
              </div>
          </div>
      </div>
    <?php endwhile; ?>

      </div>
</div>

<!-- Bootstrap JS (optional) -->
<script>
    // JavaScript to hide the loader once the page is fully loaded
    window.addEventListener('load', function() {
        setTimeout(function() {
            document.querySelector('.loader').style.display = 'none';
            document.querySelector('.content').style.display = 'block';
        }, 200);
    });
</script>
</body>
</html>
