<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title><?= esc($title ?? 'Autenticación - Blog') ?></title>
  <link rel="stylesheet" href="<?= base_url('assets/css/styles.css') ?>">
</head>
<body class="bg-gray-50">
  <main>
    <?= $this->renderSection('content') ?>
  </main>
</body>
</html>
