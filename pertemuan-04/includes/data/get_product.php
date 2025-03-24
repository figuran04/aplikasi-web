<?php
require_once '../../config/init.php';

if (!isset($_GET['id']) || !is_numeric($_GET['id'])) {
  die("Produk tidak ditemukan.");
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
  die("Produk tidak ditemukan.");
}

return $product;
