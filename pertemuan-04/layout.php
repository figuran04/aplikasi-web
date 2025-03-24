<?php
if (session_status() === PHP_SESSION_NONE) {
  session_start();
}
$currentPath = trim($_SERVER['REQUEST_URI'], '/');
$hideHeaderFooter = preg_match('#views/(login|register)#', $currentPath);

?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title><?php echo isset($pageTitle) ? $pageTitle . " | Zerovaa" : "Zerovaa"; ?></title>
  <script src="https://unpkg.com/@tailwindcss/browser@4"></script>
  <script src="https://unpkg.com/@phosphor-icons/web@2.1.1"></script>
  <link rel="stylesheet" href="<?= $BASE_URL; ?>/global.css">
</head>

<body>

  <?php if (!$hideHeaderFooter) include 'includes/header.php'; ?>

  <main class="container mx-auto p-4 flex flex-col gap-4 min-h-screen">
    <?= isset($content) ? $content : '<p>Konten tidak ditemukan.</p>'; ?>
  </main>

  <?php if (!$hideHeaderFooter) include 'includes/footer.php'; ?>

</body>

</html>