<header class="bg-emerald-100 py-4 px-8 flex justify-between items-center sticky top-0 shadow gap-8">
  <ul class="flex gap-8 items-center">
    <li>
      <h1 class="text-xl font-bold"><a href="../home">Zerovaa</a></h1>
    </li>
    <li>
      <a href="../categories">Kategori</a>
    </li>
  </ul>

  <input type="text" placeholder="Cari produk..." class="w-full max-w-xs py-2 px-4 bg-gray-100 rounded-full outline-emerald-200">

  <nav>
    <ul class="flex gap-8 items-center flex-nowrap">
      <?php if (isset($_SESSION['user_id'])) : ?>
        <li><a href="../../controllers/orders/fetch_orders.php">Riwayat Order</a></li>
        <li><a href="../cart">Keranjang</a></li>
        <li><a href="../profile">Profil</a></li>
      <?php else : ?>
        <li><a href="../login">Masuk</a></li>
        <li><a href="../register">Daftar</a></li>
      <?php endif; ?>
    </ul>
  </nav>
</header>