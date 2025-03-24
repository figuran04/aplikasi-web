<?php
require_once '../../config/init.php';
$pageTitle = "Kategori Produk";
include '../../includes/data/get_categories.php';
ob_start();
?>

<h2 class="text-2xl font-bold mb-4">Kategori Produk</h2>
<div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-4">
  <?php while ($category = mysqli_fetch_assoc($categories)) : ?>
    <a href="../products?category=<?= $category['id'] ?>"
      class="block p-4 bg-gray-100 rounded-lg text-center font-semibold">
      <?= htmlspecialchars($category['name']); ?>
    </a>
  <?php endwhile; ?>
</div>

<?php
$content = ob_get_clean();
include '../../layout.php';
?>