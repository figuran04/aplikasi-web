<?php
require_once '../../config/init.php';

if (!isset($_GET['id']) || !is_numeric($_GET['id'])) {
  $_SESSION['error'] = "Produk tidak ditemukan.";
  header("Location: ../../views/home");
  exit;
}

$id = $_GET['id'];
$query = "SELECT p.*, c.name AS category FROM products p 
          LEFT JOIN categories c ON p.category_id = c.id 
          WHERE p.id = ?";
$stmt = $conn->prepare($query);
$stmt->bind_param("i", $id);
$stmt->execute();
$result = $stmt->get_result();
$product = $result->fetch_assoc();

if (!$product) {
  $_SESSION['error'] = "Produk tidak ditemukan.";
  header("Location: ../../views/home");
  exit;
}

// Simpan data produk di session agar bisa dipakai di view
$_SESSION['product_detail'] = $product;

// Redirect ke view
header("Location: ../../views/product_detail?id=$id");
exit;
