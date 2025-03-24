<?php
require_once '../../config/init.php';
$pageTitle = "Daftar Produk";
require '../../controllers/products/products_controller.php';
ob_start();
?>


<div class="flex gap-4">
  <a href="../products"
    class="border rounded px-4 py-1 border-gray-200">
    Semua
  </a>
  <?php while ($category = mysqli_fetch_assoc($categoriesResult)) : ?>
    <a href="../products?category=<?= $category['id'] ?>"
      class="border rounded px-4 py-1 border-gray-200">
      <?= $category['name']; ?>
    </a>
  <?php endwhile; ?>
</div>
<h2><?= $pageTitle; ?></h2>
<div class="grid grid-cols-2 md:grid-cols-4 lg:grid-cols-5 xl:grid-cols-6 gap-4">
  <?php include '../../includes/product_card.php'; ?>
</div>

<?php
$content = ob_get_clean();

include '../../layout.php';
?>