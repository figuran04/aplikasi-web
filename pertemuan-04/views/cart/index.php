<?php
require '../../config/init.php';
$pageTitle = "Keranjang";
include '../../includes/cart_items.php';
ob_start();
?>

<h2 class="text-xl font-bold">Keranjang Belanja</h2>

<?php if ($result->num_rows > 0) : ?>
  <table class="w-full mt-4 border">
    <thead>
      <tr class="bg-gray-100">
        <th class="p-2">Produk</th>
        <th class="p-2">Harga</th>
        <th class="p-2">Jumlah</th>
        <th class="p-2">Total</th>
        <th class="p-2">Aksi</th>
      </tr>
    </thead>
    <tbody>
      <?php while ($cart = $result->fetch_assoc()) : ?>
        <tr>
          <td class="p-2">
            <img src="../../uploads/<?= $cart['image'] ?>" alt="<?= $cart['name'] ?>" class="w-20 aspect-square object-cover">
            <?= htmlspecialchars($cart['name']) ?>
          </td>
          <td class="p-2">Rp<?= number_format($cart['price'], 0, ',', '.') ?></td>
          <td class="p-2">
            <form action="../../controllers/cart/update_cart.php" method="POST" class="flex items-center">
              <input type="hidden" name="cart_id" value="<?= $cart['cart_id'] ?>">
              <input type="number" name="quantity" value="<?= $cart['quantity'] ?>" min="1" class="w-16 border rounded p-1 text-center">
              <button type="submit" class="ml-2 text-blue-500">Update</button>
            </form>
          </td>
          <td class="p-2">Rp<?= number_format($cart['price'] * $cart['quantity'], 0, ',', '.') ?></td>
          <td class="p-2">
            <a href="../../controllers/cart/remove_cart.php?cart_id=<?= $cart['cart_id'] ?>" class="text-red-500">Hapus</a>
          </td>
        </tr>
      <?php endwhile; ?>
    </tbody>
  </table>

  <a href="../checkout" class="block text-center bg-blue-500 text-white px-4 py-2 rounded mt-4">Lanjut ke Checkout</a>
<?php else : ?>
  <p class="text-gray-500 mt-4">Keranjang belanja Anda kosong.</p>
<?php endif; ?>

<?php
$content = ob_get_clean();
include '../../layout.php';
?>