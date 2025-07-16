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
<h1 class="text-2xl font-bold mb-6">Nueva Categoría</h1>
<form action="/admin/categories/store" method="post" class="bg-white p-6 rounded shadow max-w-xl mx-auto">
    <div class="mb-4">
        <label class="block mb-1 font-semibold">Nombre</label>
        <input type="text" name="name" class="w-full border px-3 py-2 rounded" required value="<?= old('name') ?>">
    </div>
    <div class="flex justify-end">
        <a href="/admin/categories" class="mr-4 text-gray-600 hover:underline">Cancelar</a>
        <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">Guardar</button>
    </div>
</form>
<?= $this->endSection() ?> 