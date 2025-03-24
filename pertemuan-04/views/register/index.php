<?php
$pageTitle = "Daftar";

require '../../config/init.php';
ob_start();
?>

<style type="text/tailwindcss">
  button {
    @apply bg-emerald-500 hover:bg-emerald-400 text-white font-semibold rounded px-4 py-1 w-min;
  }
</style>
<h1 class="text-xl font-bold"><a href="../home">Zerovaa</a></h1>

<h1>Daftar</h1>
<form action="../../controllers/auth/register_handler.php" method="POST" class="flex flex-col w-min gap-1">
  <label for="name">Nama:</label>
  <input type="text" id="name" name="name" class="border" required>

  <label for="email">Email:</label>
  <input type="email" id="email" name="email" class="border" required>

  <label for="password">Password:</label>
  <input type="password" id="password" name="password" class="border" required>

  <button type="submit">Daftar</button>
</form>
<p>Sudah punya akun? <a href="../login">Masuk di sini</a></p>

<?php
$content = ob_get_clean();

include '../../layout.php';
?>