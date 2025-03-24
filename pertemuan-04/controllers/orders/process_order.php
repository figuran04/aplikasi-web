<?php
require '../../config/init.php';

if (!isset($_SESSION['user_id'])) {
  header("Location: ../../views/login");
  exit;
}

$user_id = $_SESSION['user_id'];
$total_price = 0;
$order_items = [];

// Ambil data dari keranjang
$query = "SELECT c.id AS cart_id, p.id AS product_id, p.name, p.price, c.quantity
          FROM carts c 
          JOIN products p ON c.product_id = p.id 
          WHERE c.user_id = ?";
$stmt = $conn->prepare($query);
$stmt->bind_param("i", $user_id);
$stmt->execute();
$result = $stmt->get_result();

while ($row = $result->fetch_assoc()) {
  $total_price += $row['price'] * $row['quantity'];
  $order_items[] = $row;
}

// Jika keranjang kosong, redirect kembali
if (count($order_items) === 0) {
  header("Location: ../../views/cart?error=empty_cart");
  exit;
}

// Buat order baru
$conn->begin_transaction();
try {
  $query = "INSERT INTO orders (user_id, total_price, status) VALUES (?, ?, 'pending')";
  $stmt = $conn->prepare($query);
  $stmt->bind_param("id", $user_id, $total_price);
  $stmt->execute();
  $order_id = $stmt->insert_id;

  // Tambahkan produk ke order_items
  $query = "INSERT INTO order_items (order_id, product_id, quantity, price) VALUES (?, ?, ?, ?)";
  $stmt = $conn->prepare($query);
  foreach ($order_items as $item) {
    $stmt->bind_param("iiid", $order_id, $item['product_id'], $item['quantity'], $item['price']);
    $stmt->execute();
  }

  // Hapus produk dari keranjang
  $query = "DELETE FROM carts WHERE user_id = ?";
  $stmt = $conn->prepare($query);
  $stmt->bind_param("i", $user_id);
  $stmt->execute();

  $conn->commit();
  header("Location: ../../views/order_success?order_id=$order_id");
  exit;
} catch (Exception $e) {
  $conn->rollback();
  header("Location: ../../views/cart?error=order_failed");
  exit;
}
