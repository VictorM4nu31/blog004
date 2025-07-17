<?= $this->extend('layouts/main') ?>
<?= $this->section('content') ?>


<h1 class="text-4xl md:text-5xl font-bold text-center my-12">Gestión de Categorías</h1>

<?php if (session('message')): ?>
    <div class="bg-green-100 text-green-800 p-2 mb-4 rounded max-w-2xl mx-auto text-center shadow"> <?= session('message') ?> </div>
<?php endif; ?>
<?php if (session('error')): ?>
    <div class="bg-red-100 text-red-800 p-2 mb-4 rounded max-w-2xl mx-auto text-center shadow"> <?= session('error') ?> </div>
<?php endif; ?>

<div class="flex justify-center mb-8">
  <a href="/admin/categories/create" class="bg-blue-600 text-white px-6 py-2 rounded-full hover:bg-blue-700 transition font-semibold shadow">Nueva Categoría</a>
</div>

<div class="max-w-4xl mx-auto grid grid-cols-1 md:grid-cols-2 gap-6" id="categoriesGrid">
  <?php if (empty($categories)): ?>
    <div class="col-span-full text-center text-gray-500 text-lg">No hay categorías.</div>
  <?php else: ?>
    <?php foreach ($categories as $category): ?>
      <div class="bg-white rounded-xl shadow-lg p-6 flex flex-col gap-2 border-t-4 border-blue-400 data-category-id="<?= $category['id'] ?>">
        <span class="text-2xl font-bold text-blue-700 mb-2 flex items-center gap-2">
          <span class="inline-block bg-blue-100 text-blue-700 px-3 py-1 rounded-full text-sm font-semibold">#<?= esc($category['id']) ?></span>
          <?= esc($category['name']) ?>
        </span>
        <div class="flex gap-2 mt-4">
          <a href="/admin/categories/edit/<?= $category['id'] ?>" class="bg-yellow-400 text-white px-4 py-1 rounded-full hover:bg-yellow-500 transition font-semibold shadow">Editar</a>
          <button onclick="confirmDeleteCategory(<?= $category['id'] ?>)" class="bg-red-500 text-white px-4 py-1 rounded-full hover:bg-red-600 transition font-semibold shadow">Eliminar</button>
        </div>
      </div>
    <?php endforeach; ?>
  <?php endif; ?>
</div>

<footer class="flex justify-between items-center max-w-4xl mx-auto py-6 text-gray-500 mt-16">
  <span>BlogLogo</span>
  <span class="flex gap-4">
    <a href="#" aria-label="Facebook"><svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24"><path d="M22 12c0-5.522-4.477-10-10-10S2 6.478 2 12c0 5.019 3.676 9.163 8.438 9.877v-6.987h-2.54v-2.89h2.54V9.797c0-2.506 1.492-3.89 3.777-3.89 1.094 0 2.238.195 2.238.195v2.46h-1.26c-1.242 0-1.632.771-1.632 1.562v1.875h2.773l-.443 2.89h-2.33v6.987C18.324 21.163 22 17.019 22 12z"/></svg></a>
    <a href="#" aria-label="Instagram"><svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24"><path d="M7.75 2h8.5A5.75 5.75 0 0 1 22 7.75v8.5A5.75 5.75 0 0 1 16.25 22h-8.5A5.75 5.75 0 0 1 2 16.25v-8.5A5.75 5.75 0 0 1 7.75 2zm0 1.5A4.25 4.25 0 0 0 3.5 7.75v8.5A4.25 4.25 0 0 0 7.75 20.5h8.5A4.25 4.25 0 0 0 20.5 16.25v-8.5A4.25 4.25 0 0 0 16.25 3.5h-8.5zm4.25 2.25a6 6 0 1 1 0 12 6 6 0 0 1 0-12zm0 1.5a4.5 4.5 0 1 0 0 9 4.5 4.5 0 0 0 0-9zm6.25 1.25a1 1 0 1 1-2 0 1 1 0 0 1 2 0z"/></svg></a>
    <a href="#" aria-label="X"><svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24"><path d="M17.53 6.47a.75.75 0 0 1 0 1.06L13.06 12l4.47 4.47a.75.75 0 1 1-1.06 1.06L12 13.06l-4.47 4.47a.75.75 0 0 1-1.06-1.06L10.94 12 6.47 7.53a.75.75 0 1 1 1.06-1.06L12 10.94l4.47-4.47a.75.75 0 0 1 1.06 0z"/></svg></a>
  </span>
</footer>

<script>
// Función para mostrar notificaciones
function showNotification(message, type = 'success') {
    const notification = document.createElement('div');
    notification.className = `fixed top-4 right-4 p-4 rounded-lg shadow-lg z-50 ${type === 'success' ? 'bg-green-50 text-white' : 'bg-red-50 text-white'}`;
    notification.textContent = message;
    
    document.body.appendChild(notification);
    
    // Auto-remover después de 3 segundos
    setTimeout(() => {
        notification.remove();
    }, 3000);
}

// Función para eliminar categoría con AJAX
async function confirmDeleteCategory(categoryId) {
    if (confirm('¿Eliminar esta categoría?')) {
        try {
            const response = await fetch(`/admin/categories/delete/${categoryId}`, {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-Requested-With': 'XMLHttpRequest'
                }
            });
            
            const data = await response.json();
            
            if (response.ok && data.success) {
                // Eliminar el elemento del DOM
                const categoryElement = document.querySelector(`[data-category-id="${categoryId}"]`);
                if (categoryElement) {
                    categoryElement.remove();
                    showNotification('Categoría eliminada exitosamente', 'success');
                }
                
                // Si no quedan categorías, mostrar mensaje
                const remainingCategories = document.querySelectorAll('[data-category-id]');
                if (remainingCategories.length === 0) {
                    const grid = document.getElementById('categoriesGrid');
                    grid.innerHTML = '<div class="col-span-full text-center text-gray-500 text-lg">No hay categorías.</div>';
                }
            } else {
                showNotification(data.message || 'Error al eliminar la categoría', 'error');
            }
        } catch (error) {
            console.error(error);
            showNotification('Error al eliminar la categoría', 'error');
        }
    }
}
</script>

<?= $this->endSection() ?> 