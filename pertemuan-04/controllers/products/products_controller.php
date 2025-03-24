<?php
require_once '../../config/init.php';

$categoryFilter = "";
$pageTitle = "Semua Produk";

if (isset($_GET['category']) && is_numeric($_GET['category'])) {
  $categoryID = $_GET['category'];
  $stmt = $conn->prepare("SELECT name FROM categories WHERE id = ?");
  $stmt->bind_param("i", $categoryID);
  $stmt->execute();
  $categoryResult = $stmt->get_result();
  $category = $categoryResult->fetch_assoc();

  if ($category) {
    $pageTitle = "Kategori: " . htmlspecialchars($category['name']);
    $categoryFilter = "WHERE p.category_id = ?";
  }
}

// Ambil daftar kategori
$categoryQuery = "SELECT * FROM categories ORDER BY name ASC";
$categoriesResult = $conn->query($categoryQuery);

// Ambil daftar produk
$query = "SELECT p.id, p.name, p.price, p.image, c.name AS category 
          FROM products p 
          LEFT JOIN categories c ON p.category_id = c.id 
          $categoryFilter
          ORDER BY p.created_at DESC";

$stmt = $conn->prepare($query);
if ($categoryFilter !== "") {
  $stmt->bind_param("i", $categoryID);
}
$stmt->execute();
$result = $stmt->get_result();

$products = $result->fetch_all(MYSQLI_ASSOC);
