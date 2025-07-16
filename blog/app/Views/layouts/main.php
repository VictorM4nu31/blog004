<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <title><?= esc($title ?? 'Blog') ?></title>
  <link rel="stylesheet" href="<?= base_url('assets/css/styles.css') ?>">
</head>
<body>
  <?= $this->renderSection('content') ?>
</body>
</html>
