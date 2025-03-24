<?php
require './config/init.php';
// if (file_exists(__DIR__ . $BASE_URL . '/home')) {
//   header("Location: $BASE_URL/home");
//   exit;
// } else {
//   die("Halaman home tidak ditemukan.");
// }
header("Location: views/home");
exit;
