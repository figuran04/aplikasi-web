<?php

if (!isset($_SESSION['user_id'])) {
  die("User not logged in.");
}

$user_id = $_SESSION['user_id'];
$query = "SELECT c.id AS cart_id, p.id AS product_id, p.name, p.price, c.quantity
          FROM carts c 
          JOIN products p ON c.product_id = p.id 
          WHERE c.user_id = ?";
$stmt = $conn->prepare($query);
$stmt->bind_param("i", $user_id);
$stmt->execute();
$result = $stmt->get_result();

$cart_items = [];
$total_price = 0;
while ($row = $result->fetch_assoc()) {
  $cart_items[] = $row;
  $total_price += $row['price'] * $row['quantity'];
}
