<?php
$BASE_URL = "http://localhost/native/views";
$BASE = "http://localhost/native";
$host = "localhost";
$user = "root";
$pass = "";
$dbname = "zerovaa_db";

$conn = mysqli_connect($host, $user, $pass, $dbname);

if (!$conn) {
  die("Koneksi gagal: " . mysqli_connect_error());
}
