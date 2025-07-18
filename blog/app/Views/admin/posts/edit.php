<?= $this->extend('layouts/main') ?>
<?= $this->section('content') ?>
<div class="max-w-xl mx-auto mt-10">
  <div class="bg-gradient-to-r from-blue-50 to-green-50 rounded-xl shadow-xl p-8">
    <h1 class="text-3xl font-bold mb-6 text-blue-700">Editar Post</h1>
    <?php if (session('errors')): ?>
      <div class="bg-red-100 text-red-800 p-2 mb-4 rounded shadow">
        <ul class="list-disc pl-5">
          <?php foreach (session('errors') as $error): ?>
            <li><?= esc($error) ?></li>
          <?php endforeach; ?>
        </ul>
      </div>
    <?php endif; ?>
    <form id="postEditForm" method="post" action="/admin/posts/update/<?= $post['id'] ?>" enctype="multipart/form-data" class="space-y-6">
      <div>
        <label class="block mb-1 font-semibold text-blue-700">Título</label>
        <input type="text" name="title" id="title" class="w-full border-2 border-blue-300 px-3 py-2 rounded focus:border-blue-500 focus:ring-2 focus:ring-blue-200 transition" value="<?= old('title', $post['title']) ?>" required>
        <div id="title-error" class="text-red-500 text-sm mt-1 hidden"></div>
      </div>
      <div>
        <label class="block mb-1 font-semibold text-blue-700">Contenido</label>
        <textarea name="content" id="content" class="w-full border-2 border-blue-300 px-3 py-2 rounded h-32 focus:border-blue-500 focus:ring-2 focus:ring-blue-200 transition" required><?= old('content', $post['content']) ?></textarea>
        <div id="content-error" class="text-red-500 text-sm mt-1 hidden"></div>
      </div>
      <div>
        <label class="block mb-1 font-semibold text-blue-700">Imagen</label>
        <?php if (!empty($post['image'])): ?>
          <div class="mb-3">
            <img src="/writable/<?= esc($post['image']) ?>" alt="Imagen actual" class="w-32 h-32 object-cover rounded-lg border-2 border-blue-300">
            <p class="text-sm text-gray-600 mt-1">Imagen actual</p>
          </div>
        <?php endif; ?>
        <input type="file" name="image" id="image" accept="image/*" class="w-full border-2 border-blue-300 px-3 py-2 rounded focus:border-blue-500 focus:ring-2 focus:ring-blue-200 transition file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-sm file:font-semibold file:bg-blue-50 file:text-blue-700 hover:file:bg-blue-100">
        <p class="text-sm text-gray-600 mt-1">Formatos permitidos: JPG, PNG, GIF. Tamaño máximo: 5MB. Deja vacío para mantener la imagen actual.</p>
        <div id="image-error" class="text-red-500 text-sm mt-1 hidden"></div>
      </div>
      <div>
        <label class="block mb-1 font-semibold text-blue-700">Categoría</label>
        <select name="category_id" id="category_id" class="w-full border-2 border-blue-300 px-3 py-2 rounded focus:border-blue-500 focus:ring-2 focus:ring-blue-200 transition" required>
          <option value="">Selecciona una categoría</option>
          <?php foreach ($categories as $cat): ?>
            <option value="<?= $cat['id'] ?>" <?= old('category_id', $post['category_id']) == $cat['id'] ? 'selected' : '' ?>><?= esc($cat['name']) ?></option>
          <?php endforeach; ?>
        </select>
        <div id="category-error" class="text-red-500 text-sm mt-1 hidden"></div>
      </div>
      <div class="flex justify-end gap-4">
        <a href="/admin/posts" class="bg-gray-200 text-gray-700 px-5 py-2 rounded-full hover:bg-gray-300 transition font-semibold shadow">Cancelar</a>
        <button type="submit" id="submitBtn" class="bg-blue-600 text-white px-6 py-2 rounded-full hover:bg-blue-700 transition font-semibold shadow disabled:bg-gray-400 disabled:cursor-not-allowed">Actualizar</button>
      </div>
    </form>
  </div>
</div>
<?= $this->endSection() ?>
<script>
const postForm = document.getElementById('postEditForm');
const title = document.getElementById('title');
const content = document.getElementById('content');
const category = document.getElementById('category_id');
const submitBtn = document.getElementById('submitBtn');

function validarCampos() {
    let valido = true;
    if (title.value.trim().length < 3) {
        valido = false;
    }
    if (content.value.trim().length < 10) {
        valido = false;
    }
    if (category.value === '') {
        valido = false;
    }
    submitBtn.disabled = !valido;
}

title.addEventListener('input', validarCampos);
content.addEventListener('input', validarCampos);
category.addEventListener('change', validarCampos);

document.addEventListener('DOMContentLoaded', function() {
    validarCampos();
});

// Envío del formulario con AJAX (opcional, puedes dejarlo o quitarlo si prefieres el submit normal)
postForm.addEventListener('submit', function(e) {
    // Si quieres usar AJAX, descomenta lo siguiente y ajusta según tu necesidad
    // e.preventDefault();
    // validarCampos();
    // if (submitBtn.disabled) return;
    // ...
    // Si prefieres el submit normal, puedes dejarlo vacío
});
</script>