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
    <form action="/admin/categories/update/<?= $category['id'] ?>" method="post" class="space-y-6">
      <div>
        <label class="block mb-1 font-semibold text-blue-700">Nombre</label>
        <input type="text" name="name" class="w-full border-2 border-blue-300 px-3 py-2 rounded focus:border-blue-500 focus:ring-2 focus:ring-blue-200 transition" required value="<?= old('name', $category['name']) ?>">
      </div>
      <div class="flex justify-end gap-4">
        <a href="/admin/categories" class="bg-gray-200 text-gray-700 px-5 py-2 rounded-full hover:bg-gray-300 transition font-semibold shadow">Cancelar</a>
        <button type="submit" class="bg-blue-600 text-white px-6 py-2 rounded-full hover:bg-blue-700 transition font-semibold shadow">Actualizar</button>
      </div>
    </form>
  </div>
</div>
<?= $this->endSection() ?> 