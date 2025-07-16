<!-- Mensajes -->
<?php if (session('message')): ?>
    <div class="bg-green-100 text-green-800 p-2 mb-4 rounded"> <?= session('message') ?> </div>
<?php endif; ?>
<?php if (session('error')): ?>
    <div class="bg-red-100 text-red-800 p-2 mb-4 rounded"> <?= session('error') ?> </div>
<?php endif; ?>

<div class="flex justify-between items-center mb-6">
    <h1 class="text-2xl font-bold">Categorías</h1>
    <a href="/admin/categories/create" class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">Nueva Categoría</a>
</div>

<table class="min-w-full bg-white rounded shadow">
    <thead>
        <tr>
            <th class="py-2 px-4 border-b">ID</th>
            <th class="py-2 px-4 border-b">Nombre</th>
            <th class="py-2 px-4 border-b">Acciones</th>
        </tr>
    </thead>
    <tbody>
        <?php if (empty($categories)): ?>
            <tr><td colspan="3" class="text-center py-4">No hay categorías.</td></tr>
        <?php else: ?>
            <?php foreach ($categories as $category): ?>
                <tr>
                    <td class="py-2 px-4 border-b"> <?= esc($category['id']) ?> </td>
                    <td class="py-2 px-4 border-b"> <?= esc($category['name']) ?> </td>
                    <td class="py-2 px-4 border-b">
                        <a href="/admin/categories/edit/<?= $category['id'] ?>" class="text-blue-600 hover:underline mr-2">Editar</a>
                        <a href="/admin/categories/delete/<?= $category['id'] ?>" class="text-red-600 hover:underline" onclick="return confirm('¿Eliminar esta categoría?')">Eliminar</a>
                    </td>
                </tr>
            <?php endforeach; ?>
        <?php endif; ?>
    </tbody>
</table> 