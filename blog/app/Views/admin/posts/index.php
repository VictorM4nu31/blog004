<!-- Mensajes -->
<?php if (session('message')): ?>
    <div class="bg-green-100 text-green-800 p-2 mb-4 rounded"> <?= session('message') ?> </div>
<?php endif; ?>
<?php if (session('error')): ?>
    <div class="bg-red-100 text-red-800 p-2 mb-4 rounded"> <?= session('error') ?> </div>
<?php endif; ?>

<div class="flex justify-between items-center mb-6">
    <h1 class="text-2xl font-bold">Artículos</h1>
    <a href="/admin/posts/create" class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">Nuevo Artículo</a>
</div>

<table class="min-w-full bg-white rounded shadow">
    <thead>
        <tr>
            <th class="py-2 px-4 border-b">ID</th>
            <th class="py-2 px-4 border-b">Título</th>
            <th class="py-2 px-4 border-b">Categoría</th>
            <th class="py-2 px-4 border-b">Fecha</th>
            <th class="py-2 px-4 border-b">Acciones</th>
        </tr>
    </thead>
    <tbody>
        <?php if (empty($posts)): ?>
            <tr><td colspan="5" class="text-center py-4">No hay artículos.</td></tr>
        <?php else: ?>
            <?php foreach ($posts as $post): ?>
                <tr>
                    <td class="py-2 px-4 border-b"> <?= esc($post['id']) ?> </td>
                    <td class="py-2 px-4 border-b"> <?= esc($post['title']) ?> </td>
                    <td class="py-2 px-4 border-b"> <?= esc($categoryMap[$post['category_id']] ?? 'Sin categoría') ?> </td>
                    <td class="py-2 px-4 border-b"> <?= date('d/m/Y', strtotime($post['created_at'])) ?> </td>
                    <td class="py-2 px-4 border-b">
                        <a href="/admin/posts/edit/<?= $post['id'] ?>" class="text-blue-600 hover:underline mr-2">Editar</a>
                        <a href="/admin/posts/delete/<?= $post['id'] ?>" class="text-red-600 hover:underline" onclick="return confirm('¿Eliminar este artículo?')">Eliminar</a>
                    </td>
                </tr>
            <?php endforeach; ?>
        <?php endif; ?>
    </tbody>
</table> 