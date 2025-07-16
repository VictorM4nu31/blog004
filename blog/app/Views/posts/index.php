<?= $this->extend('layouts/main') ?>
<?= $this->section('content') ?>
<?php
use App\Models\CategoryModel;
$categoryModel = new CategoryModel();
$categoryMap = [];
foreach ($categoryModel->findAll() as $cat) {
    $categoryMap[$cat['id']] = $cat['name'];
}
?>
<!-- Header -->
<header class="bg-gray-800 text-white p-4 mb-6">
    <div class="container mx-auto flex justify-between items-center">
        <h1 class="text-2xl font-bold">Mini Blog</h1>
        <nav>
            <a href="/" class="mr-4 hover:underline">Inicio</a>
            <a href="/login" class="hover:underline">Admin</a>
        </nav>
    </div>
</header>

<!-- Main Content -->
<main class="container mx-auto px-4">
    <div class="grid gap-6 md:grid-cols-2 lg:grid-cols-3">
        <?php if (empty($posts)): ?>
            <div class="col-span-full text-center text-gray-500">No hay artículos publicados.</div>
        <?php else: ?>
            <?php foreach ($posts as $post): ?>
                <article class="bg-white rounded-lg shadow p-4 flex flex-col">
                    <?php if ($post['image']): ?>
                        <img src="<?= esc($post['image']) ?>" alt="<?= esc($post['title']) ?>" class="mb-3 rounded h-48 w-full object-cover">
                    <?php endif; ?>
                    <h2 class="text-xl font-semibold mb-2"><?= esc($post['title']) ?></h2>
                    <div class="text-sm text-gray-400 mb-2">Categoría: <?= esc($categoryMap[$post['category_id']] ?? 'Sin categoría') ?> | <?= date('d/m/Y', strtotime($post['created_at'])) ?></div>
                    <p class="flex-1 text-gray-700 mb-4"> <?= esc(substr($post['content'], 0, 120)) ?>...</p>
                    <a href="#" class="text-blue-600 hover:underline mt-auto">Leer más</a>
                </article>
            <?php endforeach; ?>
        <?php endif; ?>
    </div>
    <!-- Botón Load More -->
    <div class="flex justify-center mt-8">
        <button class="bg-blue-600 text-white px-6 py-2 rounded hover:bg-blue-700 transition">Load more articles</button>
    </div>
</main>

<!-- Footer -->
<footer class="bg-gray-900 text-gray-300 mt-12 p-4 text-center">
    Mini Blog &copy; <?= date('Y') ?>. Todos los derechos reservados.
</footer>
<?= $this->endSection() ?> 