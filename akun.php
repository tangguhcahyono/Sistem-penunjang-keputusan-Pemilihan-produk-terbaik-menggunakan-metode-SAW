<?php
session_start();
// Redirect to login if not authenticated
if (!isset($_SESSION['session_username'])) {
    header("location:login.php");
    exit();
}

// Fetch user role from session
$role = $_SESSION['role']; // Assuming 'role' is stored in the session during login

// Role-based redirection
if ($role === 'user') {
    header("location:akun_user.php"); // Redirect users with 'user' role to their account page
    exit();
}

// Establish database connection
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
    td, th {
            vertical-align: middle; /* Center text vertically */
            text-align: center; /* Center text horizontally */
            font-size: 18px; /* Increase font size */
        }
  </style>
</head>
<body>

  <!-- Sidebar -->
  <div class="loader"></div>
  <div class="sidebar">
    <p>Akun</p>
    <a href="home.php">Home</a>
    <a href="item.php">Produk</a>
    <a href="nilai.php">Nilai Produk</a>
    <a href="criteria.php">Kriteria</a>
    <a href="calculation.php">Perhitungan</a>
    <a href="akun.php" class="active">Akun</a>
    <div><a href="logout.php" style="margin-top: 40vh;">Log out</a></div>
  </div>
  <!-- Page Content -->
  <div class="content">
    <h1>Daftar Akun</h1>
    <button type="button" class="btn btn-primary mb-2"><a href="add_akun.php" class="text-white text-decoration-none">Add</a></button>
    <table id="example" class="table table-striped overflow-auto">
      <thead>
        <tr>
          <th scope="col">No</th>
          <th scope="col">Username</th>
          <th scope="col">Password</th>
          <th scope="col">Aksi</th>
        </tr>
      </thead>
      <tbody>
        <?php
          $no = 1;
          $ambildata = mysqli_query($conn, "SELECT * FROM akun");

          while ($tampil = mysqli_fetch_assoc($ambildata)) {
              echo "
              <tr>
              <td class='items-center'>$no</td>
              <td class='items-center'>{$tampil['username']}</td>
              <td class='items-center'>
                <span class='password-text' style='display: none;'>{$tampil['password_asli']}</span>
                <input type='password' class='form-control d-inline-block' value='{$tampil['password_asli']}' readonly style='width: auto;'>
                <button class='btn btn-sm btn-warning ms-2 toggle-password'>Show</button>
              </td>
              <td class='items-center'>
                <div class='d-flex'>
                  <p class='px-2 btn btn-primary mx-2 mb-0' data-bs-toggle='modal' data-bs-target='#exampleModal{$tampil['id_akun']}'>Edit</p>
                  <p class='px-2 btn btn-danger mb-0'>
                    <a href='delete_akun.php?id_akun={$tampil['id_akun']}'class='text-white text-decoration-none'>Delete</a>
                  </p>
                </div>
              </td>
              </tr>
              ";
              $no++;
          }
        ?>
      </tbody>
    </table>
    <!-- Modal -->
    <?php
      $ambildata = mysqli_query($conn, "SELECT * FROM akun");

      while ($tampil = mysqli_fetch_assoc($ambildata)) :
    ?>
      <div class='modal fade' id='exampleModal<?php echo $tampil['id_akun']; ?>' tabindex='-1' aria-labelledby='exampleModalLabel' aria-hidden='true'>
        <div class='modal-dialog'>
          <div class='modal-content'>
            <div class='modal-header'>
              <h5 class='modal-title' id='exampleModalLabel'>Edit Akun</h5>
              <button type='button' class='btn-close' data-bs-dismiss='modal' aria-label='Close'></button>
            </div>
            <div class='modal-body'>
              <form action='edit_akun.php' method='post'>
                <div class='mb-3'>
                  <label for='akunId' class='form-label'>Id akun</label>
                  <input type='text' class='form-control' id='akunId' name='akunId' value='<?php echo $tampil['id_akun']; ?>' readonly>
                </div>
                <div class='mb-3'>
                  <label for='username' class='form-label'>Username</label>
                  <input type='text' class='form-control' id='username' name='username' value='<?php echo $tampil['username']; ?>'>
                </div>
                <div class='mb-3'>
                  <label for='password' class='form-label'>Password</label>
                  <input type='text' class='form-control' id='password' name='password' value='<?php echo $tampil['password_asli']; ?>'>
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

  <script>
    // JavaScript to hide the loader once the page is fully loaded
    window.addEventListener('load', function() {
      setTimeout(function() {
        document.querySelector('.loader').style.display = 'none';
        document.querySelector('.content').style.display = 'block';
      }, 400);
    });

    // JavaScript to toggle password visibility
    document.querySelectorAll('.toggle-password').forEach(button => {
        button.addEventListener('click', function() {
            const passwordField = this.previousElementSibling;
            const passwordText = passwordField.previousElementSibling;

            if (passwordField.type === 'password') {
                passwordField.type = 'text';
                this.textContent = 'Hide';
            } else {
                passwordField.type = 'password';
                this.textContent = 'Show';
            }
        });
    });
  </script>
</body>
</html>
