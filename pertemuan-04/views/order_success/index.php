<?php
require '../../includes/data/get_order.php';

$pageTitle = "Pesanan Berhasil";
ob_start();
?>

<h2 class="text-2xl font-bold text-green-600">✅ Pesanan Berhasil!</h2>
<p>Terima kasih telah berbelanja di Zenovaa. Detail pesanan Anda:</p>

<div class="mt-4 p-4 border rounded-lg shadow">
  <p><strong>ID Pesanan:</strong> <?= $order['id'] ?></p>
  <p><strong>Total Harga:</strong> Rp<?= number_format($order['total_price'], 0, ',', '.'); ?></p>
  <p><strong>Status:</strong> <?= ucfirst($order['status']); ?></p>
  <p><strong>Tanggal:</strong> <?= $order['created_at']; ?></p>

  <h3 class="text-lg font-semibold mt-4">🛒 Daftar Produk</h3>
  <ul>
    <?php foreach ($order_items as $item) : ?>
      <li><?= $item['name']; ?> (<?= $item['quantity']; ?>x) - Rp<?= number_format($item['price'], 0, ',', '.'); ?></li>
    <?php endforeach; ?>
  </ul>
</div>

<div class="mt-4">
  <a href="../home" class="bg-blue-500 text-white px-4 py-2 rounded">🏠 Kembali ke Beranda</a>
  <a href="../../controllers/orders/fetch_orders.php" class="bg-green-500 text-white px-4 py-2 rounded">📜 Lihat Riwayat Pesanan</a>
</div>

<?php
$content = ob_get_clean();
include '../../layout.php';
?>