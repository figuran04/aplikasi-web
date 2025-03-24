<?php
require '../../config/init.php';

// Pastikan pengguna login
if (!isset($_SESSION['user_id'])) {
  $_SESSION['error'] = "Silakan login untuk mengunggah produk!";
  header("Location: ../../views/login");
  exit;
}

$user_id = $_SESSION['user_id']; // ID pengguna yang login
$user_name = $_SESSION['user_name']; // Nama pengguna jika diperlukan

if ($_SERVER["REQUEST_METHOD"] == "POST") {
  $name = trim($_POST['name']);
  $description = trim($_POST['description']);
  $price = floatval($_POST['price']);
  $stock = intval($_POST['stock']);
  $category_id = intval($_POST['category_id']);

  if (empty($name) || empty($price) || empty($stock) || empty($category_id)) {
    $_SESSION['error'] = "Semua bidang wajib diisi!";
    header("Location: ../../views/upload_product");
    exit;
  }

  // Upload gambar (jika ada)
  $image = null;
  if (!empty($_FILES['image']['name'])) {
    $image_name = time() . "_" . basename($_FILES['image']['name']);
    $target_dir = "../../uploads/";
    $target_file = $target_dir . $image_name;

    if (move_uploaded_file($_FILES["image"]["tmp_name"], $target_file)) {
      $image = $image_name;
    }
  }

  // Simpan produk ke database
  $query = "INSERT INTO products (user_id, name, description, price, stock, category_id, image) 
              VALUES (?, ?, ?, ?, ?, ?, ?)";
  $stmt = $conn->prepare($query);
  $stmt->bind_param("issdiis", $user_id, $name, $description, $price, $stock, $category_id, $image);

  if ($stmt->execute()) {
    $_SESSION['success'] = "Produk berhasil diunggah!";
    header("Location: ../../views/profile");
  } else {
    $_SESSION['error'] = "Gagal mengunggah produk!";
    header("Location: ../../views/upload_product");
  }
  exit;
}
