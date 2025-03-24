<?php
require '../../config/init.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
  $name = trim($_POST['name']);
  $email = trim($_POST['email']);
  $password = password_hash($_POST['password'], PASSWORD_BCRYPT);

  $query = "INSERT INTO users (name, email, password) VALUES (?, ?, ?)";
  $stmt = $conn->prepare($query);
  $stmt->bind_param("sss", $name, $email, $password);

  if ($stmt->execute()) {
    $_SESSION['success'] = "Akun berhasil dibuat! Silakan login.";
    header("Location: ../../views/login");
    exit;
  } else {
    $_SESSION['error'] = "Gagal mendaftar, coba lagi.";
    header("Location: ../../views/register");
    exit;
  }
}
