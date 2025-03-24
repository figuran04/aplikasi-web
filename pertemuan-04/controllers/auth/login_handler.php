<?php
require '../../config/init.php';

if ($_SERVER["REQUEST_METHOD"] === "POST") {
  $email = filter_var(trim($_POST['email']), FILTER_SANITIZE_EMAIL);
  $password = trim($_POST['password']);

  if (empty($email) || empty($password)) {
    $_SESSION['error'] = "Email dan password wajib diisi!";
    header("Location: ../../views/login");
    exit;
  }

  $query = "SELECT id, name, email, password FROM users WHERE email = ?";
  $stmt = $conn->prepare($query);
  $stmt->bind_param("s", $email);
  $stmt->execute();
  $result = $stmt->get_result();
  $user = $result->fetch_assoc();

  if ($user && password_verify($password, $user['password'])) {
    $_SESSION['user_id'] = $user['id'];
    $_SESSION['user_name'] = htmlspecialchars($user['name']);
    $_SESSION['user_email'] = htmlspecialchars($user['email']);

    header("Location: ../../views/home");
    exit;
  } else {
    $_SESSION['error'] = "Email atau password salah!";
    header("Location: ../../views/login");
    exit;
  }
}
