<?php
require '../../config/init.php';

if (!isset($_SESSION['user_id'])) {
  header("Location: ../../views/login");
  exit;
}

$user_id = $_SESSION['user_id'];
$product_id = $_POST['product_id'];
$quantity = isset($_POST['quantity']) ? (int)$_POST['quantity'] : 1;

// Cek apakah produk sudah ada di keranjang
$query = "SELECT id, quantity FROM carts WHERE user_id = ? AND product_id = ?";
$stmt = $conn->prepare($query);
$stmt->bind_param("ii", $user_id, $product_id);
$stmt->execute();
$result = $stmt->get_result();
$row = $result->fetch_assoc();

if ($row) {
  // Jika sudah ada, update jumlah
  $new_quantity = $row['quantity'] + $quantity;
  $update_query = "UPDATE carts SET quantity = ? WHERE id = ?";
  $stmt = $conn->prepare($update_query);
  $stmt->bind_param("ii", $new_quantity, $row['id']);
  $stmt->execute();
} else {
  // Jika belum ada, tambahkan ke database
  $insert_query = "INSERT INTO carts (user_id, product_id, quantity) VALUES (?, ?, ?)";
  $stmt = $conn->prepare($insert_query);
  $stmt->bind_param("iii", $user_id, $product_id, $quantity);
  $stmt->execute();
}

header("Location: ../../views/cart");
exit;
