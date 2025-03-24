<?php
require '../../config/init.php';

if (!isset($_SESSION['user_id']) || !isset($_GET['cart_id'])) {
  header("Location: ../../views/cart");
  exit;
}

$cart_id = $_GET['cart_id'];

$query = "DELETE FROM carts WHERE id = ?";
$stmt = $conn->prepare($query);
$stmt->bind_param("i", $cart_id);
$stmt->execute();

header("Location: ../../views/cart");
exit;
