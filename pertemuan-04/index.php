<?php
include 'db.php';

$sql = "SELECT * FROM produk";
$stmt = $pdo->query($sql);
$produk = $stmt->fetchAll();
include './includes/header.php';
$pageTitle = 'Daftar Produk';
?>
<h1 class="text-3xl font-bold mb-4"><?= $pageTitle; ?></h1>

<a href="create.php" class="flex font-semibold items-center inline-block px-4 py-2 bg-blue-500 text-white rounded-md hover:bg-blue-600 mb-4">
  <i class="ph-bold ph-plus"></i> Tambah Produk
</a>

<table class="min-w-full table-auto bg-white border border-gray-300 rounded-md shadow-sm">
  <thead>
    <tr class="bg-gray-200">
      <th class="px-4 py-2 text-left">No</th>
      <th class="px-4 py-2 text-left">Nama</th>
      <th class="px-4 py-2 text-left">Deskripsi</th>
      <th class="px-4 py-2 text-left">Harga</th>
      <th class="px-4 py-2 text-left">Aksi</th>
    </tr>
  </thead>
  <tbody>
    <?php foreach ($produk as $index => $item): ?>
      <tr class="hover:bg-gray-50">
        <td class="px-4 py-2"><?= $index + 1; ?></td> <!-- ID menjadi urutan -->
        <td class="px-4 py-2"><?= $item['nama']; ?></td>
        <td class="px-4 py-2"><?= $item['deskripsi']; ?></td>
        <td class="px-4 py-2"><?= number_format($item['harga'], 2, ',', '.'); ?></td>
        <td class="px-4 py-2 flex gap-1">
          <a href="update.php?id=<?= $item['id']; ?>" class="px-4 py-2 bg-yellow-500 text-white font-semibold rounded-md hover:bg-yellow-600">
            <i class="ph-bold ph-pencil-simple"></i> Edit
          </a>
          <a href="delete.php?id=<?= $item['id']; ?>" class="px-4 py-2 bg-red-500 text-white font-semibold rounded-md hover:bg-red-600">
            <i class="ph-bold ph-trash"></i> Hapus
          </a>
        </td>
      </tr>
    <?php endforeach; ?>
  </tbody>
</table>
<?php include './includes/footer.php'; ?>