<?php
require_once '../../config/init.php';

if (!isset($_SESSION['user_id'])) {
  header("Location: ../../views/login");
  exit;
}

$user_id = $_SESSION['user_id'];

// Ambil daftar pesanan pengguna
$query = "SELECT * FROM orders WHERE user_id = ? ORDER BY created_at DESC";
$stmt = $conn->prepare($query);
$stmt->bind_param("i", $user_id);
$stmt->execute();
$orders = $stmt->get_result()->fetch_all(MYSQLI_ASSOC);
