<?php
require_once '../../config/init.php';

if (!isset($_SESSION['user_id'])) {
  header("Location: ../login");
  exit;
}

$user_id = $_SESSION['user_id'];
$query = "SELECT * FROM products WHERE user_id = ?";
$stmt = $conn->prepare($query);
$stmt->bind_param("i", $user_id);
$stmt->execute();
$products = $stmt->get_result()->fetch_all(MYSQLI_ASSOC);
