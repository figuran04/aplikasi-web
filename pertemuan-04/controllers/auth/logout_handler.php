<?php
session_start(); // Pastikan session dimulai sebelum menghapusnya

// Hapus semua variabel session
$_SESSION = [];

// Hancurkan session
session_destroy();

// Hapus cookie session jika ada
if (ini_get("session.use_cookies")) {
  $params = session_get_cookie_params();
  setcookie(
    session_name(),
    '',
    time() - 42000,
    $params["path"],
    $params["domain"],
    $params["secure"],
    $params["httponly"]
  );
}

// Redirect ke halaman login
header("Location: ../../views/login");
exit;
