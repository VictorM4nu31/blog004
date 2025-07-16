<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title><?= esc($title ?? 'Blog') ?></title>
  <link rel="stylesheet" href="<?= base_url('assets/css/styles.css') ?>">
</head>
<body class="bg-gray-50">
  <?php helper('auth'); ?>
  <?= view('Auth/_navbar', ['user' => auth()->user()]) ?>
  <main>
    <?= $this->renderSection('content') ?>
  </main>
</body>
</html>
