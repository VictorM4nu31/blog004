<?= $this->extend('layouts/main') ?>
<?= $this->section('content') ?>
<div class="max-w-xl mx-auto mt-10">
  <div class="bg-gradient-to-r from-blue-50 to-green-50 rounded-xl shadow-xl p-8">
    <h1 class="text-3xl font-bold mb-6 text-blue-700">Editar Artículo</h1>
    <?php if (session('errors')): ?>
      <div class="bg-red-100 text-red-800 p-2 mb-4 rounded shadow">
        <ul class="list-disc pl-5">
          <?php foreach (session('errors') as $error): ?>
            <li><?= esc($error) ?></li>
          <?php endforeach; ?>
        </ul>
      </div>
    <?php endif; ?>
    <form action="/admin/posts/update/<?= $post['id'] ?>" method="post" class="space-y-6">
      <div>
        <label class="block mb-1 font-semibold text-blue-700">Título</label>
        <input type="text" name="title" class="w-full border-2 border-blue-300 px-3 py-2 rounded focus:border-blue-500 focus:ring-2 focus:ring-blue-200 transition" value="<?= old('title', $post['title']) ?>" required>
      </div>
      <div>
        <label class="block mb-1 font-semibold text-blue-700">Contenido</label>
        <textarea name="content" class="w-full border-2 border-blue-300 px-3 py-2 rounded h-32 focus:border-blue-500 focus:ring-2 focus:ring-blue-200 transition" required><?= old('content', $post['content']) ?></textarea>
      </div>
      <div>
        <label class="block mb-1 font-semibold text-blue-700">Imagen (URL)</label>
        <input type="text" name="image" class="w-full border-2 border-blue-300 px-3 py-2 rounded focus:border-blue-500 focus:ring-2 focus:ring-blue-200 transition" value="<?= old('image', $post['image']) ?>">
      </div>
      <div>
        <label class="block mb-1 font-semibold text-blue-700">Categoría</label>
        <select name="category_id" class="w-full border-2 border-blue-300 px-3 py-2 rounded focus:border-blue-500 focus:ring-2 focus:ring-blue-200 transition" required>
          <option value="">Selecciona una categoría</option>
          <?php foreach ($categories as $cat): ?>
            <option value="<?= $cat['id'] ?>" <?= old('category_id', $post['category_id']) == $cat['id'] ? 'selected' : '' ?>><?= esc($cat['name']) ?></option>
          <?php endforeach; ?>
        </select>
      </div>
      <div class="flex justify-end gap-4">
        <a href="/admin/posts" class="bg-gray-200 text-gray-700 px-5 py-2 rounded-full hover:bg-gray-300 transition font-semibold shadow">Cancelar</a>
        <button type="submit" class="bg-blue-600 text-white px-6 py-2 rounded-full hover:bg-blue-700 transition font-semibold shadow">Actualizar</button>
      </div>
    </form>
  </div>
</div>
<?= $this->endSection() ?> 