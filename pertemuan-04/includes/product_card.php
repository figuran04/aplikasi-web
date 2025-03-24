<?php foreach ($products as $product) : ?>
  <a href="../product_detail?id=<?= $product['id']; ?>" class="cursor-pointer w-full shadow rounded-lg overflow-hidden">
    <img src="../../uploads/<?= $product['image']; ?>" class="w-full h-40 aspect-square object-cover">
    <div class="p-2 w-max">
      <h3 class="text-lg font-semibold mt-1 line-clamp-2"><?= $product['name']; ?></h3>
      <p class="text-gray-500"><?= $product['category'] ?: 'Tanpa Kategori'; ?></p>
      <p class="text-emerald-500 font-bold">Rp<?= number_format($product['price'], 0, ',', '.'); ?></p>
    </div>
  </a>
<?php endforeach; ?>