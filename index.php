<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Gambia Book Store</title>
  <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
  <link rel="shortcut icon" href="img/logo.jpg">
  <style>
    body {
      background-color: whitesmoke; /* Light Blue */
      scroll-behavior: smooth; /* Enables smooth scrolling */
    }
    .navbar {
      background-color: #003366; /* Dark Blue */
    }
    .navbar-nav .nav-link {
      color: #cce6ff; /* Light Blue */
    }
    .navbar-nav .nav-link:hover {
      color: #99ccff; /* Slightly darker Light Blue */
    }
    .jumbotron {
    background-image: url('img/gontor.webp');
    background-size: cover;
    background-blend-mode: multiply;
    background-color: rgba(0, 0, 0, 0.6); /* 80% opacity black */
    color: black;
    height: 100vh;
    margin-bottom: 0;
    position: relative;
    font-size: 25px;
    }
    .jumbotron h1 {
      margin-top: 200px;
      margin-bottom: 50px;
    }
    .footer {
      background-color: #003366; /* Dark Blue */
      color: #cce6ff; /* Light Blue */
      padding: 20px 0;
      text-align: center;
    }
    .section {
      padding: 60px 0;
      height: 90vh;
      opacity: 0;
      transform: translateY(20px);
      transition: all 0.6s ease-in-out;
    }
    #about, #saw {
      background-color: whitesmoke; /* Light Blue */
    }
    .animate {
      opacity: 1;
      transform: translateY(0);
    }
    .section p {
      font-size: 25px;
    }
    /* .judul {
      font-weight: bold;
    } */
    .about {
      padding: 10px 0px;
      background-color: #003366;
      width: 200px;
      border-radius: 15px;
    } 
  </style>
</head>
<body>
  <!-- Navbar -->
  <nav class="navbar navbar-expand-lg navbar-dark fixed-top">
    <a class="navbar-brand" href="#">Gambia Book Store</a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarNav">
      <ul class="navbar-nav ml-auto">
        <li class="nav-item">
          <a class="nav-link" href="#home">Home</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="#about">About</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="#tutorial">Tutorial</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="login.php">Login</a>
        </li>
      </ul>
    </div>
  </nav>

  <!-- Home Section -->
  <div id="home" class="jumbotron text-center text-white">
    <h1 class="display-4">Selamat datang di sistem aplikasi penentuan produk terbaik <br> Gambia Book Store</h1>
    <a class="btn btn-primary btn-lg mt-2" href="login.php" role="button">Login</a>
  </div>

  <!-- About Section -->
  <div id="about" class="section text-center" style="background-image: url('img/gambia2.jpeg'); background-size: cover; height: 100vh; background-blend-mode: multiply; background-color: rgba(0, 0, 0, 0.6); color: white;">
    <div class="container d-flex justify-content-center align-items-center flex-column">
        <div><h2 class="mb-4 about">About</h2></div>
        <p><span class="judul">Aplikasi pemilihan produk terbaik ini dikembangkan oleh Tangguh Hari Cahyono, mahasiswa Universitas Darussalam Gontor Program Studi Teknik Informatika , sebagai bagian dari tugas akhir. Sistem ini dirancang untuk membantu pengambilan keputusan dalam pemilihan produk berdasarkan kriteria yang telah ditetapkan dengan menggunakan metode Simple Additive Weighting (SAW).</p></div> 
    </div>
  </div>

  <!-- Saw Section -->
  <div id="tutorial" class="container text-center mt-4">
        <h2 class="mb-4">Panduan Penggunaan Aplikasi</h2>
        <img src="img/tutorial.png" alt="About Us Image" class="img-fluid rounded mb-3">
        <p>Ini adalah deskripsi singkat tentang gambar yang menampilkan aktivitas atau informasi terkait kami.</p>
    </div>
  </div>
  <!-- Footer -->
  <footer class="footer">
    <p>&copy; 2024 Gambia Book Store. All rights reserved.</p>
  </footer>

  <!-- Bootstrap JS -->
  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
  <script>
    // Smooth scrolling for navigation links
    $(document).ready(function(){
      $(".navbar-nav .nav-link").on('click', function(event) {
        if (this.hash !== "") {
          event.preventDefault();
          var hash = this.hash;
          $('html, body').animate({
            scrollTop: $(hash).offset().top - $('.navbar').outerHeight()
          }, 500);
        }
      });

      // Animation on scroll
      $(window).on('scroll', function() {
        $('.section').each(function() {
          if ($(this).offset().top < $(window).scrollTop() + $(window).height() - 100) {
            $(this).addClass('animate');
          }
        });
      });

      // Trigger scroll event on load
      $(window).trigger('scroll');
    });
  </script>
</body>
</html>
