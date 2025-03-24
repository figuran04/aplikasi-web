<?php
require_once '../../config/init.php';
$pageTitle = "Masuk";
ob_start();
?>
<style type='text/tailwindcss'>
  button {
    @apply bg-emerald-500 hover:bg-emerald-400 text-white font-semibold rounded px-4 py-1 w-min;
  }
</style>

<h1 class="text-xl font-bold"><a href="../home">Zerovaa</a></h1>
<h2>Masuk</h2>
<?php if (isset($error)) : ?>
  <p style="color: red;"><?= $error; ?></p>
<?php endif; ?>
<form action="../../controllers/auth/login_handler.php" method="POST" class="flex flex-col w-min gap-1">
  <label for="email">Email:</label>
  <input type="email" id="email" name="email" class="border" required>

  <label for="password">Password:</label>
  <input type="password" id="password" name="password" class="border" required>

  <button type="submit">Masuk</button>
</form>
<p>Belum punya akun? <a href="../register">Daftar di sini</a></p>

<?php
$content = ob_get_clean();
include '../../layout.php';
?>