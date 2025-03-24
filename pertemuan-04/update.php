<?php
include 'db.php';

$id = $_GET['id'];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  $nama = $_POST['nama'];
  $deskripsi = $_POST['deskripsi'];
  $harga = $_POST['harga'];

  $sql = "UPDATE produk SET nama = ?, deskripsi = ?, harga = ? WHERE id = ?";
  $stmt = $pdo->prepare($sql);
  $stmt->execute([$nama, $deskripsi, $harga, $id]);

  header("Location: index.php");
}

$sql = "SELECT * FROM produk WHERE id = ?";
$stmt = $pdo->prepare($sql);
$stmt->execute([$id]);
$produk = $stmt->fetch();

include './includes/header.php';
$pageTitle = 'Edit Produk';
?>

<h1 class="text-3xl font-bold mb-6"><?= $pageTitle; ?></h1>

<form method="POST" class="bg-white p-6 rounded-lg shadow-md">
  <div class="mb-4">
    <label for="nama" class="block text-sm font-semibold text-gray-700">Nama Produk</label>
    <input type="text" id="nama" name="nama" value="<?php echo htmlspecialchars($produk['nama']); ?>"
      class="mt-1 block w-full px-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500" required>
  </div>

  <div class="mb-4">
    <label for="deskripsi" class="block text-sm font-semibold text-gray-700">Deskripsi</label>
    <textarea id="deskripsi" name="deskripsi"
      class="mt-1 block w-full px-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500"><?= htmlspecialchars($produk['deskripsi']); ?></textarea>
  </div>

  <div class="mb-4">
    <label for="harga" class="block text-sm font-semibold text-gray-700">Harga</label>
    <input type="number" id="harga" name="harga" value="<?php echo htmlspecialchars($produk['harga']); ?>"
      class="mt-1 block w-full px-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500" required>
  </div>

  <button type="submit" class="font-semibold w-full bg-blue-500 text-white py-2 rounded-md hover:bg-blue-600 focus:outline-none focus:ring-2 focus:ring-blue-500">
    Perbarui Produk
  </button>
</form>

<br>
<a href="index.php" class="text-blue-500 hover:text-blue-700">Kembali ke Daftar Produk</a>

<?php include './includes/footer.php'; ?>