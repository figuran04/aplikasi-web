<?php
require '../../config/init.php';

$query = "SELECT p.id, p.name, p.description, p.price, p.stock, p.image, c.name AS category
          FROM products p
          LEFT JOIN categories c ON p.category_id = c.id
          ORDER BY p.created_at DESC";
$result = mysqli_query($conn, $query);
