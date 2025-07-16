<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <title><?= esc($title ?? 'Blog') ?></title>
  <link rel="stylesheet" href="<?= base_url('assets/css/styles.css') ?>">
</head>
<body>
  <?php helper('auth'); ?>
  <?= view('Auth/_navbar', ['user' => auth()->user()]) ?>
  <main class="container mx-auto py-6">
  
    <?= $this->renderSection('content') ?>
  </main>
</body>
</html>
