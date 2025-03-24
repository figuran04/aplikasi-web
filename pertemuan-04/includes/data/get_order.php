<?php
require '../../config/init.php';

if (!isset($_SESSION['user_id'])) {
  header("Location: ../login");
  exit;
}

if (!isset($_GET['order_id'])) {
  $_SESSION['error'] = "Pesanan tidak ditemukan!";
  header("Location: ../checkout");
  exit;
}

$order_id = $_GET['order_id'];
$user_id = $_SESSION['user_id'];

// Ambil data pesanan
$query = "SELECT * FROM orders WHERE id = ? AND user_id = ?";
$stmt = $conn->prepare($query);
$stmt->bind_param("ii", $order_id, $user_id);
$stmt->execute();
$order = $stmt->get_result()->fetch_assoc();

if (!$order) {
  $_SESSION['error'] = "Pesanan tidak ditemukan!";
  header("Location: ../checkout");
  exit;
}

// Ambil daftar item pesanan
$query = "SELECT oi.*, p.name FROM order_items oi 
          JOIN products p ON oi.product_id = p.id 
          WHERE oi.order_id = ?";
$stmt = $conn->prepare($query);
$stmt->bind_param("i", $order_id);
$stmt->execute();
$order_items = $stmt->get_result()->fetch_all(MYSQLI_ASSOC);
