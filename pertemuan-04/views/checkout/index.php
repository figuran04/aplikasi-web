<?php
require_once '../../config/init.php';
$pageTitle = "Checkout";
include '../../includes/data/get_checkout_items.php';
if (empty($cart_items)) {
  header("Location: ../cart?error=empty_cart");
  exit;
}
ob_start();
?>

<h2 class="text-2xl font-bold mb-4">Checkout</h2>

<form action="../../controllers/orders/process_order.php" method="POST">
  <ul>
    <?php foreach ($cart_items as $item) : ?>
      <li>
        <strong><?= htmlspecialchars($item['name']); ?></strong> - <?= $item['quantity']; ?> x Rp<?= number_format($item['price'], 0, ',', '.'); ?>
      </li>
    <?php endforeach; ?>
  </ul>

  <p class="font-bold mt-4">Total Harga: Rp<?= number_format($total_price, 0, ',', '.'); ?></p>

  <button type="submit" class="block bg-blue-500 text-white text-center py-2 px-4 rounded mt-4">Bayar Sekarang</button>
</form>

<?php
$content = ob_get_clean();
include '../../layout.php';
?>