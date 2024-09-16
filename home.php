<?php 
session_start();
if(!isset($_SESSION['session_username'])){
    header("location:login.php");
    exit();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>SPK-Saw | Dashboard</title>
  <!-- Bootstrap CSS -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
  <link rel="stylesheet" href="style.css">
  <link rel="shortcut icon" href="img/logo.jpg">
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
    </style>
</head>
<body>
  <!-- Sidebar -->
  <div class="sidebar">
    <p class="" >Home</p>
    <a href="home.php" class="active">Home</a>
    <a href="item.php">Produk</a>
    <a href="nilai.php">Nilai Produk</a>
    <a href="criteria.php">Kriteria</a>
    <a href="calculation.php">Perhitungan</a>
    <a href="akun.php">Akun</a>
    <div><a href="logout.php" style="margin-top:  40vh;">Log out</a></div>
  </div>

  <!-- Page Content -->
  <div class="content">
    <h1>Dashboard</h1>
    <h3>Selamat datang di Sistem Pendukung Keputusan penentuan produk terbaik pada Gambia Book Sotre</h3>
  </div>
  <div class="loader"></div>
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
