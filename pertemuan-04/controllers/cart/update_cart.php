<?php
require '../../config/init.php';

if (!isset($_SESSION['user_id']) || !isset($_POST['cart_id']) || !isset($_POST['quantity'])) {
  header("Location: ../../views/cart");
  exit;
}

$cart_id = $_POST['cart_id'];
$quantity = (int) $_POST['quantity'];

// Pastikan jumlah minimal 1
if ($quantity < 1) {
  $quantity = 1;
}

$query = "UPDATE carts SET quantity = ? WHERE id = ?";
$stmt = $conn->prepare($query);
$stmt->bind_param("ii", $quantity, $cart_id);
$stmt->execute();

header("Location: ../../views/cart");
exit;
