<?php
require '../../config/init.php';

if (!isset($_SESSION['user_id'])) {
  header("Location: ../login");
  exit;
}

$user_id = $_SESSION['user_id'];
ob_start();
?>
<style type="text/tailwindcss">
  .form_upload{
    @apply flex flex-col gap-1 w-min;
  }
  .form_upload input, textarea {
    border: 1px solid black;
  }
</style>

<h2 class="text-2xl font-bold mb-4">Unggah Produk</h2>

<form action="../../controllers/products/process_upload_product.php" method="POST" enctype="multipart/form-data" class="form_upload">
  <label for="name">Nama Produk:</label>
  <input type="text" name="name" id="name" required>

  <label for="description">Deskripsi:</label>
  <textarea name="description" id="description" required></textarea>

  <label for="price">Harga:</label>
  <input type="number" name="price" id="price" required>

  <label for="stock">Stok:</label>
  <input type="number" name="stock" id="stock" required>

  <label for="category">Kategori:</label>
  <select name="category_id" id="category" required>
    <option value="">Pilih Kategori</option>
    <?php
    $result = $conn->query("SELECT id, name FROM categories");
    while ($row = $result->fetch_assoc()) {
      echo "<option value='{$row['id']}'>{$row['name']}</option>";
    }
    ?>
  </select>

  <label for="image">Gambar Produk:</label>
  <input type="file" name="image" id="image" accept="image/*" required>

  <button type="submit" class="bg-green-500 text-white py-2 px-4 rounded">Unggah</button>
</form>

<?php
$content = ob_get_clean();

include '../../layout.php';
?>