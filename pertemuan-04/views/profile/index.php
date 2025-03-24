<?php
require_once '../../controllers/profile/profile_controller.php';
$pageTitle = "Profil";
ob_start();
?>

<h2 class="text-2xl font-bold mb-4">Profil</h2>
<p>Selamat datang, <?= $_SESSION['user_name']; ?>!</p>

<h3 class="text-xl font-semibold mt-6">Produk yang Diunggah</h3>
<a href="../upload_product/" class="block bg-blue-500 text-white text-center py-2 px-4 rounded mt-4">
  Unggah Produk Baru
</a>

<div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-4 mt-4">
  <?php foreach ($products as $product) : ?>
    <div class="border p-2 rounded">
      <img src="../../uploads/<?= $product['image']; ?>" class="w-full h-40 object-cover">
      <h3 class="font-semibold"><?= $product['name']; ?></h3>
      <p class="text-gray-600">Rp<?= number_format($product['price'], 0, ',', '.'); ?></p>
      <p class="text-sm text-gray-500"><?= $product['stock']; ?> stok</p>
    </div>
  <?php endforeach; ?>
</div>

<a href="../../controllers/auth/logout_handler.php" class="text-red-500 w-min">Logout</a>

<?php
$content = ob_get_clean();
include '../../layout.php';
?>