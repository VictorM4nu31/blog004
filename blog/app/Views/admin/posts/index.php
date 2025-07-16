<?= $this->extend('layouts/main') ?>
<?= $this->section('content') ?>
<?php $user = auth()->user(); ?>
<div class="container mx-auto px-4 py-6">

<!-- Título central -->
<h1 class="text-4xl md:text-5xl font-bold text-center my-12">Gestión de Posts</h1>

<!-- Mensajes -->
<?php if (session('message')): ?>
    <div class="bg-green-100 text-green-800 p-2 mb-4 rounded max-w-2xl mx-auto text-center"> <?= session('message') ?> </div>
<?php endif; ?>
<?php if (session('error')): ?>
    <div class="bg-red-100 text-red-800 p-2 mb-4 rounded max-w-2xl mx-auto text-center"> <?= session('error') ?> </div>
<?php endif; ?>

<!-- Acciones principales -->
<div class="flex justify-center gap-4 mb-8">
  <?php if ($user && $user->can('blog.posts.create')): ?>
    <a href="/admin/posts/create" class="bg-blue-600 text-white px-6 py-2 rounded-full hover:bg-blue-700 transition font-semibold shadow">Nuevo Post</a>
  <?php endif; ?>
  <?php if ($user && $user->can('blog.categories.view')): ?>
    <a href="/admin/categories" class="bg-green-600 text-white px-6 py-2 rounded-full hover:bg-green-700 transition font-semibold shadow">Categorías</a>
  <?php endif; ?>
  <a href="<?= route_to('logout') ?>" class="bg-red-600 text-white px-6 py-2 rounded-full hover:bg-red-700 transition font-semibold shadow">Cerrar Sesión</a>
</div>

<!-- Grid de posts -->
<main class="max-w-6xl mx-auto px-4">
  <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
    <?php if (empty($posts)): ?>
      <div class="col-span-full text-center text-gray-500 text-lg">No hay posts.</div>
    <?php else: ?>
      <?php foreach ($posts as $post): ?>
        <article class="bg-white rounded-xl shadow-lg overflow-hidden flex flex-col">
          <?php if (!empty($categoryMap[$post['category_id']])): ?>
            <div class="h-2 w-full bg-gradient-to-r from-blue-500 to-green-400"></div>
          <?php endif; ?>
          <?php if (!empty($post['image'])): ?>
            <img src="/writable/<?= esc($post['image']) ?>" alt="<?= esc($post['title']) ?>" class="h-48 w-full object-cover">
          <?php else: ?>
            <div class="h-48 w-full bg-gray-100 flex items-center justify-center">
              <svg class="w-12 h-12 text-gray-400" fill="currentColor" viewBox="0 0 20 20">
                <path fill-rule="evenodd" d="M4 3a2 2 0 00-2 2v10a2 2 0 002 2h12a2 2 0 002-2V5a2 2 0 00-2-2H4zm12 12H4l4-8 3 6 2-4 3 6z" clip-rule="evenodd" />
              </svg>
            </div>
          <?php endif; ?>
          <div class="p-6 flex-1 flex flex-col">
            <h2 class="font-bold text-lg mb-1"><?= esc($post['title']) ?></h2>
            <div class="text-sm text-gray-500 mb-2">
              <?= esc($categoryMap[$post['category_id']] ?? 'Sin categoría') ?> · <?= date('F d, Y', strtotime($post['created_at'])) ?>
            </div>
            <p class="text-gray-700 flex-1 mb-4"> <?= esc(substr($post['content'], 0, 120)) ?>...</p>
            <div class="flex gap-2 mt-auto">
              <a href="/admin/posts/edit/<?= $post['id'] ?>" class="text-blue-600 hover:underline font-medium">Editar</a>
              <button onclick="confirmDelete(<?= $post['id'] ?>)" class="text-red-600 hover:underline font-medium">Eliminar</button>
            </div>
          </div>
        </article>
      <?php endforeach; ?>
    <?php endif; ?>
  </div>
</main>

<!-- Footer Moderno -->
<footer class="flex justify-between items-center max-w-4xl mx-auto py-6 text-gray-500 mt-16">
  <span>BlogLogo</span>
  <span class="flex gap-4">
    <a href="#" aria-label="Facebook"><svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24"><path d="M22 12c0-5.522-4.477-10-10-10S2 6.478 2 12c0 5.019 3.676 9.163 8.438 9.877v-6.987h-2.54v-2.89h2.54V9.797c0-2.506 1.492-3.89 3.777-3.89 1.094 0 2.238.195 2.238.195v2.46h-1.26c-1.242 0-1.632.771-1.632 1.562v1.875h2.773l-.443 2.89h-2.33v6.987C18.324 21.163 22 17.019 22 12z"/></svg></a>
    <a href="#" aria-label="Instagram"><svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24"><path d="M7.75 2h8.5A5.75 5.75 0 0 1 22 7.75v8.5A5.75 5.75 0 0 1 16.25 22h-8.5A5.75 5.75 0 0 1 2 16.25v-8.5A5.75 5.75 0 0 1 7.75 2zm0 1.5A4.25 4.25 0 0 0 3.5 7.75v8.5A4.25 4.25 0 0 0 7.75 20.5h8.5A4.25 4.25 0 0 0 20.5 16.25v-8.5A4.25 4.25 0 0 0 16.25 3.5h-8.5zm4.25 2.25a6 6 0 1 1 0 12 6 6 0 0 1 0-12zm0 1.5a4.5 4.5 0 1 0 0 9 4.5 4.5 0 0 0 0-9zm6.25 1.25a1 1 0 1 1-2 0 1 1 0 0 1 2 0z"/></svg></a>
    <a href="#" aria-label="X"><svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24"><path d="M17.53 6.47a.75.75 0 0 1 0 1.06L13.06 12l4.47 4.47a.75.75 0 1 1-1.06 1.06L12 13.06l-4.47 4.47a.75.75 0 0 1-1.06-1.06L10.94 12 6.47 7.53a.75.75 0 1 1 1.06-1.06L12 10.94l4.47-4.47a.75.75 0 0 1 1.06 0z"/></svg></a>
  </span>
</footer>

<script>
function confirmDelete(postId) {
  if (confirm('¿Eliminar este post?')) {
    window.location.href = '/admin/posts/delete/' + postId;
  }
}
</script>
</div>
<?= $this->endSection() ?>
