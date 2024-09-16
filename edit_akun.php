<?php
session_start();
if (!isset($_SESSION['session_username'])) {
    header("location:login.php");
    exit();
}

include_once("config.php");
$errors = [];

// Memeriksa apakah form telah disubmit
if (isset($_POST['edit'])) {
    $akunId = clean_input($_POST["akunId"]);
    $username = clean_input($_POST["username"]);
    $password = clean_input($_POST["password"]);
    $password_asli = clean_input($_POST["password"]);
    $hashed_password = md5($password);

    // Memeriksa apakah field tidak kosong
    if (empty($username)) {
        $errors[] = "Username harus diisi";
    }
    if (empty($password)) {
        $errors[] = "Password harus diisi";
    }

    // Jika tidak ada error, lanjutkan dengan proses form
    if (empty($errors)) {
        $sql = "UPDATE akun SET username='$username', password='$hashed_password', password_asli='$password_asli' WHERE id_akun='$akunId'";
        if (mysqli_query($conn, $sql)) {
            header("Location: akun.php");
            exit;
        } else {
            $errors[] = "Error updating record: " . mysqli_error($conn);
        }
    }
}

function clean_input($data) {
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}

mysqli_close($conn);
