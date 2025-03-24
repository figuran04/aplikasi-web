<?php
require '../../config/init.php';

$product = include '../../includes/data/get_product.php';

if (!$product) {
  $_SESSION['error'] = "Produk tidak ditemukan.";
  header("Location: ../products");
  exit;
}

$pageTitle = "Detail Produk";
ob_start();
?>

<div class="flex flex-col md:flex-row items-center gap-6 mt-6">
  <img src="../../uploads/<?= htmlspecialchars($product['image']); ?>"
    class="w-64 h-64 object-cover rounded shadow-md"
    alt="<?= htmlspecialchars($product['name']); ?>">

  <div>
    <h1 class="text-3xl font-bold"><?= htmlspecialchars($product['name']); ?></h1>
    <p class="text-gray-600"><?= htmlspecialchars($product['category']) ?: 'Tanpa Kategori'; ?></p>
    <p class="text-green-600 font-bold text-2xl">Rp<?= number_format($product['price'], 0, ',', '.'); ?></p>
    <p class="mt-4"><?= nl2br(htmlspecialchars($product['description'])); ?></p>
    <p class="mt-2 text-sm text-gray-500">Stok: <?= (int) $product['stock']; ?></p>
    <form action="../../controllers/cart/add_to_cart.php" method="POST" class="mt-4">
      <input type="hidden" name="product_id" value="<?= (int) $product['id']; ?>">
      <label for="quantity" class="block text-sm font-medium">Jumlah</label>
      <input type="number" name="quantity" id="quantity" value="1" min="1" max="<?= (int) $product['stock']; ?>" class="w-20 p-2 border rounded">
      <button type="submit" class="ml-2 px-4 py-2 bg-blue-500 text-white rounded">Masukkan ke Keranjang</button>
    </form>
  </div>
</div>

<?php
$content = ob_get_clean();
include '../../layout.php';
?>