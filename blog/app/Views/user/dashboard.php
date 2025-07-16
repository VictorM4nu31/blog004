<?= $this->extend('layouts/main') ?>
<?= $this->section('content') ?>

<div class="container mx-auto px-4 py-8">
    <div class="flex justify-between items-center mb-6">
        <h1 class="text-3xl font-bold text-gray-800">Dashboard de Usuario</h1>
        <div class="flex items-center space-x-4">
            <span class="text-gray-600">Bienvenido, <?= auth()->user()->username ?>!</span>
            <a href="<?= route_to('logout') ?>" class="bg-red-600 text-white px-4 py-2 rounded hover:bg-red-700">Cerrar Sesión</a>
        </div>
    </div>
    
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
        <?php foreach ($posts as $post): ?>
            <div class="bg-white rounded-lg shadow-md overflow-hidden">
                <?php if (!empty($post['image'])): ?>
                    <img src="<?= esc($post['image']) ?>" alt="<?= esc($post['title']) ?>" class="w-full h-48 object-cover">
                <?php endif; ?>
                <div class="p-6">
                    <h2 class="text-xl font-bold mb-2"><?= esc($post['title']) ?></h2>
                    <p class="text-gray-600 mb-2"><?= esc($categoryMap[$post['category_id']] ?? 'Sin categoría') ?></p>
                    <p class="text-gray-700 mb-4"><?= esc(substr($post['content'], 0, 100)) ?>...</p>
                    <div class="flex justify-between items-center">
                        <span class="text-sm text-gray-500"><?= date('d/m/Y', strtotime($post['created_at'])) ?></span>
                        <button class="text-blue-600 hover:underline" onclick="openModal('<?= $post['id'] ?>')">
                            Leer más
                        </button>
                    </div>
                </div>
            </div>
        <?php endforeach; ?>
    </div>
    
    <?php if (empty($posts)): ?>
        <div class="text-center py-12">
            <p class="text-gray-500 text-lg">No hay artículos disponibles.</p>
        </div>
    <?php endif; ?>
</div>

<!-- Modal para mostrar contenido completo -->
<div id="postModal" class="fixed inset-0 bg-black bg-opacity-50 hidden z-50">
    <div class="flex items-center justify-center min-h-screen p-4">
        <div class="bg-white rounded-lg max-w-2xl w-full max-h-screen overflow-y-auto">
            <div class="p-6">
                <div class="flex justify-between items-center mb-4">
                    <h2 id="modalTitle" class="text-2xl font-bold"></h2>
                    <button onclick="closeModal()" class="text-gray-500 hover:text-gray-700">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                        </svg>
                    </button>
                </div>
                <div id="modalContent" class="prose max-w-none"></div>
            </div>
        </div>
    </div>
</div>

<script>
const posts = <?= json_encode($posts) ?>;
const categoryMap = <?= json_encode($categoryMap) ?>;

function openModal(postId) {
    const post = posts.find(p => p.id == postId);
    if (post) {
        document.getElementById('modalTitle').textContent = post.title;
        document.getElementById('modalContent').innerHTML = `
            <p><strong>Categoría:</strong> ${categoryMap[post.category_id] || 'Sin categoría'}</p>
            <p><strong>Fecha:</strong> ${new Date(post.created_at).toLocaleDateString()}</p>
            <div class="mt-4">${post.content}</div>
        `;
        document.getElementById('postModal').classList.remove('hidden');
    }
}

function closeModal() {
    document.getElementById('postModal').classList.add('hidden');
}
</script>

<?= $this->endSection() ?>
