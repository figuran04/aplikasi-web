<?php
$pageTitle = "Beranda";
require '../../controllers/products/products_controller.php';
ob_start();
?>

<style type='text/tailwindcss'>
  .product-grid{
    @apply grid grid-cols-2 md:grid-cols-4 lg:grid-cols-5 xl:grid-cols-6 gap-4;
  }
  h2 {
    font-size: larger;
    font-weight: bold;
  }
</style>

<h2>Produk Terlaris</h2>
<div class="product-grid">
  <?php include '../../includes/product_card.php'; ?>
</div>
<div class="w-full text-center">
  <a href="../products">Lihat Semua</a>
</div>

<?php
$content = ob_get_clean();
include '../../layout.php';
?>