<?php
session_start();
if(!isset($_SESSION['session_username'])){
    header("location:login.php");
    exit();
}
$conn =mysqli_connect("localhost","root","","data_saw");
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>SPK-Saw | Kriteria</title>
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
        /* Add the loader CSS here for demonstration purposes */
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
            display: none; /* Hide content until loader disappears */
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
  <!-- Sidebar -->
  <div class="sidebar">
    <p class="" >Kriteria</p>
    <a href="home.php">Home</a>
    <a href="item.php">Produk</a>
    <a href="nilai.php">Nilai Produk</a>
    <a href="criteria.php"  class="active">Kriteria</a>
    <a href="calculation.php">Perhitungan</a>
    <a href="akun.php">Akun</a>
    <div><a href="logout.php" style="margin-top:  40vh;">Log out</a></div>
  </div>

  <!-- Page Content -->
  <div class="content">
    <h1>Kriteria</h1>
  <table id="example" class="table table-striped">
      <thead>
        <tr>
          <th scope="col">No</th>
          <th scope="col">Id Kriteria</th>
          <th scope="col">Kriteria</th>
          <th scope="col">bobot</th>
          <th scope="col">jenis</th>
        </tr>
      </thead>
      <tbody>
        <?php
        $no=1;
        $ambildata = mysqli_query($conn,"SELECT * FROM kriteria");
        
        while ($tampil = mysqli_fetch_array($ambildata)){
            echo "
            <tr>
            <td>$no</td>
            <td>$tampil[id_kriteria]</td>
            <td>$tampil[kriteria]</td>
            <td>$tampil[bobot]</td>
            <td>$tampil[Jenis]</td>
            </tr>
            ";
            $no++;
        }
        ?>
      </tbody>
    </table>
  </div>
  <!-- Bootstrap JS (optional) -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
  <script> 
    // JavaScript to hide the loader once the page is fully loaded
    window.addEventListener('load', function() {
            setTimeout(function() {
                document.querySelector('.loader').style.display = 'none';
                document.querySelector('.content').style.display = 'block';
            }, 400);
        });
  </script>
</body>
</html>
