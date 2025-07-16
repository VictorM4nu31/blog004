<?= $this->extend('layouts/main') ?>
<?= $this->section('content') ?>
<?php if (session('errors')): ?>
    <div class="bg-red-100 text-red-800 p-2 mb-4 rounded">
        <ul class="list-disc pl-5">
            <?php foreach (session('errors') as $error): ?>
                <li><?= esc($error) ?></li>
            <?php endforeach; ?>
        </ul>
    </div>
<?php endif; ?>
<h1 class="text-2xl font-bold mb-6">Editar Artículo</h1>
<form action="/admin/posts/update/<?= $post['id'] ?>" method="post" class="bg-white p-6 rounded shadow max-w-xl mx-auto">
    <div class="mb-4">
        <label class="block mb-1 font-semibold">Título</label>
        <input type="text" name="title" class="w-full border px-3 py-2 rounded" value="<?= old('title', $post['title']) ?>" required>
    </div>
    <div class="mb-4">
        <label class="block mb-1 font-semibold">Contenido</label>
        <textarea name="content" class="w-full border px-3 py-2 rounded h-32" required><?= old('content', $post['content']) ?></textarea>
    </div>
    <div class="mb-4">
        <label class="block mb-1 font-semibold">Imagen (URL)</label>
        <input type="text" name="image" class="w-full border px-3 py-2 rounded" value="<?= old('image', $post['image']) ?>">
    </div>
    <div class="mb-4">
        <label class="block mb-1 font-semibold">Categoría</label>
        <select name="category_id" class="w-full border px-3 py-2 rounded" required>
            <option value="">Selecciona una categoría</option>
            <?php foreach ($categories as $cat): ?>
                <option value="<?= $cat['id'] ?>" <?= old('category_id', $post['category_id']) == $cat['id'] ? 'selected' : '' ?>><?= esc($cat['name']) ?></option>
            <?php endforeach; ?>
        </select>
    </div>
    <div class="flex justify-end">
        <a href="/admin/posts" class="mr-4 text-gray-600 hover:underline">Cancelar</a>
        <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">Actualizar</button>
    </div>
</form>
<?= $this->endSection() ?> 