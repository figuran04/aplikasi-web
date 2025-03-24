<?php

if (!isset($_SESSION['user_id'])) {
  header("Location: ../login");
  exit;
}

$user_id = $_SESSION['user_id'];

$query = "SELECT carts.id AS cart_id, products.id AS product_id, products.name, products.price, products.image, carts.quantity 
          FROM carts 
          JOIN products ON carts.product_id = products.id 
          WHERE carts.user_id = ?";
$stmt = $conn->prepare($query);
$stmt->bind_param("i", $user_id);
$stmt->execute();
$result = $stmt->get_result();
