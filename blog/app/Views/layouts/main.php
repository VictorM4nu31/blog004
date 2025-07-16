<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <title><?= esc($title ?? 'Blog') ?></title>
  <link rel="stylesheet" href="<?= base_url('assets/css/styles.css') ?>">
</head>
<body>
  <?php $auth = service('authentication'); ?>
  <?= view('Auth/_navbar', ['user' => $auth->user()]) ?>
  <main class="container mx-auto py-6">
    <?= view('Auth/_message_block') ?>
    <?= $this->renderSection('content') ?>
  </main>
</body>
</html>
