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
    // Memeriksa dan membersihkan setiap input
    $akunId = clean_input($_POST["akunId"]);
    $username = clean_input($_POST["username"]);
    $password = clean_input($_POST["password"]);
    $password_asli = clean_input($_POST["password"]);
    $role= clean_input($_POST["role"]);
    $hashed_password = md5($password); // Hash password dengan MD5

    // Memeriksa apakah field Akun Id tidak kosong
    if (empty($akunId)) {
        $errors[] = "Akun Id harus diisi";
    }

    // Memeriksa apakah field Username tidak kosong
    if (empty($username)) {
        $errors[] = "Username harus diisi";
    }

    // Memeriksa apakah field Password tidak kosong
    if (empty($password)) {
        $errors[] = "Password harus diisi";
    }
    if (empty($role)) {
        $errors[] = "Role harus diisi";
    }

    // Jika tidak ada error, lanjutkan dengan proses form
    if (empty($errors)) {
        // Include database connection file
        include_once("config.php");
        
        // Insert data into table
        $result = mysqli_query($mysqli, "INSERT INTO akun (id_akun, username, password, password_asli, role) VALUES ('$akunId', '$username', '$hashed_password', '$password_asli','$role')");

        // Redirect atau tampilkan pesan sukses
        if ($result) {
            header("Location: akun.php");
            exit;
        } else {
            $errors[] = "Error: " . mysqli_error($mysqli);
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>SPK-Saw | Tambah Akun</title>
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
        display: none; /* Hide content until loader disappears */
    }
    .error {
        color: red;
    }
  </style>
</head>
<body>
  <div class="loader"></div>
  <div class="container content">
    <h1 class="mt-5">Tambah Akun</h1>
    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
    <?php
        $conn = mysqli_connect("localhost", "root", "", "data_saw");
        $sql = "SELECT id_akun FROM akun ORDER BY id_akun DESC LIMIT 1";
        $result = mysqli_query($conn, $sql);

        // Memeriksa apakah kueri berhasil dieksekusi
        if ($result) {
            // Memeriksa apakah ada baris yang dikembalikan
            if (mysqli_num_rows($result) > 0) {
                // Mendapatkan hasil kueri sebagai array asosiatif
                $row = mysqli_fetch_assoc($result);
                // Mendapatkan nilai id_akun terakhir
                $last_id_akun = $row["id_akun"];
            } else {
                $last_id_akun = 0; // Tidak ada data yang ditemukan, mulai dari 0
            }
        } else {
            $last_id_akun = "Error: " . mysqli_error($conn);
        }  
      ?>
      <div class="mb-3">
        <label for="akunId" class="form-label">Account ID</label>
        <input type="text" class="form-control" id="akunId" name="akunId" value="<?php echo $last_id_akun + 1 ?>" readonly>
        <span class="error"><?php echo isset($errors) && !empty($errors) ? $errors[0] : ''; ?></span>
      </div>
      <div class="mb-3">
        <label for="username" class="form-label">Username</label>
        <input type="text" class="form-control" id="username" name="username">
        <span class="error"><?php echo isset($errors) && !empty($errors) ? $errors[1] : ''; ?></span>
      </div>
      <div class="mb-3">
        <label for="password" class="form-label">Password</label>
        <input type="password" class="form-control" id="password" name="password">
        <span class="error"><?php echo isset($errors) && !empty($errors) ? $errors[2] : ''; ?></span>
      </div>
      <div class="mb-3">
        <label for="role" class="form-label">Role</label>
        <select class="form-control" id="role" name="role">
            <option value="admin">admin</option>
            <option value="user">user</option>
        </select>
        <span class="error">
            <?php echo isset($errors) && !empty($errors) ? $errors[2] : ''; ?>
        </span>
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
