<?php
require_once '../../config/init.php';

$query = "SELECT * FROM categories ORDER BY name ASC";
$categories = mysqli_query($conn, $query);
