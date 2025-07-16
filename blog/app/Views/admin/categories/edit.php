<?= $this->extend('layouts/main') ?>
<?= $this->section('content') ?>
<div class="max-w-xl mx-auto mt-10">
  <div class="bg-gradient-to-r from-blue-50 to-green-50 rounded-xl shadow-xl p-8">
    <h1 class="text-3xl font-bold mb-6 text-blue-700">Editar Categoría</h1>
    <?php if (session('errors')): ?>
      <div class="bg-red-100 text-red-800 p-2 mb-4 rounded shadow">
        <ul class="list-disc pl-5">
          <?php foreach (session('errors') as $error): ?>
            <li><?= esc($error) ?></li>
          <?php endforeach; ?>
        </ul>
      </div>
    <?php endif; ?>
    <form action="/admin/categories/update/<?= $category['id'] ?>" method="post" enctype="multipart/form-data" class="space-y-6">
      <div>
        <label class="block mb-1 font-semibold text-blue-700">Nombre</label>
        <input type="text" name="name" class="w-full border-2 border-blue-300 px-3 py-2 rounded focus:border-blue-500 focus:ring-2 focus:ring-blue-200 transition" required value="<?= old('name', $category['name']) ?>">
      </div>
      <div>
        <label class="block mb-1 font-semibold text-blue-700">Imagen</label>
        <?php if (!empty($category['image'])): ?>
          <div class="mb-3">
            <img src="/writable/<?= esc($category['image']) ?>" alt="Imagen actual" class="w-32 h-32 object-cover rounded-lg border-2 border-blue-300">
            <p class="text-sm text-gray-600 mt-1">Imagen actual</p>
          </div>
        <?php endif; ?>
        <input type="file" name="image" accept="image/*" class="w-full border-2 border-blue-300 px-3 py-2 rounded focus:border-blue-500 focus:ring-2 focus:ring-blue-200 transition file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-sm file:font-semibold file:bg-blue-50 file:text-blue-700 hover:file:bg-blue-100">
        <p class="text-sm text-gray-600 mt-1">Formatos permitidos: JPG, PNG, GIF. Tamaño máximo: 5MB. Deja vacío para mantener la imagen actual.</p>
      </div>
      <div class="flex justify-end gap-4">
        <a href="/admin/categories" class="bg-gray-200 text-gray-700 px-5 py-2 rounded-full hover:bg-gray-300 transition font-semibold shadow">Cancelar</a>
        <button type="submit" class="bg-blue-600 text-white px-6 py-2 rounded-full hover:bg-blue-700 transition font-semibold shadow">Actualizar</button>
      </div>
    </form>
  </div>
</div>
<?= $this->endSection() ?> 