<?php
session_start();
if (!isset($_SESSION['session_username'])) {
    header("location:login.php");
    exit();
}

$conn = mysqli_connect("localhost", "root", "", "data_saw");

if (isset($_POST['edit'])) {
    $id_produk = $_POST['id_produk'];
    $nama_produk = $_POST['nProduk'];
    $gambar = $_FILES['gambar'];
    $target_dir = "img/";
    $sql_get_image = "SELECT gambar FROM produk WHERE id_produk = ?";
    $stmt_get_image = $conn->prepare($sql_get_image);
    $stmt_get_image->bind_param("i", $id_produk);
    $stmt_get_image->execute();
    $result = $stmt_get_image->get_result();
    $data = $result->fetch_assoc();
    // Start transaction
    mysqli_begin_transaction($conn);
    
    try {
        // Check if a new image is uploaded
        $sql_get_image = "SELECT gambar FROM produk WHERE id_produk = ?";
        $stmt_get_image = $conn->prepare($sql_get_image);
        $stmt_get_image->bind_param("i", $id_produk);
        $stmt_get_image->execute();
        $result = $stmt_get_image->get_result();
        $data = $result->fetch_assoc();
        $old_image = $data['gambar'];
        if ($gambar['error'] === UPLOAD_ERR_OK) {
            // Delete old image from the server if it exists
            if (!empty($old_image) && file_exists($target_dir . $old_image)) {
                unlink($target_dir . $old_image);
            }

            // Get file extension and define new image name
            $fileExtension = pathinfo($gambar['name'], PATHINFO_EXTENSION);
            $imageName = $id_produk . '.' . $fileExtension;
            $target_file = $target_dir . $imageName;

            // Move new image to the target directory
            if (!move_uploaded_file($gambar['tmp_name'], $target_file)) {
                throw new Exception("Failed to upload new image.");
            }
            
            $gambar = $imageName; // Use new image name
        } else {
            // If no new image is uploaded, keep the old image name
            $gambar = $_POST['old_gambar'];
        }
        
        // Update the product data in the database
        $sql_update = "UPDATE produk SET nama_produk = ?, gambar = ? WHERE id_produk = ?";
        $stmt_update = $conn->prepare($sql_update);
        $stmt_update->bind_param("ssi", $nama_produk, $gambar, $id_produk);
        $stmt_update->execute();

        // Commit transaction
        mysqli_commit($conn);

        // Close statement
        $stmt_get_image->close();
        $stmt_update->close();

        // Redirect to item.php
        header("Location: item.php");
        exit;
        
    } catch (Exception $e) {
        // Rollback transaction if error occurs
        mysqli_rollback($conn);
        echo "Failed to update product: " . $e->getMessage();
    }
}

// Close connection
$conn->close();

